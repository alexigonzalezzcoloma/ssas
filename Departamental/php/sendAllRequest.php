<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $querySelectAllRequest="SELECT solicitudes.id FROM solicitudes WHERE solicitudes.id_estado_actual >= 4 and solicitudes.id_estado_actual<=13";
        $selectAllRequest=mysqli_query($connection,$querySelectAllRequest);
        $requestList=array();
        date_default_timezone_set("America/Santiago");
        $userRut=$_SESSION['user_rut'];
        $userRol=$_SESSION['id_rol'];
        $get_date = getdate();
        $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
        $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
        $date_time=$date.' '.$time;
        //$requestList=mysqli_fetch_array($selectAllRequest);
        while ($fila = mysqli_fetch_assoc($selectAllRequest)) {
            array_push($requestList, $fila["id"]);   
        }

        $num_req=count($requestList);
        $errorsSend=0;
        $errorsNext=0;
        $errorsUpdate=0;

        for($i=0;$i<$num_req;$i++){
            $sql_Send="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `recomienda`, `fecha_hora`) VALUES ('$requestList[$i]', '$userRut', '$userRol', '12', 'Sí','$date_time');";
            $result_Send=mysqli_query($connection,$sql_Send);  
            if (!$result_Send){
                $errorsSend+=1;
            }   
            $sql_nextState="INSERT INTO `movimientos` (`id_solicitud`, `id_estado`, `fecha_hora`) VALUES ('$requestList[$i]', '13','$date_time');";
            $result_nextState=mysqli_query($connection,$sql_nextState);
            if (!$result_nextState){
                $errorsNext+=1;
            }  
            $sql_updateState="UPDATE solicitudes SET id_estado_actual = '13' WHERE solicitudes.id = '$requestList[$i]';";
            $result_updateState=mysqli_query($connection,$sql_updateState);
            if (!$result_updateState){
                $errorsUpdate+=1;
            }
        }

        if($errorsSend==0){
            if($errorsNext==0){
                if($errorsUpdate==0){
                    echo 1;
                }else{
                    echo"errores al actualizar estado de solicitudes";
                }
            }else{
                echo "errores al guardar historial de solicitudes";
            }
        }else{
            echo "errores al guardar historial de solicitudes";
        }
        
    }else{
        echo "no estas autorizad@ para enviar la Solicitud";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}
?>