<?php

use Jenssegers\Blade\Blade;

include_once(HELPERS_PATH . 'GestorErrores.php');
include_once(HELPERS_PATH . 'form.php');
include_once(MODEL_PATH . 'BaseDatos.php');
include_once(MODEL_PATH . 'Usuario.php');
include_once(MODEL_PATH . 'Tareas.php');
include_once(CTRL_PATH . 'Controlador.php');

class C_Usuario
{
    protected $blade = null;
    protected $model = null;
    protected $usuario = null;
    protected $errores = null;
    protected $paginador = null;
    protected $tarea=null;

    public function __construct()
    {
        $this->model = new BaseDatos();
        $this->usuario = new Usuario();
        $this->tarea=new Tareas();
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
    public function ShowUsuarios()
    {
        if (Usuario::EsAdministrador()) {
            $registros = $this->usuario->getUsuarios();
            return $this->blade->render('lista_usuarios', ['usuarios' => $registros]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function ShowInsertarUsuario()
    {
        if (Usuario::EsAdministrador()) {
            return $this->blade->render('insertarUsuario', ['errores' => []]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function insertarUsuario()
    {
        if (Usuario::EsAdministrador()) {
            if (VPost('nombre') == '' || preg_match("/\d/", VPost('nombre')) || preg_match("/\W/", VPost('nombre'))) {
                $this->errores->AnotaError('nombreU', 'El campo Nombre no puede estar vacio o contener caracteres especiales');
            }
            if (VPost('apellidos') == '' || preg_match("/\d/", VPost('apellidos')) || preg_match("/\W/", VPost('apellidos'))) {
                $this->errores->AnotaError('apellidosU', 'El campo Apellidos no puede estar vacio o contener caracteres especiales');
            }
            if (VPost('pass') == '') {
                $this->errores->AnotaError('passU', 'El campo Contrasena no puede estar vacio');
            }

            //comprobamos si hay errores con una funcion del gestor de errores
            if ($this->errores->HayErrores()) {
                return $this->blade->render('insertarUsuario', ['errores' => $this->errores->ArrayErrores()]);
            } else {
                $this->usuario->insertarUsuario(VPost('nombre'), VPost('apellidos'), VPost('pass'), VPost('rol'));
                return $this->blade->render('menu_adm');
            }
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function modificarUsuario($id)
    {
        if (Usuario::EsAdministrador()) {
            $usuario = $this->usuario->getUsuario($id);
            return $this->blade->render('modificarUsuario', ['usuario' => $usuario, 'id' => $id, 'errores' => []]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function usuarioModificado()
    {
        if (Usuario::EsAdministrador()) {
            if (VPost('nombre') == '' || preg_match("/\d/", VPost('nombre')) || preg_match("/\W/", VPost('nombre'))) {
                $this->errores->AnotaError('nombreU', 'El campo Nombre no puede estar vacio o contener caracteres especiales');
            }
            if (VPost('apellidos') == '' || preg_match("/\d/", VPost('apellidos')) || preg_match("/\W/", VPost('apellidos'))) {
                $this->errores->AnotaError('apellidosU', 'El campo Apellidos no puede estar vacio o contener caracteres especiales');
            }
            if (VPost('pass') == '') {
                $this->errores->AnotaError('passU', 'El campo Contrasena no puede estar vacio');
            }
            $id = VPost('id');
            $usuario = [
                "nombre" => VPost('nombre'),
                "apellidos" => VPost('apellidos'),
                "pass" => VPost('pass'),
                "rol" => VPost('rol'),
            ];
            if ($this->errores->HayErrores()) {
                return $this->blade->render('modificarUsuario', ['usuario' => $usuario, 'id' => $id, 'errores' => $this->errores->ArrayErrores()]);
            } else {
                $this->usuario->modificarUsuario($id, $usuario['nombre'], $usuario['apellidos'], $usuario['pass'], $usuario['rol']);
                return $this->blade->render('menu_adm');
            }
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function eliminarUsuario($id)
    {
        if (Usuario::EsAdministrador()) {
            $this->usuario->eliminarUsuario($id);
            $registros = $this->usuario->getUsuarios();
            return $this->blade->render('lista_usuarios', ['usuarios' => $registros]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function showTablaOperarios()
    {
        if (!Usuario::EsAdministrador()) {
            // $registros = $this->tarea->getTareasOperario($id);
            // return $this->blade->render('lista_tareas_op', ['tareas' => $registros, 'id' => $id]);

            $totalTareas = intval($this->tarea->CantidadRegistrosOP($_SESSION["usuario"]["id_trabajador"]));
            $tareasPorPagina = 5;
            $id=$_SESSION["usuario"]["id_trabajador"];
            $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
            $desde = ($tareasPorPagina * $pagina) - $tareasPorPagina;
            $tareas = $this->tarea->RegistrosPaginadosOP($desde, $tareasPorPagina,$_SESSION["usuario"]["id_trabajador"]);
            if(empty($tareas)){
                $tareas=[];
            }
            return $this->blade->render('lista_tareas_op', compact(
                'totalTareas',
                'tareasPorPagina',
                'pagina',
                'desde',
                'tareas',
                'id'
            ));
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    public function showConfirmarEliminar(){
        
    }
}
