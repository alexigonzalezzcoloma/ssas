<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '5'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $schoolRbd=$_SESSION["rbd_colegio"];
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            $sql="SELECT acciones_pme.id,acciones_pme.nombre,acciones_pme.descripcion,acciones_pme.fecha_inicio,
            acciones_pme.fecha_fin,subdimensiones_gestion.nombre as nombre_subdimension FROM `acciones_pme`
            LEFT JOIN subdimensiones_gestion on acciones_pme.id_subdimension=subdimensiones_gestion.id 
            WHERE acciones_pme.rbd_colegio='$schoolRbd' and acciones_pme.fecha_inicio BETWEEN '$startDate' and '$endDate' 
            and acciones_pme.fecha_fin BETWEEN '$startDate' and '$endDate';";
            $result=mysqli_query($connection,$sql);
                    
            if(!$result){
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
    
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id_accion' => $row['id'],
                    'nombre_accion' => $row['nombre'],
                    'descripcion_accion' => $row['descripcion'],
                    'fecha_inicio' => $row['fecha_inicio'], 
                    'fecha_fin' => $row['fecha_fin'],
                    'nombre_subdimension' => $row['nombre_subdimension'],
                );  
            }
    
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>