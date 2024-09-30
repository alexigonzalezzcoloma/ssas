<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '9'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $id = $_REQUEST["id"];
            $subvention = $_REQUEST["subvention"];
            $dimension = $_REQUEST["dimension"];
            $subdimension = $_REQUEST["subdimension"];
            $action = $_REQUEST["action"];       
            
            $sql="UPDATE pme_solicitudes SET id_subvencion = '$subvention', id_dimension = '$dimension', 
            id_subdimension = '$subdimension', id_accion='$action' WHERE id = '$id'";
            $result=mysqli_query($connection,$sql);                    
            if($result){
                echo 1;
            }else{
                //die('fallo el servidor :('.mysqli_fetch_array($connection));
                echo $sql;
            }  
        }else{
            echo "no estas autorizad@ para actualizar la acción PME de la solicitud";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>