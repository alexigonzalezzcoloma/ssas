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
    $sql="SELECT usuarios.rut, usuarios.nombre, usuarios.email, usuarios.habilitado, usuarios.rut_fundacion, usuarios.rbd_colegio,usuarios.id_rol, roles.nombre as rol_usr
    ,colegios.nombre as nombre_colegio, fundaciones.nombre as nombre_fundacion FROM usuarios 
    INNER JOIN roles on roles.id=usuarios.id_rol 
    LEFT JOIN colegios on colegios.rbd = usuarios.rbd_colegio
    INNER JOIN fundaciones on fundaciones.rut = usuarios.rut_fundacion 
    where usuarios.rut_fundacion='$foundationRut';";
    $result=mysqli_query($connection,$sql);
    if(!$result){
        die('fallo el servidor :('.mysqli_fetch_array($connection));}

    $json = array();
    while ($row = mysqli_fetch_array($result)){
        $json[] = array(
            'rut' => $row['rut'],
            'nombre' => $row['nombre'],
            'email' => $row['email'],
            'rol_usr' => $row['rol_usr'],
            'nombre_fundacion' => $row['nombre_fundacion'],
            'nombre_colegio' => $row['nombre_colegio'],
            'habilitado' => $row['habilitado'],
            'rut_fundacion' => $row['rut_fundacion'],
            'rbd_colegio' => $row['rbd_colegio'],
            'id_rol' => $row['id_rol'],
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}
mysqli_close($connection);

?>