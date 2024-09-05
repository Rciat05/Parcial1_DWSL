
<?php
    session_start();
    if($_SESSION['usuario']==""){
        header('Location: Index.php');
    }
    include_once('conf.php');
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Principal</title>
</head>
<body>
    <br>
    <a href="registrocliente.php" class="btn btn-success" style="margin-left: 10px;">Agregar cliente</a>
</body>
</html>