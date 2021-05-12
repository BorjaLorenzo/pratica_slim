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
    /**
     * funcion que muestra una vista con todos los usuarios registrados en la bbdd
     *
     * @return void
     */
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
    /**
     * funcion que muestra una vista para poder insertar un usuario
     *
     * @return void
     */
    public function ShowInsertarUsuario()
    {
        if (Usuario::EsAdministrador()) {
            return $this->blade->render('insertarUsuario', ['errores' => []]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    /**
     * funcion que filtra los errores del formulario e inserte un nuevo usuario en la bbdd
     *
     * @return void
     */
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
    /**
     * funcion a la que se le pasa por parametro el id de un usuario
     * y muestra una vista con todos sus valores en un formulario
     *
     * @param [int] $id
     * @return void
     */
    public function modificarUsuario($id)
    {
        if (Usuario::EsAdministrador()) {
            $usuario = Usuario::getUser($id);
            return $this->blade->render('modificarUsuario', ['usuario' => $usuario, 'id' => $id, 'errores' => []]);
        } else {
            Controlador::getInstance()->cerrarSesion();
            return $this->blade->render('login');
        }
    }
    /**
     * funcion que filtra los errores del formulario e inserta los cambios en del usuario en la bbdd
     *
     * @return void
     */
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
    /**
     * funcion que elimina un usuario pasandole su id por parametro
     *
     * @param [int] $id
     * @return void
     */
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
    /**
     * muestra un vista de comprobacion de que se desea eliminar un usuario
     *
     * @return void
     */
    public function showConfirmarEliminar(){
        $usuario=Usuario::getUser(VGet('id_trabajador'));
        return $this->blade->render('confirmar_usuario',['id'=>$usuario['id_trabajador'],'nombre'=> $usuario['nombre'] , 'apellidos'=>$usuario['apellidos']]);
    }
}
