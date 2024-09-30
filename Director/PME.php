<?php 
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '5'){
        $schoolRbd=$_SESSION['rbd_colegio'];
        $userName=$_SESSION["name"];
        require_once "../assets/php/connection.php";
        $connection=connection();
    }else{
        echo "No estas autorizad@ para ingresar al perfil de Director";
    }
}else{
    header("Location: ../inicio_sesion.php");   
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - SSAS</title>
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
                    <li class="nav-item"><a class="nav-link active" href="PME.php"><i class="far fa-list-alt"></i><span>Gestión PME</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="presupuestos.php"><i class="far fa-money-bill-alt"></i><span>Presupuestos</span></a></li>
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
                                <option value="2023">2023</option>
                            </select>
                        </div>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!--<div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    
                                    <a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a><a class="dropdown-item" href="#">Menu Item</a></div>
                            </div>-->
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"> <?php echo $userName;?>- Director/a</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                    <a class="dropdown-item" href="perfil.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Perfil</a>
                                        <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../inicio_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Salir</a></div>
                            </div>
                        </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid" style="font-size: 14px;">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Subvenciones</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Subvencion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SEP</td>
                                    </tr>
                                    <tr>
                                        <td>PIE</td>
                                    </tr>
                                    <tr>
                                        <td>GENERAL</td>
                                    </tr>
                                    <tr>
                                        <td>Pro Retención</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br><br></div>
                </div><br>
                <!--<div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Dimensiones PME</p>
                    </div>
                    <div class="card-body"><div class="form-group">
    
                    </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Dimensión</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Área Gestion Pedagogica<br></td>
                                    </tr>
                                    <tr>
                                        <td>Área de Liderazgo<br></td>
                                    </tr>
                                    <tr>
                                        <td>Área Gestión de Recursos<br></td>
                                    </tr>
                                    <tr>
                                        <td>Área Convivencia Escolar<br></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><br>-->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Dimensiones y Sub Dimensiones PME</p>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-md-center"> 
                                    <div class="col-md-auto">
                                        <h5>Gestion Pedagogica</h5>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Subdimensión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Gestión Curricular</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Gestión Curricular</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Enseñanza y aprendizaje en el aula</td>    
                                                    <tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-auto">
                                        <h5>Convivencia Escolar</h5>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Subdimensión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Formacion</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Convivencia</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Participacion y vida democratica</td>    
                                                    <tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-auto">
                                        <!--<div class="form-group">
                                            <select name="" id="selectDim" class="form-control">
                                                <option value="">Seleccione una Dimensión</option>
                                            </select>
                                        </div>-->
                                        <h5>Área de Liderazgo</h5>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Subdimensión</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listSubdimensions">
                                                    <tr>
                                                        <td>Liderazgo del Sostenedor</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Liderazgo del Director</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Planificación y gestión de resultados</td>    
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>                                
                                    </div>
                                    
                                    <div class="col-md">
                                        <h5>Gestion de Recursos</h5>
                                        <div class="table-responsive">
                                        
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Subdimensión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Gestion de Personal</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Gestion de Recursos Educativos</td>    
                                                    <tr>
                                                    <tr>
                                                        <td>Gestion de recursos financieros</td>    
                                                    <tr>                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Acciones PME</p>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success" onclick="openModalAddPMEAction()" type="button" style="padding: 7px;margin: 7px;">Agregar Acción</button><br><br><div class="form-group">
                        <!--<select name="" id="selectSubdim" class="form-control">
                            <option value="">Seleccione una Subdimensión</option>
                        </select>-->
                    </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Subdimensión</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody id="listPMEActionsbyYear">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © SSAS 2021</span></div>
            </div>

            <div class="modal fade" role="dialog" tabindex="-1" id="addPMEActionByYear">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Acción PME</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body">
                                <div class="form-group">
                                <select name="" id="addActionDim" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <select name="" id="addActionSubdim" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nombre de la Acción</label>
                                    <input type="text" id="addActionName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Descripción de la Acción</label>
                                    <textarea name="" id="addActionDescription" class="form-control" rows="7"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Fecha de Inicio de la Acción</label>
                                    <input type="date" id="addActionStartDate" class="form-control">
                                </div>
                            </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal" >Cerrar</button><button class="btn btn-primary" type="button" onclick="addPMEActionByYear()">Guardar</button></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" role="dialog" tabindex="-1" id="editPMEActionByYear">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edicion Acción PME</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">ID de la Acción</label>
                                    <input name="" id="editPMEActionID" class="form-control" readonly="readonly">
                                </div>
                    
                                <div class="form-group">
                                    <label for="">Nombre de la Acción</label>
                                    <input type="text" id="editPMEActionName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Descripción de la Acción</label>
                                    <textarea name="" id="editPMEActionDesc" class="form-control" rows="7"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Fecha de Inicio de la Acción</label>
                                    <input type="date" id="editPMEActionStartDate" class="form-control">
                                </div>
                            </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="button" onclick="updatePMEAction()">Guardar Cambios</button></div>
                    </div>
                </div>
            </div>
            
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="js/pmeFunctions.js"></script>
    <script src="../assets/alertifyjs/alertify.js"></script>
</body>

</html>