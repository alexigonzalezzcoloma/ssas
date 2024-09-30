<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
            if(isset($_POST['requestId'])){
                require_once "../../assets/php/connection.php";
                $connection=connection();            
                $requestId=$_POST['requestId'];
                $subventionId=$_POST['subventionId'];
                $dimensionId=$_POST['dimensionId'];
                $subdimensionId=$_POST['subdimensionId'];
                $actionId=$_POST['actionId'];

                $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId' ";
                $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
                $states=mysqli_fetch_row($resultCurrentState);
                $currentState=$states[0];

                    $count="";
                    $query_verification="SELECT COUNT(id) FROM `pme_solicitudes` WHERE id_solicitud='$requestId'and id_subvencion='$subventionId';";
                    $result_verificacion=mysqli_query($connection,$query_verification);
                    if($result_verificacion){
                        while($row_count= mysqli_fetch_array($result_verificacion)){
                            $count = $count.$row_count[0];
                        }
                        if($count=="0"){
                            $query_insert="INSERT INTO `pme_solicitudes` (`id_solicitud`, `id_subvencion`, `id_dimension`, `id_subdimension`, `id_accion`) 
                            VALUES ('$requestId', '$subventionId', '$dimensionId', '$subdimensionId', '$actionId');";
                            echo $result_insert=mysqli_query($connection,$query_insert);
                            if(!$result_insert){
                                echo "No se pudo agregar la acción";
                                echo $query_insert;
                            }
                        }else{
                            echo "Sólo se admite 1 acción por subvención, y ya agregó una para la subvención";
                        } 
                    }else{
                        echo $query_verification;
                    }
                    mysqli_close($connection);
                
            }else{
                echo"no podemos procesar la solicitud";
            }
        }else{
            echo "no estas autorizad@ para agregar solicitudes al PME";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>
