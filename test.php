<?php
$servername = "localhost";
$database = "desatranques";
$username = "root";
$password = "";
$con = new mysqli($servername, $username, $password, $database);
$sql = "SELECT * FROM trabajadores";
$registros = [];
$resultado = $con->query($sql) or die("Error->>" . mysqli_error($con));
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        array_push($registros, $fila);
    }
}
var_dump($registros);
?>