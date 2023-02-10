<?php

if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];

    if($usuario->getTipo == 1){

        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Panel profesor</title>
        </head>
        <body>";

        
            
        echo "</body>
        </html>";
    }
}

?>