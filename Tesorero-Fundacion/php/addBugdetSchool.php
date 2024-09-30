<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '3'){
            if(isset($_POST['schoolRbd'])){
                require_once "../../assets/php/connection.php";
                $connection=connection();            
                $schoolRbd=$_POST['schoolRbd'];
                $mount=$_POST['schoolMount'];
                $year=$_POST['bugdetYear'];
                $startDate=$year."-01-01";
                $endDate=$year."-12-31";
                $sqlCurrentBudget="SELECT COUNT(id) FROM `presupuestos_colegios` WHERE rbd_colegio='$schoolRbd' and fecha_inicio BETWEEN '$startDate' and '$endDate';";
                $resultCurrentBugdet=mysqli_query($connection,$sqlCurrentBudget);
                $rowBugdet=mysqli_fetch_row($resultCurrentBugdet);
                $bugdetYear=$rowBugdet[0];

                if($bugdetYear=="0"){
                    $query_insert="INSERT INTO `presupuestos_colegios` (`rbd_colegio`, `fecha_inicio`, `fecha_fin`, `monto`) 
                    VALUES ('$schoolRbd', '$startDate', '$endDate', '$mount');";
                    echo $result_insert=mysqli_query($connection,$query_insert);
                    if(!$result_insert){
                        echo "No se pudo agregar la acción";
                        echo $query_insert;
                    }
                
                    mysqli_close($connection);
                }else{
                    echo "ya se creo este presupuesto, si desea editarlo presione el botón correspondiente";
                }
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
