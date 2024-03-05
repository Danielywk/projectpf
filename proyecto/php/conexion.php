<?php

	class conexion{

		private $pass;
		private $usuario;
		private $nombreBD;

		public function conectar(){

			$pass='dani1112';
			$usuario='root';
			$nombreBD='empleados';

			try{
				$base_conexion=new PDO('mysql:host=localhost;dbname='.$nombreBD, $usuario, $pass);

				//Mensaje
				//echo('Conexion Lista');
				
				return $base_conexion; //retorna la conexion al objeto que se cree de esta clase
			}catch (Exception $e){

				die('Error'.$e->getMessage());

			}
			finally{
				$base_conexion=null; //Para que la cadena de conexion no se pueda ocupar
		} 
			

		}

	}


?>