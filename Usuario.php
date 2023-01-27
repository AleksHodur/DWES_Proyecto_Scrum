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
    private $contrasena;
    private $tipo;
    private $id;
    //private $conexion;

    /**
     * Summary of __constructor
     * @param string $nombre
     * @param string $nombreUsuario
     * @param string $contrasena
     * @param string $tipo
     * @param string $id
     * @return void
     */
    public function __constructor($nombre, $contrasena){
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->tipo = $tipo;
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
    public function usuarioExiste() {
        $conexion = new Conexion();
        $condiciones = 'nombre = :nombre AND contrasena = :contrasena;';
        $arrayExecute = array("nombre" => $this->nombre, "contrasena" => $this->contrasena);
        $id = $conexion->buscarId('usuario', $condiciones, $arrayExecute);
        if($id==-1){
            echo "Usuario no existe";
            return false;
        } else {
            echo "Se ha encontrado $id Id";
            return true;
        }
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
       // $arrayExecute = 'array("valoresCampos" =>$valoresCampo)';
        $resultado = $conexion->insertar('usuario', 'nombre, contrasena, tipo', $nombre . ', ' . $contrasena . ', ' . $tipoUsuario);

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
    public function getId() {
        return $this->nombre;
    }
    public function getContrasena(){
        return $this->nombreUsuario;
    }
    public function getTipo(){
        return $this->tipo;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setId($nombre){
        $this->nombre = $nombre;
    }
    public function setContrasena($nombreUsuario){
        $this->nombre = $nombreUsuario;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }


    
    }

    $usuario = new Usuario('Ruben', '123');
    if($usuario->usuarioExiste()){
        echo "existe";
    } else {
        echo "no existe";
    }
?>