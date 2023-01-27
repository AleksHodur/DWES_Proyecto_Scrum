<?php
  require_once ("Base.php");
  define ('DB_HOST','db');
  define ('DB_USUARIO','alumnado');
  define ('DB_contrasena','alumnado');
  define ('DB_NOMBRE','bddPodcast');
  define ('DB_CHARSET','utf8');
  
  /**
   * Clase con funciones estáticas que interactúan con la base de datos
   * @author Aleksandra
   */
  class Conexion extends Base{
    private $cadenaConexion;
    private $conexion;

    /*public $dsn = '';
    public $usuario = '';
    public $clave = '';
    public $bd = new PDO('mysql:host=db;dbname=bddPodcast;', 'alumnado', 'alumnado');

    /**
     * Función cuyo objetivo es conectar con la base de datos
     * @author Pablo
     * @param string $cadenaConexion dsn de la conexion
     * @param Object $conexion objeto PDO que conecta con la BD
     */
    public function conectar(){
        try{
            $cadenaConexion = "mysql:host=".DB_HOST.";dbname=".DB_NOMBRE.";charset=".DB_CHARSET;
            $conexion = new PDO($cadenaConexion, DB_USUARIO, DB_contrasena);
            return $conexion;
            echo "Conexion Establecida";

       }catch(Exception $ex){
         echo "Error de conexion";
       }
   }

    /*public function __constructor(){
        $this->dsn = 'mysql:host=db;dbname=bddPodcast;';
        $this->usuario = 'alumnado';
        $this->clave = 'alumnado';
        $this->bd = new PDO($this->dsn, $this->usuario, $this->clave);

    }*/

    /*public function iniciarPDO(){
        $this->bd = new PDO($this->dsn, $this->usuario, $this->clave);
    }*/

    /**
     * Función cuyo objetivo es insertar nuevas filas en una tabla de la base de datos
     * @author Aleksandra
     * @param string $dsn nombre del dsn
     * @param string $usuario usuario de la BD
     * @param string $clave clave de la BD
     * @param Object $bd objecto PDO de la BD
     * @param string $consulta consulta a realizar a la BD
     * @param Object @resultado resultado de la consulta
     */
    public function insertar($tabla, $nombresCampos, $valoresCampos) {
        try{
            $consulta = "INSERT INTO $tabla ($nombresCampos) VALUES (:valoresCampos);";
            $resultado = $this->conectar()->prepare($consulta);
            $resultado->execute(array("valoresCampos" => $valoresCampos));

            return true;

        }catch(Exception $e){
            return false;
        }
    }

    /**
     * Función cuyo objetivo es eliminar filas de tabla de la base de datos
     * @author Aleksandra
     * @param string $dsn nombre del dsn
     * @param string $usuario usuario de la BD
     * @param string $clave clave de la BD
     * @param Object $bd objecto PDO de la BD
     * @param string $consulta consulta a realizar a la BD
     * @param Object @resultado resultado de la consulta
     */
    public function eliminar($tabla, $id) {

        try{
            $consulta = "DELETE FROM $tabla WHERE ID = :id;";
            $resultado = $this->conectar()->prepare($consulta);
            $resultado->execute(array('id' => $id));

            return "Borrado realizado con éxito";

        }catch(Exception $e){
            return "Error al borrar";
        }
    }

    /**
     * Función cuyo objetivo es actualizar filas de una tabla de la base de datos
     * @author Aleksandra
     * @param string $dsn nombre del dsn
     * @param string $usuario usuario de la BD
     * @param string $clave clave de la BD
     * @param Object $bd objecto PDO de la BD
     * @param string $consulta consulta a realizar a la BD
     * @param Object @resultado resultado de la consulta
     */
    public function actualizar($tabla, $id, $nombreCampo, $valorCampo) {

        try{
            $consulta = "UPDATE $tabla SET  $nombreCampo = ':valorCampo' WHERE ID = :id;";
            $resultado = $this->conectar()->prepare($consulta);
            $resultado->execute(array('valorCampo' => $valorCampo, 'id' => $id));

            return "Actualización realizada con éxito";

        }catch(Exception $e){
            return "Error de actualización";
        }
    }

    /**
     * Función cuyo objetivo es leer filas de una tabla de la base de datos
     * @author Aleksandra
     * @param string $dsn nombre del dsn
     * @param string $usuario usuario de la BD
     * @param string $clave clave de la BD
     * @param bool $existe booleano que devuelve la función, que será true si la consulta devuelve resultados
     * @param Object $bd objecto PDO de la BD
     * @param string $consulta consulta a realizar a la BD
     * @param Object @resultado resultado de la consulta
     */
    public function leerPorId($tabla, $id) {

        try{
            
            $consulta = "SELECT * FROM $tabla WHERE ID = :id;";
            echo "<p>He llegado aquí 1</p>";
            $resultado = $this->conectar()->prepare($consulta);
            echo "<p>He llegado aquí 2</p>";
            $resultado->execute(array('id' => $id));
            echo "<p>He llegado aquí 3</p>";

            foreach($resultado as $elemento){
                $campos = [];

                $campos['id'] = $elemento['id'];
                $campos['nombre'] = $elemento['nombre'];
                $campos['contrasena'] = $elemento['contrasena'];
                $campos['tipo'] = $elemento['tipo'];//cambiar por perfil
            }

            return $campos;
            //$bd = null;

        }catch(Exception $e){
            echo "<p>La fila no existe</p>";
        }

    }

    public function buscarId($tabla, $condiciones, $arrayExecute){

        $id = -1;

        try{
            
            $consulta = "SELECT * FROM $tabla WHERE $condiciones;";
            $resultado = $this->conectar()->prepare($consulta);
            $resultado->execute($arrayExecute);
            $filas = $resultado->rowCount();

            foreach($resultado as $elemento){
                $id = $elemento['id'];
            }

        }catch(Exception $e){
            echo "<p>La fila no existe</p>";
        }

        return $id;
    }
    


    /**
     * Función cuyo objetivo es leer filas de una tabla de la base de datos
     * @author Aleksandra
     * @param string $dsn nombre del dsn
     * @param string $usuario usuario de la BD
     * @param string $clave clave de la BD
     * @param Object $bd objecto PDO de la BD
     * @param string $consulta consulta a realizar a la BD
     * @param Object @resultado resultado de la consulta
     */   
    public function listarPorCampo($tabla, $nombreCampo, $condicion, $arrayExecute) {

        try{
            
            $consulta = "SELECT FROM $tabla WHERE $condicion";
            $resultado = $this->conectar()->prepare($consulta);
            $resultado->execute($arrayExecute);

            return "Consulta realizada con éxito";

        }catch(Exception $e){
            return "Error de conexión";
        }
    }

    
}