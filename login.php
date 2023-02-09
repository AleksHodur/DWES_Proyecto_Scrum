<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
  </head>
  <body>
    <div class="logo"></div>
    <h1>Inicio de Sesión</h1>
<?php
/**
 * @author Eduardo Carretero
 * el formulario con nombre y contraseña
 */
echo "    <form action=\"index.php\" method=\"POST\">\n";

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
echo "       <div class=\"input\"> <input type=\"text\" placeholder=\"Usuario\" name=\"usuario\"></div>\n";
echo "       <div class=\"input\"> <input type=\"password\" placeholder=\"Contraseña\" name=\"contrasena\"></div>\n";
echo "       <input type=\"hidden\" name=\"token\" value=\"$token\">\n";
echo "       <button class=\"button\" type=\"submit\" value=\"login\">Identificarse</button>\n";
echo "    </form>\n";

?>
    
    </body>
<html>