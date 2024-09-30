<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '9'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];
            $sql_DateandRbd="SELECT DATE_FORMAT(fecha_hora ,'%Y')year, solicitudes.rbd_colegio from solicitudes WHERE solicitudes.id='$requestId';";
            $yearandRbd_result=mysqli_query($connection,$sql_DateandRbd);
           
            $currentYearAndRbd=mysqli_fetch_row($yearandRbd_result);
            $year=$currentYearAndRbd[0];
            $schoolRbd=$currentYearAndRbd[1];

            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            

            $sql_Subs="SELECT DISTINCT requerimientos.id_subvencion FROM requerimientos WHERE requerimientos.id_solicitud='$requestId';";
            $result_Subs=mysqli_query($connection,$sql_Subs);
            
            $subsGroup=array();
            while ($fila = mysqli_fetch_assoc($result_Subs)) {
                array_push($subsGroup, $fila["id_subvencion"]);         
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
                    $sql2="SELECT SUM(solicitudes.precio_total) as presupuesto_utilizado FROM `requerimientos` 
                    LEFT JOIN solicitudes ON solicitudes.id = requerimientos.id_solicitud  
                    WHERE id_estado_actual >'3' and solicitudes.id_estado_actual!=14 and solicitudes.id_estado_actual!=16 and solicitudes.rbd_colegio='$schoolRbd' 
                    and requerimientos.id_subvencion='$subsGroup[$i]' and solicitudes.fecha_hora BETWEEN '$startDate' and '$endDate';";
                    $result2=mysqli_query($connection,$sql2);
                    if($result2){
                        $sql3="SELECT SUM(precio*cantidad) as presupuesto_gestion FROM `requerimientos` WHERE id_solicitud='$requestId' and id_subvencion='$subsGroup[$i]';";
                        $result3=mysqli_query($connection,$sql3);                    
                        if($result3){
                                    $sql_nameSub="SELECT nombre FROM subvenciones WHERE id='$subsGroup[$i]';";
                                    $result_nameSub=mysqli_query($connection,$sql_nameSub);
                                    $row_nameSub=mysqli_fetch_row($result_nameSub);
                                    array_push($titles,$row_nameSub[0]);

                                    $row_presupuesto_total =mysqli_fetch_row($result1);
                                    $presupuesto_total = $row_presupuesto_total[0];
                                    $presupuesto_total = intval($presupuesto_total);
                                    array_push($total_bugdets,$presupuesto_total);

                                    $row_presupuesto_gestión =mysqli_fetch_row($result3);                                   
                                    $presupuesto_gestión = $row_presupuesto_gestión[0];                                    
                                    $presupuesto_gestión = intval($presupuesto_gestión);
                                    array_push($this_bugdets,$presupuesto_gestión);

                                    $row_presupuesto_utilizado=mysqli_fetch_row($result2);
                                    $presupuesto_utilizado = $row_presupuesto_utilizado[0];
                                    $presupuesto_utilizado = intval($presupuesto_utilizado);
                                    $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
                                    $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
                                    $states=mysqli_fetch_row($resultCurrentState);
                                    $currentState=$states[0];

                                    if($currentState>'3' && $currentState<'16'){
                                        $presupuesto_utilizado=$presupuesto_utilizado-$presupuesto_gestión;
                                    }
                                    array_push($used_bugdets,$presupuesto_utilizado);
        
                                    $presupuesto_disponible = $presupuesto_total - $presupuesto_utilizado;    
                                    array_push($ready_bugdets,$presupuesto_disponible); 
                                }else{
                                    echo $sql3;
                                }
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
                            'presupuesto_gestion' => number_format($this_bugdets[$i],0,',','.'),
                            'presupuesto_disponible' => number_format($ready_bugdets[$i],0,',','.'),
                        );  
                    }
                    $jsonstring = json_encode($json);
                    echo $jsonstring;
        }else{
            echo "No estás autorizad@ para listar Presupuestos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>