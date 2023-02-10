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
        <body>
            <tr>
                <th>Correo</th>
                <th>Descripcion</th>
                <th>Opciones</th>
            </tr>";

        /*En un futuro, esto podría llamar a una función que estuviera en una clase profesor? en lugar
        llamar directamente a Conexion.php. Entonces, se podría plantear para que devolviera
        objetos Usuario en lugar de un array de arrays */

        $alumnos = listarPorCampo('usuario', 'WHERE tipo = :tipo', array('tipo' => 1)); 

        for($i = 0; $i < count($alumnos); $i++){

            echo "          <tr>
            <td>" . $alumnos[$i]['correo'] . "</td>
            <td>" . $alumnos[$i]['descripcion'] . "</td>
            <td>
                <ul>
                    <li>Actualizar</li>
                    <li>Eliminar</li>
                </ul>
            </td>
            </tr>\n";
        }
            
        echo "</body>
        </html>";
    }
}

?>