<?php 
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
        require_once "../../assets/php/connection.php";
        $connection=connection();
        $userName=$_SESSION["name"];
        $userRut=$_SESSION["user_rut"];
        //$schoolRbd=$_SESSION["rbd_colegio"];
        $sqlMailAndRol="SELECT usuarios.email,roles.nombre FROM `usuarios` INNER JOIN roles on usuarios.id_rol=roles.id WHERE usuarios.rut='$userRut';";
        $result=mysqli_query($connection,$sqlMailAndRol);
        $rows=mysqli_fetch_row($result);
        $userMail=$rows[0];
        $userRol=$rows[1];

        $json = array();

        $json[] = array(
            'userRut' => $userRut,
            'userName' => $userName,
            'userRol' =>  $userRol,
            'userMail' => $userMail, 
        );  

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }else{
        echo "<script>alert('No estas autorizad@ para ingresar al perfil de Director');</script>";
        header("Location: ../inicio_sesion.php");   
    }
}else{
    echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
    header("Location: ../inicio_sesion.php");   
}

?>