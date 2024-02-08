<?php
include('./db/conection.php');
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- mis estilos css -->
    <link rel="stylesheet" href="./assets/estilo.css">
</head>
<body>
     <div class="container">
        <div class="content">
            <h3> Hola,<span>admin</span></h3>
            <h1>Bienvenido <span><?php echo $_SESSION['admin_name']; ?></span></h1>
            <p>Esta es la pagina para administradores del sistema</p>
            <a href="login.php" class="btn"> inicio sesion </a>
            <a href="registro.php" class="btn"> Registrar usuarios </a>
            <a href="logout.php" class="btn">cerrar sesion</a>
        </div>
     </div>
</body>
</html>