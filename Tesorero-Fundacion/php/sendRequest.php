<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];
            $userRut=$_SESSION['user_rut'];
            $userRol=$_SESSION["id_rol"];
            $Recommend=$_POST["Recommend"];
            $Comment=$_POST["Comment"];

            date_default_timezone_set("America/Santiago");
            $get_date = getdate();
            $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
            $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
            $date_time=$date.' '.$time;

            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];

            if($currentState>=5 && $currentState<=9 || $currentState==14 ){
                $sql_Send="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `recomienda`, `comentario`, `fecha_hora`) VALUES ('$requestId', '$userRut', '$userRol', '10', '$Recommend', '$Comment', '$date_time');";
                $result_Send=mysqli_query($connection,$sql_Send);
                if($result_Send){
                    $next_state=11;
                    if($Recommend=="Sí"){
                        $next_state=11;
                    }else{
                        $next_state=14;
                    }
                    $sql_nextState="INSERT INTO `movimientos` (`id_solicitud`, `id_estado`, `fecha_hora`) VALUES ('$requestId', '$next_state','$date_time');";
                    $result_nextState=mysqli_query($connection,$sql_nextState);
                    if ($result_nextState){
                        $sql_updateState="UPDATE solicitudes SET id_estado_actual = '$next_state' WHERE solicitudes.id = '$requestId';";
                        echo $result_updateState=mysqli_query($connection,$sql_updateState);
                        if(!$result_updateState){
                            echo "No se pudo actualizar el estado de su solicitud en el encabezado;";
                        }
                    }else{
                        echo"no se pudo guardar el estado #7 en la solicitud";
                    }
                }else{
                    echo "No se pudo procesar la Solicitud";
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