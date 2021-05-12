<?php
class Usuario{
    /**
     * Funcion para comprobar si el usuario y contraseña son correctos
     *
     * @param [int] $user_id
     * @param [string] $pass
     * @return void
     */
    public static function checkUser($user_id, $pass) //si devuelve true significa que el usuario y la contraseña son correctas
    {
        $con=BaseDatos::getInstance()->Conexion();
        if ($con->connect_errno) {
            return $con->connect_error;
        } else {
            $sql = "SELECT COUNT(*) AS encontrado FROM trabajadores WHERE id_trabajador='" . $user_id . "' AND pass ='" . $pass . "';";
            $resultado = $con->query($sql);
            //var_dump(mysqli_error( $con ));
            if ($resultado && $resultado->num_rows == 1) {
                $fila = $resultado->fetch_assoc();
                if ($fila["encontrado"] == '1') {
                    $usuario=Usuario::getUser($user_id);
                    $_SESSION["usuario"]=$usuario;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    /**
     * Devuelve un usuario pasandole por parametro el id correspondiente
     * 
     * @param [int] $id
     * @return void
     */
    public static function getUser($id){
        $con=BaseDatos::getInstance()->Conexion();
        $sql = "SELECT * FROM `trabajadores` WHERE `id_trabajador`='$id';";
        $resultado = $con->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    /**
     * Comprueba que el usuario este dentro de la sesion y si es administrador o no
     *
     * @return void
     */
    public static function EsAdministrador(){

        return self::EstaDentro() && $_SESSION["usuario"]["rol"]=='administrador';
    }
    /**
     * Comprueba si la variable de sesion contiene algun usuario
     *
     * @return void
     */
    public static function EstaDentro(){
        return isset($_SESSION['usuario']);
    }
    /**
     * Borrar el contenido del usuario en la variable de sesion
     *
     * @return void
     */
    public static function Logout(){
        //session_unset('usuario');
        unset($_SESSION['usuario']);
    }
    /**
     * Devuelve el usuario almacenado en la variable de sesion
     *
     * @return void
     */
    public static function Usuario(){
        return $_SESSION['usuario'];
    }
    /**
     * Comprueba si que el usuario no este dentro de la sesion para enviarlo de vuelta
     * a la pantalla de inicio
     *
     * @return void
     */
    public static function SalirSiNoDentro(){
        if (!Usuario::EstaDentro()) {
            header('Location: '.BASE_URL.'login');
            exit();
        }
    }
    /**
     * Devuelve todos un array con todos los usuarios
     *
     * @return void
     */
    public function getUsuarios(){
        $con=BaseDatos::getInstance()->Conexion();
        $sql = "SELECT * FROM trabajadores";
        $registros = [];
        $resultado = $con->query($sql) or die("Error->>" . mysqli_error($con));
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    /**
     * Funcion que inserta un usuario en la base de datos
     *
     * @param [string] $nombre
     * @param [string] $apellidos
     * @param [string] $pass
     * @param [string] $rol
     * @return void
     */
    public function insertarUsuario($nombre,$apellidos,$pass,$rol){
        $con=BaseDatos::getInstance()->Conexion();
        $sql = "INSERT INTO `trabajadores`( `pass`, `nombre`, `apellidos`, `rol`) VALUES ('$pass','$nombre','$apellidos','$rol');";
        $con->query($sql) or die("Error en algunos de los campos->>" . mysqli_error($con));
    }
    /**
     * Funcion para modificar los datos de un usario
     *
     * @param [int] $id
     * @param [string] $nombre
     * @param [string] $apellidos
     * @param [string] $pass
     * @param [string] $rol
     * @return void
     */
    public function modificarUsuario($id,$nombre,$apellidos,$pass,$rol){
        $con=BaseDatos::getInstance()->Conexion();
        $sql="UPDATE `trabajadores` SET `pass`='$pass',`nombre`='$nombre',`apellidos`='$apellidos',`rol`='$rol' WHERE `id_trabajador`='$id';";
        $con->query($sql) or die("Error->>" . mysqli_error($con));
    }
    /**
     * funcion que elimina un usuario pasando el id por parametro
     *
     * @param [int] $id
     * @return void
     */
    public function eliminarUsuario($id){
        $con=BaseDatos::getInstance()->Conexion();
        $sql = "DELETE FROM `trabajadores` where id_trabajador='$id';";
        $con->query($sql) or die("Error->>" . mysqli_error($con));
    }
    /**
     * Devuelve el rol de un usuario pasandole por parametro el id
     *
     * @param [int] $id
     * @return void
     */
    public function getRol($id){
        $con=BaseDatos::getInstance()->Conexion();
        $sql = "SELECT * FROM `trabajadores` where id_trabajador='$id';";
        $resultado = $con->query($sql) or die("Error->>" . mysqli_error($con));
        $registro=[];
        while ($fila = $resultado->fetch_assoc()) {
            array_push($registro, $fila);
        }
        return $registro;
    }
    /**
     * Funcion para actualizar la contraseña de los trabajadores
     *
     * @param [string] $pass
     * @param [int] $id
     * @return void
     */
    public function actualizarPass($pass,$id){
        $con=BaseDatos::getInstance()->Conexion();
        $sql="UPDATE `trabajadores` SET `pass`='$pass' WHERE `id_trabajador`='$id';";
        $con->query($sql) or die("Error->>" . mysqli_error($con));
    }
}
