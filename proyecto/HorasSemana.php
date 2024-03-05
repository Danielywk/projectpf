<?php

$uss = $_GET['ad'];


session_start();
$sesion = $_SESSION['usuario'];

// en el if podria ir tambien isset($_SESSION['usuario'])
if (!isset($sesion) && !isset($uss)) {
    // no hay sesion
/* echo "no hay sesion, ni usuario en el url"; */

    header("location: login2.php");
} else if (isset($sesion) && (isset($uss) && $uss == $sesion)) {


    /* Si hay sesion y la sesion es del usuario que viene en el url*/

    //se importa la conexion a la BD
    include_once 'php/conexion.php';
    $objConexion = new conexion();
    $BD = $objConexion->conectar();

    $productosPorPagina = 10;

    $pagina = 1;
    if (isset($_GET["pagina"])) {
     $pagina = $_GET["pagina"];

    }

    if (!isset($_GET["pagina"])) {
        header("location:HorasSemana.php?ad=$uss&pagina=1");
    }

    $limit = $productosPorPagina;
    $offset = ($pagina - 1) * $productosPorPagina;

    $sentencia = $BD->query('SELECT count(*) as "conteo" from asistencia inner join empleados on
    asistencia.ID_empleado=empleados.ID_empleado
    inner join departamentos on
    departamentos.id=empleados.Departamento');

    $conteo = $sentencia->fetchObject()->conteo;
    //print_r($conteo);

    $paginas = ceil($conteo / $productosPorPagina);

    if ($_GET['pagina']>$paginas || $_GET['pagina']<=0) {
        echo("<script> window.location.href='HorasSemana.php?ad=$uss&pagina=1' </script>");
    }

    $sentencia = $BD->prepare('SELECT empleados.ID_empleado, empleados.nombre, empleados.apellido, asistencia.fecha,
    departamentos.nom_departamento, time_FORMAT((asistencia.H_salida-asistencia.H_entrada),"%H:%i:%S") as "hora_dia",
    asistencia.H_entrada,asistencia.H_salida from asistencia inner join empleados on
    asistencia.ID_empleado=empleados.ID_empleado
    inner join departamentos on
    departamentos.id=empleados.Departamento ORDER BY asistencia.fecha desc LIMIT :offset,:limit ');
    $sentencia->bindParam(':offset', $offset, PDO::PARAM_INT);
    $sentencia->bindParam(':limit', $limit, PDO::PARAM_INT);
    //$sentencia->execute([$limit, $offset]);
    //pasar los parametros a la sentencia preparada
    $sentencia->execute();

    $res = $sentencia->fetchAll(PDO::FETCH_OBJ);

    //print_r($res);
    
    //$U = $res->id_doctor;
    //print_r($U);


} else if (isset($sesion) && (isset($uss) && $uss != $sesion)) {
    /* echo "hay sesion pero la sesion: ".$sesion." es diferente de el usuario: ".$uss." del url"; */

    // header("location: login2.php");
    header("location: login2.php");
} else if (isset($sesion) && !isset($uss)) {
    /* echo "hay sesion pero no hay usuario"; */
    header("location: login2.php");
} else if (!isset($sesion) && isset($uss)) {
    /* echo "hay usuario pero no hay sesion"; */
    header("location: login2.php");
} else {

    header("location: login2.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Horas Empleados</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script "text/javascript" src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    




</head>

<body id="page-top" class="text-dark" class="p-2 bg-dark text-warning">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" style="background-color: rgb(0,0,139)" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?alumno=<?php echo $U; ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> <sup>Administrador</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Control</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Apartados
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a href="administrador.php?ad=<?php echo $uss; ?>" class="nav-link collapsed">
                    <i class="fas fa-fw fa-briefcase" style="color: white;"></i>
                    <span>Empleados</span>
                </a>

                <a href="HorasEmpleados.php?ad=<?php echo $uss; ?>" class="nav-link collapsed">
                    
                    <i class="fas fa-fw fa-clock" style="color: white;"></i>
                    <span>Registro de Horas</span>
                </a>

                <a href="faltas.php?ad=<?php echo $uss; ?>" class="nav-link collapsed">
                
                    <i class="fas fa-fw fa-calendar-check" style="color: white;"></i>
                    <span>Faltas</span>
                </a>
                
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/logo2.png" alt="...">

            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content  cambiar el color de fondo-->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                <h1 class="p-2  text-dark">Registro de Horas-Semana</h1>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>




                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->
                        <!-- BARRA DE NAVEGACION --->


                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-dark" aria-current="page" href="HorasDia.php?ad=<?php echo $uss; ?>">Hrs. Diarias</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active text-dark" aria-current="page" href="HorasSemana.php?ad=<?php echo $uss; ?>">Hrs.Semanales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active text-dark" href="HorasMes.php?ad=<?php echo $uss; ?>">Hrs. Mensuales</a>
                                    </li>

                                </ul>

                            </div>

                        </div>









                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>
                            

                            <!-- Elemento de navegación - Información del usuario botones de perfil,ajustes y registro de act. -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="php/destruirsesion.php" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </li>

                        </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Encabezado de página -->

                    <div class="row">

                        <!-- End of Content Wrapper -->

                    </div>
                    <!-- End of Page Wrapper -->

                    <!-- Scroll to Top Button-->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>

                    <!-- Diseño para cerrar sesion-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Desea cerrar la sesion actual?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Seleccione "Cerrar sesión" si está de acuerdo en finalizar su sesión actual.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                    <a class="btn btn-primary" href="php/destruirsesion.php">Cerrar sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-auto mt-4">

        <div class="col-xs-12 col-sm-12">
         <h1 style="margin-left:10%; color:black;"> Horas Empleados</h1>

                    <p style="font-style: italic; color:black;">
                        Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> registros de empleados</p>
        </div>

    <table class="table table-responsive table-striped" style="color: white;">
        <thead style="background-color: rgb(0,0,205);">
         <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha</th>
            <th>Departamento</th>
            <th>Horas trabajadas</th>
            <th>Horas semana</th>
            
            
         </tr>
        </thead>
        <?php
         foreach ($res as $dato){
                
            
        ?>
        <tbody style="background-color: rgb(255,255,255); color:black;">

            
            <tr>
                <td> <?php echo $dato->ID_empleado; ?></td>
                <td> <?php echo $dato->nombre; ?> </td>
                <td> <?php echo $dato->apellido; ?></td>
                <td> <?php echo $dato->fecha; ?> </td>
                <td> <?php echo $dato->nom_departamento; ?> </td>
                <td> <?php echo $dato->hora_dia; ?> hrs. </td>
                <td>
                  <span class="btn btn-success">
                  <a href="php/reporte_S.php?id=<?php echo $dato->ID_empleado; ?>&dat=<?php echo $dato->fecha; ?>"
                  style="color: white;"> Reporte <li class="fa fa-file-pdf"></li></a>
                  </span>
                </td>
                

            </tr>
            
        </tbody>

<?php 
}

 ?>
   
    </table>

 
    <nav>

            <div class="row">
                
                <div class="col-xs-12 col-sm-6" style="margin-left: 38%;">
                    <p style="color:black;">
                       <b>Página <?php echo $pagina ?> de <?php echo $paginas ?> </b></p>
                </div>
            </div>
            <ul class="pagination">
                <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
                <?php if ($pagina > 1) { ?>
                    <li>
                        <a class="page-link" href="./HorasSemana.php?pagina=<?php echo $pagina - 1 ?>&ad=<?php echo $uss; ?>">
                            <span aria-hidden="true">Anterior</span>
                        </a>
                    </li>
                <?php } ?>

                <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                    <li class="<?php if ($x == $pagina) echo 'active'; ?>">
                        <a style="color:black;" class="page-link" href="./HorasSemana.php?pagina=<?php echo $x ?>&ad=<?php echo $uss; ?>">
                            <?php echo $x ?></a>
                    </li>
                <?php } ?>
                <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                <?php if ($pagina < $paginas) { ?>
                    <li class="page-item">
                        <a class="page-link" href="./HorasSemana.php?pagina=<?php echo $pagina + 1 ?>&ad=<?php echo $uss; ?>">
                            <span aria-hidden="true">Siguiente</span>
                        </a>
                    </li>
                <?php } ?>

                    

            </ul>
        </nav>

        </div>
  </div>
</div>

   <!-- ======= Footer ======= -->
   <footer id="footer">

    

<div class="container d-md-flex py-4">

  <div class="me-md-auto text-center text-md-start">
  <div class="me-md-auto text-center text-md-start">
    <div class="copyright" style="color:black">
      &copy; Copyright <strong><span>Eco-Systec México - Sucursal Atlacomulco</span></strong>. Reservados todos los derechos
    </div>
    <div class="credits">
      
    </div>
  </div>
  </div>
  
</div>

</footer><!-- End Footer -->
                    <!-- Bootstrap core JavaScript-->
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <!-- Custom scripts for all pages-->
                    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>