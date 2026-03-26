<?php
session_start(); 
require_once "assets/php/connection.php";
$connection=connection();
error_log("inicio_sesion.php loaded, connection: " . ($connection ? 'ok' : 'failed'));

if(isset($_POST["login"])) {
    $rut = addslashes($_POST["user_rut"]);
    $rut=str_replace('.', '', $rut);
    $pass = $_POST["usr_pass"];
    error_log("Login attempt for rut: $rut");
    $sql1 = "SELECT nombre,clave,id_rol,rbd_colegio,habilitado,rut_fundacion FROM usuarios WHERE rut='$rut' ";
    $result=mysqli_query($connection,$sql1);
    error_log("Query executed, num rows: " . mysqli_num_rows($result));

    if(mysqli_num_rows($result)>0){
        while($var=mysqli_fetch_row($result)){
            if ($var[4]==1){
                error_log("var[2] (id_rol from DB): " . $var[2]);
                error_log("User enabled, rol from DB: $var[2]");
                $GLOBALS['pass']= $GLOBALS['pass'];
                $_SESSION["user_rut"] = $rut;
                
                $_SESSION["name"] = $var[0];
                $_SESSION["id_rol"] = $var[2];
                error_log("Session id_rol set to: " . $_SESSION["id_rol"]);
                $_SESSION["rbd_colegio"] = $var[3];
                $_SESSION["rut_fundacion"] = $var[5];

                $rol_usuario= $var[2];
                error_log("rol_usuario variable: $rol_usuario");

                echo "<script>console.log('Rol del usuario antes de verificar contraseña: $rol_usuario');</script>";
                error_log("Rol del usuario: $rol_usuario");

                if (password_verify($pass, $var[1])) {
                    switch ($rol_usuario) {
                        case '1':
                            echo "<script>console.log('Iniciando sesión como Administrador');</script>";
                            header("Location:Administracion/inicio.php");
                            break;
                        case '2':
                            echo "<script>console.log('Iniciando sesión como Departamental');</script>";
                            header("Location:Departamental/inicio.php");
                            break;
                        case '3':
                            echo "<script>console.log('Iniciando sesión como Tesorero de la Fundación');</script>";
                            header("Location:Tesorero-Fundacion/inicio.php");
                            break;
                        case '4':
                            echo "<script>console.log('Iniciando sesión como Editor');</script>";
                            header("Location:Editor/inicio.php");
                            break;
                        case '5':      
                            echo "<script>console.log('Iniciando sesión como Director');</script>";
                            header("Location:Director/inicio.php");
                            break;
                        case '6':
                            echo "<script>console.log('Iniciando sesión como Encargado de TI');</script>";
                            header("Location:Encargado-TI/inicio.php");
                            break;
                        case '7':
                            echo "<script>console.log('Iniciando sesión como Encargado de GTH');</script>";

                            header("Location:Encargado-GTH/inicio.php");
                            break;
                        case '8':
                            echo "<script>console.log('Iniciando sesión como Revisor');</script>";

                            header("Location:Revisor/inicio.php");
                            break;
                        case '9':
                            echo "<script>console.log('Iniciando sesión como Secretaria');</script>";
                            header("Location:Secretaria/inicio.php");
                            break;
                        default:
                            error_log("Rol no reconocido: '$rol_usuario'");
                            echo "<script>alert('Rol de usuario inválido: $rol_usuario');</script>";
                            break;
                    }
                    exit;
                } else {
                    echo"<script> alert('Credenciales erróneas'); </script>";
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
    <script>
        <?php if (isset($_SESSION["id_rol"])) { ?>
            console.log("Rol del usuario: <?php echo $_SESSION['id_rol']; ?>");
        <?php } else { ?>
            console.log("No hay sesión activa o rol definido");
        <?php } ?>
    </script>
</body>

</html>