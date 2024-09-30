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

            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];
            
            if($currentState=="1" || $currentState=="14"){
                if($schoolRbd=="1"){
                    $queryReqNums="SELECT requerimientos.id FROM `requerimientos` WHERE requerimientos.id_solicitud='$requestId';";
                    $resultReqNums=mysqli_query($connection,$queryReqNums);
                    $numReqs=mysqli_num_rows($resultReqNums);
                    if($numReqs==0){
                        echo 1;
                    }else{
                        echo 2;
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