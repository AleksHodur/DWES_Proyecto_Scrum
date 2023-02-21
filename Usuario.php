<?php

require_once 'Conexion.php';
/**
 * @author Eduardo Carretero, Rubén Torres, Aleksandra Hodur
 */
/** 
 * creamos una clase usuario en la que tendremos diferentes métodos que llamaremos desde el programa principal
*/
class Usuario {
    private $id;
    private $correo;
    private $contrasena;
    private $tipo;
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

    /**
     * Función cuyo objetivo es insertar un nuevo Usuario en la BD llamando
     * a la función insertar() de la clase Conexion y, seguidamente, asignarle esos
     * mismos atributos al objeto llamando a la función asignarAtributos()
     * 
     * @author Aleksandra Hodur
     * @param string $correo
     * @param string $contrasena
     * @param int $tipo
     * @param string $descripcion
     */
    public function insertar($correo, $contrasena, $tipo, $descripcion){
        if(!$this->usuarioExiste($correo, false)){ //de este modo, no se podrán repetir los correos
            //$conexion = new Conexion();
            $nombresCampos = 'correo, contrasena, tipo, descripcion';
            $valoresCampos = ":correo, :contrasena, :tipo, :descripcion";
            $arrayExecute = array('correo' => $correo, 'contrasena' => $contrasena, 'tipo' => $tipo, 'descripcion' => $descripcion);
            
            Conexion::insertar('usuario', $nombresCampos, $valoresCampos, $arrayExecute);
            $id = Conexion::buscarId('usuario', 'correo = :correo', array('correo' => $correo));
            $this->asignarAtributos($id);

            return true;
        }else{
            return false;
        }
    }


    /**
     * Función cuyo objetivo es eliminar al usuario de la BD llamando a la
     * función eliminar() de la clase Conexion
     * 
     * @author Aleksandra Hodur
     */
    public function eliminar(){
        //$conexion = new Conexion();
        Conexion::eliminar('usuario', $this->getId());
    }

    /**
     * Función cuyo objetivo es actualizar el usuario en la BD llamando a la función
     * actualizar() de la clase Conexion. Seguidamente, comprueba el nombre del campo,
     * y actualiza su atributo correspondiente en el objeto
     * 
     * @author Aleksandra
     * @param string $nombreCampo nombre del campo que se desea cambiar
     * @param string $valorCampo valor nuevo que se le desea asignar al campo
     * 
     */
    public function actualizar($nombreCampo, $valorCampo){
        //$conexion = new Conexion();
        Conexion::actualizar('usuario', $this->getId(), $nombreCampo, $valorCampo);

        switch($nombreCampo){
            case 'id':
                $this->setId($valorCampo);
                break;

            case 'correo':
                $this->setId($valorCampo);
                break;

            case 'contrasena':
                $this->setId($valorCampo);
                break;

            case 'tipo':
                $this->setId($valorCampo);
                break;

            case 'descripcion':
                $this->setId($valorCampo);
                break;
        }
    }

    /** 
     * @author Rubén Torres y Aleksandra Hodur
    */
    /**
     * Summary of UsuarioExiste
     * @param string $correo
     * @param string/bool $contrasena si es un booleano false, se realiza la búsqueda sin contrasena
     * @return bool
     */
    /**
     *con la función usuario existe llamamos al método estático leer que está en conexión para comprobar que esté dentro de la bdd
     */
    public function usuarioExiste($correo, $contrasena) {
        //$conexion = new Conexion();

        if($contrasena){
            $condiciones = 'correo = :correo AND contrasena = :contrasena';
            $arrayExecute = array("correo" => $correo, "contrasena" => $contrasena);
        }else{
            $condiciones = 'correo = :correo';
            $arrayExecute = array("correo" => $correo);
        }

        $id = Conexion::buscarId('usuario', $condiciones, $arrayExecute);

        if($id < 0) {
            //echo "Usuario no existe";
            return false;
        } else {
            //echo "Se ha encontrado $id Id";
            $this->asignarAtributos($id);
            return true;
        }
    }

    /**
     * Función cuyo objetivo es asignarle los atributos al objeto correspondientes con 
     * la tabla usuario en la BD. Llama a la función leerPorId() que lee una fila por su id
     * y devuelve un array clave valor, donde la clave corresponde al nombre del campo
     * y el valor, a su valor
     * @author Aleksandra Hodur
     * @param int $id el id del usuario en la BD
     */
    public function asignarAtributos($id){
        //$conexion = new Conexion();
        $atributos = Conexion::leerPorId('usuario', $id);
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


    public function toString(){
        return "Id: " . $this->getId() . "\nCorreo: " . $this->getCorreo() .
        "\nContrasena: " . $this->getContrasena() . "\nTipo: " . $this->getTipo() . 
        "\nDescripcion: " . $this->getDescripcion();
    }

    
    }
    
?>