<?php
class Tareas{
    /**
     * Funcion que devuelve todas las tareas en funcion de unos criterios
     * seleccionados en el buscador, se usa como parametros:
     *                                  -op = opcion que el usuario escribe
     *                                  -vop= valor comparativo seleccionado -> [>, =, <]
     *                                  -sop= seccion seleccionada -> id_operario,nombre_contacto,fecha_inicio....
     * @param [string] $op1
     * @param [string] $vop1
     * @param [string] $sop1
     * @param [string] $op2
     * @param [string] $vop2
     * @param [string] $sop2
     * @param [string] $op3
     * @param [string] $vop3
     * @param [string] $sop3
     * @return void
     */
    public static function buscarTodo($op1,$vop1,$sop1,$op2,$vop2,$sop2,$op3,$vop3,$sop3){
        $con=BaseDatos::getInstance()->Conexion();
        $op=$_SESSION["usuario"]["id_trabajador"];
        if ($_SESSION["usuario"]["rol"]=='operario') {
            $sql="SELECT * FROM `tareas` WHERE $sop1 $vop1 '$op1' and $sop2 $vop2 '$op2' and $sop3 $vop3 '$op3' and `id_operario`='$op';";
        }else{
            $sql="SELECT * FROM `tareas` WHERE $sop1 $vop1 '$op1' and $sop2 $vop2 '$op2' and $sop3 $vop3 '$op3';";
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
    /**
     * Funcion para insertar una tarea en la bbdd
     *
     * @param [string] $id_operario
     * @param [string] $nombre
     * @param [string] $apellidos
     * @param [string] $telefono
     * @param [string] $descripcion
     * @param [string] $email
     * @param [string] $direccion
     * @param [string] $poblacion
     * @param [string] $codigoPostal
     * @param [string] $provincia
     * @param [string] $estado
     * @param [string] $anotaciones_ANT
     * @return void
     */
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
    /**
     * Devuelve todas las teras de la bbdd
     *
     * @return void
     */
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
    /**
     * devuelve la cantidad de registros que hay en la tabla tareas
     *
     * @return int 
     */
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
    /**
     * devuelve la cantidad de registros que hay en la tabla tareas
     * asociadas con un operario, en este caso  pasamos su id por parametros
     *
     * @param [int] $id
     * @return void
     */
    public function CantidadRegistrosOP($id)
    {
        $con=BaseDatos::getInstance()->Conexion();

        if ($con->connect_errno) {
            return $con->connect_error;
        } else {
            $sql = "SELECT COUNT(*) AS total FROM tareas WHERE id_operario = '$id'";
            $resultado = $con->query($sql);
            if ($resultado->num_rows == 0) {
                return 0;
            } else {
                $fila = $resultado->fetch_assoc();
                return $fila["total"];
            }
        }
    }
    /**
     * devuelve una serie de tareas entre 2 limites siendo 
     * $limite1 el registro de inicio y siendo $limite2 la cantidad de registros
     * desde $limite1
     *
     * @param [int] $limite1
     * @param [int] $limite2
     * @return void
     */
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
    /**
     * devuelve una serie de tareas entre 2 limites siendo 
     * $limite1 el registro de inicio y siendo $limite2 la cantidad de registros
     * desde $limite1 asociados con un operario, en este caso pasamos su id por parametro
     *
     * @param [int] $limite1
     * @param [int] $limite2
     * @param [int] $id
     * @return void
     */
    public function RegistrosPaginadosOP($limite1, $limite2,$id)
    {
        $con=BaseDatos::getInstance()->Conexion();

        $registros = [];
        if ($con->connect_errno) {
            return $con->connect_error;
        } else {
            $sql = "SELECT * FROM tareas where id_operario = '$id' LIMIT " . $limite1 . "," . $limite2 . " ;";
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
    /**
     * funcion que borra una tarea de la bbdd
     *
     * @param [int] $id
     * @return void
     */
    public function BorrarTarea($id)
    {
        $con=BaseDatos::getInstance()->Conexion();

        if ($con->connect_errno) {
            return $con->connect_error;
        } else {

            $sql = "DELETE FROM `tareas` where id= $id ;";
            $con->query($sql);
        }
    }
    /**
     * funcion para modificar los datos de una tarea
     *
     * @param [int] $id
     * @param [string] $id_operario
     * @param [string] $nombre
     * @param [string] $apellidos
     * @param [string] $telefono
     * @param [string] $descripcion
     * @param [string] $email
     * @param [string] $direccion
     * @param [string] $poblacion
     * @param [string] $codigoPostal
     * @param [string] $provincia
     * @param [string] $estado
     * @param [string] $anotaciones_POST
     * @return void
     */
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
    /**
     * Devuelve una tarea pasandole su id por parametro
     *
     * @param [int] $id
     * @return void
     */
    public function getTarea($id)
    {
        $con=BaseDatos::getInstance()->Conexion();

        $sql = "SELECT * FROM tareas where id=" . $id . ";";
        $resultado = $con->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    /**
     * Devuelve todas las tareas de un trabajador pasandole su id por parametro
     *
     * @param [int] $id
     * @return void
     */
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
    /**
     * funcion que actualiza el estado de una tarea
     * le pasamos por parametro el estado y el id de la tarea
     *
     * @param [string] $estado
     * @param [int] $id
     * @return void
     */
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