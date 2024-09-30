<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];            
            $sql= "SELECT pme_solicitudes.id,pme_solicitudes.id_subvencion,pme_solicitudes.id_dimension,
            pme_solicitudes.id_subdimension,pme_solicitudes.id_accion,
            subvenciones.nombre as nombre_subvencion,dimesiones_gestion.nombre as nombre_dimension,
            subdimensiones_gestion.nombre as nombre_subdimension, acciones_pme.nombre as nombre_accion,
            acciones_pme.descripcion as descripcion_accion FROM `pme_solicitudes` 
            LEFT JOIN subvenciones on subvenciones.id = pme_solicitudes.id_subvencion
            LEFT JOIN dimesiones_gestion on dimesiones_gestion.id = pme_solicitudes.id_dimension
            LEFT JOIN subdimensiones_gestion on subdimensiones_gestion.id=pme_solicitudes.id_subdimension
            LEFT JOIN acciones_pme on acciones_pme.id=pme_solicitudes.id_accion WHERE pme_solicitudes.id_solicitud='$requestId';
            ";

            $result=mysqli_query($connection,$sql);
                    
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id_seleccion' => $row['id'],
                        'id_subvencion' => $row['id_subvencion'],
                        'id_dimension' =>  $row['id_dimension'],
                        'id_subdimension' => $row['id_subdimension'], 
                        'id_accion' => $row['id_accion'],
                        'nombre_subvencion' => $row['nombre_subvencion'],
                        'nombre_dimension' =>  $row['nombre_dimension'],
                        'nombre_subdimension' => $row['nombre_subdimension'], 
                        'nombre_accion' => $row['nombre_accion'],
                        'descripcion_accion'  => $row['descripcion_accion'],
                        'id_solicitud' => $requestId,
                    );  
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                //die('fallo el servidor :('.mysqli_fetch_array($connection));
                echo $sql;
            }  
        }else{
            echo "no estas autorizad@ para listar el PME";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>