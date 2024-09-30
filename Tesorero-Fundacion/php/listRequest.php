<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];

            $sql="SELECT solicitudes.tipo,solicitudes.titulo,solicitudes.justificacion,solicitudes.precio_total,estados.nombre as estado_actual,solicitudes.voto_interno,fecha_voto_interno from solicitudes
            LEFT JOIN estados on solicitudes.id_estado_actual = estados.id  WHERE solicitudes.id='$requestId';";

            $result=mysqli_query($connection,$sql);
                    
            if(!$result){
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
    
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'tipo' => $row['tipo'],
                    'titulo' => $row['titulo'],
                    'justificacion' => $row['justificacion'], 
                    'estado_actual' => $row['estado_actual'],
                    'precio_total' => number_format($row['precio_total'],0,',','.'),
                    'voto_interno' => $row['voto_interno'],
                    'fecha_voto_interno' => $row['fecha_voto_interno'],
                );  
            }
    
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }else{
            echo "no estas autorizad@ para listar solicitudes";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
    
?>