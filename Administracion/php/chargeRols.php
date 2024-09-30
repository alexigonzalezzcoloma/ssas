<?php
//session_start();
//if (!isset($_SESSION['rut'])){
//	header("Location: ../../../login.php");
//}

    require_once "../../assets/php/connection.php";
    $connection=connection();
    $sql="SELECT id,nombre from roles;";
    $result=mysqli_query($connection,$sql);
    if(!$result){
        die('fallo el servidor :('.mysqli_fetch_array($connection));}

    $json = array();
    while ($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

    mysqli_close($connection);

?>