<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <title>Login</title>
  </head>
  <body>
    <h1>Inicio de Sesión</h1>
<?php
/**
 * @author Eduardo Carretero
 */
$posicionActual = $_SERVER['PHP_SELF'];
/**
 * el formulario con nombre y contraseña
 */
echo "    <form action=\"$posicionActual\" method=\"POST\">\n";

/**
 * comprobación de si da error al iniciar sesión
 * @var string $errorLogin
 */
if (isset($errorLogin)) {
  echo $errorLogin;
}
/** 
 * generamos un token aleatorio y lo amacenamos en sesión
 * @var int $token
 */
$token = rand(1, 1000);
$_SESSION['token'] = $token;
/**
 * el formulario con usuario, contraseña y un input de tipo hidden para comprobar el token y dar más protección al formulario
 */
echo "       <p>Usuario: <input type=\"text\" name=\"usuario\"></p>\n";
echo "       <p>Contraseña: <input type=\"password\" name=\"contrasena\"></p>\n";
echo "       <input type=\"hidden\" name=\"token\" value=\"$token\">\n";
echo "       <button type=\"submit\" value=\"login\">Identificarse</button>\n";
echo "    </form>\n";

?>

    </body>
<html>