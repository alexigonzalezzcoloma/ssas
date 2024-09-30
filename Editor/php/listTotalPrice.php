<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '4'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $rbdColegio=$_SESSION["rbd_colegio"];
        $commisionId=$_POST["IdComision"];        
        $queryTotalPrice="SELECT SUM(solicitudes.precio_total) as gasto_total FROM desiciones_comisiones 
        INNER JOIN solicitudes on desiciones_comisiones.id_solicitud=solicitudes.id
        WHERE id_comision='$commisionId' and desiciones_comisiones.rbd_colegio='$rbdColegio' and solicitudes.id_estado_actual=15;";

        $resultTotalPrice=mysqli_query($connection,$queryTotalPrice);
        $arrayTotal=mysqli_fetch_array($resultTotalPrice);
        $totalPrice=$arrayTotal[0];

        $json=array();

        $json[] = array(
                'titulo' => 'Total de todos los colegios',
                'gasto_total' => number_format($totalPrice,0,',','.'),
        );  
        
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