<?php
session_start();

require_once 'Conexion.php';
require_once 'Usuario.php';

$conexion = new Conexion();
$usuario = new Usuario();

if ((isset($_SESSION['token'])) && isset($_POST['token'])) {
    if ($_SESSION['token'] == $_POST['token']) {
        echo "token correcto";
        if (isset($_SESSION['usuario'])) {
           require_once 'vistaUsuario.php';
        
        } elseif ((isset($_POST['usuario'])) && (isset($_POST['contrasena']))) {
            $usuarioFormulario = trim(strip_tags($_POST['usuario']));
            $contrasenaFormulario = trim(strip_tags($_POST['contrasena']));
            $patron = '/^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,3}$/';
        
            if (preg_match($patron, $_POST['usuario'])) {
                echo "<p>Usuario: " . $usuarioFormulario . "</p>";
                echo "<p>Contraseña: $contrasenaFormulario</p>";

                if ($usuario->usuarioExiste($usuarioFormulario, $contrasenaFormulario)) {
                    echo " el usuario existe";
                    $_SESSION['usuario'] = $usuario;
                } else {
                    echo " el usuario no existe";
                    echo "<a>Crear usuario</a>";
                }

            } else {
                echo " falló el patrón";
            }
        } 
    }
    
} else {
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
  </head>
  <body>
    <h1>Inicio de Sesión</h1>

<?php
    $token = rand(1, 1000);
    $_SESSION['token'] = $token;
    $posicionActual = $_SERVER['PHP_SELF'];

    echo "    <form action=\"$posicionActual\" method=\"POST\">\n";
    echo "       <div class=\"input\"> <input type=\"text\" placeholder=\"Usuario\" name=\"usuario\"></div>\n";
    echo "       <div class=\"input\"> <input type=\"password\" placeholder=\"Contraseña\" name=\"contrasena\" maxlength=\"16\"></div>\n";
    echo "       <input type=\"hidden\" name=\"token\" value=\"$token\">\n";
    echo "       <button class=\"button\" type=\"submit\" value=\"login\">Identificarse</button>\n";
    echo "    </form>\n";
}