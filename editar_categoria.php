<?php
// Conexión a la base de datos
$con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

// Obtener el ID de la categoría desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obtener los detalles de la categoría
$consulta = "SELECT * FROM categorias WHERE id_categoria = $id";
$categoria = mysqli_query($con, $consulta);
$categoria = mysqli_fetch_assoc($categoria);

// Consulta para obtener los productos
$productos = mysqli_query($con, "SELECT id_producto, nombre FROM productos");

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : null;

    $consulta = "UPDATE categorias 
                 SET nombre = '$nombre', descripcion = '$descripcion', id_producto = '$id_producto'
                 WHERE id_categoria = $id";

    if (mysqli_query($con, $consulta)) {
        header('Location: gestion_categoria.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Categoría</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($categoria['nombre']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($categoria['descripcion']); ?>">
            </div>

            <div class="mb-3">
                <label for="producto" class="form-label">Selecciona un Producto:</label>
                <select class="form-select" id="producto" name="id_producto">
                    <?php while ($producto = mysqli_fetch_assoc($productos)) { ?>
                        <option value="<?php echo $producto['id_producto']; ?>"
                            <?php echo $producto['id_producto'] == $categoria['id_producto'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($producto['nombre']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="gestion_categoria.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-RnKj1l+3TW+OQd3dBtNT0qIph9Kk6Lra1J9KlhA0O6U8kK4YH7SvZhOh0Or4t8+n" crossorigin="anonymous"></script>
</body>
</html>
