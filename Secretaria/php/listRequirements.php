<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $requestId=$_REQUEST['requestId'];
        $sql="SELECT requerimientos.id, requerimientos.nombre, requerimientos.cantidad,requerimientos.precio,
        (requerimientos.cantidad*requerimientos.precio) as monto_total,
        requerimientos.nombre_profesional,requerimientos.tiempo_contrato,subvenciones.nombre as nombre_subvencion,
        profesionales_contratables.nombre as profesional_contratado 
        FROM requerimientos 
        LEFT JOIN subvenciones on requerimientos.id_subvencion=subvenciones.id 
        LEFT JOIN profesionales_contratables ON profesionales_contratables.id = requerimientos.id_profesional_contratado
        WHERE requerimientos.id_solicitud='$requestId'";
        $result=mysqli_query($connection,$sql);
                
        if(!$result){
            die('fallo el servidor :('.mysqli_fetch_array($connection));
        }

        $json = array();
        while ($row = mysqli_fetch_array($result)){
            $json[] = array(
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'cantidad' => $row['cantidad'],
                'precio' => number_format($row['precio'],0,',','.'),
                'monto_total' =>  number_format($row['monto_total'],0,',','.'),
                'profesional_contratado' => $row['profesional_contratado'],
                'nombre_profesional' => $row['nombre_profesional'],
                'nombre_subvencion' => $row['nombre_subvencion'],
                'tiempo_contrato' => $row['tiempo_contrato'],
            );  
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }else{
        echo "no estas autorizad@ para listar requerimientos";
    }
}else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>