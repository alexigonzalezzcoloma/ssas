<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
        $foundationRut=$_SESSION["rut_fundacion"];
        if ($foundationRut==""){
            echo "Fundación no especificada,no podemos procesar tu solicitud";
        }else{
            $schoolRbd=$_SESSION["rbd_colegio"];
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $get_date = getdate();
            $thisYear=$get_date['year'];

            $sql="SELECT id_subvencion, subvenciones.nombre as nombre_sub FROM `presupuestos_subvenciones` 
            INNER JOIN subvenciones on presupuestos_subvenciones.id_subvencion=subvenciones.id 
            WHERE YEAR(fecha_inicio)='$thisYear' and YEAR(fecha_fin)='$thisYear' and rbd_colegio='$schoolRbd';";

            $result=mysqli_query($connection,$sql);
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id_sub' => $row['id_subvencion'],
                        'nombre_sub' => $row['nombre_sub'],
                    );
                }
        
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
            mysqli_close($connection);
        }
    }else{
        echo "no estas autorizad@ para listar las Subvenciones";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}
?>