<?php 
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '5'){
        $userName=$_SESSION["name"];
        require_once "../assets/php/connection.php";
        $connection=connection();
    }else{
        echo "<script>alert('No estas autorizad@ para ingresar al perfil de Director');</script>";
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
    <title>Gestion de Presupuestos</title>
    <meta name="description" content="Sistema de Seguimiento y Autorizacion de Solicitudes">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
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
                    <li class="nav-item"><a class="nav-link" href="PME.php"><i class="far fa-list-alt"></i><span>Gestión PME</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="presupuestos.php"><i class="far fa-money-bill-alt"></i><span>Presupuestos</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="perfil.php"><i class="fas fa-user"></i><span>Perfil</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../inicio_sesion.php"><i class="far fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <div class="btn-group" style="height: 30px;font-size: 10px;padding: 0px;margin: 0px;">
                            <select class="btn btn-primary" name="yearFilter" id="yearFilter" type="button" style="padding: 3px;">
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <!--<li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    <a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a><a class="dropdown-item" href="#">Menu Item</a>
                                </div>
                            </div>
                        </li>-->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userName;?> - Director/a</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="perfil.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Perfil</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="../inicio_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Salir</a></div>
                            </div>
                        </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid">
            <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Nivel Colegio</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Colegio</th>
                                        <th>Monto Total</th>
                                        <th>Monto Usado</th>
                                        <th>Monto Disponible</th>
                                    </tr>
                                </thead>
                                <tbody id="listSchoolBugdet">
                                    
                                </tbody>
                            </table>
                </div>
                        
                </div>
            </div><br>
            <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Nivel Subvenciones</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Subvención</th>
                                        <th>Monto Total</th>
                                        <th>Monto Usado</th>
                                        <th>Monto Disponible</th>
                                    </tr>
                                </thead>
                                <tbody id="listSubsBugdets">
                                    
                                </tbody>
                            </table>
                        </div>
                </div>
            </div><br>

                
                <!--<div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Presupuestos por Dimensiones PME</p>
                    </div>
                    <div class="card-body">
                        <label>Seleccione Subvención</label>
                        <select name="selectSub" id="selectSub" class="form-control">
                            <option value="">Subvención 1</option>
                        </select>
                        <br>
                        <button class="btn btn-success" type="button">Agregar Presupuesto</button><br><br>
                        <div class="form-group">
                    </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Monto</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><br>
                
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Presupuestos por Sub Dimensiones PME</p>
                    </div>
                    
                    <div class="card-body">
                    <label>Seleccione Dimensión</labeL>
                    <select class="form-control" name="selectDim" id="SelectDim">
                        <option value="">Dimensión 1</option>
                    </select>
                    <br>
                    <button class="btn btn-success" type="button">Agregar Presuesto</button><br><br><div class="form-group"><br>
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Monto</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                        
                    </div>
                </div>
                -->
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © SSAS 2021</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="js/bugdetsFunctions.js"></script>
    <script src="../assets/alertifyjs/alertify.js"></script>
</body>

</html>