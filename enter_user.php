<?php

#variables de acceso

$resultado = null;

    function login($email,$passwd){
        session_start();
        #conexion a la base de datos
        require 'connBD.php';
        $conn = conexion();
    
        $sql = mysqli_prepare($conn,"SELECT matricula,clave from usr where correo = ?");
        mysqli_stmt_bind_param($sql,"s",$email);
        mysqli_execute($sql);
    
        $resultado = mysqli_stmt_get_result($sql);
    
        if($fila = mysqli_fetch_assoc($resultado)){
            $matricula = $fila['matricula'];
            $binario = $fila['clave'];
            #vamos a verificar la contraseña
            if (password_verify($passwd,$binario)){
                $_SESSION['matricula'] = $matricula;
                mysqli_stmt_close($sql);
                mysqli_close(conexion());
                return [true,$matricula];

            } else{
                mysqli_stmt_close($sql);
                mysqli_close(conexion());
                return false;
            } 
        }else{
            mysqli_stmt_close($sql);
                mysqli_close(conexion());
            return false;
        }

        
    }
    

?>