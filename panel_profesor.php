<?php
require_once 'Conexion.php';
require_once 'Usuario.php';

session_start();

if(isset($_POST['eliminar'])){
    
    $usuario = new Usuario();

    if($usuario->usuarioExiste($_POST['eliminar'], false)){

        $usuario->eliminar();
    }
}

if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];

    if($usuario->getTipo() == 2){

        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Panel profesor</title>
        </head>
        <body>
            <h1>Panel de profesor</h1>
            <h2>Tabla alumnos</h2>
            <table border='1'>
                <tr>
                    <th>Correo</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>
                </tr>";

        /*En un futuro, esto podría llamar a una función que estuviera en una clase profesor? en lugar
        llamar directamente a Conexion.php. Entonces, se podría plantear para que devolviera
        objetos Usuario en lugar de un array de arrays */

        $conexion = new Conexion;
        $alumnos = $conexion->listarPorCampo('usuario', 'tipo = :tipo', array('tipo' => 1)); 

        if($alumnos){
            for($i = 0; $i < count($alumnos); $i++){

                echo "          <tr>
                <td>" . $alumnos[$i]['correo'] . "</td>
                <td>" . $alumnos[$i]['descripcion'] . "</td>
                <td>
                    <ul>
                        <li><button>Actualizar</button></li>
                        <li>
                            <form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">
                                <input type=\"hidden\" name=\"eliminar\" value=\"" . $alumnos[$i]['correo'] . "\">
                                <button type=\"submit\">Eliminar</button>
                            </form>
                        </li>
                    </ul>
                </td>
                </tr>\n";
            }
        }else{
            echo "<p>Error de conexión. Inténtelo otra vez</p>";
        }

        echo "</table>
        <form>
            <label for=\"correo\">Correo:</label>
            <input type=\"text\" name=\"correo\">
            <label for=\"contrasena\">Contrasena:</label>
            <input type=\"text\" name=\"contrasena\">            
            <label for=\"tipo\">Tipo:</label>
            <input type=\"text\" name=\"tipo\">            
            <label for=\"descripcion\">Descripción:</label>
            <input type=\"text\" name=\"descripcion\">
            <input type=\"submit\" value=\"Insertar\">
        </form>";
            
        echo "</body>
        </html>";
    }
}else{
    echo "<p>No se detecta al usuario en sesión</p>";
}

?>