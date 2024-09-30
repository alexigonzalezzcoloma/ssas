<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
            if(isset($_POST['requestId'])){
                require_once "../../assets/php/connection.php";
                $connection=connection();            
                $requestID=$_POST['requestId'];
                $subId=$_POST['subId'];
                $name=$_POST['name'];
                $quantity=$_POST['quantity'];
                $requestType=$_POST['requestType'];
                $process=0;

                $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestID' ";
                $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
                $states=mysqli_fetch_row($resultCurrentState);
                $currentState=$states[0];

                if($currentState=="1" || $currentState=="14"){
                    if ($requestType=="Contratos"){
                        if(isset($_POST['hiredProfessionalId'])){
                            if(isset($_POST['profesionalName'])){
                                date_default_timezone_set("America/Santiago");
                                $get_date = getdate();
                                $thisYear=$get_date['year'];
                                $contractStart=$_POST['contractStart'];
                                $contractEnd=$_POST['contractEnd'];
                                
                                $covertDate=strtotime($contractStart);
                                $mon_req = date("m", $covertDate);

                                $startDate=new DateTime($contractStart);
                                $endDate=new DateTime($contractEnd);                              

                                $intvl = $startDate->diff($endDate);
                                $year=$intvl->y;
                                $months=$intvl->m;
                                $days=$intvl->d;

                                if($year>0){
                                    $yearToMonths=$year*12;
                                    $months=$months+$yearToMonths;
                                }


                                $hiredProfessionalId=$_POST['hiredProfessionalId'];
                                $profesionalName= $_POST['profesionalName'];
                                
                                $contractTime=$months." meses, ".$days." días";
                                if($months>=12){
                                    $months=12-$mon_req;
                                    $contractTime='Indefinido';
                                }
                                if($months<=0){
                                    $months=1;
                                }
                                
                                $sql_price_hour="SELECT precio_hora FROM `profesionales_contratables` WHERE id='$hiredProfessionalId';";
                                $result_price=mysqli_query($connection,$sql_price_hour);
                                $row_price_hour=mysqli_fetch_row($result_price);
                                $price_hour=$row_price_hour[0];

                                //$weeks_per_month=4.34524;
                                $weeks_per_month=1;
                                
                                $priceReq=$price_hour*$weeks_per_month*$months;
                                $priceReq=intval($priceReq);

                                $sql="INSERT into requerimientos (id_solicitud,id_subvencion,nombre,cantidad,id_profesional_contratado,nombre_profesional,precio,tiempo_contrato,inicio_contrato,fin_contrato) 
                                VALUES ('$requestID','$subId','$name','$quantity','$hiredProfessionalId','$profesionalName','$priceReq','$contractTime','$contractStart','$contractEnd')";
                                $process=1;
                            }else{
                                echo "Debe Especificarse el nombre del Profesional";
                                $process=0;
                            }
                        }else{
                            echo "Debe Especificarse el Tipo de Profesional";
                            $process=0;
                        }
                    }
                    if($requestType=="Bienes" || $requestType=="Servicios"){
                        if(isset($_POST['price'])){
                            $price=$_POST['price'];
                            $sql="INSERT into requerimientos (id_solicitud,id_subvencion,nombre,cantidad,precio) 
                            VALUES ('$requestID','$subId','$name','$quantity','$price')";
                            $process=1;
                        }else{
                            echo "Debe especificar el precio";
                            $process=0;
                        }
        
                    }
                    if($process==1){
                        echo $result=mysqli_query($connection,$sql);
                        if(!$result){
                            echo $sql;
                        }
                    }else{
                        echo "Errores en la consulta SQL";
                    }
                }else{
                  echo "En el estado en que se encuentra la solicitud no es posible la acción indicada";
                }
                mysqli_close($connection);
            }else{
                echo"no podemos procesar la solicitud";
            }
        }else{
            echo "no estas autorizad@ para agregar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>
