<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '7'){
        if (isset($_REQUEST["IdComision"])){
            $IdComision=$_REQUEST["IdComision"];
            $userName=$_SESSION["name"];
            require_once "../assets/php/connection.php";
            $connection=connection();
        }else{
            echo "<script>alert('no se detecta un número de solicitud');</script>";
            header("Location: inicio.php");
        }   
    }else{
        echo"<script>alert('No estas autorizad@ para ingresar al perfil Encargado TI');</script>";
        header("Location: ../inicio_sesion.php");   
    }
}else{
    echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
    header("Location: ../inicio_sesion.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Revisión Solicitud</title>
    <meta name="description" content="Sistema de Seguimiento y Autorizacion de Solicitudes">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/themes/default.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background-color: rgb(0,50,100);">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-file-pdf"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>SSAS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link" href="inicio.php"><i class="fas fa-tachometer-alt"></i><span>Mi Bandeja</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="solicitudes-pendientes.php"><i class="fas fa-comment-slash"></i><span>Pendientes</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="comision-interna.php"><i class="fas fa-comment-slash"></i><span>Gestion Comisión</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="perfil.php"><i class="fas fa-user"></i><span>Perfil</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../inicio_sesion.php"><i class="far fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <strong><label for="">Comisión: <?php echo $IdComision; ?></label></strong>
                        <input hidden class="form-control" name="IdComision" id="IdComision" value="<?php echo $IdComision; ?>">
                        <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!--<div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="mr-3">
                                            <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 12, 2019</span>
                                            <p>A new monthly report is ready to download!</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="mr-3">
                                            <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 7, 2019</span>
                                            <p>$290.29 has been deposited into your account!</p>
                                        </div>
                                    </a>
                                    <a class="d-flex align-items-center dropdown-item" href="#">
                                        <div class="mr-3">
                                            <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">December 2, 2019</span>
                                            <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                        </div>
                                    </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a></div>
                            </div>-->
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userName;?> - Departamental Fundación</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                    <a class="dropdown-item" href="perfil.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../inicio_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
            </div>
            </nav>

            <div class="container-fluid">
                <h3 class="text-dark mb-4"></h3>
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Acta</p>
                        </div>
                        <div class="card-body" id="chargeRecord">
                            
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Solicitudes Aceptadas</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id Solicitud</th>
                                            <th>Colegio</th>
                                            <th>Titulo Solicitud</th>
                                            <th>Voto</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listAprovedReq">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id Solicitud</th>
                                            <th>Colegio</th>
                                            <th>Titulo Solicitud</th>
                                            <th>Voto</th>
                                            <th>Ver</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Solicitudes Denegadas</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id Solicitud</th>
                                            <th>Colegio</th>
                                            <th>Titulo Solicitud</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listDeniedReq">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id Solicitud</th>
                                            <th>Colegio</th>
                                            <th>Titulo Solicitud</th>
                                            <th>Ver</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

</div>

                    </div>
                    <div class="container-fluid my-4">
                    </div>

                </div>
            </div>
        </div>
        
        <footer class="bg-white sticky-footer">
            <!-- Modal -->
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © SSAS 2021</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="js/detailComissionFunctions.js"></script>
    <script src="../assets/alertifyjs/alertify.js"></script>
</body>

</html>