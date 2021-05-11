<?php

use Jenssegers\Blade\Blade;

include_once(HELPERS_PATH . 'GestorErrores.php');
include_once(HELPERS_PATH . 'form.php');
include_once(MODEL_PATH . 'BaseDatos.php');
include_once(MODEL_PATH . 'Tareas.php');
include_once(CTRL_PATH . 'Controlador.php');

class C_Tareas
{
    protected $blade = null;
    protected $model = null;
    protected $tarea = null;
    protected $errores = null;
    protected $paginador = null;


    public function __construct()
    {
        $this->tarea = new Tareas();
        // El gestor solo sería necesario crearlo si editamos o insertamos
        // Inicializamos el gestor de errores que utilizaremos en la vista
        $this->errores = new GestorErrores(
            '<span style="color:red; background:#EEE; padding:.2em 1em; margin:1em">',
            '</span>'
        );
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }
    public static function getInstance()
    {
        return new self();
    }
    public function CheckTarea()
    {
        if (Usuario::EsAdministrador()) {
            if (VPost('nombre') == '' || preg_match("/\d/", VPost('nombre')) || preg_match("/\W/", VPost('nombre'))) {
                $this->errores->AnotaError('nombre', 'El campo Nombre no puede estar vacio o contener caracteres especiales');
            }
            if (VPost('apellidos') == '' || preg_match("/\d/", VPost('apellidos')) || preg_match("/\W/", VPost('apellidos'))) {
                $this->errores->AnotaError('apellidos', 'El campo Apellidos no puede estar vacio o contener caracteres especiales');
            }
            if (strlen(VPost('telefono')) > 9 || VPost('telefono') == '' || preg_match("/\D/", VPost('telefono')) || preg_match("/\W/", VPost('telefono'))) {
                $this->errores->AnotaError('telefono', 'Se debe introducir un numero de telefono correcto');
            }
            if (VPost('descripcion') == '') {
                $this->errores->AnotaError('descripcion', 'El campo Descripcion no puede estar vacio');
            }
            if (VPost('email') == '' || !filter_var(VPost('email'), FILTER_VALIDATE_EMAIL)) {
                $this->errores->AnotaError('email', 'El campo Email no tiene un formato valido');
            }
            if (VPost('poblacion') == '' || preg_match("/\d/", VPost('poblacion')) || preg_match("/\W/", VPost('poblacion'))) {
                $this->errores->AnotaError('poblacion', 'El campo Poblacion no tiene un formato valido');
            }
            if (VPost('codigoPostal') == '' || !filter_var(VPost('codigoPostal'), FILTER_VALIDATE_INT) || strlen(VPost('codigoPostal')) > 5) {
                $this->errores->AnotaError('codigoPostal', 'El campo codigoPostal no puede contener caracteres no numericos o ser mayor de 5 digitos');
            }
            if (VPost('provincia') == '') {
                $this->errores->AnotaError('provincia', 'El campo provincia no puede estar vacio');
            }
            if (VPost('direccion') == '') {
                $this->errores->AnotaError('direccion', 'El campo direccion no puede estar vacio');
            }
            if (VPost('operarioEncargado') == '' || preg_match("/\D/", VPost('operarioEncargado')) || preg_match("/\W/", VPost('operarioEncargado'))) {
                $this->errores->AnotaError('operarioEncargado', 'El campo Operario Encargado solo puede contener el numero ID del Operario');
            }
            if (VPost('anotacionesANT') == '') {
                $this->errores->AnotaError('anotacionesANT', 'El campo de Anotaciones Anteriores no puede estar vacio');
            }

            //comprobamos si hay errores con una funcion del gestor de errores
            if ($this->errores->HayErrores()) {
                return $this->blade->render('tareas_error', ['errores' => $this->errores->ArrayErrores()]);
            } else {
                $this->tarea->insertarTablaTarea(VPost('operarioEncargado'), VPost('nombre'), VPost('apellidos'), VPost('telefono'), VPost('descripcion'), VPost('email'), VPost('direccion'), VPost('poblacion'), VPost('codigoPostal'), VPost('provincia'), VPost('estado'), VPost('anotacionesANT'));
                return $this->blade->render('tarea_insertada');
            }
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function ShowTabla()
    {
        if (Usuario::EsAdministrador()) {
            //$registros = $this->tarea->getArrayRegistrosTablaTarea();
            $totalTareas = intval($this->tarea->CantidadRegistros());
            $tareasPorPagina = 5;
            $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
            $desde = ($tareasPorPagina * $pagina) - $tareasPorPagina;
            $tareas = $this->tarea->RegistrosPaginados($desde, $tareasPorPagina);
            return $this->blade->render('lista_tareas', compact(
                'totalTareas',
                'tareasPorPagina',
                'pagina',
                'desde',
                'tareas'
            ));
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function ShowInsertarTarea()
    {
        if (Usuario::EsAdministrador()) {
            return $this->blade->render('tareas');
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function MenuBorrar()
    {
        if (Usuario::EsAdministrador()) {
            return $this->blade->render('menu_borrar_tarea', ['exito' => '']);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function borrarTarea($id)
    {
        if (Usuario::EsAdministrador()) {
            $this->tarea->BorrarTarea($id);
            header('Location:tablaTareas');
            exit;
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function modificarTarea($test)
    {
        if (Usuario::EsAdministrador()) {
            $tarea = $this->tarea->getTarea($test);
            return $this->blade->render('menu_modificar_tarea', ['tarea' => $tarea, 'id' => $test, 'errores' => []]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function tareamodificada()
    {
        if (Usuario::EsAdministrador()) {
            if (VPost('nombre') == '' || preg_match("/\d/", VPost('nombre')) || preg_match("/\W/", VPost('nombre'))) {
                $this->errores->AnotaError('nombre', 'El campo Nombre no puede estar vacio o contener caracteres especiales');
            }
            if (VPost('apellidos') == '' || preg_match("/\d/", VPost('apellidos')) || preg_match("/\W/", VPost('apellidos'))) {
                $this->errores->AnotaError('apellidos', 'El campo Apellidos no puede estar vacio o contener caracteres especiales');
            }
            if (strlen(VPost('telefono')) > 9 || VPost('telefono') == '' || preg_match("/\D/", VPost('telefono')) || preg_match("/\W/", VPost('telefono'))) {
                $this->errores->AnotaError('telefono', 'Se debe introducir un numero de telefono correcto');
            }
            if (VPost('descripcion') == '') {
                $this->errores->AnotaError('descripcion', 'El campo Descripcion no puede estar vacio');
            }
            if (VPost('email') == '' || !filter_var(VPost('email'), FILTER_VALIDATE_EMAIL)) {
                $this->errores->AnotaError('email', 'El campo Email no tiene un formato valido');
            }
            if (VPost('poblacion') == '' || preg_match("/\d/", VPost('poblacion')) || preg_match("/\W/", VPost('poblacion'))) {
                $this->errores->AnotaError('poblacion', 'El campo Poblacion no tiene un formato valido');
            }
            if (VPost('codigoPostal') == '' || !filter_var(VPost('codigoPostal'), FILTER_VALIDATE_INT) || strlen(VPost('codigoPostal')) > 5) {
                $this->errores->AnotaError('codigoPostal', 'El campo codigoPostal no puede contener caracteres no numericos o ser mayor de 5 digitos');
            }
            if (VPost('provincia') == '') {
                $this->errores->AnotaError('provincia', 'El campo provincia no puede estar vacio');
            }
            if (VPost('direccion') == '') {
                $this->errores->AnotaError('direccion', 'El campo direccion no puede estar vacio');
            }
            if (VPost('operarioEncargado') == '' || preg_match("/\D/", VPost('operarioEncargado')) || preg_match("/\W/", VPost('operarioEncargado'))) {
                $this->errores->AnotaError('operarioEncargado', 'El campo Operario Encargado solo puede contener el numero ID del Operario');
            }
            if (VPost('anotacionesPOST') == '') {
                $this->errores->AnotaError('anotacionesPOST', 'El campo de Anotaciones Posteriores no puede estar vacio');
            }
            $tarea = [
                "id" => VPost('id'),
                "nombre_contacto" => VPost('nombre'),
                "apellidos_contacto" => VPost('apellidos'),
                "telefono" => VPost('telefono'),
                "descripcion" => VPost('descripcion'),
                "email" => VPost('email'),
                "poblacion" => VPost('poblacion'),
                "codigo_postal" => VPost('codigoPostal'),
                "provincia" => VPost('provincia'),
                "direccion" => VPost('direccion'),
                "id_operario" => VPost('operarioEncargado'),
                "anotaciones_POST" => VPost('anotacionesPOST'),
                "estado" => VPost('estado')
            ];

            //comprobamos si hay errores con una funcion del gestor de errores
            if ($this->errores->HayErrores()) {
                return $this->blade->render('menu_modificar_tarea', ['tarea' => $tarea, 'id' => $tarea['id'], 'errores' => $this->errores->ArrayErrores()]);
            } else {
                $this->tarea->ModificarTarea($tarea['id'], $tarea['id_operario'], $tarea['nombre_contacto'], $tarea['apellidos_contacto'], $tarea['telefono'], $tarea['descripcion'], $tarea['email'], $tarea['direccion'], $tarea['poblacion'], $tarea['codigo_postal'], $tarea['provincia'], $tarea['estado'], $tarea['anotaciones_POST'],);
                return $this->blade->render('menu_adm');
            }
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function realizarTarea($id, $op)
    {
        if (Usuario::EsAdministrador()) {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        } else {
            $this->tarea->actualizarEstado("Realizada", $id);
            header('Location:tablaTareasOperario');
            exit;
        }
    }
    public function realizarTareaBuscar($id)
    {
        if (Usuario::EsAdministrador()) {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        } else {
            $this->tarea->actualizarEstado("Realizada", $id);
            return $this->blade->render('buscadorOP', ['id' => $_SESSION['usuario']['id_trabajador'], 'errores'=>[]]);
        }
    }
    public function cancelarTarea($id, $op)
    {
        if (Usuario::EsAdministrador()) {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        } else {
            $this->tarea->actualizarEstado("Cancelada", $id);
            header('Location:tablaTareasOperario');
            exit;
        }
    }
    public function cancelarTareaBuscar($id)
    {
        if (Usuario::EsAdministrador()) {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        } else {
            $this->tarea->actualizarEstado("Cancelada", $id);  
            return $this->blade->render('buscadorOP', ['errores'=>[], 'id' => $_SESSION["usuario"]["id_trabajador"]]);
        }
    }
    public function ShowConfirmar()
    {
        return $this->blade->render('confirmar_eliminar', ['id_tarea' => $_GET['id_tarea']]);
    }
}
