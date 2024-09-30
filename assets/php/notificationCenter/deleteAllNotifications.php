<?php
session_start();
if(isset($_SESSION['user_rut'])){
    require_once "../connection.php";
    $connection=connection();
    $rol=$_SESSION["id_rol"];
    $rbd_colegio=$_SESSION["rbd_colegio"];
    $queryDelete="DELETE FROM notificaciones where id_destinatario='$rol' and rbd_colegio='$rbd_colegio';";
    $resultNotifications=mysqli_query($connection,$queryDelete);
    
    if($resultNotifications){
        echo 1;
    }else{
        echo "no se puede procesar la consulta sql";
        echo $queryDelete;
    }
}else{
    echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
    header("Location: ../inicio_sesion.php");
}
?>