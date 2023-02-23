<?php
/**
 * @author Eduardo Carretero
 * indicamos que vamos a utilizar sesiones
 * y llamamos a las clases que vamos a utilizar para la sesión
 */
session_start();

require_once '../modelo/Conexion.php';
require_once '../modelo/Usuario.php';

/**instanciamos las clases obteniendo los objetos correspondientes
 */
 /**
  * @var object $usuarioSesion
  * @var object $usuario
	 */
$conexion = new Conexion();
$usuario = new Usuario();

/**
*hacemos la comprobación de que el token ha sido almacenado en sesión 
* y comprobamos que sea igual al que el formulario mandó
 */
if ((isset($_SESSION['token'])) && isset($_POST['token'])) {
    if ($_SESSION['token'] == $_POST['token']) {
         /**
         * comprobamos si el usuario está en sesión, en cuyo caso
         * nos manda a vistaUsuario
         */
        if (isset($_SESSION['usuario'])) {
           //header("Location:vistaUsuario.php");
           require_once 'vistaUsuario.php';
        /**
         * si clicka en el botón registro entonces te mandará al fichero registro.php
         */
        } else if (isset($_POST['register'])) {
            require_once 'registro.php';
         /**
             * comprobamos que existan tanto el usuario como la contraseña
             */
        } elseif ((isset($_POST['usuario'])) && (isset($_POST['contrasena']))) {
            /**
             * limpiamos lo que se nos manda por post de posibles símbolos no permitidos
             * y creamos un patrón que valide una expresión regular de correo
             */
            $usuarioFormulario = trim(strip_tags($_POST['usuario']));
            $contrasenaFormulario = trim(strip_tags($_POST['contrasena']));
            $patron = '/^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,3}$/';
            
            /**
             * comprobamos que coincida el patrón
             */
            if (preg_match($patron, $_POST['usuario'])) {
                //echo "<p>Usuario: " . $usuarioFormulario . "</p>";
                //echo "<p>Contraseña: $contrasenaFormulario</p>";
                /**
                 * es entonces cuando le pasamos como argumento
                 *  al método usuarioExiste de la clase usuario
                 * las variables en las que almacenamos lo que
                 * nos llegó por el formulario
                 */
                if ($usuario->usuarioExiste($usuarioFormulario, $contrasenaFormulario)) {
                    //echo " el usuario existe";
                    /**
                     * si existe almacenamos en sesión el usuario
                     * y llamamos a vistaUsuario
                     */
                    $_SESSION['usuario'] = $usuario;
                    //header("Location:vistaUsuario.php");
                    require_once 'vistaUsuario.php';
                } else {
                    //no existe el usuario
                    echo " el usuario no existe";
                    //echo "<a>Crear usuario</a>";
                }

            } else {
                echo " falló el patrón";
            }
        } 
    }
    
} else {
    /**
     * entra al formulario si no se cumple ninguna condición
     */
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="Estructura Web/CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="Estructura Web/CSS/estilos.css">
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
    echo "       <button class=\"button\" type=\"submit\" name=\"register\" value=\"register\">Registrarse</button>\n";
    echo "    </form>\n";
}
