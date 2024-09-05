<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
    
</body>
</html>


<?php
$server = "localhost";
$pass = "291866Rc";
$user = "root";
$db = "TiendaBebidas";


$con= mysqli_connect($server, $user, $pass, $db);

if($con){

}else{
    echo "error de conexion";
}

function validar($nombre, $pwd){
    echo "hola mundo";
}
?>
