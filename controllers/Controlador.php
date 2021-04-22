<?php

use Jenssegers\Blade\Blade;

include_once(HELPERS_PATH . 'GestorErrores.php');
include_once(HELPERS_PATH . 'form.php');
include_once(MODEL_PATH . 'BaseDatos.php');
include_once(MODEL_PATH . 'Usuario.php');

class Controlador
{
    protected $blade = null;
    protected $model = null;
    protected $errores = null;
    protected $paginador = null;
    

    public function __construct()
    {
        $this->model = new BaseDatos();

        // El gestor solo sería necesario crearlo si editamos o insertamos
        // Inicializamos el gestor de errores que utilizaremos en la vista
        $this->errores = new GestorErrores(
            '<span style="color:red; background:#EEE; padding:.2em 1em; margin:1em">',
            '</span>'
        );
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }
    public function verLogin()
    {
        return $this->blade->render('login');
    }
    public function CheckLogin()
    {
        if (!$_POST) {
            return $this->blade->render('login');
        } else if (!Usuario::checkUser($_POST['usuario_inicio'], $_POST['pass'])) {
            //Usuario clave incorrecto
            return $this->blade->render('login_error', ['descripcion_error' => 'El usuario o contraseña son incorrectos prueba de nuevo']);
        } else {
            //Usuario dentro
            if (Usuario::EsAdministrador()) {
                return $this->blade->render('menu_adm');
            } else {
                return $this->blade->render('menu_op',['id'=>Usuario::Usuario()["id_trabajador"]]);
            }
        }
    }
    public function CheckTarea()
    {
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
            $this->model->insertarTablaTarea(VPost('operarioEncargado'), VPost('nombre'), VPost('apellidos'), VPost('telefono'), VPost('descripcion'), VPost('email'), VPost('direccion'), VPost('poblacion'), VPost('codigoPostal'), VPost('provincia'), VPost('estado'), VPost('anotacionesANT'));
            return $this->blade->render('tarea_insertada');
        }
    }
    public function ShowTabla()
    {
        $registros = $this->model->getArrayRegistrosTablaTarea();
        return $this->blade->render('lista_tareas', ['tareas' => $registros]);
    }
    public function ShowMenuAdm()
    {
        return $this->blade->render('menu_adm');
    }
    public function ShowMenuOP($id)
    {
        return $this->blade->render('menu_op',['id'=>$id]);
    }
    public function ShowInsertarTarea()
    {
        return $this->blade->render('tareas');
    }
    public static function getInstance()
    {
        return new self();
    }
    public function MenuBorrar()
    {
        return $this->blade->render('menu_borrar_tarea', ['exito' => '']);
    }
    public function borrarTarea($id)
    {
        $this->model->BorrarTarea($id);
        $registros = $this->model->getArrayRegistrosTablaTarea();
        return $this->blade->render('lista_tareas', ['tareas' => $registros]);
    }
    public function modificarTarea($test)
    {
        $tarea = $this->model->getTarea($test);
        return $this->blade->render('menu_modificar_tarea', ['tarea' => $tarea, 'id' => $test, 'errores'=>[] ]);
    }
    public function tareamodificada()
    {
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
            return $this->blade->render('menu_modificar_tarea', ['tarea' => $tarea, 'id' => $tarea['id'],'errores' => $this->errores->ArrayErrores()]);
        } else {
            $this->model->ModificarTarea($tarea['id'],$tarea['id_operario'],$tarea['nombre_contacto'],$tarea['apellidos_contacto'],$tarea['telefono'],$tarea['descripcion'],$tarea['email'],$tarea['direccion'],$tarea['poblacion'],$tarea['codigo_postal'],$tarea['provincia'],$tarea['estado'],$tarea['anotaciones_POST'],);
            return $this->blade->render('menu_adm');
        }
        
    }
    public function ShowUsuarios(){
        $registros = $this->model->getUsuarios();
        return $this->blade->render('lista_usuarios', ['usuarios' => $registros]);
    }
    public function ShowInsertarUsuario(){
        return $this->blade->render('insertarUsuario', ['errores' => []]);
    }
    public function insertarUsuario(){
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
            $this->model->insertarUsuario(VPost('nombre'), VPost('apellidos'), VPost('pass'), VPost('rol'));
            return $this->blade->render('menu_adm');
        }
    }
    public function modificarUsuario($id){
        $usuario = $this->model->getUsuario($id);
        return $this->blade->render('modificarUsuario', ['usuario' => $usuario, 'id' => $id,'errores' =>[]]);
    }
    public function usuarioModificado(){
        if (VPost('nombre') == '' || preg_match("/\d/", VPost('nombre')) || preg_match("/\W/", VPost('nombre'))) {
            $this->errores->AnotaError('nombreU', 'El campo Nombre no puede estar vacio o contener caracteres especiales');
        }
        if (VPost('apellidos') == '' || preg_match("/\d/", VPost('apellidos')) || preg_match("/\W/", VPost('apellidos'))) {
            $this->errores->AnotaError('apellidosU', 'El campo Apellidos no puede estar vacio o contener caracteres especiales');
        }
        if (VPost('pass') == '') {
            $this->errores->AnotaError('passU', 'El campo Contrasena no puede estar vacio');
        }
        $id=VPost('id');
        $usuario = [
            "nombre" => VPost('nombre'),
            "apellidos" => VPost('apellidos'),
            "pass" => VPost('pass'),
            "rol" => VPost('rol'),
        ];
        if ($this->errores->HayErrores()) {
            return $this->blade->render('modificarUsuario', ['usuario' => $usuario,'id' => $id,'errores' => $this->errores->ArrayErrores()]);
        } else {
            $this->model->modificarUsuario($id,$usuario['nombre'],$usuario['apellidos'],$usuario['pass'],$usuario['rol']);
            return $this->blade->render('menu_adm');
        }
        
    }
    public function eliminarUsuario($id){
        $this->model->eliminarUsuario($id);
        $registros = $this->model->getUsuarios();
        return $this->blade->render('lista_usuarios', ['usuarios' => $registros]);
    }
    public function showTablaOperarios($id){
        $registros=$this->model->getTareasOperario($id);
        return $this->blade->render('lista_tareas_op', ['tareas' => $registros , 'id'=>$id]);
    }
    public function realizarTarea($id,$op){
        $this->model->actualizarEstado("Realizada",$id);
        $registros=$this->model->getTareasOperario($op);
        return $this->blade->render('lista_tareas_op', ['tareas' => $registros , 'id'=>$op]);
    }
    public function cancelarTarea($id,$op){
        $this->model->actualizarEstado("Cancelada",$id);
        $registros=$this->model->getTareasOperario($op);
        return $this->blade->render('lista_tareas_op', ['tareas' => $registros , 'id'=>$op]);
    }
    public function showConfiguracion($id_operario){
        return $this->blade->render('cambiarPass', [ 'id'=>$id_operario ,'errores'=>[]]);
    }
    public function cambiarPass(){
        if (VPost('pass1') == '' || VPost('pass2') == '') {
            $this->errores->AnotaError('pass', 'Ninguno de los campos pueden estar vacio');
        }
        if (VPost('pass1') != VPost('pass2')) {
            $this->errores->AnotaError('pass', 'Las contrasenas no coinciden');
        }
        if ($this->errores->HayErrores()) {
            return $this->blade->render('cambiarPass', ['errores' => $this->errores->ArrayErrores(), 'id'=>VPost('id')]);
        } else {
            $this->model->actualizarPass(VPost('pass1'),VPost('id'));
            return $this->blade->render('menu_op',['id'=>VPost('id')]);
        }
    }
    public function cerrarSesion(){
        Usuario::Logout();
        return $this->blade->render('login');
    }
}
