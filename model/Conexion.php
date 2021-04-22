<?php

class Conexion
{
    protected $servername = null;
    protected $database = null;
    protected $username = null;
    protected $password = null;
    protected $con = null;

    function __construct()
    {
        $this->servername = "localhost";
        $this->database = "desatranques";
        $this->username = "root";
        $this->password = "";
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
    }
    public static function getInstance()
    {
        return new self();
    }

    public function insertarTablaTarea($id_operario, $nombre, $apellidos, $telefono, $descripcion, $email, $direccion, $poblacion, $codigoPostal, $provincia, $estado, $anotaciones_ANT)
    {
        $hoy = getdate();
        $fecha_actual = "" . $hoy['mday'] . "/" . $hoy['mon'] . "/" . $hoy['year'];
        $sql = "INSERT INTO `tareas`(`id_operario`, `nombre_contacto`, `apellidos_contacto`, `telefono`, `descripcion`, `email`, `direccion`, `poblacion`, `codigo_postal`, `provincia`, `estado`, `fecha_creacion`, `fecha_realizacion`, `anotaciones_ANT`, `anotaciones_POST`) VALUES ('" . $id_operario . "','" . $nombre . "','" . $apellidos . "','" . $telefono . "','" . $descripcion . "','" . $email . "','" . $direccion . "','" . $poblacion . "','" . $codigoPostal . "','" . $provincia . "','" . $estado . "','" . $fecha_actual . "','" . "- - -" . "','" . $anotaciones_ANT . "','" . "- - -" . "');";

        $this->con->query($sql) or die("Error en algunos de los campos->>" . mysqli_error($this->con));
    }
    public function getArrayRegistrosTablaTarea()
    {
        $sql = "SELECT * FROM tareas";
        $registros = [];
        $resultado = $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    public function checkUser($user_id, $pass) //si devuelve true significa que el usuario y la contraseña son correctas
    {
        if ($this->con->connect_errno) {
            return $this->con->connect_error;
        } else {
            $sql = "SELECT COUNT(*) AS encontrado FROM trabajadores WHERE id_trabajador='" . $user_id . "' AND pass ='" . $pass . "';";
            $resultado = $this->con->query($sql);
            //var_dump(mysqli_error( $this->con ));
            if ($resultado && $resultado->num_rows == 1) {
                $fila = $resultado->fetch_assoc();
                if ($fila["encontrado"] == '1') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    public function CantidadRegistros()
    {
        if ($this->con->connect_errno) {
            return $this->con->connect_error;
        } else {
            $sql = "SELECT COUNT(*) AS total FROM tareas ";
            $resultado = $this->con->query($sql);
            if ($resultado->num_rows == 0) {
                return 0;
            } else {
                $fila = $resultado->fetch_assoc();
                return $fila["total"];
            }
        }
    }
    public function RegistrosPaginados($limite1, $limite2)
    {
        $registros = [];
        if ($this->con->connect_errno) {
            return $this->con->connect_error;
        } else {
            $sql = "SELECT * FROM tareas LIMIT " . $limite1 . "," . $limite2 . ";";
            $resultado = $this->con->query($sql);
            if ($resultado->num_rows == 0) {
                return 0;
            } else {
                while ($fila = $resultado->fetch_assoc()) {
                    array_push($registros, $fila);
                }
                return $registros;
            }
        }
    }
    public function BorrarTarea($id)
    {
        if ($this->con->connect_errno) {
            return $this->con->connect_error;
        } else {

            $sql = "DELETE FROM `tareas` where id=" . $id . ";";
            $this->con->query($sql);
        }
    }
    public function ModificarTarea($id, $id_operario, $nombre, $apellidos, $telefono, $descripcion, $email, $direccion, $poblacion, $codigoPostal, $provincia, $estado, $anotaciones_POST)
    {
        if ($estado != 'Pendiente') {
            $hoy = getdate();
            $fechaFin = "" . $hoy['mday'] . "/" . $hoy['mon'] . "/" . $hoy['year'];
        } else {
            $fechaFin = "-";
        }
        $sql = 'UPDATE `tareas` SET `id_operario`="' . $id_operario . '",`nombre_contacto`="' . $nombre . '",`apellidos_contacto`="' . $apellidos . '",`telefono`="' . $telefono . '",
        `descripcion`="' . $descripcion . '",`email`="' . $email . '",`direccion`="' . $direccion . '",`poblacion`="' . $poblacion . '",`codigo_postal`="' . $codigoPostal . '",
        `provincia`="' . $provincia . '",`estado`="' . $estado . '",`fecha_realizacion`="' . $fechaFin . '",
        `anotaciones_POST`="' . $anotaciones_POST . '" WHERE `id`= "' . $id . '" ;';
        $this->con->query($sql);
    }
    public function getTarea($id)
    {
        $sql = "SELECT * FROM tareas where id=" . $id . ";";
        $resultado = $this->con->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    public function getUsuario($id){
        $sql = "SELECT * FROM trabajadores where id_trabajador='$id';";
        $resultado = $this->con->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    public function getUsuarios(){
        $sql = "SELECT * FROM trabajadores";
        $registros = [];
        $resultado = $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    public function insertarUsuario($nombre,$apellidos,$pass,$rol){
        $sql = "INSERT INTO `trabajadores`( `pass`, `nombre`, `apellidos`, `rol`) VALUES ('$pass','$nombre','$apellidos','$rol');";
        $this->con->query($sql) or die("Error en algunos de los campos->>" . mysqli_error($this->con));
    }
    public function modificarUsuario($id,$nombre,$apellidos,$pass,$rol){
        $sql="UPDATE `trabajadores` SET `pass`='$pass',`nombre`='$nombre',`apellidos`='$apellidos',`rol`='$rol' WHERE `id_trabajador`='$id';";
        $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
    }
    public function eliminarUsuario($id){
        $sql = "DELETE FROM `trabajadores` where id_trabajador='$id';";
        $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
    }
    public function getRol($id){
        $sql = "SELECT * FROM `trabajadores` where id_trabajador='$id';";
        $resultado = $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
        $registro=[];
        while ($fila = $resultado->fetch_assoc()) {
            array_push($registro, $fila);
        }
        //var_dump($registro);
        return $registro;
    }
    public function getTareasOperario($id){
        $sql = "SELECT * FROM `tareas` WHERE `id_operario`='$id' ";
        $registros = [];
        $resultado = $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    public function actualizarEstado($estado ,$id){
        $sql="UPDATE `tareas` SET `estado`='$estado' WHERE id='$id';";
        $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
    }
    public function actualizarPass($pass,$id){
        $sql="UPDATE `trabajadores` SET `pass`='$pass' WHERE `id_trabajador`='$id';";
        $this->con->query($sql) or die("Error->>" . mysqli_error($this->con));
    }
}
