<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '4'){
        if (isset($_POST['schoolRBD'])){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $schoolRBD=$_REQUEST['schoolRBD'];
            $codigo=$_POST['codigo'];
            $sql="SELECT id,nombre from estado where cod_producto='$codigo'";
            $resultado=mysqli_query($conexion,$sql);
            if(!$resultado){
                die('fallo el servidor :('.mysqli_fetch_array($conexion));}

            $json = array();
            while ($row = mysqli_fetch_array($resultado)){
                $json[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                );
            }

            $jsonstring = json_encode($json);
            echo $jsonstring;
        }else{
            echo "no podemos procesar tu solicitud";
        }
    }else{
        echo "no estas autorizad@ para listar Subvenciones";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php"); 
}
?>