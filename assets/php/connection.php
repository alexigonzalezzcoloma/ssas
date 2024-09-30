<?php 
		function connection(){
			$servidor="localhost";
			$usuario="root";
			$password="";
			$bd="solicitudes";

			$connection=mysqli_connect($servidor,$usuario,$password,$bd);
			return $connection;
		}

 ?>