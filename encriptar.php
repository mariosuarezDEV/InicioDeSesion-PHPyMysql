<?php

#encriptar las contraseñas
function encript($passwd){
    #algoritmo bcrypt

    $options = [
        'cost' => 12, // El costo determina el número de iteraciones (logaritmo base 2) que se realizarán
    ];

    $hash = password_hash($passwd, PASSWORD_BCRYPT, $options);

    return $hash;
}

?>