<?php
$opcion = isset($_POST['bandera']) ? $_POST['bandera']: "";
$nombre= isset($_POST['nombre']) ? $_POST['nombre']: "";
$tel= isset($_POST['tel']) ? $_POST['tel']: "";
$dui= isset($_POST['dui']) ? $_POST['dui']: "";
$correo= isset($_POST['correo']) ? $_POST['correo']: "";
$direccion= isset($_POST['direccion']) ? $_POST['direccion']: "";


if($opcion==1){
    $consulta= "INSERT INTO cliente (id, 
                                    nombre, 
                                    tel, 
                                    dui, 
                                    correo, 
                                    direccion) 
                                    VALUES
                                    (null, 
                                    '$nombre', 
                                    '$tel', 
                                    '$dui',  
                                    '$correo', 
                                    '$direccion')";

$ejecutar = mysqli_query($con, $consulta);
if ($ejecutar){
    header('Location: index.php');
}
} else if($opcion===2){

}

$con -> close();
