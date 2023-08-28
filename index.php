<?php

require 'toBD.php';
$conn = conexion();

$passwd_usr = "";
$email_usr = "";
$aviso="";
$resultado = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['entrar'])) {
        $email_usr = $_POST['correo'];
        $passwd_usr = $_POST['passwd'];
        #validar que los campos esten llenos
        if ($email_usr == "" || $passwd_usr ==""){
            $aviso = '<div class="negativo">¡Llena todos los campos!</div>';
        } else{
            $sql = mysqli_prepare($conn,"select clave from usr where correo = ?");
            mysqli_stmt_bind_param($sql,"s",$email_usr);
            mysqli_execute($sql);

            $resultado = mysqli_stmt_get_result($sql);

            if($fila = mysqli_fetch_assoc($resultado)){
                $binario = $fila['clave'];
                #vamos a verificar la contraseña
                if (password_verify($passwd_usr,$binario)){
                    $aviso = '<div class="positivo">Cuenta correcta</div>';
                } else{
                    $aviso = '<div class="negativo">¡Contraseña incorrecta!</div>';
                }
            } else{
                $aviso = '<div class="negativo">¡Correo no registrado!</div>';
            }
        }
        #echo('contraseña ingresada: '.$passwd_usr);
    }else{
        #echo 'No hay nada:/';
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>FEI - LOGIN</title>
</head>
<body>
    <!-- contenedor de toda la pagina -->
    <div class="index">
        <!-- portada -->
        <div class="portada">
            
        </div>
        <!-- Formulario -->
        <div class="form">
            <h1 class="titulo">
                Facultad de<br>Estadística e Informática
            </h1>
            <form action="" name="login" method="post" class="inputs">
                <input type="email" name="correo" id="" placeholder="Ingresa tu correo electronico">
                
                <input type="password" name="passwd" id="" placeholder="Ingresa tu contraseña">

                <div class="avisos">
                    <?php
                        echo $aviso;
                    ?>
                </div>
                
                <input type="submit" name="entrar" value="Inciar sesion">

                <a href="http://" target="_blank" rel="noopener noreferrer">Recuperar mi contraseña</a>
                <a href="registrar.php">Crear una cuenta!</a>
            </form>
            
        </div>
    </div>
</body>
</html>

