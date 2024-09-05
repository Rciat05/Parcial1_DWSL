<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="Index.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nombre_usuario">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena">
  </div>
  
  <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
</form>
</body>
</html>
<?php 
  echo isset($error);

  //$con = mysqli_connect("localhost", "root", "291866Rc", "TiendaBebidas");
//if (mysqli_connect_errno()) {
    //echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
  //  exit();
//}

?>
<?php 
include_once'conf.php';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre_usuario = isset($_POST['nombre_usuario'])? $_POST['nombre_usuario']:"";
    $contrasena = isset($_POST['contrasena'])? $_POST['contrasena']:"";
    $consulta = "SELECT nombre_usuario, email, contrasena FROM usuarios WHERE nombre_usuario ='".$nombre_usuario."' AND contrasena ='".md5($contrasena)."'";
    $ejecutar = mysqli_query($con, $consulta);
    if ($ejecutar -> num_rows == 1){
      session_start();
      while($user=mysqli_fetch_assoc($ejecutar)){
        $_SESSION['usuario'] = $user['nombre'];
      }
        header ('Location: index.php');
    } else {
      $error = "Error en el inicio de sesion";
    }
  }

?>