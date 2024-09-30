<?php
/*session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '3'){*/
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $commisionId=$_POST["IdComision"];
        $sql1="SELECT colegios.nombre as nombre_colegio,voto,id_solicitud,solicitudes.precio_total,estados.nombre AS nombre_estado, solicitudes.titulo FROM `desiciones_comisiones`
        INNER JOIN solicitudes on desiciones_comisiones.id_solicitud = solicitudes.id
        INNER JOIN estados ON desiciones_comisiones.id_estado=estados.id 
        INNER JOIN colegios ON desiciones_comisiones.rbd_colegio=colegios.rbd
        WHERE id_comision='$commisionId' and solicitudes.tipo !='Contratos' ORDER BY solicitudes.rbd_colegio DESC, desiciones_comisiones.id_estado ASC;";                                        
       // $sql1=$sql1." ORDER BY solicitudes.rbd_colegio DESC, solicitudes.tipo='Contratos', solicitudes.tipo='Servicios', solicitudes.tipo='Bienes' ";

                                                $result1 = mysqli_query($connection,$sql1);                                                
                                                
                                                $school=array();
                                                $votes=array();
                                                $requestList=array();  
                                                $prices=array();                                
                                                $states=array();
                                                $titles=array();
                                                                                               
                                                $subs=array();


                                                while ($fila = mysqli_fetch_assoc($result1)) {
                                                    array_push($school, $fila["nombre_colegio"]);   
                                                    array_push($votes, $fila["voto"]);  
                                                    array_push($requestList, $fila["id_solicitud"]);   
                                                    array_push($prices, $fila["precio_total"]);  
                                                    array_push($states, $fila["nombre_estado"]);   
                                                    array_push($titles, $fila["titulo"]);  
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
                                                        'nombre_colegio' => $school[$i],
                                                        'voto' => $votes[$i],
                                                        'id_solicitud' => $requestList[$i],
                                                        'precio_total' => number_format($prices[$i],0,',','.'),
                                                        'nombre_estado' => $states[$i],
                                                        'titulo' => $titles[$i],
                                                        'subvenciones' => $subs[$i],
                                                    );  
                                                }
                                                
                                                $jsonstring = json_encode($json);
                                                echo $jsonstring;
    /*}else{
        echo "no estas autorizad@ para listar requerimientos";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php"); 
}*/
                                                ?>