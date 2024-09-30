<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_REQUEST['requestId'];

            $sql="SELECT id,nombre,fecha_hora,ruta from adjuntos WHERE id_solicitud='$requestId'";
            $result=mysqli_query($connection,$sql);
                    
            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id' => $row['id'],
                        'nombre' => $row['nombre'],
                        'fecha_hora' => $row['fecha_hora'], 
                        'ruta' => $row['ruta'],
                    );  
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
            mysqli_close($connection);
        }else{
            echo "no estas autorizad@ para listar los Adjuntos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }
?>