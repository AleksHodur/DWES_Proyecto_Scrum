<?php
  define ('DB_HOST','db');
  define ('DB_USUARIO','alumnado');
  define ('DB_contrasena','alumnado');
  define ('DB_NOMBRE','bddPodcast');
  define ('DB_CHARSET','utf8');
  
  /**
   * Clase con funciones estáticas que interactúan con la base de datos
   * @author Aleksandra y Pablo
   */
  class Conexion{

    /**
     * Función cuyo objetivo es conectar con la base de datos
     * @author Pablo y  Aleksandra
     * @param string $cadenaConexion dsn de la conexion
     * @param Object $conexion objeto PDO que conecta con la BD
     */
    static public function conectar(){
        try{
            $cadenaConexion = "mysql:host=".DB_HOST.";dbname=".DB_NOMBRE.";charset=".DB_CHARSET;
            $conexion = new PDO($cadenaConexion, DB_USUARIO, DB_contrasena);
            return $conexion;
            echo "Conexion Establecida";

       }catch(Exception $ex){
         echo "Error de conexion";
       }
   }

    /**
     * Función cuyo objetivo es insertar nuevas filas en una tabla de la base de datos
     * @author Aleksandra
     * @param string $tabla nombre de la tabla
     * @param string $nombresCampos los nombres de los campos a insertar separados por comas: campo1, campo2, campo3
     * @param string $valoresCampos los valores de los campos a insertar en formato campo = :campo
     * @param string $arrayExecute array que se meterá como parámetro en la función execute de la consulta, tendrá
     *               una estructura clave valor, donde la clave tendrá que corresponder con lo puesto en $valoresCampos:
     *               array('campo' => valorCampo)
     */
    static public function insertar($tabla, $nombresCampos, $valoresCampos, $arrayExecute) {

        try{
            $consulta = "INSERT INTO $tabla ($nombresCampos) VALUES ($valoresCampos);";
            $resultado = self::conectar()->prepare($consulta);
            //$resultado->execute();
            $resultado->execute($arrayExecute);
            
            return true;

        }catch(Exception $e){
            return false;
        }
    }

    /**
     * Función cuyo objetivo es eliminar filas de tabla de la base de datos
     * @author Aleksandra
     * @param string $tabla nombre de la tabla a la que pertenece la fila
     * @param string $id id de la fila a eliminar
     */
    static public function eliminar($tabla, $id) {

        try{
            $consulta = "DELETE FROM $tabla WHERE ID = :id;";
            $resultado = self::conectar()->prepare($consulta);
            $resultado->execute(array('id' => $id));

            return true;

        }catch(Exception $e){
            return false;
        }
    }

    /**
     * Función cuyo objetivo es actualizar filas de una tabla de la base de datos
     * @author Aleksandra
     * @param string $tabla nombre de la tabla
     * @param string $id de la fila a actualizar
     * @param string $nombreCampo nombre del campo a actualizar
     * @param string $valorCampo nuevo valor del campo
     */
    static public function actualizar($tabla, $id, $nombreCampo, $valorCampo) {

        try{
            $consulta = "UPDATE $tabla SET  $nombreCampo = :valorCampo WHERE ID = :id;";
            $resultado = self::conectar()->prepare($consulta);
            $resultado->execute(array('valorCampo' => $valorCampo, 'id' => $id));

            echo "<p>Actualización realizada con éxito</p>";

        }catch(Exception $e){
            echo "<p>Error de actualización</p>";
        }
    }

    /**
     * Función cuyo objetivo es leer filas de una tabla de la base de datos
     * y devolver todos sus campos en un array
     * y devolver todos sus campos en un array
     * @author Aleksandra
     * @param string $tabla nombre de la tabla
     * @param string $id id de la fila por leer
     * @return array $campos array de los campos de la fila con sus valores
     */
    static public function leerPorId($tabla, $id) {

        try{
            $campos = [];
            $consulta = "SELECT * FROM $tabla WHERE ID = :id;";
            $resultado = self::conectar()->prepare($consulta);
            $resultado->execute(array('id' => $id));

            foreach($resultado as $elemento){

                $nombresCampos = self::getNombresCampos($tabla);

                for($i = 0; $i < count($nombresCampos); $i++){
                    $nombre = $nombresCampos[$i];
                    $campos[$nombre] = $elemento[$nombre];
                }
            }

            return $campos;
            //$bd = null;

        }catch(Exception $e){
            echo "<p>La fila no existe leerporid</p>";
        }

    }

    /**
     * Función cuyo objetivo es devolver un array con los nombres de los
     * campos de una tabla
     * @author Aleksandra Hodur
     * @param String $tabla nombre de la tabla en la BD
     */
    static public function getNombresCampos($tabla){

        try{
            $consulta = "DESCRIBE $tabla";
            $resultado = self::conectar()->prepare($consulta);
            $resultado->execute();
            $nombres = $resultado->fetchAll(PDO::FETCH_COLUMN);

            return $nombres;
        }catch(Exception $e){
            echo "<p>Fallo en nombres campos</p>";
        }
    }

    /**
     * Función cuyo objetivo es buscar el id de una fila que coincida con la condición
     * Si no existe dicha fila, devuelve -1. Si existe, devuelve el id
     * @param string $tabla nombre de la tabla a consultar
     * @param string $condiciones las condiciones que se desea consultar en formato campo = :campo
     * @param array $arrayExecute array de índice valor que se le pasa al objeto resultado para realizar execute()
     *              Tendrá una estructura clave valor, donde la clave tendrá que corresponder con lo puesto en $condiciones:
     *              array('campo' => valorCampo)
     */
    static public function buscarId($tabla, $condiciones, $arrayExecute){

        $id = -1;

        try{
            
            $consulta = "SELECT * FROM $tabla WHERE $condiciones;";
            $resultado = self::conectar()->prepare($consulta);
            $resultado->execute($arrayExecute);
            $filas = $resultado->rowCount();
            
            foreach($resultado as $elemento){
                $id = $elemento['id'];
            }

        }catch(Exception $e){
            echo "<p>La fila no existe buscarid</p>";
        }

        return $id;
    }
    


    /**
     * Función cuyo objetivo es leer filas de una tabla de la base de datos
     * @author Aleksandra
     * @param string $tabla nombre de la tabla
     * @param string $condicion condición que se desea consultar
     * @param array $arrayExecute array de índice valor que se le pasa objeto resultado para realizar execute()
     */   
    static public function listarPorCampo($tabla, $condicion, $arrayExecute) {

        try{
            
            $filas = [];
            $consulta = "SELECT * FROM $tabla WHERE $condicion;";
            $resultado = self::conectar()->prepare($consulta);
            $resultado->execute($arrayExecute);

            foreach($resultado as $elemento){
                $campos = [];
                $nombresCampos = self::getNombresCampos($tabla);

                for($i = 0; $i < count($nombresCampos); $i++){
                    $nombre = $nombresCampos[$i];
                    $campos[$nombre] = $elemento[$nombre];
                }

                $filas[] = $elemento;
            }

            return $filas;

        }catch(Exception $e){
            return false;
        }
    }

    
}