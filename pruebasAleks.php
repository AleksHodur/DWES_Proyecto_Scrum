<?php

require_once "Conexion.php";

$usuario = 'juan@gmail.com';
$contrasena = 'hola';

$conexion = new Conexion();
//$conexion->conectar();
//$conexion->iniciarPDO();

$arrayId = array('correo' => $usuario, 'contrasena' => $contrasena);
$id = $conexion->buscarId('usuario', 'correo = :correo AND contrasena = :contrasena', $arrayId);

if($id < 0){
    echo "<p>El usuario no existe</p>";
}else{
    echo "<p>El usuario existe. Id: $id</p>";
}

$campos = $conexion->leerPorId('usuario', $id);

echo "<pre>" . print_r($campos) . "</pre>";