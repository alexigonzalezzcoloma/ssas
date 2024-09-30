<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
            if (isset($_POST["realizationDate"])){
                if (isset($_POST["arrayYesRequests"])){
                    if (isset($_POST["arrayNotRequests"])){
                        if (isset($_FILES["File"])){
                            require_once "../../assets/php/connection.php";
                            $connection=connection();
                            date_default_timezone_set("America/Santiago");
                            $get_date = getdate();
                            $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
                            $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
                            $date_time=$date.' '.$time;
                            $userRut=$_SESSION['user_rut'];
                            $userRol=$_SESSION['id_rol'];

                            $attachFile=$_FILES["File"];
                            $path="../../assets/uploads/docs/";
                            $filename =  md5($attachFile["tmp_name"]) .".". pathinfo($attachFile["name"],PATHINFO_EXTENSION);
                            $savePath = $path . $filename;

                            $arrayYesRequests=$_POST["arrayYesRequests"];
                            $arrayYesRequests = explode(',', $arrayYesRequests);
                            $arrayNotRequests=$_POST["arrayNotRequests"];
                            $arrayNotRequests= explode(',', $arrayNotRequests);
                                    
                            $numYesReq=count($arrayYesRequests);
                            $numNotReq=count($arrayNotRequests);

                            if($numNotReq>=1 || $numYesReq>=1){
                                if(move_uploaded_file($attachFile["tmp_name"],$savePath)){
                                    $queryComission="INSERT INTO `comisiones` (`fecha_realizacion`, `acta`) VALUES ('$date', '$filename');";
                                    $resultCreatingCommission=mysqli_query($connection,$queryComission);
                                    $comissionId=mysqli_insert_id($connection);
                                    if($resultCreatingCommission){
                                        if($numYesReq>=1){
                                            $queryLastVote="SELECT id_anual, DATE_FORMAT(fecha_hora , '%Y')anio, DATE_FORMAT(fecha_hora , '%m')mes FROM `votos_aprobacion` order by id DESC LIMIT 1;";
                                            $resultLastVote=mysqli_query($connection,$queryLastVote);
                                            $arrayLastVote=mysqli_fetch_row($resultLastVote);
                                            $lastYear=$arrayLastVote[1];
                                            $lastVote=$arrayLastVote[0];
                                                    
                                            
                                            $currentYear=$get_date['year'];
                                            //$currentMon=$get_date['mon'];
                                            $newVote=$lastVote;
                                            if($currentYear>$lastYear){
                                                $newVote=0;
                                            }
                                            
                                                    

                                            for ($i=0;$i<$numYesReq;$i++){
                                                $newVote=$newVote+1;
                                                $querySchoolRbd="SELECT rbd_colegio FROM `solicitudes` WHERE id='$arrayYesRequests[$i]';";
                                                $resultSchoolRbd=mysqli_query($connection,$querySchoolRbd);
                                                $rowSchoolRbd=mysqli_fetch_row($resultSchoolRbd);
                                                $schoolRbd=$rowSchoolRbd[0];

                                                $queryAccept="INSERT INTO `desiciones_comisiones` (`id_comision`, `id_solicitud`, `id_estado`, `rbd_colegio`,voto) 
                                                VALUES ('$comissionId', '$arrayYesRequests[$i]', '15','$schoolRbd',$newVote);";
                                                $resultAccept=mysqli_query($connection,$queryAccept);
                                                if($resultAccept){
                                                    //crear voto
                                                    $queryVote="INSERT INTO `votos_aprobacion` (`id_anual`, `id_solicitud`, `id_comision`, `fecha_hora`) 
                                                    VALUES ('$newVote', '$arrayYesRequests[$i]', '$comissionId', current_timestamp());";
                                                    $resultNewVote=mysqli_query($connection,$queryVote);
                                                    
                                                    if ($resultNewVote){
                                                        //crear un nuevo estado de Aprobado
                                                        $queryNewState="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `fecha_hora`) 
                                                        VALUES ('$arrayYesRequests[$i]', '$userRut', '$userRol', '15', '$date_time');";
                                                        $resultNewState=mysqli_query($connection,$queryNewState);
                                                        if($resultNewState){
                                                            $queryUpdate="UPDATE `solicitudes` SET `id_estado_actual` = '15' WHERE solicitudes.id = '$arrayYesRequests[$i]'";
                                                            $resultUpdate=mysqli_query($connection,$queryUpdate);
                                                            if ($resultUpdate){
                                                                createNotification($schoolRbd,15,$arrayYesRequests[$i],$date_time,$connection);
                                                            }else{
                                                                echo "No se pudo guardar la actualización de la solicitud";
                                                            }
                                                        }else{
                                                            echo "No se pudo guardar el estado de la solicitud";
                                                        }
                                                    }else{
                                                        echo "no se pudo guardar el voto de respaldo";
                                                    }
                    
                                                }else{
                                                    echo "No se pudo guardar la desición respecto a la solicitud";
                                                }
                                            }
                                        }
                                        if($numNotReq>0){
                                            for ($j=0;$j<$numNotReq;$j++){
                                                $querySchoolRbd="SELECT rbd_colegio FROM `solicitudes` WHERE id='$arrayNotRequests[$j]';";
                                                $resultSchoolRbd=mysqli_query($connection,$querySchoolRbd);
                                                $rowSchoolRbd=mysqli_fetch_row($resultSchoolRbd);
                                                $schoolRbd=$rowSchoolRbd[0];
                                                $queryAccept="INSERT INTO `desiciones_comisiones` (`id_comision`, `id_solicitud`, `id_estado`, `rbd_colegio`) VALUES ('$comissionId', '$arrayNotRequests[$j]', '16','$schoolRbd');";
                                                $resultAccept=mysqli_query($connection,$queryAccept);
                                                if($resultAccept){
                                                    //crear un nuevo estado de Aprobado
                                                    $queryNewState="INSERT INTO `movimientos` (`id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`, `fecha_hora`) 
                                                    VALUES ('$arrayNotRequests[$j]', '$userRut', '$userRol', '16', '$date_time');";
                                                    $resultNewState=mysqli_query($connection,$queryNewState);
                                                    if($resultNewState){
                                                        $queryUpdate="UPDATE `solicitudes` SET `id_estado_actual` = '16' WHERE solicitudes.id = '$arrayNotRequests[$j]'";
                                                        $resultUpdate=mysqli_query($connection,$queryUpdate);
                                                        if ($resultUpdate){
                                                            createNotification($schoolRbd,16,$arrayNotRequests[$j],$date_time,$connection);
                                                        }else{
                                                            echo "No se pudo guardar la actualización de la solicitud";
                                                        }
                                                    }else{
                                                        echo "No se pudo guardar el estado de la solicitud";
                                                    }
                                                }else{
                                                    echo "No se pudo guardar la desición respecto a la solicitud";
                                                }
                                            }
                                        }
                                        
                                        echo 1;
                                    }else{
                                        echo "no se pudo crear la comisión en la BD";
                                    }
                                }else{
                                    echo"No se pudo guardar el fichero";
                                }
                            }else{
                                echo "No se detectan solicitudes para realizar el proceso";
                            }
                        }else{
                            echo "no se detecta el adjunto en PDF";
                        }
                    }else{
                        echo "No se detecta array con solicitudes rechazadas";
                    }
                }else{
                    echo "No se detecta array con solicitudes aceptadas";
                }
            }else{
                echo "no se detecta la Fecha";
            }
        }else{
            echo "no estas autorizad@ para agregar Adjuntos"; 
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }       

    function createNotification($schoolRbd,$state,$requestId,$date_time,$connection)
    {    
        if($state=="15"){
            $queryCreate="INSERT INTO `notificaciones` (`id_solicitud`, `id_destinatario`, `rbd_colegio`, `mensaje`, `fecha_hora`) 
            VALUES ('$requestId', '3', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time'),
            ('$requestId', '4', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time'),
            ('$requestId', '5', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time'),
            ('$requestId', '6', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time'),
            ('$requestId', '7', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time'),
            ('$requestId', '8', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time'),
            ('$requestId', '9', '$schoolRbd', 'La solicitud n° $requestId ha sido Aceptada', '$date_time');";
        }
        
        if($state=="16"){
            $queryCreate="INSERT INTO `notificaciones` (`id_solicitud`, `id_destinatario`, `rbd_colegio`, `mensaje`, `fecha_hora`) 
            VALUES ('$requestId', '3', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada', '$date_time'),
            ('$requestId', '4', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada', '$date_time'),
            ('$requestId', '5', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada', '$date_time'),
            ('$requestId', '6', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada', '$date_time'),
            ('$requestId', '7', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada', '$date_time'),
            ('$requestId', '8', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada', '$date_time'),
            ('$requestId', '9', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada,  recuerda al Departamental justificar la desicion', '$date_time'),
            ('$requestId', '2', '$schoolRbd', 'La solicitud n° $requestId ha sido Rechazada, recuerda justificar la desicion', '$date_time');";
        }
        $resultNotification=mysqli_query($connection,$queryCreate);
        if (!$resultNotification){
            echo "No se pudo crear la notificación";
        }
    }
?>