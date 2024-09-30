<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '4'){
                require_once "../../assets/php/connection.php";
                $connection=connection();
                $Id=$_POST["contractId"];
                $course=$_POST["course"];
                $Quantity=$_POST["hours"];
                $SubId=$_POST["subId"];

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


                $sql="UPDATE requerimientos SET id_subvencion='$SubId', nombre='$course' 
                ,cantidad='$Quantity',id_profesional_contratado='$hiredProfessionalId',nombre_profesional='$profesionalName',
                precio='$priceReq',tiempo_contrato='$contractTime',inicio_contrato='$contractStart',fin_contrato='$contractEnd', id_subvencion='$SubId' WHERE id='$Id'";
                
                $result=mysqli_query($connection,$sql);

                if($result){
                    echo 1;
                }
                else{
                    echo "no se pudieron actualizar los datos error: ".$sql;
                }
                mysqli_close($connection);
        }else{
            echo "No estás autorizad@ para actualizar Requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>