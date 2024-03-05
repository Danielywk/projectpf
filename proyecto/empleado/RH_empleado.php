<?php

$uss = $_GET['emp'];
$idE = $_GET['id_e'];

session_start();
$sesion = $_SESSION['usuario'];

// en el if podria ir tambien isset($_SESSION['usuario'])
if (!isset($sesion) && !isset($uss)) {
    // no hay sesion
/* echo "no hay sesion, ni usuario en el url"; */

    header("location: ../login2.php");
} else if (isset($sesion) && (isset($uss) && $uss == $sesion)) {


    /* Si hay sesion y la sesion es del usuario que viene en el url*/

    //se importa la conexion a la BD
    include_once '../php/conexion.php';
    $objConexion = new conexion();
    $BD = $objConexion->conectar();

    $productosPorPagina = 10;

    $pagina = 1;
    if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
    }

    
    

    $limit = $productosPorPagina;
    $offset = ($pagina - 1) * $productosPorPagina;

    $sentencia = $BD->query('SELECT count(*) as "conteo" from empleados inner join departamentos on
    departamentos.id=empleados.Departamento inner join horario on horario.ID_departamento=departamentos.id
    inner join dia on dia.dia_id=horario.dia_id;');

    $conteo = $sentencia->fetchObject()->conteo;
    //print_r($conteo);

    $paginas = ceil($conteo / $productosPorPagina);

    $sentencia = $BD->prepare('SELECT empleados.ID_empleado, empleados.nombre, empleados.apellido, asistencia.fecha,
    departamentos.nom_departamento, time_FORMAT((asistencia.H_salida-asistencia.H_entrada),"%H:%i:%S") as "hora_dia",
    asistencia.H_entrada,asistencia.H_salida from asistencia inner join empleados on
    asistencia.ID_empleado=empleados.ID_empleado
    inner join departamentos on
    departamentos.id=empleados.Departamento where asistencia.ID_empleado = :id ');
    $sentencia->bindParam(':id', $idE);
    //$sentencia->bindParam(':offset', $offset, PDO::PARAM_INT);
    //$sentencia->bindParam(':limit', $limit, PDO::PARAM_INT);
    $sentencia->execute();

    $res = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($res->fecha);

    

} else if (isset($sesion) && (isset($uss) && $uss != $sesion)) {
    /* echo "hay sesion pero la sesion: ".$sesion." es diferente de el usuario: ".$uss." del url"; */

    // header("location: login2.php");
    header("location: ../login2.php");
} else if (isset($sesion) && !isset($uss)) {
    /* echo "hay sesion pero no hay usuario"; */
    header("location: ../login2.php");
} else if (!isset($sesion) && isset($uss)) {
    /* echo "hay usuario pero no hay sesion"; */
    header("location: ../login2.php");
} else {

    header("location: ../login2.php");
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

    <title>Control de Empleados</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script "text/javascript" src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    
</head>

<body id="page-top" class="text-dark" class="p-2 text-warning">

    <!-- Page Wrapper -->
    <div id="wrapper">

       


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="background-color: white;">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow">


                <h1 class="p-2  text-dark"></h1>
                              

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="administrador.html">Empleado</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="contenido.html">Resumen de Registros de Horas</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-dark" href="HS_empleado.php?emp=<?php echo $uss ?>&id_e=<?php echo $idE ?>">Horas semana</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-dark" href="HM_empleado.php?emp=<?php echo $uss ?>&id_e=<?php echo $idE ?>">Horas mes</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="#"></a>
                        </li>
                    </ul>


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
                           

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Elemento de navegación - Información del usuario botones de perfil,ajustes y registro de act. -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $uss; ?></span>
                                    <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                    
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
                                    <h5 class="text-dark" class="modal-title" id="exampleModalLabel">Desea cerrar la sesion actual?</h5>
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



    <table class="table table-responsive table-striped" style="color: white; background-color: rgb(72,61,139);">
        <thead>
         <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Departamento</th>
            <th>Fecha</th>
            <th>Horas trabajadas</th>
            
            
         </tr>
        </thead>
        <?php
          //$res as $dato;
          foreach ($res as $dato){
            
        ?>
        <tbody style="background-color: rgb(255,255,255); color:black;">

            
            <tr>
                <td> <?php echo $dato->ID_empleado; ?></td>
                <td> <?php echo $dato->nombre; ?> </td>
                <td> <?php echo $dato->apellido; ?></td>
                <td> <?php echo $dato->nom_departamento; ?> </td>
                <td> <?php echo $dato->fecha; ?> </td>
                <td> <?php echo $dato->hora_dia; ?> </td>
                
            

            </tr>
            
        </tbody>

        <?php 
}

 ?>
   
    </table>

 

    </div>
  </div>
</div>

<!-- ======= Footer ======= -->
   <footer id="footer" style="margin-top:20%; margin-left:-25%;">

    

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
                    <script src="../vendor/jquery/jquery.min.js"></script>
                    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

                    <!-- Custom scripts for all pages-->
                    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>