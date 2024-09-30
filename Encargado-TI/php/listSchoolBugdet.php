<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '6'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];

            $sql_DateandRbd="SELECT DATE_FORMAT(fecha_hora ,'%Y')year, solicitudes.rbd_colegio from solicitudes WHERE solicitudes.id='$requestId';";
            $yearandRbd_result=mysqli_query($connection,$sql_DateandRbd);
           
            if(!$yearandRbd_result){
                echo "no se pudo obtener el año";
            }else{
                $currentYearAndRbd=mysqli_fetch_row($yearandRbd_result);
                $year=$currentYearAndRbd[0];
                $schoolRbd=$currentYearAndRbd[1];
                $startDate=$year."-01-01";
                $endDate=$year."-12-31";

                $sql_typeReq="SELECT tipo FROM solicitudes WHERE id='$requestId';";
                $result_typeReq=mysqli_query($connection,$sql_typeReq);
                $row_typeReq=mysqli_fetch_row($result_typeReq);
                $typeReq=$row_typeReq[0];

                    $sql1="SELECT presupuestos_colegios.monto as presupuesto_total FROM `presupuestos_colegios` 
                    WHERE presupuestos_colegios.rbd_colegio='$schoolRbd' and fecha_fin BETWEEN '$startDate' and '$endDate';";
                    $result1=mysqli_query($connection,$sql1);   
                    if(!$result1){
                        echo $sql1;
                    }else{
                        $sql2="SELECT SUM(precio_total) as presupuesto_utilizado FROM `solicitudes` 
                        WHERE rbd_colegio='$schoolRbd' and id_estado_actual >'3' and id_estado_actual!='14' and id_estado_actual!='16' 
                        and fecha_hora BETWEEN '$startDate' and '$endDate';";
                        $result2=mysqli_query($connection,$sql2);
                        if(!$result2){
                            echo $sql2;
                        }else{
                            $sql3="SELECT SUM(precio*cantidad) as presupuesto_gestion FROM `requerimientos` WHERE id_solicitud='$requestId';";
                            $result3=mysqli_query($connection,$sql3);                    
                            if(!$result3){
                                echo $sql3;
                            }else{
                                $sql_nameSchool="SELECT nombre FROM `colegios` where colegios.rbd='$schoolRbd';";
                                $result_nameSchool=mysqli_query($connection,$sql_nameSchool);
                                $row_nameSchool=mysqli_fetch_row($result_nameSchool);

                                $title=$row_nameSchool[0];
                                $row_presupuesto_total =mysqli_fetch_row($result1);
                                $row_presupuesto_utilizado=mysqli_fetch_row($result2);
                                $row_presupuesto_gestión =mysqli_fetch_row($result3);
                                
                                $presupuesto_total = $row_presupuesto_total[0];
                                $presupuesto_utilizado = $row_presupuesto_utilizado[0];
                                $presupuesto_gestión = $row_presupuesto_gestión[0];
                                
                                $presupuesto_total = intval($presupuesto_total);
                                $presupuesto_utilizado = intval($presupuesto_utilizado);
                                $presupuesto_gestión = intval($presupuesto_gestión);
                                

                                $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
                                $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
                                $states=mysqli_fetch_row($resultCurrentState);
                                $currentState=$states[0];

                                if($currentState>'3' && $currentState<'16'){
                                    $presupuesto_utilizado=$presupuesto_utilizado-$presupuesto_gestión;
                                }
    
                                $presupuesto_disponible = $presupuesto_total - $presupuesto_utilizado;
                                
                                $json = array();    
                                $json[] = array(
                                    'titulo' => $title,
                                    'presupuesto_total' => number_format($presupuesto_total,0,',','.'),
                                    'presupuesto_utilizado' => number_format($presupuesto_utilizado,0,',','.'),
                                    'presupuesto_gestion' => number_format($presupuesto_gestión,0,',','.'),
                                    'presupuesto_disponible' =>  number_format($presupuesto_disponible,0,',','.'),
                                );  
                                
                                $jsonstring = json_encode($json);
                                echo $jsonstring;
                            }    
                        }  
                    }
            }
        
        }else{
            echo "no estas autorizad@ para listar presupuestos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>