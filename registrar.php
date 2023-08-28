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
                #encriptamos clave
                require 'encriptar.php';
                require 'toBD.php';
                $clave_toBD = encript(($clave));
                $conn = conexion();
                #haciendo la consulta parametrizada
                $sql = mysqli_prepare($conn,"INSERT INTO usr (nombre,apellidoP,apellidoM,correo,clave) values (?, ?, ?, ?, ?)");

                mysqli_stmt_bind_param($sql,"sssss", $nombre,$apellidoP,$apellidoM,$correo,$clave_toBD);

                if(mysqli_stmt_execute($sql) == true){
                    #$mensaje = '<div class="correcto">¡Datos guardados!</div>';
                    $flag = true;
                } else{
                    $mensaje = '<div class="mensaje">¡Los datos no se subieron al servidor!</div>';
                }
                mysqli_stmt_close($sql);
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
    <div class="all">
        <form action="" name="registrar" method="post">
        <h1 class="titulo">¡REGISTRATE EN LA FEI!</h1>
            <input type="text" name="nombre" id="" placeholder="Ingresa tu nombre">

            <input type="text" name="apellidoP" id="" placeholder="Ingresa tu apellido paterno">

            <input type="text" name="apellidoM" id="" placeholder="Ingresa tu apellido materno">

            <input type="email" name="correo" id="" placeholder="Ingresa tu correo electronico">

            <input type="password" name="passwd" id="" placeholder="Ingresa una contraseña">

            <input type="submit" name="subir_datos" value="Registrar cuenta">
        </form>
        <div class="mensaje">
            <?php
                echo $mensaje;
                if($flag == true){
                    header("Location: sesion.php"); // Redirige después de la inserción
                    exit(); 
                }
            ?>
        </div>
    </div>
</body>
</html>