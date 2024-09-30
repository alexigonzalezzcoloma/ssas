<?php
require_once "../../assets/php/connection.php";
$connection=connection();
$numero=41;
$sqlSubs="SELECT DISTINCT subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion=subvenciones.id WHERE requerimientos.id_solicitud='$numero';";
$result1=mysqli_query($connection,$sqlSubs);
$num_subs=mysqli_num_rows($result1);

$subsGroup="";
$count=1;
while ($fila = mysqli_fetch_assoc($result1)) {
    $subsGroup= $subsGroup.$fila["nombre_subvencion"];
    if ($count<$num_subs){
        $subsGroup=$subsGroup.", ";
    }
    $count++;
}
echo $subsGroup;

?>