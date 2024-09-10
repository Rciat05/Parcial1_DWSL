<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Inicio de Sesión</h1>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nombre_usuario">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena">
            </div>
            <button type="submit" class="btn btn-info">Iniciar Sesión</button>
        </form>
    </div>

    <?php
    session_start();

    $con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
    if (mysqli_connect_errno()) {
        echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_usuario = isset($_POST['nombre_usuario']) ? mysqli_real_escape_string($con, $_POST['nombre_usuario']) : "";
        $contrasena = isset($_POST['contrasena']) ? mysqli_real_escape_string($con, $_POST['contrasena']) : "";

        $consulta = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '".md5($contrasena)."'";
        $ejecutar = mysqli_query($con, $consulta);

        if (mysqli_num_rows($ejecutar) == 1) {
            $user = mysqli_fetch_assoc($ejecutar);
            $_SESSION['usuario'] = $user['nombre_usuario'];
            header('Location: panel.php');
            exit();
        } else {
            echo "<div class='container mt-3'><div class='alert alert-danger'>Usuario o contraseña incorrectos</div></div>";
        }
    }
    ?>
</body>
</html>
