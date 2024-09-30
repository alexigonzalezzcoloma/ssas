<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '4'){
          require_once "../../assets/php/connection.php";
          $connection=connection();
          $creatorRut=$_SESSION["user_rut"];
          $schoolRbd=$_SESSION["rbd_colegio"];
          date_default_timezone_set("America/Santiago");
          $get_date = getdate();
          $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
          $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
          $date_time=$date.' '.$time;
          $sql1="INSERT into solicitudes (rut_creador,rbd_colegio,tipo,titulo,justificacion,id_estado_actual,fecha_hora)
          values ('$creatorRut','$schoolRbd','','','',1,'$date_time')";
          $result=mysqli_query($connection,$sql1);
          $requestId=mysqli_insert_id($connection);
          if ($result!=1){
              echo "La consulta falló";
              echo $sql1;
          }else{

            $sql2="INSERT INTO `movimientos` 
            ( `id_solicitud`, `rut_usuario`, `id_rol_usuario`, `id_estado`,`fecha_hora`) 
            VALUES ('$requestId', '$creatorRut', '4',1,'$date_time');";
            $result2=mysqli_query($connection,$sql2);
            if($result2){
              echo $requestId;
            }else{
              echo "no se pudo agregar el estado";
            }
          }
    }else{
      echo "No estás autorizad@ para listar Presupuestos";
    }
}else{
  echo "No se detecta su sesión, por favor inicie sesión";
  header("Location: ../../inicio_sesion.php"); 
}
?>