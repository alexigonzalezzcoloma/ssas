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
            $userRol = $_POST["userRolE"];
            $userPass = $_POST["userPassE"];
            $isEnabled = $_POST["isEnabledE"];

            $encPass= password_hash($userPass, PASSWORD_BCRYPT);

            $sql="UPDATE usuarios SET nombre = '$userName' , email='$userMail' , rut_fundacion='$userFoundation' , rbd_colegio='$userSchool' , id_rol='$userRol' , clave = '$encPass' , habilitado = '$isEnabled' WHERE rut='$userRut'";
            echo $result=mysqli_query($connection,$sql);
            if(!$result){
                echo $sql;
                //die('fallo el servidor :('.mysqli_fetch_array($connection));
            }
        }
        //mysqli_close($connection);
    //}
?>
