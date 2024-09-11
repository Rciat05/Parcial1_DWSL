<?php
$con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

// Verificar si se ha enviado el formulario de búsqueda
$busqueda = isset($_GET['buscar']) ? mysqli_real_escape_string($con, $_GET['buscar']) : '';

// Modificar la consulta para buscar categorías si hay un término de búsqueda
if ($busqueda) {
    $consulta = "SELECT * FROM categorias WHERE nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%'";
} else {
    $consulta = "SELECT * FROM categorias";  // Mostrar todas las categorías si no hay búsqueda
}

$categorias = mysqli_query($con, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestión de Categorías</h2>
        <hr>
        <a class="btn btn-primary mb-3" href="../panel.php">Volver al panel principal</a>
        <a href="agregar_categoria.php" class="btn btn-success mb-3">Agregar Categoría</a>

        <!-- Formulario de búsqueda -->
        <form action="gestion_categoria.php" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="buscar" placeholder="Buscar categoría..." value="<?php echo htmlspecialchars($busqueda); ?>">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- Tabla de categorías -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Producto Asociado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($categoria = mysqli_fetch_assoc($categorias)) { ?>
                    <tr>
                        <td><?php echo $categoria['id_categoria']; ?></td>
                        <td><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['descripcion']); ?></td>
                        <td>
                            <?php
                            if ($categoria['id_producto']) {
                                $producto = mysqli_query($con, "SELECT nombre FROM productos WHERE id_producto = " . $categoria['id_producto']);
                                $producto = mysqli_fetch_assoc($producto);
                                echo htmlspecialchars($producto['nombre']);
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="editar_categoria.php?id=<?php echo $categoria['id_categoria']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar_categoria.php?id=<?php echo $categoria['id_categoria']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-RnKj1l+3TW+OQd3dBtNT0qIph9Kk6Lra1J9KlhA0O6U8kK4YH7SvZhOh0Or4t8+n" crossorigin="anonymous"></script>
</body>
</html>
