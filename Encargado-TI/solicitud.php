<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '6'){
        if (isset($_REQUEST["numero"])){
            $numero=$_REQUEST["numero"];
            require_once "../assets/php/connection.php";
            $connection=connection();
            $sqlCurrentStateandRbd="SELECT solicitudes.id_estado_actual, solicitudes.rbd_colegio, colegios.nombre FROM `solicitudes` INNER JOIN colegios on solicitudes.rbd_colegio=colegios.rbd WHERE solicitudes.id='$numero';";
            $resultCurrentStateandRbd=mysqli_query($connection,$sqlCurrentStateandRbd);
            $stateAndRbd=mysqli_fetch_row($resultCurrentStateandRbd);
            $currentState=$stateAndRbd[0];
            $requestRbd=$stateAndRbd[1];
            $collegeName=$stateAndRbd[2];
            if ($currentState >= 4){
                $schoolRbd=$_SESSION['rbd_colegio'];
                $userName=$_SESSION["name"]; 
            }else{
                header("Location: inicio.php");
                echo "<script>alert('no estas autorizad@ para revisar esta solicitud');</script>";
            }
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
                    <label for="">Solicitud: <?php echo $numero; ?></label>&nbsp;&nbsp;<label for=""><?php echo "$collegeName"; ?></label>
                        <input hidden class="form-control" name="numero" id="numero" value="<?php echo $numero; ?>">
                        <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow">
                                <!--<a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
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
                                    </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a>
                                </div>-->
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userName;?> - Encargado TI</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="perfil.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Perfil</a>
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
                            <p class="text-primary m-0 font-weight-bold">Encabezado</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group" id="listRequest">
                                            
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Requerimientos</p>
                        </div>
                        <div class="card-body" id="FormRequirements">
                            
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Gestión del PME</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Subvención</th>
                                            <th>Dimensión de Gestión</th>
                                            <th>Subdimensión de Gestión</th>
                                            <th>Acción PME</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listPME">
                                            
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Subvención</th>
                                            <th>Dimensión de Gestión</th>
                                            <th>Subdimensión de Gestión</th>
                                            <th>Acción PME</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Presupuestos</p>
                        </div>
                        <div class="card-body">
                            <div id="schoolBudget">
                                
                            </div>
                            
                            <div id="subsBugdets">
                                
                            </div>
                            
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Adjuntos</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID Movimiento</th>
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listAttach">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID Movimiento</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Fecha</strong></td>
                                            <td><strong>Acciones</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Movimientos</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Estado</th>
                                            <th>Cargo</th>
                                            <th>Usuario</th>
                                            <th>¿Recomienda?</th>
                                            <th>Comentario</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listMoves">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Estado</strong></td>
                                            <td><strong>Cargo</strong></td>
                                            <td><strong>Usuario</strong></td>
                                            <th>¿Recomienda?</th>
                                            <td><strong>Comentario</strong></td>
                                            <td><strong>Fecha</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="container-fluid my-4">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#sendReqModal">Enviar Solicitud</button>
                    </div>

                </div>
            </div>
        </div>
        
        <footer class="bg-white sticky-footer">
            <!-- Modal -->
            <div class="modal fade" id="sendReqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Enviar Solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="tiRecommend">¿Está Correcta la Solicitud?</label>
                                <select class="form-control" id="tiRecommend">
                                <option value="">Seleccione una opción</option>
                                <option value="Sí">Sí, está Correcta</option>
                                <option value="No">No, está Incorrecta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tiComment">Comentario</label>
                                <textarea class="form-control" name="tiComment" id="tiComment" placeholder="Ingrese Comentario (Opcional)"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="sendRequest(<?php echo $numero;?>)">Enviar</button>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Generar Reporte PDF&nbsp;</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                            <p>Está Seguro de Generar Reporte detallado?&nbsp; &nbsp;Los Reportes detallados consumen muchos recursos del Servidor, sólo se recomiendan para Actas.</p>
                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal" style="background-color: rgb(222,68,58);color: rgb(237,237,237);">Cancelar</button><button class="btn btn-primary" type="button">Sí, Reporte Completo</button>
                            <button
                                class="btn btn-primary" type="button" style="background-color: rgb(78,223,84);">Reporte resumido</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © SSAS 2021</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="js/requestFunctions.js"></script>
    <script src="../assets/alertifyjs/alertify.js"></script>
</body>

</html>