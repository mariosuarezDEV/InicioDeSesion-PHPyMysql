<?php
$nombre = "";
$apellidoP = "";
$apellidoM = "";
$correo = "";
$clave = "";
$mensaje ="";
$flag = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subir_datos'])) {
        $passwd_usr = $_POST['passwd'];
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $correo = $_POST['correo'];
        $clave = $_POST['passwd'];
        #validar los datos
        if ($nombre == "" || $apellidoP == "" || $apellidoM == "" || $clave == "" || $correo == ""){
            $mensaje = "¡Faltando datos por llenar!";
        } else{
                require 'new_user.php';
                require 'send_mail.php';

                $bandera = buscarCorreo($correo);
                if ($bandera == true){
                    send();
                    $flag = registrar($nombre,$apellidoP,$apellidoM,$correo,$clave);
                } else{
                    $flag = false;
                    $mensaje = 'Error al registrar la cuenta';
                }
                #registrar($nombre,$apellidoP,$apellidoM,$correo,$clave);
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
    <link rel="stylesheet" href="style/estilos.css">
    <title>Registrate!</title>
</head>
<body>
    <!-- DIV DE TODO EL CONTENIDO -->
    <div class="contenedor">
        <div class="video">
            
        </div>
        <div class="registro">
            <form action="" name="registrar" method="post">
            <h2 class="titulo">
                ¡REGISTRATE GRATIS!
            </h2>
                <input type="text" name="nombre" id="" placeholder="Ingresa tu nombre">
                <input type="text" name="apellidoP" id="" placeholder="Ingresa tu apellido paterno">
                
                <input type="text" name="apellidoM" id="" placeholder="Ingresa tu apellido materno">

                <input type="email" name="correo" id="" placeholder="Ingresa tu correo electronico">
                <input type="password" name="passwd" id="" placeholder="Ingresa una contraseña">
                <!-- <input type="file" name="perfilFoto" accept="image/*"> -->
                <div class="mensaje">
                    <?php
                        if ($flag == true){
                            header("Location: sign_up_complete.php"); // Redirige después de la inserción
                        } else{
                            echo $mensaje;
                        }
                    ?>
                </div>
                <input type="submit" name="subir_datos" value="Crear cuenta">
            </form>
        </div>
    </div>
        
        
</body>
</html>