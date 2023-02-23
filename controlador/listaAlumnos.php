<?php
require_once '../modelo/Conexion.php';
require_once '../modelo/Usuario.php';

session_start();

if(isset($_SESSION['usuario'])){

    $usuario = $_SESSION['usuario'];
    if($usuario->getTipo() == 1){

        $alumnos = Conexion::listarPorCampo('usuario', 'tipo = :tipo', array('tipo' => 1)); 
        for($i = 0; $i < count($alumnos); $i++){
            $matrizUsuario = [
                "correo" => $alumnos[$i]['correo'],
                "contrasena" => $alumnos[$i]['contrasena'],
                "tipo" => $alumnos[$i]['tipo'],
                "descripcion" => $alumnos[$i]['descripcion']
            ];
           $json = json_encode($matrizUsuario);
        }

        
        echo "[$json]";
    }
}