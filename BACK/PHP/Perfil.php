<?php

/**
 * Clase para instanciar un objeto que corresponda a una fila
 * de la tabla Perfil
 * @author Aleksandra Hodur
 */

require_once 'Conexion.php';

class Perfil {

    private $id;
    private $nombre;
    private $descripcion;

    /**
     * Setters que tienen como argumento el atributo que se va a modificar y
     * modifican el atributo actual por este
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->id = $nombre;
    }
    
    public function setDescripcion($descripcion) {
        $this->id = $descripcion;
    }

    /**
     * Getters que devuelven el atributo en concreto
     */
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
}