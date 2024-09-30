<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '4'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];
            $userRut=$_SESSION['user_rut'];
            $userRol=$_SESSION["id_rol"];
            $schoolRbd=$_SESSION["rbd_colegio"];
            date_default_timezone_set("America/Santiago");
            $get_date = getdate();
            $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
            $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
            $date_time=$date.' '.$time;

            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];

            if($currentState=="1" || $currentState=="14"){
                $sql1="SELECT DISTINCT requerimientos.id_subvencion FROM requerimientos WHERE requerimientos.id_solicitud='$requestId' ORDER BY requerimientos.id_subvencion;";
                $result1=mysqli_query($connection,$sql1);
                if($result1){
                        $num_sub_req=mysqli_num_rows($result1);
                        if($num_sub_req > 0){
                            $rowSubs=mysqli_fetch_row($result1);
                            $arrayReqWithOutPME=array();
                            $arrayReqWithPME=array();
                            for($l=0; $l<$num_sub_req;$l++){
                                if ($rowSubs[$l] >= 4){
                                    array_push($arrayReqWithOutPME,$rowSubs[$l]);
                                }else{
                                    array_push($arrayReqWithPME,$rowSubs[$l]);
                                }
                            }
                            $numsReqsWithOutPME=count($arrayReqWithOutPME);
                            $numsReqsWithPME=intval($num_sub_req)-intval($numsReqsWithOutPME);

                            $sql2="SELECT DISTINCT pme_solicitudes.id_subvencion FROM `pme_solicitudes` WHERE pme_solicitudes.id_solicitud='$requestId' ORDER by pme_solicitudes.id_subvencion;";
                            $result2=mysqli_query($connection,$sql2);
                            if($result2){
                                $num_sub_pme=mysqli_num_rows($result2);

                                if($num_sub_pme >= $numsReqsWithPME){
                                        $arr_pme=array();
                                        while ($row_pme = mysqli_fetch_array($result2)){
                                            $arr_pme[] = array(
                                                'id_subvencion' => $row_pme['id_subvencion'],
                                            );
                                        }

                                        $correctCounter=0;
                                        $is_correct=0;

                                        for($i=0;$i<$numsReqsWithPME;$i++){
                                            if (in_array($arrayReqWithPME[$i], $arr_pme)) {
                                                $correctCounter=$correctCounter+1;
                                            }
                                        }

                                        if($correctCounter>0 && $correctCounter==$numsReqsWithPME){
                                            $is_correct=1;
                                        }

                                        if($is_correct==1){
                                            $sql_state2="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `recomienda`, `comentario`, `fecha_hora`) VALUES ('$requestId', '$userRut', '$userRol', '2', NULL, NULL, '$date_time');";
                                            $result_state2=mysqli_query($connection,$sql_state2);
                                            if ($result_state2){
                                                $sql_state3="INSERT INTO `movimientos` (`id_solicitud`, `id_estado`, `fecha_hora`) VALUES ('$requestId','3','$date_time');";
                                                $result_state3=mysqli_query($connection,$sql_state3);
                                                if ($result_state3){
                                                    $sql_totalPrice="SELECT SUM(precio*cantidad) as presupuesto_gestion FROM `requerimientos` WHERE id_solicitud='$requestId';";
                                                    $result_totalPrice=mysqli_query($connection,$sql_totalPrice);
                                                    $row_totalPrice=mysqli_fetch_row($result_totalPrice);
                                                    $totalPrice=$row_totalPrice[0];
                                                    $sqlUpReq="UPDATE solicitudes SET id_estado_actual = '3', precio_total = '$totalPrice' WHERE solicitudes.id = '$requestId';";
                                                    echo $resultUpReq=mysqli_query($connection,$sqlUpReq);
                                                    if (!$resultUpReq){
                                                        echo "no se pudo actualizar el estado de la solicitud";
                                                    }
                                                }else{
                                                    echo "no se pudo guardar el movimiento #3 en la Base de Datos";
                                                    echo $sql_state3;
                                                }
                                            }else{
                                                echo "no se pudo guardar el movimiento #2 en la Base de Datos";
                                            }
                                        }else{
                                            echo "La solicitud es incorrecta, revise los requerimientos y PME";
                                        }
                                }else{
                                    echo "Deben seleccionarse las acciones del PME correspondientes antes de enviar la solicitud";
                                }
                            }else{
                                echo "No se puede realizar la consulta SQL para calculas las subvenciones de sus solicitud";
                            }
                        }else{
                            echo "Deben incluirse requerimientos en la solicitud antes de enviarla";
                        }
                    
                }else{
                    echo "No se puede realizar la consulta SQL para calcular las subvenciones de sus solicitud";
                }                
            }else{
                echo "En el estado en que se encuentra la solicitud no es posible la acción indicada";
            }
            mysqli_close($connection);
        }else{
           echo "no estas autorizad@ para enviar la Solicitud";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>