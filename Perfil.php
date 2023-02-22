<?php

/**
 * Clase para instanciar un objeto que corresponda a una fila
 * de la tabla Perfil
 * @author Pablo Fernandez
 */

require_once 'Conexion.php';

class Perfil {
/**
     * ATRIBUTOS DE LA TABLA
     * @param string $id
     * @param string $nombre
     * @param string $descripcion
     * @param string conexion
     */

    private $id;
    private $nombre;
    private $descripcion;
    private $conexion;

    /**
     * DEFINICION DEL CONSTRUCTOR  
     *  @param string $dsn
     *  @param string $nombre
     *  @param string clave
     *  crea la conexion 
     */

    public function __construct(){
        $dsn = 'mysql:host=db;dbname=bddPodcast';
        $usuario = 'alumnado';
        $clave = 'alumnado';
        $this->conexion = new PDO($dsn, $usuario, $clave);
    }

        /**
     * Setters y Getters de los atributos de los atributos
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


    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * FUNCION INSERTAR DATOS EN LA TABLA PERFIL PASANDILE NOMBRE Y DESCRIPCION
     * @param string $nombre
     * @param string $descripcion
     */
    
     public function insertar($nombre, $descripcion) {
        $consulta = $this->conexion->prepare("INSERT INTO perfil (nombre, descripcion ) VALUES (:nombre, :descripcion)");
        $consulta->execute([':nombre' => $nombre, ':descripcion' => $descripcion]);
      //  echo "<p>Valor insertado</p>";
     }


     /**
      * FUNCION BORRAR DATOS DE LA TABLA A TRAVES DEL ID
      * @param int $id
      */


    public function borrar($id){
        $consulta = $this->conexion->prepare("DELETE FROM perfil WHERE id = :id");
        $consulta->execute([':id' =>$id]);
        //echo "<p>Perfil borrados</p>";

    }
 
    /** 
     *FUNCION actulizarNombre EN LA QUE LE PASAS EL ID PARA MODIFICAR EL NOMBRE
     * @param int id
     * @param string nombre
    */

    public function actualizarNombre($id, $nombre){
        $consulta = $this->conexion->prepare("UPDATE perfil SET nombre=:nombre where id=:id ");
        $consulta->execute([':nombre' => $nombre, ':id'=>$id]);
        //echo "<p>$id modificado</p>";

    }


 /** 
     *FUNCION actulizarDescripcion EN LA QUE LE PASAS EL ID PARA MODIFICAR LA DESCRIPCION
     * @param int id
     * @param string descripcion
    */

    public function actualizarDescripcion($id, $descripcion){
        $consulta = $this->conexion->prepare("UPDATE perfil SET  descripcion=:descripcion where id=:id ");
        $consulta->execute([':descripcion' => $descripcion, ':id'=>$id]);
      //  echo "<p>Descripcion modificados</p>";
    }

    /**
     * FUNCION consultar LA CUAL TE SACA UNA TABALA CON TODOS LOS CAMPOS
     */

    public function consultar() {
        try{
            $result = $this->conexion->query("SELECT * FROM perfil");
            echo "<table border=1>";
            echo "<tr><th>ID</th><th>NOMBRE</th><th>DESCRIPCION</th></tr>";
            foreach ($result as $elemento) {
            echo "<tr><td>" .$elemento['id']. "</td><td>".$elemento['nombre']."</td><td>".$elemento['descripcion']."</td><tr>";
            }
            echo "</table>";
        }catch(Exception $ex){
            echo "Fallo consultar";
        }
    }

/*
    public  function conectar(){
        try{
        $this->cadenaConexion = "mysql:host=".DB_HOST.";dbname=".DB_NOMBRE.";charset=".DB_CHARSET;
        $this->conexion = new PDO($this->cadenaConexion, "alummnado", "alumnado");
        echo "Conexion Establecida";
    }catch(Exception $ex){
        echo "Error de conexion";
    }
    }
*/
  
}

$perfiles =  new Perfil();
//$perfiles->conectar();
//$perfiles->insertar("Paco", "Alumno");
//$perfiles->insertar("Juan", "Profesor");
//$perfiles->actualizarDescripcion(1, "Juan");
//$perfiles->borrar(1);
//$perfiles->actualizarNombre(2, "Paco");
//$perfiles->actualizarDescripcion(2,"Alumno");

$perfiles->consultar('');