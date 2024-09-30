<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $schoolRbd=$_POST["schoolRbd"];
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            
            $sql="SELECT presupuestos_subvenciones.id, presupuestos_subvenciones.rbd_colegio, presupuestos_subvenciones.monto, subvenciones.nombre FROM `presupuestos_subvenciones` INNER JOIN subvenciones on presupuestos_subvenciones.id_subvencion=subvenciones.id WHERE rbd_colegio='$schoolRbd' and fecha_inicio between '$startDate' and '$endDate';";
            $result=mysqli_query($connection,$sql);
                    
            if(!$result){
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
    
            $json = array();
            while ($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id_presupuesto' => $row['id'],
                    'rbd_colegio' =>$row['rbd_colegio'],
                    'monto_sub' =>  number_format($row['monto'],0,',','.'),
                    'nombre_sub' => $row['nombre'],
                );  
            }

            $jsonstring = json_encode($json);
            echo $jsonstring;
        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>