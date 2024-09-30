<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '3'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";

            
            $sql="SELECT presupuestos_colegios.id, colegios.nombre, presupuestos_colegios.rbd_colegio, presupuestos_colegios.monto FROM `presupuestos_colegios` LEFT JOIN colegios on presupuestos_colegios.rbd_colegio=colegios.rbd WHERE fecha_inicio BETWEEN '$startDate' and '$endDate';";
            $result=mysqli_query($connection,$sql);

                    
            if($result){                
                $json = array(); 
                while ($row = mysqli_fetch_array($result)){
                    $json[] = array(
                        'id_presupuesto' => $row['id'],
                        'nombre_colegio' => $row['nombre'],
                        'rbd_colegio' => $row['rbd_colegio'],
                        'monto_colegio' => number_format($row['monto'],0,',','.'),
                    );  
                }
                               
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else{
                echo $sql;
                die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
        }else{
            echo "no estas autorizad@ para listar requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>