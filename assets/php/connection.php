<?php 
		function connection(){
			$servidor="ballast.proxy.rlwy.net:30044/railway";
			$usuario="root";
			$password="gtnkMyMmOlZzTJqZlugyCjUvZubTYKmZ";
			$bd="solicitudes";

			$connection=mysqli_connect($servidor,$usuario,$password,$bd);
			return $connection;
		}

 ?>