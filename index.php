<?php

require 'enter_user.php';

$passwd_usr = "";
$email_usr = "";
$matri = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['entrar'])) {
        $email_usr =  htmlspecialchars($_POST['correo']);
        $passwd_usr = htmlspecialchars($_POST['passwd']);
        #validar que los campos esten llenos
        if ($email_usr == "" || $passwd_usr ==""){
            $aviso = '<div class="negativo">¡Llena todos los campos!</div>';
        } else{
            $paso = login($email_usr,$passwd_usr);
            if($paso[0] === true){
                #$matri = $paso[1];
                header('Location: administrator.php');
                exit();
            } else{
                $aviso = '<div class="negativo">Cuenta incorrecta!</div>';
            }
        }
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
                NOTAS FEI
            </h1>
            <h3>
                ¡Notas para la facultad!
            </h3>
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
                <a href="sign_up_page.php">¡Crear una cuenta!</a>
            </form>
            
        </div>
    </div>
</body>
</html>

