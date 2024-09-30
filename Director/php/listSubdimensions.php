<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '5'){
           
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $dimId=$_POST["dimId"];
            
            $sql="SELECT nombre FROM `subdimensiones_gestion` WHERE id_dimension='$dimId' and nombre!='Seleccione Subdimension';";
            $result=mysqli_query($connection,$sql);

            if($result){
                $json = array();
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'nombre_subdim' => $row['nombre'],
                    );
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
            mysqli_close($connection);

        }else{
            echo "no estas autorizad@ para eliminar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>