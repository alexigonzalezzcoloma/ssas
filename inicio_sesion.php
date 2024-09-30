<?php
session_start(); 
require_once "assets/php/connection.php";
$connection=connection();

if(isset($_POST["login"])) {
    $rut = addslashes($_POST["user_rut"]);
    $rut=str_replace('.', '', $rut);
    $pass = $_POST["usr_pass"];
    $sql1 = "SELECT nombre,clave,id_rol,rbd_colegio,habilitado,rut_fundacion FROM usuarios WHERE rut='$rut' ";
    $result=mysqli_query($connection,$sql1);

    if(mysqli_num_rows($result)>0){
        while($var=mysqli_fetch_row($result)){
            if ($var[4]==1){
                $GLOBALS['pass']= $GLOBALS['pass'];
                $_SESSION["user_rut"] = $rut;
                
                $_SESSION["name"] = $var[0];
                $_SESSION["id_rol"] = $var[2];
                $_SESSION["rbd_colegio"] = $var[3];
                $_SESSION["rut_fundacion"] = $var[5];

                $rol_usuario= $_SESSION["id_rol"];

                if ($rol_usuario=='1' && password_verify($pass, $var[1])){
                    header("Location:Administracion/inicio.php");
                }
                if ($rol_usuario=='2' && password_verify($pass, $var[1])){
                    header("Location:Departamental/inicio.php");
                }   
                if ($rol_usuario=='3' && password_verify($pass, $var[1])){
                    header("Location:Tesorero-Fundacion/inicio.php");
                }              
                if ($rol_usuario=='4' && password_verify($pass, $var[1])){
                    header("Location:Editor/inicio.php");
                }
                if ($rol_usuario=='5' && password_verify($pass, $var[1])){
                    header("Location:Director/inicio.php");
                }
                if($rol_usuario=='6' && password_verify($pass, $var[1])){
                    header("Location:Encargado-TI/inicio.php");
                }
                if($rol_usuario=='7' && password_verify($pass, $var[1])){
                    header("Location:Encargado-GTH/inicio.php");
                }
                if($rol_usuario=='8' && password_verify($pass, $var[1])){
                    header("Location:Revisor/inicio.php");
                } 
                if($rol_usuario=='9' && password_verify($pass, $var[1])){
                    header("Location:Secretaria/inicio.php");
                }                
                
                if (password_verify($pass, $var[1])==FALSE){
                    echo"<script> alert('Crendenciales erróneas'); </script>";
                    echo "<form action='inicio_sesion.php' method='post'>";
                }
            }else{
                echo"<script> alert('No estas habilitad@ para usar el Sistema en este momento'); </script>";
		        echo "<form action='inicio_sesion.php' method='post'>";
            }
        }
    }else{
        echo"<script> alert('Usuario no encontrado'); </script>";
		echo "<form action='inicio_sesion.php' method='post'>";
    }
}else{
    session_destroy();
}
mysqli_close($connection);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inicio de Sesión - Solicitudes</title>
    <meta name="description" content="Sistema de Seguimiento y Autorizacion de Solicitudes">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/ea-login.jpg&quot;);width: 412px;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Sistema de Seguimiento y Autorización de Solicitudes&nbsp;</h4>
                                    </div>
                                    <form class="user" method="POST" action="inicio_sesion.php">
                                        <div class="form-group"><input class="form-control form-control-user" type="text" id="user_rut" placeholder="Rut.ej: 12345678-9" name="user_rut"/></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="usr_pass" placeholder="Clave de 8 caractéres" name="usr_pass"/>
                                        </div>
                                        <div class="form-group">
                                            <!--<div class="custom-control custom-checkbox small"><div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1" /><label class="form-check-label custom-control-label" for="formCheck-1">Recordarme</label></div></div>-->
                                        </div>
                                        <button class="btn btn-primary btn-block text-white btn-user" name="login"  type="submit">Iniciar Sesión</button>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.html">Olvidé la Clave</a></div>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>