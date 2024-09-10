<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

$id = $_GET['id'];

$consulta = "DELETE FROM productos WHERE id_producto = $id";

if (mysqli_query($con, $consulta)) {
    header('Location: gestion_productos.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}

