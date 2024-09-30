<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
                require_once "../../assets/php/connection.php";
                $connection=connection();
                $userRut=$_SESSION["user_rut"];
                $userName=$_POST["userName"];
                $userMail=$_POST["userMail"];
                $userPass=$_POST["userPass"];
                $encPass= password_hash($userPass, PASSWORD_BCRYPT);

                $sql="UPDATE usuarios SET nombre = '$userName', email = '$userMail', 
                clave = '$encPass' WHERE rut = '$userRut'";
                $result=mysqli_query($connection,$sql);

                if($result){
                    echo 1;
                }
                else{
                    echo "no se pudieron actualizar los datos error: ".$sql;
                }
                mysqli_close($connection);
        }else{
            echo "No estás autorizad@ para listar Presupuestos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>