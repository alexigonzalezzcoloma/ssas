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
            
            $sql="UPDATE usuarios SET  habilitado = '0' WHERE rut='$userRut'";
            echo $result=mysqli_query($connection,$sql);
            if(!$result){
                echo $sql;
            }
        }
        mysqli_close($connection);
    //}
?>
