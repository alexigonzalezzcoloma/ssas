<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '3'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $query="SELECT comisiones.id,comisiones.fecha_realizacion FROM comisiones ORDER BY ID DESC;";
        $result=mysqli_query($connection,$query);
        if($result){
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id' => $row['id'],
                    'fecha' => $row['fecha_realizacion'],
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }else{
            //echo "Hubo Errores: ";
            echo $query;
        }
    }else{
        echo "no estas autorizad@ para seleccionar acciones del PME";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}
?>