<?php
    function conexion(){
        #variables de entorno
        $env_vars = parse_ini_file('.env');
        #variables de conexion
        $db_host = $env_vars['db_host'];
        $db_user = $env_vars['db_user'];
        $db_passwd = $env_vars['db_passwd'];
        $db_name = $env_vars['db_name'];

        #Hacer la conexion a la base de datos
        $connectar = mysqli_connect(
            $db_host,
            $db_user,
            $db_passwd,
            $db_name
        );

        if($connectar == false){
            #echo('No se hizo la conexion');
            return false;
        } else{
            #echo('Conexion correcta!');
            return $connectar;
        }
    }

    function cerrar_conexion(){
        conexion() -> close();
    }

?>