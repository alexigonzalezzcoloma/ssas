<?php

session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
        $foundationRut=$_SESSION["rut_fundacion"];
        if ($foundationRut!=""){
            $dimensionId=$_POST['dimensionId'];
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $sql="SELECT nombre, id FROM `subdimensiones_gestion` WHERE subdimensiones_gestion.id_dimension='$dimensionId';";
            $result=mysqli_query($connection,$sql);
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id_subd' => $row['id'],
                        'nombre_subd' => $row['nombre'],
                    );
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
            mysqli_close($connection);
        }else{
            echo "Fundación no especificada,no podemos procesar tu solicitud";
        }
    }else{
        echo "no estas autorizad@ para listar Subdimensiones de Gestión";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php");
}

?>