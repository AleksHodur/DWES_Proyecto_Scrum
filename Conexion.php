<?php
  require_once ("Base.php");
  define ('DB_HOST','db');
  define ('DB_USUARIO','alumnado');
  define ('DB_contrasena','alumnado');
  define ('DB_NOMBRE','bddPodcast');
  define ('DB_CHARSET','utf8');
  
  /**
   * Clase con funciones estáticas que interactúan con la base de datos
   * @author Aleksandra y Pablo
   */
  class Conexion extends Base{
    private $cadenaConexion;
    private $conexion;

    //LO QUE QUEREMOS USAR
    //protected static $dsn = 'mysql:host=db';
   //protected static $usuario = 'alumnado';
    //protected static $clave = 'alumnado';

    /*public function __constructor($dsn, $usuario, $clave){
        $this->dsn = $dsn;
        $this->usuario = $usuario;
        $this->clave = $clave;
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
    static function insertar($tabla, $nombresCampos, $valoresCampos) {
        try{
            $dsn = 'mysql:host=db';
            $usuario = 'alumnado';
            $clave = 'alumnado';

            $bd = new PDO($dsn, $usuario, $clave);
            $consulta = "INSERT INTO :tabla (:nombresCampos) VALUES (:valoresCampos)";
            $resultado = $bd->prepare($consulta);
            $resultado->execute(array('tabla' => $tabla, 'nombresCampos' => $nombresCampos, 'valoresCampos' => $valoresCampos));

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
    static function eliminar($tabla, $id) {

        try{
            $dsn = 'mysql:host=db';
            $usuario = 'alumnado';
            $clave = 'alumnado';

            $bd = new PDO($dsn, $usuario, $clave);
            $consulta = "DELETE FROM :tabla WHERE ID = ':id'";
            $resultado = $bd->prepare($consulta);
            $resultado->execute(array('tabla' => $tabla, 'id' => $id));

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
    static function actualizar($tabla, $id, $nombreCampo, $valorCampo) {

        try{
            $dsn = 'mysql:host=db';
            $usuario = 'alumnado';
            $clave = 'alumnado';
            $bd = new PDO($dsn, $usuario, $clave);
            $consulta = "UPDATE :tabla SET  :nombreCampo = ':valorCampo' WHERE ID = ':id'";
            $resultado = $bd->prepare($consulta);
            $resultado->execute(array('tabla' => $tabla, 'nombreCampo' => $nombreCampo, 'id' => $id));

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
    static function leer($tabla, $nombre, $contrasena) {

        $dsn = 'mysql:host=db';
        $usuario = 'alumnado';
        $clave = 'alumnado';

        echo "<p>Esto es Conexión:";
        echo "<p>Nombre tabla: $tabla</p>";
        echo "<p>Usuario: $nombre</p>
        <p>Contrasena: $contrasena</p>";


        $existe = false;

        try{
            
            $bd = new PDO($dsn, $usuario, $clave);
            $consulta = "SELECT * FROM :tabla WHERE nombre = ':nombre' AND contrasena = ':contrasena';";
            echo "<p>He llegado aquí 1</p>";
            $resultado = $bd->prepare($consulta);
            echo "<p>He llegado aquí 2</p>";
            $resultado->execute(array(':tabla' => $tabla, ':nombre' => $nombre, ':contrasena' => $contrasena));
            echo "<p>He llegado aquí 3</p>";
            $filas = $resultado->rowCount();
            echo "<p>He llegado aquí 4</p>";


            if($filas > 0){
                $existe = true;
            }
            $bd = null;

        }catch(Exception $e){
            echo "<p>La fila no existe</p>";
        }

        return $existe;
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
    static function listarPorCampo($tabla, $nombreCampo, $valorCampo) {

        try{
            $dsn = 'mysql:host=db';
            $usuario = 'alumnado';
            $clave = 'alumnado';
            $bd = new PDO($dsn, $usuario, $clave);
            $consulta = "SELECT FROM :tabla WHERE  :nombreCampo = ':valorCampo'";
            $resultado = $bd->prepare($consulta);
            $resultado->execute(array('tabla' => $tabla, 'nombreCampo' => $nombreCampo,'valorCampo' => $valorCampo));

            return "Consulta realizada con éxito";

        }catch(Exception $e){
            return "Error de conexión";
        }
    }

    /**
     * Función cuyo objetivo es conectar con la base de datos
     * @author Pablo
     * @param string $cadenaConexion dsn de la conexion
     * @param Object $conexion objeto PDO que conecta con la BD
     */
    static function conectar(){
        try{
            $cadenaConexion = "mysql:host=".DB_HOST.";dbname=".DB_NOMBRE.";charset=".DB_CHARSET;
            $conexion = new PDO($cadenaConexion, DB_USUARIO, DB_contrasena);
            echo "Conexion Establecida";

       }catch(Exception $ex){
         echo "Error de conexion";
       }
   }
}