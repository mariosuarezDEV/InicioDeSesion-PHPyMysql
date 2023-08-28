<?php
    $nombre ="";
    $apellidoP = "";
    $apellidoM = "";

    session_start();
    $_SESSION['matricula'];

    require 'toBD.php';
    $conn = conexion();

    if($conn == false){
        #echo 'error en la conexion';
    } else{
        #tareas de conexion
        $sql = mysqli_prepare($conn,"select nombre,apellidoP, apellidoM from usr where matricula = ?");
        mysqli_stmt_bind_param($sql,'i',$_SESSION['matricula']);
        mysqli_execute($sql);

        $resultado = mysqli_stmt_get_result($sql);

        if($fila = mysqli_fetch_assoc($resultado)){
            $nombre = $fila['nombre'];
            $apellidoP = $fila['apellidoP'];
            $apellidoM = $fila['apellidoM'];
        }
    }

    mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/panel.css">
    <title>Administrador</title>
</head>
<body>
    <div class="index">
        <div class="contenido">
            <h2>
            <?php
                    echo $nombre;
                    echo '<br>';
                    echo $apellidoP." ".$apellidoM;
                ?>
            </h2>
        </div>
    </div>
</body>
</html>