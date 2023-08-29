<?php
require 'encriptar.php';
require 'toBD.php';


function buscarCorreo($usr_email){
    $conn = conexion();
    $bandera = false;
    #verificar que el correo no exista! #UPGRADE 28 AGOSTO 15:32
    $verificar_correo = mysqli_prepare($conn, "SELECT correo from usr where correo = ?");
    mysqli_stmt_bind_param($verificar_correo,"s",$usr_email);
    mysqli_execute($verificar_correo);

    $correosObtenidos = mysqli_stmt_get_result($verificar_correo);

    if($listas = mysqli_fetch_assoc($correosObtenidos)){
        $bandera = false;
        
    } else{
        $bandera = true;
    }

    return $bandera;
}

function registrar($nombre,$apellidoP,$apellidoM,$correo,$clave){
    $flag = false;
    $conn = conexion();
        #encriptamos clave
        $clave_toBD = encript(($clave));
        #haciendo la consulta parametrizada
        $sql = mysqli_prepare($conn,"INSERT INTO usr (nombre,apellidoP,apellidoM,correo,clave) values (?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($sql,"sssss", $nombre,$apellidoP,$apellidoM,$correo,$clave_toBD);

        if(mysqli_stmt_execute($sql) == true){
            #
            $flag = true;
            return $flag;
        } else{
                $flag = false;
                return $flag;
            }
    
}


?>