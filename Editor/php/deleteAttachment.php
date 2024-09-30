<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '4'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_POST["requestId"];
            $attachmentId=$_POST["attachmentId"];
            $path=$_POST["path"];
            $path="../../assets/uploads/docs/".$path;
            
            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];

            if($currentState=="1" || $currentState=="14"){
                if(unlink($path)){
                    $sql="DELETE FROM adjuntos WHERE adjuntos.id = '$attachmentId'";
                    echo $result=mysqli_query($connection,$sql);
                    if (!$result){
                        echo $sql;
                    }
                }else{
                    echo "no se pudo eliminar el fichero del almacenamiento";
                }
            }else{
                echo "En el estado que cursa la solicitud no es pósible esta acción";
            }
        }else{
            echo "no estas autorizad@ para eliminar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>