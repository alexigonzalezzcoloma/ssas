<?php
session_start();
if(isset($_SESSION['user_rut'])){
    $notificationId=$_POST['notificationId'];
    require_once "../connection.php";
    $connection=connection();
    $queryDelete="DELETE FROM notificaciones where id='$notificationId';";
    echo $resultNotifications=mysqli_query($connection,$queryDelete);
    
    if(!$resultNotifications){
        echo "no se puede procesar la consulta sql";
        echo $queryDelete;
    }
}else{
    echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
    header("Location: ../inicio_sesion.php");
}
?>