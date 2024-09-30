<?php
    /*session_start();
    if (!isset($_SESSION['rut'])){
        header("Location: ../../login.php");
    }
    if ($_SESSION["tipo"] != 'editor'){
        echo"no estas autorizad@ para listar esta orden";
    }else{
        */
        if(!isset($_POST['userRut'])){
            echo"no podemos procesar la solicitud";
        }else{
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $userRut = $_POST["userRut"];
            $userName = $_POST["userName"];
            $userMail = $_POST["userMail"];
            $userFoundation = $_POST["userFoundation"];
            $userSchool = $_POST["userSchool"];
            $userRol = $_POST["userRol"];
            $userPass = $_POST["userPass"];

            $encPass= password_hash($userPass, PASSWORD_BCRYPT);

            $sql="INSERT into usuarios (rut,nombre,email,rut_fundacion,rbd_colegio,id_rol,clave,habilitado) 
            VALUES ('$userRut','$userName','$userMail','$userFoundation','$userSchool','$userRol','$encPass','1')";
            echo $result=mysqli_query($connection,$sql);
            if(!$result){
                echo $sql;
                //die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
        }
        mysqli_close($connection);
    //}
?>
