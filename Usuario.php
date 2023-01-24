<?php

require_once 'Conexion.php';
/**
 * @author Eduardo Carretero
 */
/** 
 * creamos una clase usuario en la que tendremos diferentes métodos que llamaremos desde el programa principal
*/
class Usuario {
    private $nombre;
    private $nombreUsuario;
    private $id;
    //private $conexion;

    /**
     * Summary of __constructor
     * @param string $nombre
     * @param string $usuario
     * @param string $id
     * @return void
     */
    public function __constructor($nombre, $usuario, $id){
        $this->nombre = $nombre;
        $this->nombreUsuario = $usuario;
        $this->id = $id;
        //$this->conexion = new Conexion('mysql:host=db', 'alumnado', 'alumnado');
    }
    /** 
     * @author Rubén Torres
    */
    /**
     * Summary of UsuarioExiste
     * @param string $nombre
     * @param string $contrasena
     * @return bool
     */
    /**
     *con la función usuario existe llamamos al método estático leer que está en conexión para comprobar que esté dentro de la bdd
     */
    public function usuarioExiste($nombre, $contrasena) {
        //if($this->conexion != null){
            return Conexion::leer('usuario', $nombre, $contrasena);
        /*}else{
            echo "<p>Conexión es nulo</p>";
            return false;
        }*/
    }
    /** 
     * @author Rubén Torres
    */
    /**
     * Summary of setUsuario
     * @param string $nombre
     * @param string $contrasena
     * @param string $tipoUsuario
     * @return void
     * Con este setter insertamos los datos del usuario en la bdd
     */
    public function setUsuario($nombre, $contrasena, $tipoUsuario) {
        $resultado = Conexion::insertar('usuario', 'nombre, contrasena, tipo', $nombre . ', ' . $contrasena . ', ' . $tipoUsuario);

        if($resultado){
            echo "Se ha creado el usuario";
        }else{
            echo "Error al crear el usuario";
        }
    }

    /**
     * @author Rubén Torres
     * getters y setters correspondientes
     */
    public function getNombre() {
        return $this->nombre;
    }
    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setNombreUsuario($nombreUsuario){
        $this->nombre = $nombreUsuario;
    }

     /**
     * @author Rubén Torres
     */
    public function getId() {
        return $this->nombre;
    }
    public function getContrasena(){
        return $this->nombreUsuario;
    }
    public function setId($nombre){
        $this->nombre = $nombre;
    }
    public function setContrasena($nombreUsuario){
        $this->nombre = $nombreUsuario;
    }


    
    }
?>