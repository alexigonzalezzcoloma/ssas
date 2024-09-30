<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '5'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $limitMonth=6;

            $ActionStartDate=$_POST["ActionStartDate"];
            $ActionStartDate = strtotime($ActionStartDate);
            $year=date("Y", $ActionStartDate);
            $month=date("m", $ActionStartDate);
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            

            if ($month<=$limitMonth){
                $endDate=$year."-12-31";
                $schoolRbd=$_SESSION["rbd_colegio"];
                $subdimId=$_POST["subdimId"];
                $actionName=$_POST["actionName"];
                $actionDescription=$_POST["actionDescription"];

                $sql="INSERT INTO `acciones_pme` (`rbd_colegio`, `id_subdimension`, `nombre`, `descripcion`, `fecha_inicio`,fecha_fin) 
                VALUES ('$schoolRbd', '$subdimId', '$actionName', '$actionDescription','$startDate','$endDate');";
                echo $result=mysqli_query($connection,$sql);
                if(!$result){
                    echo $sql;
                }
            }else{
                echo "Ya no es posible agregar más acciones al PME, ya pasó el mes límite";
            }
            
        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>