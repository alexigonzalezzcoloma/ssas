<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        date_default_timezone_set("America/Santiago");
        $get_date = getdate();
        $date_limit=$get_date['year']."-12-31";
        $reqId=$_REQUEST["reqId"];
        $querySchoolRbd="SELECT rbd_colegio from solicitudes WHERE id='$reqId'";
        $resultSchoolRbd=mysqli_query($connection,$querySchoolRbd);
        $rowSchool=mysqli_fetch_row($resultSchoolRbd);
        $schoolRbd=$rowSchool[0];
        if ($schoolRbd!=""){
            $subdimensionId=$_REQUEST['subdimensionId'];
            $sql="SELECT nombre, id FROM `acciones_pme` WHERE fecha_fin='$date_limit' and acciones_pme.id_subdimension='$subdimensionId' and acciones_pme.rbd_colegio='$schoolRbd';";
            $result=mysqli_query($connection,$sql);
            if(!$result){
                echo $sql;
            }else{
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id_act' => $row['id'],
                        'nombre_act' => $row['nombre'],
                    );
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }
        }else{
            echo "Colegio no especificado,no podemos procesar tu solicitud";
        }
    }else{
        echo "no estas autorizad@ para seleccionar acciones del PME";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}
?>