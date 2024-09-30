<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
                                                require_once "../../assets/php/connection.php";
                                                $connection=connection();
                                                $sql1="SELECT solicitudes.id, solicitudes.titulo, solicitudes.tipo, solicitudes.precio_total, estados.nombre as estado_actual, 
                                                colegios.nombre as nombre_colegio FROM solicitudes INNER JOIN colegios on colegios.rbd=solicitudes.rbd_colegio 
                                                INNER JOIN estados on solicitudes.id_estado_actual=estados.id WHERE solicitudes.id_estado_actual = 13 ";
                                                
                                                $sql1=$sql1." ORDER BY solicitudes.rbd_colegio DESC, solicitudes.tipo='Contratos', solicitudes.tipo='Servicios', solicitudes.tipo='Bienes' ";

                                                $result1 = mysqli_query($connection,$sql1);                                                
                                                $requestList=array();
                                                $titles=array();
                                                $type=array();
                                                $totalPrice=array();
                                                $actualState=array();
                                                $school=array();
                                                $subs=array();


                                                while ($fila = mysqli_fetch_assoc($result1)) {
                                                    array_push($requestList, $fila["id"]);   
                                                    array_push($titles, $fila["titulo"]);  
                                                    array_push($type, $fila["tipo"]);   
                                                    array_push($totalPrice, $fila["precio_total"]);  
                                                    array_push($actualState, $fila["estado_actual"]);   
                                                    array_push($school, $fila["nombre_colegio"]);  
                                                }
                                                
                                                $num_req=count($requestList);
                                                for($i=0;$i<$num_req;$i++){
                                                    $querySubs="SELECT DISTINCT subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion=subvenciones.id WHERE requerimientos.id_solicitud='$requestList[$i]';";
                                                    $resultSubs=mysqli_query($connection,$querySubs);
                                                    $num_subs=mysqli_num_rows($resultSubs);

                                                    $subsGroup="";
                                                    $count=1;
                                                    while ($fila = mysqli_fetch_assoc($resultSubs)) {
                                                        $subsGroup= $subsGroup.$fila["nombre_subvencion"];
                                                        if ($count<$num_subs){
                                                        $subsGroup=$subsGroup.", ";
                                                        }
                                                        $count++;
                                                    }
                                                    array_push($subs,$subsGroup);      
                                                }
                                                $json = array(); 
                                                
                                                for($i=0;$i<$num_req;$i++){
                                                    $json[] = array(
                                                        'id' => $requestList[$i],
                                                        'titulo' => $titles[$i],
                                                        'tipo' => $type[$i],
                                                        'precio_total' => number_format($totalPrice[$i],0,',','.'),
                                                        'estado_actual' => $actualState[$i],
                                                        'colegio' => $school[$i],
                                                        'recursos' => $subs[$i],
                                                    );  
                                                }
                                                
                                                $jsonstring = json_encode($json);
                                                echo $jsonstring;
    }else{
        echo "no estas autorizad@ para listar solicitudes";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php"); 
}
                                                ?>