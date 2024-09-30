<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $commisionId=$_POST["IdComision"];
        $SchoolsRbds=array();
        $votes=array();
        $nameSchools=array();
        $queryRbds="SELECT DISTINCT desiciones_comisiones.rbd_colegio FROM desiciones_comisiones 
        INNER JOIN solicitudes on desiciones_comisiones.id_solicitud=solicitudes.id
        WHERE id_comision='10' AND solicitudes.id_estado_actual=15;";
        $resultRbs=mysqli_query($connection,$queryRbds);
        while ($fila = mysqli_fetch_assoc($resultRbs)) {
            array_push($SchoolsRbds, $fila["rbd_colegio"]);   
        }

        $numSchools=count($SchoolsRbds);

        $PricePerSchool=array();
        for($i=0;$i<$numSchools;$i++){
            $queryPricePerSchool="SELECT SUM(solicitudes.precio_total) as gasto, colegios.nombre as nombre_colegio FROM desiciones_comisiones 
            INNER JOIN solicitudes on desiciones_comisiones.id_solicitud=solicitudes.id
            INNER JOIN colegios on desiciones_comisiones.rbd_colegio=colegios.rbd
            WHERE id_comision='$commisionId' AND solicitudes.id_estado_actual=15 and solicitudes.tipo!='Contratos'and desiciones_comisiones.rbd_colegio='$SchoolsRbds[$i]';";
            $resultPriceSchool=mysqli_query($connection,$queryPricePerSchool);
            while ($fila = mysqli_fetch_assoc($resultPriceSchool)) {
                array_push($PricePerSchool, $fila["gasto"]);
                array_push($nameSchools,$fila["nombre_colegio"]);
            }
        }

        $json=array();

        for($i=0;$i<$numSchools;$i++){
            $json[] = array(
                'nombre_colegio' => $nameSchools[$i],
                'dinero_usado' => number_format($PricePerSchool[$i],0,',','.'),
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