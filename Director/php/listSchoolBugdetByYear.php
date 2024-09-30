<?php
   session_start();
   if (isset($_SESSION['user_rut'])){
       if ($_SESSION["id_rol"] == '5'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $year=$_POST["year"];
            $startDate=$year."-01-01";
            $endDate=$year."-12-31";
            $schoolRbd=$_SESSION["rbd_colegio"];

            $sql="SELECT presupuestos_colegios.monto as presupuesto_total, colegios.nombre FROM `presupuestos_colegios`
            LEFT JOIN colegios on presupuestos_colegios.rbd_colegio=colegios.rbd  
            WHERE presupuestos_colegios.rbd_colegio='$schoolRbd' and fecha_fin BETWEEN '$startDate' and '$endDate';";

            $sql2="SELECT SUM(precio_total) as presupuesto_utilizado FROM `solicitudes` 
            WHERE rbd_colegio='$schoolRbd' and id_estado_actual >3 and id_estado_actual!=14 and id_estado_actual!=16
            and fecha_hora BETWEEN '$startDate' and '$endDate';";

            $result1=mysqli_query($connection,$sql);
            $result2=mysqli_query($connection,$sql2);

            $sql_nameSchool="SELECT nombre FROM `colegios` where colegios.rbd='$schoolRbd';";
            $result_nameSchool=mysqli_query($connection,$sql_nameSchool);
            $row_nameSchool=mysqli_fetch_row($result_nameSchool);

            $title=$row_nameSchool[0];
            $row_presupuesto_total =mysqli_fetch_row($result1);
            $row_presupuesto_utilizado=mysqli_fetch_row($result2);
            
            $presupuesto_total = $row_presupuesto_total[0];
            $presupuesto_utilizado = $row_presupuesto_utilizado[0];
            
            $presupuesto_total = intval($presupuesto_total);
            $presupuesto_utilizado = intval($presupuesto_utilizado);
            

            $presupuesto_disponible = $presupuesto_total - $presupuesto_utilizado;
            
            $json = array();    
            $json[] = array(
                'titulo' => $title,
                'presupuesto_total' => number_format($presupuesto_total,0,',','.'),
                'presupuesto_utilizado' => number_format($presupuesto_utilizado,0,',','.'),
                'presupuesto_disponible' =>  number_format($presupuesto_disponible,0,',','.'),
            );  
            
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