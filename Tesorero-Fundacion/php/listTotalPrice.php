<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '3'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $commisionId=$_POST["IdComision"];
        //$totalPrice=array();
        
        $queryTotalPrice="SELECT SUM(solicitudes.precio_total) as gasto_total FROM desiciones_comisiones 
        INNER JOIN solicitudes on desiciones_comisiones.id_solicitud=solicitudes.id
        WHERE id_comision='$commisionId' AND solicitudes.id_estado_actual=15 and solicitudes.tipo!='Contratos';";

        $resultTotalPrice=mysqli_query($connection,$queryTotalPrice);
        
        /*while ($fila = mysqli_fetch_assoc($resultTotalPrice)) {
            array_push($totalPrice, $fila["gasto_total"]);   
        }*/
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