<?php
/**
 * @author Eduardo Carretero
 * llamamos a las clases que vamos a utilizar para la sesión
 */
require_once '../modelo/UsuarioSesion.php';
require_once '../modelo/Usuario.php';

/**instanciamos las clases obteniendo los objetos correspondientes
 */
 /**
  * @var object $usuarioSesion
  * @var object $usuario
	 */
$usuarioSesion = new UsuarioSesion();
$usuario = new Usuario();
/**
*hacemos la comprobación de que el token ha sido almacenado en sesión y comprobamos que sea igual al que el formulario mandó
 */

if ((isset($_SESSION['token'])) && (isset($_POST['token']))) {
    if ($_SESSION['token'] == $_POST['token']) {
        /**
         * comprobamos si el usuario está en sesión, en cuyo caso almacenamos el usuario en la bdd con la función setUsuario y le pasamos como argumento getUsuarioActual
         */
        echo "token correcto";
        if (isset($_SESSION['usuario'])) {
            echo "Sesión iniciada";
            //$usuario->setUsuario($usuarioSesion->getUsuarioActual());

            /**
             * comprobamos que existan tanto el usuario como la contraseña con la función UsuarioExiste utilizando la función estática leer
             */
        } elseif ((isset($_POST['usuario'])) && (isset($_POST['contrasena']))) {

            /** 
             * en caso de que no esté almacenado en sesión  pues almacenamos en variables los datos del formulario
             * @var string $usuarioFormulario
             * @var string $contrasenaFormulario
             */
            $usuarioFormulario = trim(strip_tags($_POST['usuario']));
            $contrasenaFormulario = trim(strip_tags($_POST['contrasena']));
            $patron = '/^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,3}/';

            if (preg_match($patron, $_POST['usuario'])) {
                echo "<p>Usuario: " . $usuarioFormulario . "</p>";
                echo "<p>Contraseña: $contrasenaFormulario</p>";
            } else {
                require_once 'login.php';
                echo "falló el patrón";
            }
            /**
             * llamamos al método UsuarioExiste de la clase usuario para comprobar si ese usuario existe en la bdd
             */
            if ($usuario->UsuarioExiste()) {
                /**
                 * almacenamos al usuario en sesión con setUsuarioActual
                 */
                $usuarioSesion->setUsuarioActual($usuarioFormulario);
                /**
                 * Esto sería para el código futuro poder almacenar el usuario en la bdd
                 * $usuario->setUsuario($usuarioFormulario);
                 */
            
                echo "usuario válido";
            /**
             * nos devuelve al login en caso de error dentro de la sesión
             * @var string $errorLogin
             */
            } else {
                $errorLogin = "nombre de usuario/contraseña incorrecto";
                require_once 'login.php';
                echo "llamada 1";
            }

        } else {
            /**
             * aquí es donde nos manda al principio, ya que no hay sesión aún
             */
            require_once 'login.php';
            echo "llamada 2";
        }
    } else {
        /**
         * En caso de que falle la comprobación del token nos devuelve al login
         */
        echo "El inicio de sesión no es valido.";
        require_once 'login.php';
    }
} else {
    require_once 'login.php';
    echo "llamada final";
}