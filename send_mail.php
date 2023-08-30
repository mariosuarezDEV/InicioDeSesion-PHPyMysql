<?php

function generacion_de_codido() {
    $numero = '';
    for ($i = 0; $i < 6; $i++) {
        $digito = mt_rand(0, 9); // Generar un número aleatorio entre 0 y 9
        $numero .= $digito;
    }
    return $numero;
}


function send(){
    $mandar = 'sudo echo "hola mundo" | mail -s "prueba de correo" zs21015977@estudiantes.uv.mx';

    $correo =shell_exec($mandar);
    echo $correo;

}

send();



?>