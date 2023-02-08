<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <title>Bienvenido</title>
    <link rel="stylesheet" type="text/css" href="CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
  </head>
  <body>

<?php
switch ($usuario1->getTipo()) {
    case 1 : 
             $tipo = "profesor";
             break;
     case 2 :
             $tipo = "alumno";
             break;
     default :
             $tipo = "no se detecta tipo";
             break;
 }
 echo "bienvenido $tipo";