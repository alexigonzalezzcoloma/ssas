<?php
session_start();
if(isset($_SESSION['user_rut'])){
    $schoolRbd=$_SESSION['rbd_colegio'];
    $rolId=$_SESSION["id_rol"];
    require_once "../connection.php";
    $connection=connection();
    $queryList="SELECT id, id_solicitud, mensaje, DATE_FORMAT(fecha_hora , '%d-%m-%Y %T')fecha FROM `notificaciones` where rbd_colegio='$schoolRbd' and id_destinatario='$rolId';";
    $resultNotifications=mysqli_query($connection,$queryList);
    
    if($resultNotifications){
        $json = array();
        while ($row = mysqli_fetch_array($resultNotifications)){
            $json[] = array(
                'id' => $row['id'],
                'id_solicitud' => $row['id_solicitud'],
                'mensaje' => $row['mensaje'], 
                'fecha'=> $row['fecha'], 
            );  
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }else{
        echo "no se puede procesar la consulta sql";
        echo $queryList;
    }
}else{
    echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
    header("Location: ../inicio_sesion.php");
}
?>