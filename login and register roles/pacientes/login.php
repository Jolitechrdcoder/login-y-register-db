<?php 
include('./db/conection.php');
session_start();
$error = array(); // Inicializar el array de errores

if(isset($_POST['submit'])){
   $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
   $contrasena = md5($_POST['contrasena']);

   $select = "SELECT * FROM user_form  WHERE correo = '$correo' && contrasena = '$contrasena'";
   $result = mysqli_query($conexion, $select);

   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['nombre'];
         header('location: administrador.php');
      }
      else if($row['user_type'] == 'usuario'){
         $_SESSION['user_name'] = $row['nombre'];
         header('location: usuario.php');
      }
   }
   else{
      $error[] = 'Contraseña o correo incorrecto';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./assets/estilo.css">
</head>
<body>
     <div class="form-container">
        <form action="#" method="post">
            <h3>Iniciar Sesión</h3>
            <?php 
             if(!empty($error)){
                foreach($error as $err){
                    echo '<span class="error-msg">'.$err.'</span>';
                };
             };
            
            ?>
            <input type="email" name="correo" required placeholder="Ingresa tu Correo">
            <input type="password" name="contrasena" required placeholder="Ingresa una Contraseña">
           
            <input type="submit" name="submit" value="Iniciar Sesión" class="form-btn">
            <p>¿Aún no tienes una cuenta?<a href="registro.php">Registrarse ahora</a></p>
        </form>
     </div>
</body>
</html>