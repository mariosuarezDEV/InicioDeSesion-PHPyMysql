<?php
#consulta para iniciar sesion

require 'toBD.php';

if (conexion() == false){
    #no se hace nada, la pagina no continua
} else{
    #en caso de que la conexion sea correcta
    $enlace = conexion();
    $query = <<< CONSULTA
    "select " 
    CONSULTA;

}


?>