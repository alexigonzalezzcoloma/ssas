<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '5'){
            if(isset($_POST['actionId'])){
                require_once "../../assets/php/connection.php";
                $connection=connection();      
                $actionId=$_POST["actionId"];
                $actionName=$_POST["actionName"];
                $actionDescription=$_POST["actionDescription"];
                $startDate=$_POST["startDate"];
                
                $query_update="UPDATE `acciones_pme` SET `nombre` = '$actionName', `descripcion` = '$actionDescription', `fecha_inicio` = '$startDate' WHERE `acciones_pme`.`id` = '$actionId';";
                echo $result_insert=mysqli_query($connection,$query_update);
                if(!$result_insert){
                    echo "No se pudo actualizar el presupuesto";
                    echo " ".$query_update;
                }
                
                mysqli_close($connection);
            }else{
                echo"no podemos procesar la solicitud";
            }
        }else{
            echo "no estas autorizad@ para agregar solicitudes al PME";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>