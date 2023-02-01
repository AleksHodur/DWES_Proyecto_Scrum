<?php

require_once 'Conexion.php';
/**
 * @author Eduardo Carretero, Rubén Torres, Aleksandra Hodur
 */
/** 
 * creamos una clase usuario en la que tendremos diferentes métodos que llamaremos desde el programa principal
*/
class Usuario {
    private $correo;
    private $contrasena;
    private $tipo;
    private $id;
    private $descripcion;
    //private $conexion;

    /**
     * Summary of __constructor
     * @param string $correo
     * @param string $correoUsuario
     * @param string $contrasena
     * @param string $tipo
     * @param string $id
     * @return void
     */
   /* public function __constructor($correo, $contrasena){
        echo $correo;
        $this->setCorreo($correo);
        $this->setContrasena($contrasena);
        //$this->conexion = new Conexion('mysql:host=db', 'alumnado', 'alumnado');
    }*/
    /** 
     * @author Rubén Torres
    */
    /**
     * Summary of UsuarioExiste
     * @param string $correo
     * @param string $contrasena
     * @return bool
     */
    /**
     *con la función usuario existe llamamos al método estático leer que está en conexión para comprobar que esté dentro de la bdd
     */
    public function usuarioExiste($correo, $contrasena) {
        $conexion = new Conexion();
        
        $condiciones = 'correo = :correo AND contrasena = :contrasena';
        $arrayExecute = array("correo" => $correo, "contrasena" => $contrasena);
        $id = $conexion->buscarId('usuario', $condiciones, $arrayExecute);
        echo $id;
        if($id == -1) {
            echo "Usuario no existe";
            return false;
        } else {
            echo "Se ha encontrado $id Id";
            $this->asignarAtributos($id);
            return true;
        }
    }

    public function asignarAtributos($id){
        $conexion = new Conexion();
        $atributos = $conexion->leerPorId('usuario', $id);
        $error = false;

        if(isset($atributos['id'])){
            $this->setId($atributos['id']);
        }else{
            $error = true;
        }

        if(isset($atributos['correo'])){
            $this->setCorreo($atributos['correo']);
        }else{
            $error = true;
        }

        if(isset($atributos['contrasena'])){
            $this->setContrasena($atributos['contrasena']);
        }else{
            $error = true;
        }

        if(isset($atributos['tipo'])){
            $this->setTipo($atributos['tipo']);
        }else{
            $error = true;
        }

        if(isset($atributos['descripcion'])){
            $this->setDescripcion($atributos['descripcion']);
        }else{
            $error = true;
        }

        if($error){
            echo "Error en la asignación de atributos";
        }
    }

    /** 
     * @author Rubén Torres
    */
    /**
     * Summary of setUsuario
     * @param string $correo
     * @param string $contrasena
     * @param string $tipoUsuario
     * @return void
     * Con este setter insertamos los datos del usuario en la bdd
     */
    public function setUsuario($correo, $contrasena, $tipoUsuario) {
       // $arrayExecute = 'array("valoresCampos" =>$valoresCampo)';
       $conexion = new Conexion();
        $resultado = $conexion->insertar('usuario', 'correo, contrasena, tipo', $correo . ', ' . $contrasena . ', ' . $tipoUsuario);

        if ($resultado) {
            echo "Se ha creado el usuario";

        } else {
            echo "Error al crear el usuario";
        }
    }

    /**
     * @author Rubén Torres
     * getters y setters correspondientes
     */
    public function getcorreo() {
        return $this->correo;
    }
    public function getId() {
        return $this->id;
    }
    public function getContrasena(){
        return $this->contrasena;
    }
    public function getTipo(){
        return $this->tipo;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setContrasena($contrasena){
        $this->contrasena = $contrasena;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function toString(){
        return "Id: " . $this->getId() . "\nCorreo: " . $this->getCorreo() .
        "\nContrasena: " . $this->getContrasena() . "\nTipo: " . $this->getTipo() . 
        "\nDescripcion: " . $this->getDescripcion();
    }

    
    }
    
?>