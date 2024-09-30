<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - SSAS</title>
    <meta name="description" content="Sistema de Seguimiento y Autorizacion de Solicitudes">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Mi Bandeja</span></a><a class="nav-link" href="index.php"><i class="fas fa-comment-slash"></i><span>En Curso</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Perfil</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-0" style="font-size: 20px;">Nueva Solicitud<br></h3>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
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
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">Jhon Doe - Editor</span></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a
                                            class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Solicitudes</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#">&nbsp;Filtrar</a></div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Lista Completa</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Mostrar <select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Buscar"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titulo</th>
                                            <th>Origen</th>
                                            <th>Subvencion</th>
                                            <th>Fecha Creacion</th>
                                            <th style="font-size: 10px;">Estado</th>
                                            <th style="font-size: 10px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12</td>
                                            <td>Accountant</td>
                                            <td>COADTE</td>
                                            <td>SEP</td>
                                            <td>2021/11/28</td>
                                            <td>creada</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;" href="solicitud.php"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Chief Executive Officer(CEO)</td>
                                            <td>COADVAN</td>
                                            <td>SEP</td>
                                            <td>2021/10/09<br></td>
                                            <td>en proceso</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Junior Technical Author</td>
                                            <td>CADVI</td>
                                            <td>PIE</td>
                                            <td>2021/01/12<br></td>
                                            <td>en proceso</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Software Engineer</td>
                                            <td>CADVI</td>
                                            <td>SEP</td>
                                            <td>2021/10/13<br></td>
                                            <td>denegada</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Software Engineer</td>
                                            <td>CADVA</td>
                                            <td>SEP</td>
                                            <td>2021/06/07<br></td>
                                            <td>rendición</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Integration Specialist</td>
                                            <td>COADTE&nbsp;</td>
                                            <td>PIE</td>
                                            <td>2021/12/02<br></td>
                                            <td>denegada</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>6<br></td>
                                            <td>Software Engineer</td>
                                            <td>COADVAN</td>
                                            <td>GENERAL</td>
                                            <td>2021/05/03<br></td>
                                            <td>aprobada&nbsp;</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Pre-Sales Support</td>
                                            <td>COADTRO</td>
                                            <td>GENERAL</td>
                                            <td>2021/12/12<br></td>
                                            <td>aprobada</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Sales Assistant</td>
                                            <td>COADPI</td>
                                            <td>SEP</td>
                                            <td>2021/12/06<br></td>
                                            <td>aprobada</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Senior JavaScript Developer</td>
                                            <td>COADTRO</td>
                                            <td>SEP</td>
                                            <td>2021/03/29<br></td>
                                            <td>en revision</td>
                                            <td><a class="btn btn-warning btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;"><i class="fas fa-edit text-white"></i></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Tutulo</strong></td>
                                            <td><strong>Origen</strong></td>
                                            <td><strong>Subvencion</strong></td>
                                            <td><strong>Fecha Creacion</strong></td>
                                            <td><strong>Estado</strong></td>
                                            <td><strong>Acciones</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Mostrando 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="modal fade" role="dialog" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Solicitud</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body"><div class="form-group">
    <label>Tipo de Subvencion</labeL><br>
    <select class="form-control">
        <option>SEP</option>
    </select>
</div><div class="form-group">
    <label>Título</labeL>
    <input type="text" class="form-control"/>
</div><div class="form-group">
    <label>Tipo de Subvencion</labeL><br>
    <select class="form-control">
        <option>SEP</option>
    </select>
</div><div class="form-group">
    <label>Área de Gestión</labeL><br>
    <select class="form-control">
        <option>Recursos</option>
        <option>Materiales</option>
    </select>
</div><div class="form-group">
    <label>Dimensión de Gestión</labeL><br>
    <select class="form-control">
        <option>Gestión de Recursos Educativos</option>
        <option>Gestion de Rescursos</option>
    </select>
</div><div class="form-group">
    <label>N° Acción del PME</labeL><br>
    <input type="text" class="form-control">
</div></div>
                            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button><button class="btn btn-primary" type="button">Agregar</button></div>
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
                <div class="modal fade" role="dialog" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Requerimiento</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body"><div class="form-group">
    <label>Requerimiento</labeL>
    <input type="text" class="form-control"/>
</div><div class="form-group">
    <label>Cantidad</labeL>
    <input type="text" class="form-control"/>
</div><div class="form-group">
    <label>Precio</labeL>
    <input type="text" class="form-control"/>
</div></div>
                            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button><button class="btn btn-success" type="button">Agregar</button></div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" role="dialog" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Adjunto</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body"><div class="form-group">
    <label>Nombre</labeL>
    <input type="text" class="form-control"/>
</div>
                                <p></p><input type="file"></div>
                            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button><button class="btn btn-primary" type="button">Agregar</button></div>
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
</body>

</html>