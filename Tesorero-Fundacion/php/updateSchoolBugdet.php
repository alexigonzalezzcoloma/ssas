<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '3'){
            if(isset($_POST['bugdetId'])){
                require_once "../../assets/php/connection.php";
                $connection=connection();            
                $bugdetId=$_POST['bugdetId'];
                $schoolMount=$_POST['schoolMount'];
               

                $query_update="UPDATE `presupuestos_colegios` SET `monto` = '$schoolMount' WHERE `presupuestos_colegios`.`id` = '$bugdetId';";
                echo $result_insert=mysqli_query($connection,$query_update);
                if(!$result_insert){
                    echo "No se pudo actualizar el presupuesto";
                    echo $query_update;
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