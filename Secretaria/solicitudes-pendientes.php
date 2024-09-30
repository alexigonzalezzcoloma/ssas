<?php 
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '9'){
        $userName=$_SESSION["name"];
        require_once "../assets/php/connection.php";
        $connection=connection();
        $user_rut=$_SESSION["user_rut"];
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
    <title>Solicitudes Pendientes</title>
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
                    <li class="nav-item"><a class="nav-link active" href="solicitudes-pendientes.php"><i class="fas fa-comment-slash"></i><span>Pendientes</span></a></li>
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
                        <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <!--<div class="btn-group" style="height: 30px;font-size: 10px;padding: 0px;margin: 0px;">
                            <select class="btn btn-primary" name="yearFilter" id="yearFilter" type="button" style="padding: 3px;">
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>-->

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
                                    </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            </div>-->
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userName;?> - Secretari@</span></a>
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
            <div class="container-fluid" style="margin: 0px;">
                <div class="card shadow">
                    <form action="solicitudes-pendientes.php" method="post">
                    <div class="card-header py-3"><strong>Buscador&nbsp; &nbsp;&nbsp;</strong><input class="border rounded" type="text" placeholder="Ingrese busqueda" name="busqueda" value="<?php if(isset($_REQUEST["busqueda"])){echo $_REQUEST["busqueda"]; }?>">
                    <input class="btn btn-primary" type="submit" style="margin: 0px;padding: 0px;height: 29px;width: 103px;" value="Buscar">
                    <a class="btn btn-danger" href="solicitudes-pendientes.php" style="margin: 0px;padding: 0px;height: 29px;width: 103px;">Limpiar</a>
                    </div>
                    </form>
                    <div class="card-body">
                        <div class="container">
                            <!--
                            <div class="row">
                                <div class="col">
                                    <label class="" for="">Subvenciones</label><br>
                                    <select class="form-control" id="selectSubs">
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="" for="">Desde Fecha</label><br>
                                    <input class="form-control" type="date">
                                </div>
                                <div class="col">
                                    <label class="" for="">Hasta Fecha</label><br>
                                    <input class="form-control" type="date">
                                </div>
                                <div class="col"><button class="btn btn-primary my-4" type="button" style="background-color: rgb(254,0,30);width: 73px;font-size: 12px;">Quitar Filtros</button></div>
                                <div class="col"><button class="btn btn-primary my-4" type="button" style="background-color: rgb(0,50,100);width: 73px;font-size: 12px;">Generar Reporte</button></div>
                            </div>
                            -->                         
                        </div>
                        
                        <div class="table-responsive table-bordered table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                        <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titulo</th>
                                                    <th>Origen</th>
                                                    <th>Tipo</th>
                                                    <th>Precio Total</th>
                                                    <th style="font-size: 10px;">Estado</th>
                                                    <th style="font-size: 10px;">Acciones</th>
                                                </tr>
                                            </thead>
                                            
                                            
                                            <?php
                                                $sql1="SELECT solicitudes.id, solicitudes.titulo, solicitudes.tipo, solicitudes.precio_total, estados.nombre as estado_actual, 
                                                colegios.nombre as nombre_colegio FROM solicitudes INNER JOIN colegios on colegios.rbd=solicitudes.rbd_colegio 
                                                INNER JOIN estados on solicitudes.id_estado_actual=estados.id WHERE solicitudes.id_estado_actual = 1 and solicitudes.rbd_colegio=1 or solicitudes.id_estado_actual = 11 ";
                                                
                                                if (isset($_REQUEST['busqueda'])){
                                                    $search=$_REQUEST["busqueda"];
                                                    $sql1=$sql1." and solicitudes.titulo LIKE '%$search%' or solicitudes.id='$search'";
                                                }else{
                                                    $search="";
                                                }

                                                $sql1=$sql1." ORDER BY solicitudes.id DESC ";

                                                $result1 = mysqli_query($connection,$sql1);
                                                
                                                //$result_register = mysqli_fetch_array($result1);
                                                //$total_registers= $result_register['total_registers'];
                                                
                                                $num_rows_sql1=mysqli_num_rows($result1);
                                                echo "Registros: ".$num_rows_sql1;
                                                echo "<br>";
                                                $regs_per_page= 15 ;
                                                if(empty($_GET['pagina'])){
                                                    $pagina=1;
                                                }else{
                                                    $pagina=$_GET['pagina'];
                                                }
                                                $from=($pagina-1) * $regs_per_page;
                                                $total_pages = ceil($num_rows_sql1/$regs_per_page);

                                                $sql2=$sql1." LIMIT $from,$regs_per_page";
                                                
                                                $result2 = mysqli_query($connection,$sql2);

                                                $num_rows_sql2= mysqli_num_rows($result2);
                                                if($num_rows_sql2>0){
                                                    while ($row=mysqli_fetch_array($result2)){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row["id"];?></td>
                                                            <td><?php echo $row["titulo"];?></td>
                                                            <td><?php echo $row["nombre_colegio"];?></td>
                                                            <td><?php echo $row["tipo"];?></td>
                                                            <td><?php echo number_format($row["precio_total"],0,',','.')?></td>
                                                            <td><?php echo $row["estado_actual"];?></td>
                                                            <td><a class="btn btn-success btn-circle ml-1" role="button" style="font-size: 11px;width: 30px;height: 30px;margin: -8px;" href="solicitud.php?numero=<?php echo $row["id"];?>"><i class="far fa-eye text-white"></i></a></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            
                                        </table>
                                        <?php
                                        if ($num_rows_sql1!=0){
                                        ?>
                                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers my-2">
                                            <ul class="pagination">
                                                <?php
                                                    if($pagina!=1){

                        
                                                ?>
                                                <li class="page-item"><a class="page-link" href="?pagina=<?php echo 1; ?>&<?php echo $search; ?>"><span aria-hidden="true">|<</span></a></li>                            
                                                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina-1; ?>&<?php echo $search;?>" aria-label="Previous"><span aria-hidden="true"><<</span></a></li>                            
                                               <?php
                                                    }
                                                    for($i=1; $i<=$total_pages; $i++){

                                                        if($i==$pagina){
                                                            echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                                                        }else{
                                                            echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'&'.$search.'">'.$i.'</a></li>';
                                                        }    
                                                    }
                                                    if($pagina != $total_pages){
                                                ?>      
                                                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina+1;?>&<?php echo $search;?>"aria-label="Next"><span aria-hidden="true">>></span></a></li>
                                                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $total_pages;?>&<?php echo $search;?>"><span aria-hidden="true">>|</span></a></li>
                                                <?php }?>
                                            </ul>
                                        </nav>
                                        <?php
                                        }
                                        ?>
                                        </div>
                                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            
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
    <script src="../assets/alertifyjs/alertify.js"></script>
</body>

</html>