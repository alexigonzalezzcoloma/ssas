<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $schoolRbd=$_POST["schoolRbd"];
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            
            $sql="SELECT presupuestos_subvenciones.id, presupuestos_subvenciones.rbd_colegio, presupuestos_subvenciones.monto, subvenciones.nombre as nombre_subvencion, presupuestos_subvenciones.id_subvencion FROM `presupuestos_subvenciones` INNER JOIN subvenciones on presupuestos_subvenciones.id_subvencion=subvenciones.id WHERE rbd_colegio='$schoolRbd' and fecha_inicio between '$startDate' and '$endDate';";
            $result=mysqli_query($connection,$sql);
                    
            if($result){
                $subsNum=intval(mysqli_num_rows($result));
                $titles= array();
                $bugdetsIds = array();
                $schoolRbds= array();
                $total_bugdets = array();
                $used_bugdets=array();
                $free_bugdets=array();
                $json=array();
                $subsIds=array();

                for($i=0;$i<$subsNum;$i++){
                    $rowsId=mysqli_fetch_row($result);
                    array_push($bugdetsIds,$rowsId[0]);
                    array_push($schoolRbds,$rowsId[1]);
                    array_push($total_bugdets,$rowsId[2]);
                    array_push($titles,$rowsId[3]);
                    array_push($subsIds,$rowsId[4]);
                }

                for($i=0;$i<$subsNum;$i++){
                    $queryUsed="SELECT SUM(requerimientos.cantidad*requerimientos.precio) as presupuesto_utilizado FROM `requerimientos` 
                    LEFT JOIN solicitudes ON solicitudes.id = requerimientos.id_solicitud  
                    WHERE solicitudes.id_estado_actual >'3' and solicitudes.id_estado_actual!=14 and solicitudes.id_estado_actual!=16 and solicitudes.rbd_colegio='$schoolRbd' 
                    and solicitudes.fecha_hora BETWEEN '$startDate' and '$endDate' and solicitudes.tipo!='Contratos' and requerimientos.id_subvencion='$subsIds[$i]'";
                    $resultUsed=mysqli_query($connection,$queryUsed);
                    $rowUsedBugdets=mysqli_fetch_array($resultUsed);
                    array_push($used_bugdets,$rowUsedBugdets[0]);
                }

                for($i=0;$i<$subsNum;$i++){

                    $json[] = array(
                        'id_presupuesto' => $bugdetsIds[$i],
                        'nombre_subvencion' => $titles[$i],
                        'presupuesto_total' => number_format($total_bugdets[$i],0,',','.'),
                        'presupuesto_usado' => number_format($used_bugdets[$i],0,',','.'),
                        'presupuesto_disponible' => number_format($total_bugdets[$i]-$used_bugdets[$i],0,',','.'),
                    );  
                }

                $jsonstring = json_encode($json);
                echo $jsonstring;
                
            }else{
                die('falló el servidor :(');
            }
    
        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>