<?php
    session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
                require_once "../../assets/php/connection.php";
                $connection=connection();
                $Id=$_POST["Id"];
                $Name=$_POST["Name"];
                $Quantity=$_POST["Quantity"];
                $Price=$_POST["Price"];
                $Subs=$_POST["Subs"];

                $sql="UPDATE requerimientos SET nombre = '$Name', cantidad = '$Quantity', 
                precio = '$Price', id_subvencion = '$Subs' WHERE id = '$Id'";
                $result=mysqli_query($connection,$sql);

                if($result){
                    echo 1;
                }
                else{
                    echo "no se pudieron actualizar los datos error: ".$sql;
                }
                mysqli_close($connection);
        }else{
            echo "No estás autorizad@ para actualizar Requerimientos";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php"); 
    }
?>