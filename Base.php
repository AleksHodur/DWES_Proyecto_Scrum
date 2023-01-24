<?php
/**
 * CLASE Base
 * 
 * En ella creamos la base de datos y la tabla
 * 
 * @author Pablo Fernandez
 */
class Base {
	/**
	 * 
	 * @var object
	 */
	protected $bd;
/**
 *La funcion crea la base de datos y la tabla 
 */
public function creaBases(){
		/**
	 * Crea los atributos para conectarse
	 * @var string dsn
	 * @var string usuario
	 * @var string clave 
	 */
  $dsn = 'mysql:host=db';
  $usuario = 'alumnado';
  $clave = 'alumnado';
  $bd = new PDO($dsn, $usuario, $clave);


  /**
   * Lo hacemos con un try catch la creacion de la base
   */
  try {

  	  	$consulta = $bd->query ("CREATE DATABASE IF NOT EXISTS bddPodcast CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

		$bd = null;
		$bd = new PDO($dsn, $usuario, $clave);
	
    	//if($consulta != null){

/**
 * Realiza la creacion de la base 
 */
    		echo "<p>Base de datos creada</p>";
    		$usarBase=$bd->query("USE bddPodcast");
    		$tablas = [
        			'usuario' => "CREATE TABLE IF NOT EXISTS usuario (
          				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          				nombre VARCHAR(40) NOT NULL,
          				contrasena VARCHAR(40) NOT NULL,
						tipo VARCHAR(15) NOT NULL
        			)",
     	 	];
				/**
	 * Saca el nombre de la tabla craeada
	 */
    		foreach ($tablas as $nombre => $sql){
        			if($bd->query($sql)){
          			echo "<p>Tabla $nombre creada</p>\n";
    		 }
      	   }
    	 /*}else{
          $borrarBase = $bd->query("DROP DATABASE bddPodcast");
          $consulta = $bd->query ("CREATE DATABASE IF NOT EXISTS bddPodcast");
          $usarBase=$bd->query("USE bddPodcast");
      		$tablas = [
				'usuario' => "CREATE TABLE  IF NOT EXISTS usuario (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					nombre VARCHAR(40) NOT NULL,
					contrasena VARCHAR(40) NOT NULL,
				  tipo VARCHAR(15) NOT NULL
			  )",
       	 	];
				foreach ($tablas as $nombre => $sql){
        			if($bd->query($sql)){
          			echo "<p>Tabla $nombre creada.</p>\n";
    		 }
      	   }

      }*/

	  $bd = null;
/**
	 * En caso de fallo saldria el siguiente error
	 */
  } catch (PDOException $e) {
    echo "Fallo la conexion:" . $e->getMessage();
	echo "<p>Fallo de creación BD</p>";

  }

  /*try{

	$consulta = $this->bd->query("
	CREATE TABLE usuario (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		nombre VARCHAR(40) NOT NULL,
		contrasena VARCHAR(40) NOT NULL,
	  	tipo VARCHAR(15) NOT NULL
  	)");

  }catch (PDOException $e) {
    echo "Fallo la conexion:" . $e->getMessage();
	echo "<p>Fallo de creación tablas</p>";
  }*/
 }
}
/**
  * Crea un objeto de la clase y ejecuta la funcion
  */
$base = new Base();
$base->creaBases();
?>
