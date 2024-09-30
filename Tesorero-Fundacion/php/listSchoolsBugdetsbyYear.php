<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            $querySchools="SELECT presupuestos_colegios.rbd_colegio,presupuestos_colegios.monto as presupuesto_total, presupuestos_colegios.id FROM `presupuestos_colegios` WHERE fecha_inicio BETWEEN '$startDate' and '$endDate';";
            $resultSchools=mysqli_query($connection,$querySchools);
            
            
            if($resultSchools){              
                $num_Schools=intval(mysqli_num_rows($resultSchools));
                //echo $num_Schools;  
                //$arraySchoolwBugdets=mysqli_fetch_array($resultSchools);
                $arraySchoolwBugdets= array();
                $bugdetsIds = array();
                $titles= array();
                $total_bugdets = array();
                $used_bugdets=array();
                $free_bugdets=array();

                $json=array();

                for($i=0;$i<$num_Schools;$i++){
                    $rowsId=mysqli_fetch_row($resultSchools);
                    array_push($arraySchoolwBugdets,$rowsId[0]);
                    array_push($total_bugdets,$rowsId[1]);
                    array_push($bugdetsIds,$rowsId[2]);
                }

                for($i=0;$i<$num_Schools;$i++){
                    $queryTitles="SELECT colegios.nombre as nombre_colegio FROM `presupuestos_colegios` LEFT JOIN colegios on presupuestos_colegios.rbd_colegio=colegios.rbd WHERE presupuestos_colegios.rbd_colegio='$arraySchoolwBugdets[$i]';";
                    $resultTitles=mysqli_query($connection,$queryTitles);
                    $rowTitles=mysqli_fetch_row($resultTitles);
                    array_push($titles,$rowTitles[0]);
                }

                for($i=0;$i<$num_Schools;$i++){
                    $queryUsed="SELECT SUM(precio_total) as presupuesto_utilizado FROM `solicitudes` 
                    WHERE rbd_colegio='$arraySchoolwBugdets[$i]' and id_estado_actual >'3' and id_estado_actual!=14 and id_estado_actual!=16
                    and tipo != 'Contratos'
                    and fecha_hora BETWEEN '$startDate' and '$endDate';";

                    $resultUsed=mysqli_query($connection,$queryUsed);
                    $rowUsedBugdets=mysqli_fetch_row($resultUsed);
                    array_push($used_bugdets,$rowUsedBugdets[0]);
                }

                for($i=0;$i<$num_Schools;$i++){

                    $json[] = array(
                        'id_presupuesto' => $bugdetsIds[$i],
                        'nombre_colegio' => $titles[$i],
                        'presupuesto_total' => number_format($total_bugdets[$i],0,',','.'),
                        'presupuesto_usado' => number_format($used_bugdets[$i],0,',','.'),
                        'presupuesto_disponible' => number_format($total_bugdets[$i]-$used_bugdets[$i],0,',','.'),
                    );  
                }

                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                echo $sql;
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>