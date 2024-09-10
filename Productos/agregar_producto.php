<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Agregar Producto</h1>
        <form action="agregar_producto.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
                <input type="date" class="form-control" id="fecha_expiracion" name="fecha_expiracion">
            </div>
            <button type="submit" class="btn btn-success">Agregar Producto</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
            if (mysqli_connect_errno()) {
                echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
                exit();
            }

            $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($con, $_POST['nombre']) : "";
            $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($con, $_POST['descripcion']) : "";
            $precio = isset($_POST['precio']) ? mysqli_real_escape_string($con, $_POST['precio']) : "";
            $stock = isset($_POST['stock']) ? mysqli_real_escape_string($con, $_POST['stock']) : "";
            $fecha_expiracion = isset($_POST['fecha_expiracion']) ? mysqli_real_escape_string($con, $_POST['fecha_expiracion']) : "";

            // Inserta el producto en la base de datos
            $consulta = "INSERT INTO productos (nombre, descripcion, precio, stock, fecha_expiracion) 
                         VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$fecha_expiracion')";

            if (mysqli_query($con, $consulta)) {
                // Redirige a la página de gestión de productos si la inserción es exitosa
                header('Location: gestion_productos.php');
                exit();
            } else {
                echo "<div class='alert alert-danger mt-3'>Error al agregar producto: " . mysqli_error($con) . "</div>";
            }

            mysqli_close($con);
        }
        ?>
    </div>
</body>
</html>
