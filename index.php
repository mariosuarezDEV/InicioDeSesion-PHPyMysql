<?php

require 'login.php';

$passwd_usr = "";
$email_usr = "";
$matri = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['entrar'])) {
        $email_usr = $_POST['correo'];
        $passwd_usr = $_POST['passwd'];
        #validar que los campos esten llenos
        if ($email_usr == "" || $passwd_usr ==""){
            $aviso = '<div class="negativo">¡Llena todos los campos!</div>';
        } else{
            $paso = login($email_usr,$passwd_usr);
            if($paso[0] === true){
                #$matri = $paso[1];
                header('Location: panel.php');
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

