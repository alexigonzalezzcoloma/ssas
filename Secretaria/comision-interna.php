<?php 
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
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
    <title>Gestión de Agenda</title>
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
                    <li class="nav-item"><a class="nav-link active" href="comision-interna.php"><i class="fas fa-comment-slash"></i><span>Gestion Comisión</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="perfil.php"><i class="fas fa-user"></i><span>Perfil</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../inicio_sesion.php"><i class="far fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <!--<div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <div class="btn-group" style="height: 30px;font-size: 10px;padding: 0px;margin: 0px;">
                        <button class="btn btn-primary" type="button" style="padding: 3px;">2022&nbsp;</button>
                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" type="button" style="padding: 4px;"></button>
                        <div
                            class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a>
                        </div>
                    </div>-->
                    
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <!--<li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                    <h6 class="dropdown-header">alerts center</h6>
                                    <a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a></div>
                            </div>
                        </li>-->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userName;?> - Secretaria</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="perfil.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Perfil</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Configuración</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Reporte</a>
                                        <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../inicio_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Salir</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="container-fluid" style="margin: 0px;">
                <div class="card shadow">
                    <div class="card-header py-3"><strong>Agenda Comisión Interna</strong></div>
                        <div class="card-body">
                                    <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="font-size: 14px;height: auto;width: auto;">
                                        <form action="crear-acta.php" method="POST" >
                                            <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                                <thead>
                                                        <tr>
                                                            <th>Seleccionar</th>
                                                            <th>ID</th>
                                                            <th>Titulo</th>
                                                            <th>Origen</th>
                                                            <th>Tipo</th>
                                                            <th>Precio Total</th>
                                                            <th>Recursos</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                </thead>
                                                <div id="numRegs">
                                                    <?php 
                                                     $queryNum="SELECT COUNT(solicitudes.id)as numRegs FROM solicitudes WHERE solicitudes.id_estado_actual = 13;";
                                                     $resultNum=mysqli_query($connection,$queryNum);
                                                     $rowsNum=mysqli_fetch_row($resultNum);
                                                     echo 'Registros: '.$rowsNum[0];
                                                    ?>
                                                </div>
                                                <tbody id="listRequestsCommision">

                                                </tbody>
                                                            
                                                                                            
                                            </table> 
                                            <br><input type='checkbox' id='checkAll'> Seleccionar todos<br><br>                                                                      
                                            <a type="button" class="btn btn-warning" style="margin: 0px;padding: 0px;height: 29px;width: 103px;" onclick="diaryGeneration()">Agenda</a>
                                            <a type="button" class="btn btn-success" style="margin: 0px;padding: 0px;height: 29px;width: 103px;" onclick="recordGeneration()">Acta</a>

                                            
                                            <div class="modal fade" role="dialog" tabindex="-1" id="genDiary">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Generar Agenda en PDF&nbsp;</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                                        <div class="modal-body">
                                                        <p>Sólo presiona el Botón para Generar la Agenda</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-light" type="button" data-dismiss="modal" style="background-color: rgb(222,68,58);color: rgb(237,237,237);">Cancelar</button>
                                                            <button class="btn btn-primary" type="submit" name="preComission">Generar Agenda</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" role="dialog" tabindex="-1" id="genRecord">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Generar Acta en PDF&nbsp;</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="" for="">Fecha Realización (en palabras):</label>
                                                                <input class="form-control" type="text" name="realizedOn" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Hora de Realización (en palabras):</label>
                                                                <input class="form-control" type="text" name="realizedOnTime" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Número de CIE</label>
                                                                <input class="form-control" type="text" name="cieNum" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Medio de Realización:</label>
                                                                <input class="form-control" type="text" name="realizedBy" > 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Nombres Participantes:</label>
                                                                <textarea class="form-control" name="participants" ></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Oración Inicial:</label>
                                                                <input class="form-control" type="text" name="pray" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Oración Final:</label>
                                                                <input class="form-control" type="text" name="finalPray" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="" for="">Ultima Página Acta Anterior:</label>
                                                                <input class="form-control" type="text" name="lastPage" >
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-light" type="button" data-dismiss="modal" style="background-color: rgb(222,68,58);color: rgb(237,237,237);">Cancelar</button>
                                                            <button class="btn btn-primary" type="submit" name="postComission">Generar Acta</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <button class="btn btn-success" onclick="acceptRequests()">Aprobación Final</button>
                        </div>
                </div>

                <br>
                <br>
                <div class="card shadow" >
                    
                    <div class="card-header py-3">
                        <strong>Historial Comisiones</strong>
                    </div>
              
                    <div class="card-body">
                        
                        <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                            <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <td>Id</td>
                                        <td>Fecha de Realización</td>
                                        <td>Ver</td>           
                                    </tr>
                                </thead>
                                    

                                <tbody id="chargeCommissions">

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>Id</td>
                                        <td>Fecha de Realización</td>
                                        <td>Ver</td>           
                                    </tr>

                                </tfoot>

                            </table>
                                        
                                        
                        </div>
                                   
                    </div>
                </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="modal fade" role="dialog" tabindex="-1" id="acceptRequestModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Requisitos para Aceptar Solicitudes&nbsp;</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                            <div class="form-group">
                            <p>Las solicitudes seleccionadas serán aceptadas y las de demas serán rechazadas, asegurese de su selección y a continuación ingrese los siguientes datos</p>
                            </div>
                            <div class="form-group">
                                <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
                                    <!--<label>Nombre del acta</label>
                                    <input type="text" id="attachName" class="form-control"/> <br>-->
                                    <div class="form-group">
                                        <label for="">Fecha de Realización</label>
                                        <input type="date" name="" id="realizationDate" class="form-control">
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="">Participantes</label>
                                        <select class="form-control" name="" id="">
                                            <option value="">Participante 1</option>
                                            <option value="">Participante 2</option>
                                        </select>
                                    </div>-->

                                    <div class="form-group">
                                        <label for="">Acta</label>
                                        <input class="form-control" type="file" id="recordFile"><br><br>
                                    </div>
                                </form>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-dismiss="modal" style="background-color: rgb(222,68,58);color: rgb(237,237,237);">Cancelar</button>
                            <button id="sendRequestApproved" class="btn btn-primary" type="button">Guardar Cambios</button>
                            <!--<button
                                class="btn btn-primary" type="button" style="background-color: rgb(78,223,84);">Reporte resumido</button>-->
                        </div>
                    </div>
                </div>
            </div>     
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © SSAS 2021</span></div>
            </div>
        </footer>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/alertifyjs/alertify.js"></script>
    <script src="js/commissionFunctions.js"></script>
</body>

</html>