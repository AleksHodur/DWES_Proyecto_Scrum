<?php

/**
 * @author Pablo Fernández
 */
require_once('Conexion.php');
require_once('index.php');

class RastroUsuario{
    private $id;
    private $correo;
    private $horaConexion;
 

    /**
     * Getters y setters correspondientes a los atributos
     */
    public function getId() {
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getCorreo() {
        return $this->correo;
    }
    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function getHoraConexion() {
        return $this->horaConexion;
    }
    public function setHoraConexion($horaConexion){
        $this->getHoraConexion = $horaConexion;
    }

    public function insertarHora($usuarioFormulario){
        $conexion =  new Conexion();
        $hora = date('Y-m-d h:i:s');
        $nombresCampos = 'correo, horaConexion';
        $valoresCampos = ':correo, :horaConexion ';
        $arrayExecute = array('correo' => $usuarioFormulario, 'horaConexion' => $hora);
        $conexion -> eliminarRastro('rastrearUsuario', 'correo', $usuarioFormulario, );
        $conexion -> insertar('rastrearUsuario', $nombresCampos, $valoresCampos, $arrayExecute);
        
    }

}
?>
