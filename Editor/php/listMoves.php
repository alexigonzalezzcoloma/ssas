<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '4'){
        if(isset($_POST['requestId'])){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_POST['requestId'];
            $sql= "SELECT movimientos.id, movimientos.id_solicitud, usuarios.nombre as nombre_usuario, 
            roles.nombre as nombre_cargo,movimientos.recomienda, movimientos.comentario, 
            estados.nombre as nombre_estado,
            DATE_FORMAT(fecha_hora , '%d-%m-%Y %T')fecha FROM `movimientos` 
            LEFT JOIN usuarios on movimientos.rut_usuario = usuarios.rut
            LEFT JOIN roles on movimientos.id_rol_usuario=roles.id
            LEFT JOIN estados on movimientos.id_estado = estados.id
            WHERE movimientos.id_solicitud='$requestId';";

            $result=mysqli_query($connection,$sql);
                    
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id' => $row['id'],
                        'id_solicitud' => $row['id_solicitud'],
                        'nombre_estado' => $row['nombre_estado'],
                        'nombre_usuario' => $row['nombre_usuario'],
                        'nombre_cargo' => $row['nombre_cargo'],
                        'recomienda' => $row['recomienda'],
                        'comentario' => $row['comentario'],
                        'fecha_hora' => $row['fecha'],
                    );  
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
            mysqli_close($connection);
        }else{
            echo "No se dectecta Id de solicitud, no podemos procesar la solicitud";
        }
    }else{
        echo "no estas autorizad@ para listar los Movimientos";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}
?>