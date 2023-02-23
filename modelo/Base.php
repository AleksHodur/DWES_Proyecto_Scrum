<?php

/**
 * Clase base de datos 
 * @author Pablo Fernandez
 */

 class Base {
//objeto PDO para usar la base de datos
	protected $bd;

	//funcion para crear la base
	public function creaBases(){
		//Conexion primero para asignar permisos a alumnado para relacionar las tablas
		/**
		 * @param string $root nombre del root
		 * @param string $usuarioRoot para el nombre del usuario
		 * @param string $claveRoot la clave del root
		 * @param Object $bdRoot objeto de la base
		 * @param string $dsn nombre del dsn
	     	 * @param string $usuario usuario de la BD
     		 * @param string $clave clave de la BD
     	 	 * @param Object $bd objecto PDO de la BD
		 * @param string $permisos para dar permisos al usuario alumnado
		 */
		$root = 'mysql:host=db';
		$usuarioRoot = 'root';
		$claveRoot = 'alumnado';
		$bdRoot = new PDO($root, $usuarioRoot, $claveRoot);
		$permisos = $bdRoot ->query("GRANT ALL PRIVILEGES ON *.* TO alumnado;");


		$dsn = 'mysql:host=db';
		$usuario = 'alumnado';
		$clave = 'alumnado';
		$bd = new PDO($dsn, $usuario, $clave);

		try {

			/**
			 * @param string $consulta para crear la base de datos
			 */
			$consulta = $bd->query ("CREATE DATABASE IF NOT EXISTS bddPodcast CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

			$bd = null;
			$bd = new PDO($dsn, $usuario, $clave);
			//echo "<p>Base de datos creada</p>";
			$usarBase=$bd->query("USE bddPodcast");
		/**
 		* @param array $tablaUsurio contiene la creacion de su tabla	 
 		*/
			$tablasUsuario = [
				'usuario' => "CREATE TABLE IF NOT EXISTS usuario (
					id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					correo VARCHAR(40) NOT NULL,
					contrasena VARCHAR(12) NOT NULL,
					tipo INT NOT NULL,
					descripcion VARCHAR(50)
				);"
			];

		/**
		 * @param array $tablaPerfil contiene la creacion de su tabla
		 */
			$tablaPerfil = [
				'perfil' => "CREATE TABLE IF NOT EXISTS perfil(
					id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					nombre VARCHAR(8) NOT NULL,
					descripcion VARCHAR(50)
				);"
			];

		//EJECUTA LAS CONSULTAS PARA CREAR LA TABLA PERFIL
			foreach ($tablaPerfil as $nombre => $sql){
					if($bd->query($sql)){
						//echo "<p>Tabla $nombre creada</p>\n";
						}
			}

		/**
		 * @param string $indice añade un indice para poder enlazar las tablas
		 */
			$indice = $bd ->query("ALTER TABLE perfil ADD INDEX (nombre);");

		//EJECTUA LAS CONSULTA PARA CREAR LA TABLA USUARIO
			foreach ($tablasUsuario as $nombre => $sql){
				if($bd->query($sql)){
					//echo "<p>Tabla $nombre creada</p>\n";
				}
			}
		
		/**
		 * @param string $datosPerfiles para insertar los datos en la tabla Perfiles
		 * @param string $datosUsuario  para insertar los datos en la tabla Usuarios
		 * */	
		$datosPerfiles = $bd->query("INSERT INTO perfil (nombre, descripcion) VALUES
		('Alumno', 'Puede subir y escuchar podcasts'),
		('Profesor', 'Puede validar alumnos y gestionar el contenido');");

	$datosUsuarios = $bd->query("INSERT INTO usuario ( correo, contrasena, tipo, descripcion) VALUES
		('juan@gmail.com', 'hola', 1, 'Puede subir y escuchar podcasts'),
		('juan@gmail.es', 'hola', 2, 'Puede validar alumnos y gestionar el contenido');");
      

			$bd = null;
		} catch (PDOException $e) {
			echo "Fallo la conexion:" . $e->getMessage();
			echo "<p>Fallo de creación BD</p>";

		}
	}
 }

$base = new Base();
$base->creaBases();
?>
