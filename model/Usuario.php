<?php
class Usuario{
    public static function checkUser($user_id, $pass) //si devuelve true significa que el usuario y la contraseña son correctas
    {
        $con=BaseDatos::getInstance()->Conexion();
        if ($con->connect_errno) {
            return $con->connect_error;
        } else {
            $sql = "SELECT COUNT(*) AS encontrado FROM trabajadores WHERE id_trabajador='" . $user_id . "' AND pass ='" . $pass . "';";
            $resultado = $con->query($sql);
            //var_dump(mysqli_error( $this->con ));
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
    public static function getUser($id){
        $con=BaseDatos::getInstance()->Conexion();
        $sql = "SELECT * FROM `trabajadores` WHERE `id_trabajador`=" . $id . ";";
        $resultado = $con->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    public static function EsAdministrador(){

        return self::EstaDentro() && $_SESSION["usuario"]["rol"]=='administrador';
    }
    public static function EstaDentro(){
        return isset($_SESSION['usuario']);
    }
    public static function Logout(){
        //session_unset('usuario');
        unset($_SESSION['usuario']);
    }
    public static function Usuario(){
        return $_SESSION['usuario'];
    }
    public static function SalirSiNoDentro(){
        if (!Usuario::EstaDentro()) {
            header('Location: '.BASE_URL.'login');
            exit();
        }
    }
}
