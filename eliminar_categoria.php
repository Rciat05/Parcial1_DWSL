<?php
// Conexión a la base de datos
$con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener el ID de la categoría desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    $consulta = "DELETE FROM categorias WHERE id_categoria = $id";
    if (mysqli_query($con, $consulta)) {
        header('Location: gestion_categoria.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "ID de categoría no especificado.";
}

