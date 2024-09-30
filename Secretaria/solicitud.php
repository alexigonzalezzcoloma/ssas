<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
        if (isset($_REQUEST["numero"])){
            $numero=$_REQUEST["numero"];
            require_once "../assets/php/connection.php";
            $connection=connection();
            $schoolRbd=$_SESSION["rbd_colegio"];
            $sqlCurrentStateandRbd="SELECT solicitudes.id_estado_actual, solicitudes.rbd_colegio, colegios.nombre FROM `solicitudes` INNER JOIN colegios on solicitudes.rbd_colegio=colegios.rbd WHERE solicitudes.id='$numero';";
            $resultCurrentStateandRbd=mysqli_query($connection,$sqlCurrentStateandRbd);
            $stateAndRbd=mysqli_fetch_row($resultCurrentStateandRbd);
            $currentState=$stateAndRbd[0];
            $requestRbd=$stateAndRbd[1];
            $collegeName=$stateAndRbd[2];
            if ($currentState >= 4 || $currentState <4 && $requestRbd==$schoolRbd){
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
                        <input hidden type="text" id="requestRbd" value="<?php echo $requestRbd; ?>">
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
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userName;?> - Secretaria</span></a>
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
                            <p class="text-primary m-0 font-weight-bold">Encabezado</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group" id="listRequest">
                                            
                                        </div>
                                        <hr><button class="btn btn-success" type="button" id="btnSaveHeader" onclick="sendHeaderReq(<?php echo $numero; ?>)">Guardar Encabezado</button></div>
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
                            <button class="btn btn-primary" type="button" style="margin: 6px;" data-toggle="modal" data-target="#addPMEActionModal" onclick="selectPMEAction(<?php echo $schoolRbd; ?>)">Seleccionar Accion PME</button>
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Subvención</th>
                                            <th>Dimensión de Gestión</th>
                                            <th>Subdimensión de Gestión</th>
                                            <th>Acción PME</th>
                                            <th>Acciones</th>
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
                                            <th>Acciones</th>

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
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addAttachModal">Agregar</button>
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
                        
                        <button class="btn btn-success" type="button" onclick="sendRequestEditor('<?php echo $numero; ?>')">Enviar Solicitud</button>
                        <button class="btn btn-primary" onclick="openCommentaryModal()">Comentario Final</button>

                        <!--<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#sendReqModal2">Enviar como Comisión</button>
                        
                        <a class="btn btn-primary" href="acta.php?numero=//<?php echo $numero;?>"><span>Reporte PDF</span></a>-->
                    </div>

                </div>
            </div>
        </div>
        
        <footer class="bg-white sticky-footer">

            <div class="modal fade" id="specialReqModal" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Enviar cómo solicitud especial</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                        <p>Opción para enviar solicitudes de permisos sin goce de sueldo, Bonos, Bono Sala Cuna, si no es un tipo de estas solicitudes subala de la manera normal;</p>
                        <div class="form-group">
                            <label>Ingrese el Precio acá</label>
                            <input type="text" class="form-control" id="totalPrice"/>
                            <label for="">Ingrese la Subvencion a la que desea cargar el monto</label>
                            <select name="" id="subSpecialReq" class="form-control">
                                
                            </select>
                        </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-warning" type="button"  onclick="sendSpecialRequest('<?php echo $numero; ?>')">Enviar Solicitud</button></div>
                    </div>
                </div>
            </div>            
            <!-- Modal Comments-->
            <div class="modal fade" id="finalCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Realizar Comentario Final</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <p>Aquí se agregar un comentario adjunto al ultimo estado de la solicitud.</p>
                                <textarea class="form-control" name="finalComment" id="finalComment" rows="6" placeholder="Ingrese Comentario"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="sendFinalComment(<?php echo $numero;?>)">Enviar</button>
                    </div>
                    </div>
                </div>
            </div>
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
                                <label for="Recommend">¿Está Correcta la Solicitud?</label>
                                <select class="form-control" id="Recommend">
                                <option value="">Seleccione una opción</option>
                                <option value="Sí">Sí, está Correcta</option>
                                <option value="No">No, está Incorrecta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tiComment">Comentario</label>
                                <textarea class="form-control" name="Comment" id="Comment" placeholder="Ingrese Comentario (Opcional)"></textarea>
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


            <div class="modal fade" id="addReqModal" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Bienes</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body"><div class="form-group">
                            <label>Requerimiento</label>
                            <input type="text" class="form-control" id="goodName"/>
                        </div><div class="form-group">
                            <label>Cantidad</label>
                            <input type="text" class="form-control" id="goodQuantity"/>
                        </div><div class="form-group">
                            <label>Precio Unitario</label>
                            <input type="text" class="form-control" id="goodPrice"/>
                        </div><div class="form-group">
                            <label>Subvencion</label>
                            <select class="form-control" id="goodSubs">
                            </select>
                        </div></div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" type="button"  onclick="addRequirement('<?php echo $numero; ?>','Bienes')">Agregar Bien</button></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addserviceModal" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar servicios</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body"><div class="form-group">
                            <label>Requerimiento</label>
                            <input type="text" class="form-control" id="serviceName"/>
                        </div><div class="form-group">
                            <label>Cantidad</label>
                            <input type="text" class="form-control" id="serviceQuantity"/>
                        </div><div class="form-group">
                            <label>Precio Unitario</label>
                            <input type="text" class="form-control" id="servicePrice"/>
                        </div><div class="form-group">
                            <label>Subvencion</label>
                            <select class="form-control" id="serviceSubs">
                                
                            </select>
                        </div></div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" type="button"  onclick="addRequirement('<?php echo $numero; ?>','Servicios')">Agregar Servicio</button></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" role="dialog" tabindex="-1" id="addContractModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Contratos</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                        <div class="form-group">
                            <label>Asignatura</label>
                            <input type="text" class="form-control" id="contractCourse"/>
                        </div>
                        <div class="form-group">
                            <label>Horas Semanales</label>
                            <input type="text" class="form-control" id="contractHours"/>
                        </div>
                        <div class="form-group">
                            <label for="">Fecha de Inicio de Contrato</label>
                            <input type="date" class="form-control" name="" id="contractStart">
                        </div>
                        <div class="form-group">
                            <label for="">Fecha de Fin del Contrato</label>
                            <input type="date" class="form-control" name="" id="contractEnd">
                        </div>
                        <div class="form-group">
                            <label>Tipo de Profesional</label>
                            <select name="" id="hiredProfessional" class="form-control">
                            </select> 
                        </div>
                        <div class="form-group">
                            <label>Nombre Profesional</label>
                            <input type="text" class="form-control" id="profesionalName"/>
                        </div>
                        <div class="form-group">
                            <label>Subvención</label>
                            <select class="form-control" id="contractSubs">
                            </select>

                        </div>
                    </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="button" onclick="addRequirement('<?php echo $numero; ?>','Contratos')">Agregar Contrato</button></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editContractModal" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edicion Carga Horaria</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body">
                            <div class="form-group">
                                <label>ID Carga Horaria</label>
                                <input type="text" class="form-control" readonly id="contractId"/>
                            </div>
                            <div class="form-group">
                                <label>Asignatura</label>
                                <input type="text" class="form-control" id="contractCourseEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Horas Semanales</label>
                                <input type="text" class="form-control" id="contractHoursEdit"/>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Inicio de Contrato</label>
                                <input type="date" class="form-control" name="" id="contractStartEdit">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Fin del Contrato</label>
                                <input type="date" class="form-control" name="" id="contractEndEdit">
                            </div>
                            <div class="form-group">
                                <label>Tipo de Profesional</label>
                                <select name="" id="hiredProfessionalEdit" class="form-control">
                                </select> 
                            </div>
                            <div class="form-group">
                                <label>Nombre Profesional</label>
                                <input type="text" class="form-control" id="profesionalNameEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Subvención</label>
                                <select class="form-control" id="contractSubsEdit">
                                        
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success" type="button"  onclick="updateContract('<?php echo $numero; ?>','Contratos')">Guardar Cambios</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editGoodModal" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Requerimiento</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ID Requerimiento</label>
                                <input type="text" class="form-control" readonly id="goodId"/>
                            </div>
                            <div class="form-group">
                                <label>Requerimiento</label>
                                <input type="text" class="form-control" id="goodNameEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="text" class="form-control" id="goodQuantityEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Precio Unitario</label>
                                <input type="text" class="form-control" id="goodPriceEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Subvencion</label>
                                <select class="form-control" id="goodSubsEdit">
                                   
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" type="button"  onclick="updateGood('<?php echo $numero; ?>','Bienes')">Actualizar Datos</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editServModal" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Requerimiento</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ID Requerimiento</label>
                                <input type="text" class="form-control" readonly id="servId"/>
                            </div>
                            <div class="form-group">
                                <label>Requerimiento</label>
                                <input type="text" class="form-control" id="servNameEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="text" class="form-control" id="servQuantityEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Precio Unitario</label>
                                <input type="text" class="form-control" id="servPriceEdit"/>
                            </div>
                            <div class="form-group">
                                <label>Subvencion</label>
                                <select class="form-control" id="servSubsEdit">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" type="button"  onclick="updateService('<?php echo $numero; ?>','Servicios')">Actualizar Datos</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" tabindex="-1" id="addAttachModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Adjunto</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            
                            <div class="modal-body">
                                <div class="form-group">
                                <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
                                    <label>Nombre</label>
                                    <input type="text" id="attachName" class="form-control"/> <br>
                                    <input type="file" id="attachFile"><br><br>
                                </form>
                                </div>
                                
                            </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button><button class="btn btn-primary" onclick="addAttachment(<?php echo $numero; ?>)" type="button">Agregar</button></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" role="dialog" tabindex="-1" id="addPMEActionModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Seleccionar Accion del PME</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Seleccione Subvencion</label><br>
                                    <select name="" id="selectSubvention" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Dimensión</label><br>
                                    <select name="" id="selectDimension" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Subdimensión</label><br>
                                    <select name="" id="selectSubdimension" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Accion</label><br>
                                    <select name="" id="selectAction" class="form-control"></select>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" onclick="addPME(<?php echo $numero; ?>)" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" role="dialog" tabindex="-1" id="editPMEActionModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar PME de la solicitud</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Id</label><br>
                                    <input name="" id="PMEId" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Subvencion</label><br>
                                    <select name="" id="subventionEdit" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Dimensión</label><br>
                                    <select name="" id="dimensionEdit" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Subdimensión</label><br>
                                    <select name="" id="subdimensionEdit" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Accion</label><br>
                                    <select name="" id="actionEdit" class="form-control"></select>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" onclick="updatePME(<?php echo $numero; ?>)" type="button">Actualizar</button>
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