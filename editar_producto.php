<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Producto</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($producto['nombre']) ? htmlspecialchars($producto['nombre']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo isset($producto['descripcion']) ? htmlspecialchars($producto['descripcion']) : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo isset($producto['precio']) ? htmlspecialchars($producto['precio']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo isset($producto['stock']) ? htmlspecialchars($producto['stock']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
            <input type="date" class="form-control" id="fecha_expiracion" name="fecha_expiracion" value="<?php echo isset($producto['fecha_expiracion']) ? htmlspecialchars($producto['fecha_expiracion']) : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="gestion_productos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>

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

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $producto_query = mysqli_query($con, "SELECT * FROM productos WHERE id_producto = $id");
    $producto = mysqli_fetch_assoc($producto_query);
    
    if (!$producto) {
        echo "Producto no encontrado";
        exit();
    }
} else {
    echo "ID de producto inválido";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $fecha_expiracion = mysqli_real_escape_string($con, $_POST['fecha_expiracion']);

    $consulta = "UPDATE productos 
                 SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', stock = '$stock', 
                     fecha_expiracion = '$fecha_expiracion'
                 WHERE id_producto = $id";

    if (mysqli_query($con, $consulta)) {
        header('Location: gestion_productos.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
