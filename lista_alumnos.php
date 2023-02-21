<?php
require_once 'Conexion.php';
require_once 'Usuario.php';

session_start();

if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];

    if($usuario->getTipo() == 2){

        $alumnos = Conexion::listarPorCampo('usuario', 'tipo = :tipo', array('tipo' => 1)); 
        $json = "[\n";

        for($i = 0; $i < count($alumnos); $i++){
            $json .= "{\"correo\": \"" . $alumnos[$i]['correo'] . "\",
                \"contrasena\": \"" . $alumnos[$i]['contrasena'] . "\",
                \"tipo\": " . $alumnos[$i]['tipo'] . ",
                \"descripcion\": \"" . $alumnos[$i]['descripcion'] . "\"}\n";
        }

        $json .= "]";
        echo $json;
    }
}