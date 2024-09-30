<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '5'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $actionId=$_POST["actionId"];
            $queryReqWithPME="SELECT COUNT(id) FROM `pme_solicitudes` WHERE pme_solicitudes.id_accion='$actionId';";
            $resultReqWithPME=mysqli_query($connection,$queryReqWithPME);
            $reqWithPME=mysqli_fetch_row($resultReqWithPME);
            $numReq=$reqWithPME[0];
            if ($numReq==0){
                    $sql="DELETE FROM acciones_pme WHERE id = '$actionId';";
                    echo $result=mysqli_query($connection,$sql);
                    if (!$result){
                        echo $numReq;
                    }
            }else{
                echo "No es posible eliminar la acción porque está siendo usada en una o más solicitudes";
            }
        }else{
            echo "no estas autorizad@ para eliminar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>