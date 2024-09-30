<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '9'){
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
                if($schoolRbd=="1"){
                    $sql_state2="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `recomienda`, `comentario`, `fecha_hora`) VALUES ('$requestId', '$userRut', '$userRol', '2', NULL, NULL, '$date_time');";
                    $result_state2=mysqli_query($connection,$sql_state2);
                    if ($result_state2){
                        $sql_state5="INSERT INTO `movimientos` (`id_solicitud`, `id_estado`, `fecha_hora`) VALUES ('$requestId','5','$date_time');";
                        $result_state5=mysqli_query($connection,$sql_state5);
                        if ($result_state5){
                            $sql_totalPrice="SELECT SUM(precio*cantidad) as presupuesto_gestion FROM `requerimientos` WHERE id_solicitud='$requestId';";
                            $result_totalPrice=mysqli_query($connection,$sql_totalPrice);
                            $row_totalPrice=mysqli_fetch_row($result_totalPrice);
                            $totalPrice=$row_totalPrice[0];
                            $sqlUpReq="UPDATE solicitudes SET id_estado_actual = '5', precio_total = '$totalPrice' WHERE solicitudes.id = '$requestId';";
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
                    echo "usted no puede enviar una solicitud que no sea de la Administración Central";
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