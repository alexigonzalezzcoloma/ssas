<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '7'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $commisionId=$_POST["IdComision"];
        $query="SELECT desiciones_comisiones.id_solicitud, colegios.nombre as nombre_colegio, solicitudes.titulo,voto FROM `desiciones_comisiones` 
        INNER JOIN colegios ON desiciones_comisiones.rbd_colegio = colegios.rbd
        INNER JOIN solicitudes ON desiciones_comisiones.id_solicitud=solicitudes.id
        WHERE desiciones_comisiones.id_estado='16' and desiciones_comisiones.id_comision='$commisionId' AND solicitudes.tipo='contratos';";        
        $result=mysqli_query($connection,$query);
        if($result){
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id_solicitud' => $row['id_solicitud'],
                    'nombre_colegio' => $row['nombre_colegio'],
                    'titulo' => $row['titulo'],
                    'voto'=> $row['voto'],
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }else{
            echo "Hubo Errores: ";
            echo $sql;
        }
    }else{
        echo "no estas autorizad@ para seleccionar acciones del PME";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}
?>
