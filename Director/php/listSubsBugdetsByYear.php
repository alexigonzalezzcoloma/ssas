<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '5'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            $schoolRbd=$_SESSION["rbd_colegio"];
            
            $sql_Subs="SELECT id FROM `subvenciones`;;";
            $result_Subs=mysqli_query($connection,$sql_Subs);
            
            $subsGroup=array();
            while ($fila = mysqli_fetch_assoc($result_Subs)) {
                array_push($subsGroup, $fila["id"]);         
            }

            $num_subs=count($subsGroup);

            $titles= array();
            $total_bugdets = array();
            $used_bugdets=array();
            $this_bugdets=array();
            $ready_bugdets=array();

            for($i=0;$i<$num_subs;$i++){
                $sql1="SELECT presupuestos_subvenciones.monto as presupuesto_subvencion FROM `presupuestos_subvenciones` WHERE presupuestos_subvenciones.rbd_colegio='$schoolRbd' and presupuestos_subvenciones.id_subvencion='$subsGroup[$i]' and fecha_fin BETWEEN '$startDate' and '$endDate';";
                $result1=mysqli_query($connection,$sql1);
                if($result1){
                    $sql2="SELECT SUM(requerimientos.cantidad*requerimientos.precio) as presupuesto_utilizado FROM `requerimientos` 
                    LEFT JOIN solicitudes ON solicitudes.id = requerimientos.id_solicitud  
                    WHERE  id_estado_actual >'3' and solicitudes.id_estado_actual!='14' and id_estado_actual !='16' and solicitudes.rbd_colegio='$schoolRbd' 
                    and requerimientos.id_subvencion='$subsGroup[$i]' and solicitudes.fecha_hora BETWEEN '$startDate' and '$endDate';";
                    $result2=mysqli_query($connection,$sql2);
                    if($result2){
                                    $sql_nameSub="SELECT nombre FROM subvenciones WHERE id='$subsGroup[$i]';";
                                    $result_nameSub=mysqli_query($connection,$sql_nameSub);
                                    $row_nameSub=mysqli_fetch_row($result_nameSub);
                                    array_push($titles,$row_nameSub[0]);

                                    $row_presupuesto_total =mysqli_fetch_row($result1);
                                    $presupuesto_total = $row_presupuesto_total[0];
                                    $presupuesto_total = intval($presupuesto_total);
                                    array_push($total_bugdets,$presupuesto_total);


                                    $row_presupuesto_utilizado=mysqli_fetch_row($result2);
                                    $presupuesto_utilizado = $row_presupuesto_utilizado[0];
                                    $presupuesto_utilizado = intval($presupuesto_utilizado);
                                   
                                    array_push($used_bugdets,$presupuesto_utilizado);
        
                                    $presupuesto_disponible = $presupuesto_total - $presupuesto_utilizado;    
                                    array_push($ready_bugdets,$presupuesto_disponible); 
                               
                            }else{
                                echo $sql2;
                            }
                        }else{
                            echo $sql1;
                        }
                    }
                
                    $json = array();    
                    
                    for($i=0;$i<$num_subs;$i++){
                        $json[] = array(
                            'titulo' => $titles[$i],
                            'presupuesto_total' => number_format($total_bugdets[$i],0,',','.'),
                            'presupuesto_utilizado' => number_format($used_bugdets[$i],0,',','.'),
                            'presupuesto_disponible' => number_format($ready_bugdets[$i],0,',','.'),
                        );  
                    }
                    $jsonstring = json_encode($json);
                    echo $jsonstring;

        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>