<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '3'){
        $foundationRut=$_SESSION["rut_fundacion"];
        if ($foundationRut==""){
            echo "Fundación no especificada,no podemos procesar tu solicitud";
        }else{
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $sql="SELECT rbd, nombre FROM `colegios` where rut_fundacion='$foundationRut'";
            $result=mysqli_query($connection,$sql);
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'rbd' => $row['rbd'],
                        'nombre' => $row['nombre'],
                    );
                }
        
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                //die('fallo el servidor :('.mysqli_fetch_array($connection));
                echo $sql;
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