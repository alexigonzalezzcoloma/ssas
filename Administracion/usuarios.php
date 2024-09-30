<?php
//session_start();
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Administración de Usuarios</title>
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
                    <li class="nav-item"><a class="nav-link" href="inicio.php"><i class="fas fa-tachometer-alt"></i><span>inicio</span></a><a class="nav-link" href="inicio.php"><i class="fas fa-comment-slash"></i><span>En Curso</span></a></li>
                    <li class="nav-item"><a class="nav-link"><i class="fas fa-user"></i><span>Perfil</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="../inicio_sesion.php"><i class="far fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">Usuario: <?php if(isset($_SESSION["name"])){echo($_SESSION["name"]);}?></span></a>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Gestion Usuarios</p>
                        </div>
                        <div class="card-body">
                            <!-- Button trigger modal -->
                            <button type="button" id="adduser"s class="btn btn-primary" data-toggle="modal" data-target="#createUserModal" onclick="chargeSelects()">
                            Agregar Usuario
                            </button><br><br>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Rut</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Cargo</th>
                                            <th>Fundación</th>
                                            <th>Colegio</th>
                                            <th>habilitado?</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id=listUsers>
                                    </tbody >

                                    <tfoot>
                                        <tr>
                                            <th>Rut</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Cargo</th>
                                            <th>Fundación</th>
                                            <th>Colegio</th>
                                            <th>habilitado?</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        <!-- Modal Crear Usuario-->
                        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
                                <center><div class="modal-body">
                                        <label class="label">Nombre</label><br>
                                        <input type="text" class="form-control" id="userName"><br>
                                        <label >Rut</label><br>
                                        <input class="form-control"type="text" id="userRut"><br>
                                        <label >Correo</label><br>
                                        <input class="form-control" type="text" id="userMail"><br>
                                        <label for="">Fundación Educacional</label><br>
                                        <select class="form-control" name="" id="userFoundation"></select><br>
                                        <label for="">Colegio</label><br>
                                        <select class="form-control" name="" id="userSchool">

                                        </select><br>
                                        <label >Tipo de Usuario</label><br>
                                        <select class="form-control" id="userRol">
                                            
                                        </select><br>
                                        <label >Clave</label><br>
                                        <input class="form-control" type="password" id="userPass"><br>
                                        <label">Confirme Clave</label><br>
                                        <input class="form-control" type="password" id="userPassCp">
                                </div></center>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="createUser" class="btn btn-primary">Crear Usuario</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>

                            <!-- Modal EDICION-->
                            <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            
                                <div class="modal-body">
                                        <input type="text" id="userRutEdit" hidden>
                                        <label class="label">Nombre</label><br>
                                        <input type="text" class="form-control" id="userNameEdit"><br>
                                        <label >Correo</label><br>
                                        <input class="form-control" type="text" id="userMailEdit"><br>
                                        <label for="">Fundación Educacional</label><br>
                                        <select class="form-control" name="" id="userFoundationEdit"></select><br>
                                        <label for="">Colegio</label><br>
                                        <select class="form-control" name="" id="userSchoolEdit">
                                        </select><br>
                                        <label >Tipo de Usuario</label><br>
                                        <select class="form-control" id="userRolEdit">
                                        </select><br>
                                        <label for="">Usuario Habilitado?</label><br>
                                        <select class="form-control" name="" id="userIsEnabled">
                                            <option value="">Seleccione una opcion válida</option>
                                            <option value="0">Deshabilitar</option>
                                            <option value="1">Habilitar</option>
                                        </select>
                                        <label>Clave</label><br>
                                        <input class="form-control" type="password" id="userPassEdit"><br>
                                        <label">Confirme Clave</label><br>
                                        <input class="form-control" type="password" id="userPassCpEdit">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="updateUsr" class="btn btn-primary">Actualizar</button>
                                </div>
                                </div>
                            </div>
                            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Inventarios FEJO 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/alertifyjs/alertify.js"></script>

    <script src="js/userFunctions.js"></script>
</body>

</html>