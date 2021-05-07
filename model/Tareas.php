<?php
class Tareas{
    public static function buscarTodo($f_creacion,$f_realizacion,$provincia,$v_creacion,$v_realizacion){
        $con=BaseDatos::getInstance()->Conexion();
        $op=$_SESSION["usuario"]["id_trabajador"];
        if ($_SESSION["usuario"]["rol"]=='operario') {
            $sql="SELECT * FROM `tareas` WHERE `fecha_creacion` $v_creacion '$f_creacion' AND `fecha_realizacion` $v_realizacion '$f_realizacion' and `provincia` ='$provincia' and `id_operario` ='$op';";
        }else{
            $sql="SELECT * FROM `tareas` WHERE `fecha_creacion` $v_creacion '$f_creacion' AND `fecha_realizacion` $v_realizacion '$f_realizacion' and `provincia` = '$provincia';";
        }
        $resultado = $con->query($sql) or die("Error->>" . mysqli_error($con));
        $registros = [];
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    public function insertarTablaTarea($id_operario, $nombre, $apellidos, $telefono, $descripcion, $email, $direccion, $poblacion, $codigoPostal, $provincia, $estado, $anotaciones_ANT)
    {
        $con=BaseDatos::getInstance()->Conexion();
        $hoy = getdate();
        if ($hoy['mon']<10 ) {
           $mon='0'.$hoy['mon'];
        } else{
            $mon=$hoy['mon'];
        }
        if ($hoy['mday']<10 ) {
            $mday='0'.$hoy['mday'];
        }else{
            $mday=$hoy['mday'];
        }

        
        $fecha_actual = "" . $hoy['year'] . "-" . $mon . "-" .$mday ;
        $sql = "INSERT INTO `tareas`(`id_operario`, `nombre_contacto`, `apellidos_contacto`, `telefono`, `descripcion`, `email`, `direccion`, `poblacion`, `codigo_postal`, `provincia`, `estado`, `fecha_creacion`, `fecha_realizacion`, `anotaciones_ANT`, `anotaciones_POST`) VALUES ('" . $id_operario . "','" . $nombre . "','" . $apellidos . "','" . $telefono . "','" . $descripcion . "','" . $email . "','" . $direccion . "','" . $poblacion . "','" . $codigoPostal . "','" . $provincia . "','" . $estado . "','" . $fecha_actual . "','" . "- - -" . "','" . $anotaciones_ANT . "','" . "- - -" . "');";

        $con->query($sql) or die("Error en algunos de los campos->>" . mysqli_error($con));
    }
    public function getArrayRegistrosTablaTarea()
    {
        $con=BaseDatos::getInstance()->Conexion();

        $sql = "SELECT * FROM tareas";
        $registros = [];
        $resultado = $con->query($sql) or die("Error->>" . mysqli_error($con));
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    public function CantidadRegistros()
    {
        $con=BaseDatos::getInstance()->Conexion();

        if ($con->connect_errno) {
            return $con->connect_error;
        } else {
            $sql = "SELECT COUNT(*) AS total FROM tareas ";
            $resultado = $con->query($sql);
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
        $con=BaseDatos::getInstance()->Conexion();

        $registros = [];
        if ($con->connect_errno) {
            return $con->connect_error;
        } else {
            $sql = "SELECT * FROM tareas LIMIT " . $limite1 . "," . $limite2 . ";";
            $resultado = $con->query($sql);
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
        $con=BaseDatos::getInstance()->Conexion();

        if ($con->connect_errno) {
            return $con->connect_error;
        } else {

            $sql = "DELETE FROM `tareas` where id=" . $id . ";";
            $con->query($sql);
        }
    }
    public function ModificarTarea($id, $id_operario, $nombre, $apellidos, $telefono, $descripcion, $email, $direccion, $poblacion, $codigoPostal, $provincia, $estado, $anotaciones_POST)
    {
        $con=BaseDatos::getInstance()->Conexion();

        if ($estado != 'Pendiente') {
            $hoy = getdate();
            $fechaFin = "" . $hoy['mday'] . "/" . $hoy['mon'] . "/" . $hoy['year'];
        } else {
            $fechaFin = "-";
        }
        $sql = 'UPDATE `tareas` SET `id_operario`="' . $id_operario . '",`nombre_contacto`="' . $nombre . '",`apellidos_contacto`="' . $apellidos . '",`telefono`="' . $telefono . '",
        `descripcion`="' . $descripcion . '",`email`="' . $email . '",`direccion`="' . $direccion . '",`poblacion`="' . $poblacion . '",`codigo_postal`="' . $codigoPostal . '",
        `provincia`="' . $provincia . '",`estado`="' . $estado . '",
        `anotaciones_POST`="' . $anotaciones_POST . '" WHERE `id`= "' . $id . '" ;';
        $con->query($sql);
    }
    public function getTarea($id)
    {
        $con=BaseDatos::getInstance()->Conexion();

        $sql = "SELECT * FROM tareas where id=" . $id . ";";
        $resultado = $con->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    public function getTareasOperario($id){
        $con=BaseDatos::getInstance()->Conexion();

        $sql = "SELECT * FROM `tareas` WHERE `id_operario`='$id' ";
        $registros = [];
        $resultado = $con->query($sql) or die("Error->>" . mysqli_error($con));
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                array_push($registros, $fila);
            }
        }
        return $registros;
    }
    public function actualizarEstado($estado ,$id){
        $con=BaseDatos::getInstance()->Conexion();

        $hoy = getdate();
        if ($hoy['mon']<10 ) {
           $mon='0'.$hoy['mon'];
        } else{
            $mon=$hoy['mon'];
        }
        if ($hoy['mday']<10 ) {
            $mday='0'.$hoy['mday'];
        }else{
            $mday=$hoy['mday'];
        }

        
        $fecha_actual = "" . $hoy['year'] . "-" . $mon . "-" .$mday ;
        $sql="UPDATE `tareas` SET `estado`='$estado', `fecha_realizacion`='$fecha_actual' WHERE id='$id';";
        $con->query($sql) or die("Error->>" . mysqli_error($con));
    }
}