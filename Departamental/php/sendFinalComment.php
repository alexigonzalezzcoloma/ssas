<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $reqId=$_POST["requestId"];
        $comment=$_POST["finalComment"];
        $queryLastMove="SELECT id FROM `movimientos` where id_solicitud='$reqId' ORDER BY id DESC LIMIT 1;";
        $resultLastMove=mysqli_query($connection,$queryLastMove);
        $rowLastMove=mysqli_fetch_row($resultLastMove);
        $lastMoveId=$rowLastMove[0];
        
        $queryComment="UPDATE `movimientos` SET `comentario` = '$comment' WHERE `movimientos`.`id` = '$lastMoveId';";
        $resultComment=mysqli_query($connection,$queryComment);
        if($resultComment){
            echo 1;
        }else{
            echo "No se guardó el Comentario Final";
        }

    }else{
        echo "No estás autorizad@ para crear Comentarios";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php"); 
}