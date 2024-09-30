<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
        $foundationRut=$_SESSION["rut_fundacion"];
        if ($foundationRut==""){
            echo "Fundación no especificada,no podemos procesar tu solicitud";
        }else{
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $sql="SELECT * FROM `profesionales_contratables`;";
            $result=mysqli_query($connection,$sql);
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id_prof' => $row['id'],
                        'nombre_prof' => $row['nombre'],
                        'precio_hora' => $row['precio_hora'],
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