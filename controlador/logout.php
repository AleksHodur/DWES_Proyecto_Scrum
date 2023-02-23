<?php
/**
 * @author  Eduardo Carretero
 * requiere la clase UsuarioSesion
 */
require_once '../controlador/UsuarioSesion.php';
/** 
 * @var object $usuarioSesion
 * instanciamos la clase y creamos el objeto
 */
$usuarioSesion = new UsuarioSesion();
/**
 * llamamos al método cerrar sesión que está dentro de la clase UsuarioSesion
 */
$usuarioSesion->cerrarSesion();
/**
 * nos devuelve al index
 */
header("location: ../index.php");