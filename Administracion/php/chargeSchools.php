<?php
//session_start();
//if (!isset($_SESSION['rut'])){
//	header("Location: ../../../login.php");
//}
$foundationRut='65.002.737-k';

if ($foundationRut==""){
    echo "no podemos procesar tu solicitud";
}else{
    require_once "../../assets/php/connection.php";
    $connection=connection();
    $sql="SELECT rbd,nombre from colegios where rut_fundacion='$foundationRut';";
    $result=mysqli_query($connection,$sql);
    if(!$result){
        die('fallo el servidor :('.mysqli_fetch_array($connection));}

    $json = array();
    while ($row = mysqli_fetch_array($result)){
        $json[] = array(
            'rbd' => $row['rbd'],
            'nombre' => $row['nombre'],
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}
mysqli_close($connection);

?>