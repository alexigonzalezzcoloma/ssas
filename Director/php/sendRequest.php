<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '5'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];
            $userRut=$_SESSION['user_rut'];
            $userRol=$_SESSION["id_rol"];
            $schoolRbd=$_SESSION["rbd_colegio"];
            $directorRecommend=$_POST["directorRecommend"];
            $directorComment=$_POST["directorComment"];

            date_default_timezone_set("America/Santiago");
            $get_date = getdate();
            $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
            $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
            $date_time=$date.' '.$time;

            $sqlCurrentState="SELECT solicitudes.id_estado_actual,solicitudes.tipo FROM `solicitudes` WHERE solicitudes.id='$requestId';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];
            $requestType=$states[1];

            if($currentState=="3" || $currentState=="14"){
                $sql_directorSend="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `recomienda`, `comentario`, `fecha_hora`) VALUES ('$requestId', '$userRut', '$userRol', '4', '$directorRecommend', '$directorComment', '$date_time');";
                $result_directorSend=mysqli_query($connection,$sql_directorSend);
                if($result_directorSend){
                    if ($directorRecommend=="Sí"){
                        if($requestType=="Contratos"){
                            $newState=7;
                        }else{
                            $newState=5;
                        }
                    }else{
                        $newState=14;
                    }
                    createNotification($newState,$requestId,$schoolRbd,$date_time,$connection);
                    $sql_nextState="INSERT INTO `movimientos` (`id_solicitud`, `id_estado`, `fecha_hora`) VALUES ('$requestId', '$newState' ,'$date_time');";
                    $result_nextState=mysqli_query($connection,$sql_nextState);
                    if($result_nextState){
                        $sql_updateState="UPDATE solicitudes SET id_estado_actual = '$newState' WHERE solicitudes.id = '$requestId';";
                        echo $result_updateState=mysqli_query($connection,$sql_updateState);
                        if(!$result_updateState){
                            echo "No se pudo actualizar el estado de su solicitud en el encabezado;";
                            echo " ".$sql_updateState;
                        }
                    }else{
                        echo "No se pudo guardar el nuevo estado de la solicitud";
                        echo " ".$sql_nextState;
                    }

                }else{
                    echo "No se pudo procesar la Solicitud";
                    echo " ".$sql_directorSend;
                }
            }else{
                echo "En el estado en que se encuentra la solicitud no es posible la acción indicada";
                echo " ".$sql_directorSend;
            }
            mysqli_close($connection);
        }else{
            echo "no estas autorizad@ para enviar la Solicitud";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }

    function createNotification($state,$requestId,$schoolRbd,$date_time,$connection)
    {
        if($state=="14"){
            $queryCreate="INSERT INTO `notificaciones` (`id_solicitud`, `id_destinatario`, `rbd_colegio`, `mensaje`, `fecha_hora`) 
            VALUES ('$requestId', '4', '$schoolRbd', 'La solicitud $requestId no avanzó por disposición del director, modifique de ser necesario', '$date_time');";
        }else{
            $queryCreate="INSERT INTO `notificaciones` (`id_solicitud`, `id_destinatario`, `rbd_colegio`, `mensaje`, `fecha_hora`) 
            VALUES ('$requestId', '4', '$schoolRbd', 'La solicitud $requestId avanzó por disposición del director', '$date_time');";
        }
        $resultNotification=mysqli_query($connection,$queryCreate);
        if (!$resultNotification){
            echo "No se pudo crear la notificación";
        }
    }
?>