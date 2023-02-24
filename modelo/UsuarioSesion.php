<?php

class UsuarioSesion {

    /**
    * public function __construct() {
    * session_start();
    *}
    *más adelante veremos si podemos utilizarlo así
     */

    /**
     * Summary of setUsuarioActual
     * @param string $usuario
     * @return void
     * el setter sirve para almacenar en sesión el usuario
     */
    public function setUsuarioActual($usuario) {
        $_SESSION['usuario'] = $usuario;
    }

    /**
     * Summary of getUsuarioActual
     * @return string
     * con el getter obtienes la variable usuario almacenada en sesión
     */
    public function getUsuarioActual() {
        return $_SESSION['usuario'];
    }

    /**
     *
     * @return void
     */
    public function cerrarSesion() {
        /**
         *cerramos la sesión vaciando $_SESSION, con la función que la destruye y eliminando las cookies
         */
        $_SESSION = array();
        setcookie(session_name(), "", time() - 3600);
        session_destroy();
    }

}