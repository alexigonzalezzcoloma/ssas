<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '4'){
           
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_POST["requestId"];
            $requirementId=$_POST["requirementId"];
            
            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            if ($resultCurrentState){
                $states=mysqli_fetch_row($resultCurrentState);
                $currentState=$states[0];
                if($currentState=="1" || $currentState=="14"){
                    $sql="DELETE FROM requerimientos WHERE requerimientos.id = '$requirementId'";
                    $result=mysqli_query($connection,$sql);
                    
                    if($result==1){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo "En el estado que cursa la solicitud no es posible esta acción";
                }  
            }else{
                echo $sqlCurrentState;
            }
        }else{
            echo "no estas autorizad@ para eliminar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>