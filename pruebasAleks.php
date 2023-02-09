<?php

require_once "Conexion.php";
require_once "Usuario.php";
require_once "Usuario.php";

$correo = 'juan@gmail.com';
$correo = 'juan@gmail.com';
$contrasena = 'hola';

$conexion = new Conexion();
//$conexion->conectar();
//$conexion->iniciarPDO();

$usuario = new Usuario();
//$arrayId = array('correo' => $correo, 'contrasena' => $contrasena);
//$id = $conexion->buscarId('usuario', 'correo = :correo AND contrasena = :contrasena', $arrayId);
$usuario = new Usuario();
//$arrayId = array('correo' => $correo, 'contrasena' => $contrasena);
//$id = $conexion->buscarId('usuario', 'correo = :correo AND contrasena = :contrasena', $arrayId);

if($usuario->usuarioExiste($correo, $contrasena)){
    echo "<p>El usuario existe. Id: " .  $usuario->getId() . "</p>";
}else{
if($usuario->usuarioExiste($correo, $contrasena)){
    echo "<p>El usuario existe. Id: " .  $usuario->getId() . "</p>";
}else{
    echo "<p>El usuario no existe</p>";
}

/*$campos = $conexion->leerPorId('usuario', $id);*/

echo "<pre>" . $usuario->toString() . "</pre>";

echo "<hr>
<p>Prueba de inserción de nuevo usuario</p>";

$nuevoUsuario = new Usuario();
$correo = 'ala@ala.ala';
$contrasena = 'ala';

if(!$nuevoUsuario->usuarioExiste($correo, false)){
    $nuevoUsuario->insertar($correo, $contrasena, '1', 'Descripcion corta de ala');
}else{
    echo "<p>El usuario ala ya existe</p>";
    echo "<p>El usuario ala ya existe</p>";
}

echo "<pre>" . $nuevoUsuario->toString() . "</pre>";

/*echo "<hr>
<p>Eliminación del usuario ala</p>";

$nuevoUsuario->eliminar(); */

echo "<hr>
<p>Actualización del usuario ala: cambio contrasena por hola</p>";
echo "<pre>" . $nuevoUsuario->toString() . "</pre>";

/*echo "<hr>
<p>Eliminación del usuario ala</p>";

$nuevoUsuario->eliminar(); */

echo "<hr>
<p>Actualización del usuario ala: cambio contrasena por hola</p>";

$nuevoUsuario->actualizar('contrasena', 'hola');
$nuevoUsuario->actualizar('contrasena', 'hola');