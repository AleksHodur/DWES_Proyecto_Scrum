<?php

require_once "Conexion.php";
require_once "Usuario.php";

$correo = 'juan@gmail.com';
$contrasena = 'hola';

$conexion = new Conexion();
//$conexion->conectar();
//$conexion->iniciarPDO();

$usuario = new Usuario();
//$arrayId = array('correo' => $correo, 'contrasena' => $contrasena);
//$id = $conexion->buscarId('usuario', 'correo = :correo AND contrasena = :contrasena', $arrayId);

if($usuario->usuarioExiste($correo, $contrasena)){
    echo "<p>El usuario existe. Id: " .  $usuario->getId() . "</p>";
}else{
    echo "<p>El usuario no existe</p>";
}

/*$campos = $conexion->leerPorId('usuario', $id);

echo "<pre>" . print_r($campos) . "</pre>";*/