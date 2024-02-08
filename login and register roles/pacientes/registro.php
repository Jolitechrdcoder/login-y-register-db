<?php 
include('./db/conection.php');
if(isset($_POST['submit'])){
   $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
   $correo = mysqli_real_escape_string($conexion,$_POST['correo']);
   $contrasena = md5( $_POST['contrasena']);
   $ccontrasena = md5( $_POST['ccontrasena']);
   $user_type = $_POST['user_type'];



   $select = "SELECT * FROM user_form  WHERE correo = '$correo' && contrasena = '$correo'";
   
   $result = mysqli_query($conexion,$select);


   if(mysqli_num_rows($result)>0){
      $error[] = 'este usuario ya existe!';

   }else{
     if($contrasena != $ccontrasena){
        $error[] = 'Las contraseñas no coinciden!';
     }else{
        $insert = "INSERT INTO user_form (nombre, correo, contrasena, user_type) 
           VALUES ('$nombre', '$correo', '$contrasena', '$user_type')";
             mysqli_query($conexion, $insert);
             header('location: login.php');  
     }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>!Registrate ya! </title>
      <!-- mis estilos css -->
      <link rel="stylesheet" href="./assets/estilo.css">
</head>
<body>
     <div class="form-container">
        <form action="#" method="post">
            <h3>!Registrate ahora!</h3>
            <?php 
             if(isset( $error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
             };
            
            ?>
            <input type="text" name="nombre" required placeholder=" Ingresa  tu  Nombre">
            <input type="email" name="correo" required placeholder=" Ingresa  tu  Correo">
            <input type="password" name="contrasena" required placeholder=" Ingresa  una Contraseña">
            <input type="password" name="ccontrasena" required placeholder=" Confirma  la Contraseña">
            <select name="user_type">
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <input type="submit" name="submit" value="Registrarse" class="form-btn">
            <p>Ya tienes una cuenta?<a href="login.php"> Iniciar sesion</a></p>
        </form>
     </div>
</body>
</html>