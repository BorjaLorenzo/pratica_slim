<?php

use Jenssegers\Blade\Blade;

include_once(HELPERS_PATH . 'GestorErrores.php');
include_once(HELPERS_PATH . 'form.php');
include_once(MODEL_PATH . 'BaseDatos.php');
include_once(MODEL_PATH . 'Usuario.php');
include_once(MODEL_PATH . 'Tareas.php');

class Controlador
{
    protected $blade = null;
    protected $model = null;
    protected $tarea = null;
    protected $usuario = null;
    protected $errores = null;
    protected $paginador = null;
    

    public function __construct()
    {
        $this->model = new BaseDatos();
        $this->tarea = new Tareas();
        $this->usuario = new Usuario();
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
    /**
     * funcion que muestra el login
     *
     * @return void
     */
    public function verLogin()
    {
        return $this->blade->render('login');
    }
    /**
     * funcion que hace la comprobacion de usuarios en el login del inicio
     *
     * @return void
     */
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
    /**
     * Muestra el menu de administradores
     *
     * @return void
     */
    public function ShowMenuAdm()
    {
        if(Usuario::EsAdministrador()){
            return $this->blade->render('menu_adm');
        }else{
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
        
    }
    /**
     * Muestra el menu de operarios
     *
     * @return void
     */
    public function ShowMenuOP()
    {
        if(!Usuario::EsAdministrador()){
            return $this->blade->render('menu_op',['id'=>$_SESSION['usuario']['id_trabajador']]);
        }
        else{
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        } 
    }
    public function showConfiguracion($id_operario){
        if(Usuario::EsAdministrador()){
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
        else{
            return $this->blade->render('cambiarPass', [ 'id'=>$id_operario ,'errores'=>[]]);
        } 
        
    }
    /**
     * funcion que se encarga de cambiar la contrasena de los operarios
     *
     * @return void
     */
    public function cambiarPass(){
        if(Usuario::EsAdministrador()){
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
        else{
            if (VPost('pass1') == '' || VPost('pass2') == '') {
                $this->errores->AnotaError('pass', 'Ninguno de los campos pueden estar vacio');
            }
            if (VPost('pass1') != VPost('pass2')) {
                $this->errores->AnotaError('pass', 'Las contrasenas no coinciden');
            }
            if ($this->errores->HayErrores()) {
                return $this->blade->render('cambiarPass', ['errores' => $this->errores->ArrayErrores(), 'id'=>VPost('id')]);
            } else {
                $this->usuario->actualizarPass(VPost('pass1'),VPost('id'));
                return $this->blade->render('menu_op',['id'=>VPost('id')]);
            }
        } 
        
    }
    /**
     * funcion que se encarga de cerrar la sesion cuando un usuario cierre sesion
     *
     * @return void
     */
    public function cerrarSesion(){
        Usuario::Logout();
        return $this->blade->render('login');
    }
    /**
     * muestra la vista del buscador de administrador
     *
     * @return void
     */
    public function showBuscar(){
        if(Usuario::EsAdministrador()){
            return $this->blade->render('buscador',['errores'=>[]]);
        }
        else{
            
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        } 
        
    }
    /**
     * muestra la vista del buscador de operarios
     *
     * @return void
     */
    public function showBuscarOP(){
        if(Usuario::EsAdministrador()){
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
        else{
            return $this->blade->render('buscadorOP',['errores'=>[],'id'=>$_SESSION['usuario']['id_trabajador']]);
        } 
        
    }
    /**
     * funcion para buscar una tarea y devuelve la vista con las tareas encontradas
     * en funcion de si el usuario es un administrador o un operario
     *
     * @return void
     */
    public function Buscar(){
        $registros=Tareas::buscarTodo(VPost('op1'),VPost('vop1'),VPost('sop1'),VPost('op2'),VPost('vop2'),VPost('sop2'),VPost('op3'),VPost('vop3'),VPost('sop3'));
        $variables=[
            VPost('op1'),
            VPost('vop1'),
            VPost('sop1'),
            VPost('op2'),
            VPost('vop2'),
            VPost('sop2'),
            VPost('op3'),
            VPost('vop3'),
            VPost('sop3')
        ];
        if($_SESSION["usuario"]["rol"]=='operario'){
            return $this->blade->render('lista_buscar_op', ['tareas' => $registros,'id'=>$_SESSION["usuario"]["id_trabajador"],'variables'=>$variables]);
        }else{
            return $this->blade->render('lista_buscar', ['tareas' => $registros]);
        }
    }
}
