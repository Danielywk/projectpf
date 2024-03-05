<?php

$uss = $_GET['ad'];


session_start();
$sesion = $_SESSION['usuario'];

// en el if podria ir tambien isset($_SESSION['usuario'])
if (!isset($sesion) && !isset($uss)) {
    // no hay sesion
/* echo "no hay sesion, ni usuario en el url"; */

    header("location: login.php");
} else if (isset($sesion) && (isset($uss) && $uss == $sesion)) {


    /* Si hay sesion y la sesion es del usuario que viene en el url*/

    //se importa la conexion a la BD
    include_once 'php/conexion.php';
    $objConexion = new conexion();
    $BD = $objConexion->conectar();

    $query = $BD -> prepare ("SELECT * FROM departamentos");
    $query->execute();
    $de = $query->fetchAll();
    //print_r($espe);


} else if (isset($sesion) && (isset($uss) && $uss != $sesion)) {
    /* echo "hay sesion pero la sesion: ".$sesion." es diferente de el usuario: ".$uss." del url"; */

    // header("location: login2.php");
    header("location: login.php");
} else if (isset($sesion) && !isset($uss)) {
    /* echo "hay sesion pero no hay usuario"; */
    header("location: login.php");
} else if (!isset($sesion) && isset($uss)) {
    header("location: login.php");
} else {

    header("location: login.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Administrador</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logoo2.png" rel="icon">
  <link href="img/logoo2.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/lib_2/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/lib_2/animate.css/animate.min.css" rel="stylesheet">
  <link href="vendor/lib_2/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/lib_2/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/lib_2/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/lib_2/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/lib_2/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/lib_2/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="vendor/lib_2/css/style.css" rel="stylesheet">
<!--script src="js/peticion.js"></script-->

</head>

<body>

  <!-- ======= Encabezado ======= -->
  <div id="header" class="d-flex align-items-center fixed-top" style="top: -1px;">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto text-dark"><a class=" text-dark" href="index.html">Eco-Systec México <br> Sucursal Atlacomulco </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <!--li><a class="nav-link scrollto active" href="altamedico.php?ad=< ?php echo $uss; ?>">Alta empleado</a></li-->
          
          <li><a class="nav-link scrollto" href="administrador.php?ad=<?php echo $uss; ?>">Regresar</a></li>
          
                   
        </ul>

        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <!--a href="destruirsesion.php" class="appointment-btn scrollto"><span class="d-none d-md-inline">Cerrar Sesión</span> </a -->

    </div>
</div><!-- End Header -->

 

  <main id="main">



 <!-- ======= Sección de alta empleaod ======= -->
 <section id="cita" class="appointment section-bg" style="margin-top:5%">
      <div class="container">

        <div class="section-title">
          <h2>Alta empleado</h2>
          <p>Para dar de alta de un empleado rellene los siguientes campos:</p>
        </div>

        <form action="php/registrar_empleado.php?ad=<?php echo $uss; ?>" method="post" role="form">
            <div class="row">
            <div class="col-md-4 form-group">
              <input type="text" name="ID" class="form-control" id="name" placeholder="Ingrese el ID para el nuevo empleado" data-rule="minlen:4" data-msg="Please enter at least 4 chars" readonly>
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group">
              <input type="text" name="nombre" class="form-control" id="name" placeholder="Ingrese Nombre de empleado" data-rule="minlen:4" data-msg="Please enter at least 4 chars" readonly>
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group">
              <input type="text" name="apellidos" class="form-control" id="name" placeholder="Ingrese Apellidos" data-rule="minlen:4" data-msg="Please enter at least 4 chars" readonly>
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="department" id="departamentos" class="form-select" required>
                <option value="">Departamento</option>
                <?php    
                      foreach ($de as $valores) {
                      echo '<option value="'.$valores["id"].'">'.$valores["nom_departamento"].'</option>';
                      }
                      ?>
              </select>
              <div class="validate"></div>
            </div>
            <div class="col-md-4 form-group mt-3">
              <input type="email" class="form-control" name="usuario" id="usuario" placeholder="Ingrese Usuario" data-rule="email" data-msg="Please enter a valid email" readonly>
              <div class="validate"></div>
            </div>
            <br><br>
            <div class="col-md-4 form-group mt-3">
              <input type="tel" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese contraseña" data-rule="minlen:4" data-msg="Please enter at least 4 chars" readonly>
              <div class="validate"></div>
            </div>

            </div>
          <div class="row">

            <section id="tabla_resultado">
		    <!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
		    </section>

          </div>

  
          <div class="text-center"><button class="appointment-btn scrollto" style="background-color: rgb(65, 105, 225);" type="submit">
            Alta</button></div>
        </form>


      </div>
    </section><!-- End Appointment Section -->

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Centro Medico Milagros Inesperados</span></strong>. Reservados todos los derechos
        </div>
        <div class="credits">
          
        </div>
      </div>
      </div>
      
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="vendor/lib_2/purecounter/purecounter_vanilla.js"></script>
  <script src="vendor/lib_2/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/lib_2/glightbox/js/glightbox.min.js"></script>
  <script src="vendor/lib_2/swiper/swiper-bundle.min.js"></script>
  <script src="vendor/lib_2/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="vendor/lib_2/js/main.js"></script>

 <!-- Agregamos la libreria Jquery -->
 <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>

<!-- Iniciamos el segmento de codigo javascript -->
<script type="text/javascript">
  
  $(document).ready(function(){
    var discos = $('#tabla_resultado');
   // var disco_sel = $('#disco_sel');

    //Ejecutar accion al cambiar de opcion en el select de las bandas
    $('#departamentos').change(function(){
      var banda_id = $(this).val(); //obtener el id seleccionado

      if(banda_id !== ''){ //verificar haber seleccionado una opcion valida

        /*Inicio de llamada ajax*/
        $.ajax({
          data: {banda_id:banda_id}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
          dataType: 'html', //tipo de datos que esperamos de regreso
          type: 'POST', //mandar variables como post o get
          url: 'php/consulta.php' //url que recibe las variables
        }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

          discos.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
          discos.prop('disabled', false); //habilitar el select
        });
        /*fin de llamada ajax*/

      }else{ //en caso de seleccionar una opcion no valida
        discos.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
        discos.prop('disabled', true); //deshabilitar el select
      }    
    });

  });
</script>    

</body>

</html>