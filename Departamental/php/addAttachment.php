<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
            if(isset($_POST['requestId'])){
                require_once "../../assets/php/connection.php";
                $connection=connection();
                $requestId=$_POST['requestId'];
                $attachName=$_POST['attachName'];
                $attachFile=$_FILES['attachFile'];

                $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId';";
                $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
                $states=mysqli_fetch_row($resultCurrentState);
                $currentState=$states[0];
                if($currentState=="1" || $currentState=="14"){
                    date_default_timezone_set("America/Santiago");
                    $get_date = getdate();
                    $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
                    $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
                    $date_time=$date.' '.$time;
        
                    $path="../../assets/uploads/docs/";
                    $filename =  md5($attachFile["tmp_name"]) .".". pathinfo($attachFile["name"],PATHINFO_EXTENSION);
                    $savePath = $path . $filename;
                    if(move_uploaded_file($attachFile["tmp_name"],$savePath)){
                        $sql="INSERT into adjuntos (id_solicitud,nombre,ruta,tipo,fecha_hora) 
                        VALUES ('$requestId','$attachName','$filename','application/pdf','$date_time')";
                        echo $result=mysqli_query($connection,$sql);
                        if(!$result){
                            echo $sql;
                        }
                        mysqli_close($connection);
                    }
                }else{
                    echo "En el estado que cursa la solicitud no es posible esta acción";
                }
            }else{
                echo"no podemos procesar la solicitud sin el Id de la Solicitud";
            }
        }else{
            echo "no estas autorizad@ para agregar Adjuntos"; 
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>
