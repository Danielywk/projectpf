<?php
// comprobar si se recibe un post
if ($_POST) {
  //ocupar la conexion
  include_once 'php/conexion.php';
  $objConexion = new conexion();
  $BD = $objConexion->conectar();

  //recibir valores del formulario
  $usuario = $_POST['uss'];
  $contra = $_POST['pass'];
  

  //sentencia preparada
  $sentencia = $BD->prepare('SELECT * FROM usuarios WHERE usuario=:uss');

  $sentencia->execute(array(":uss" => $usuario));

  $sql = $BD->prepare("SELECT usuario 
   FROM usuarios WHERE usuario=:uss");
  $sql->execute(array(":uss" => $usuario));
  $usuarioExistencia = $sql->rowCount();
  

  if ($usuarioExistencia > 0) {

  } else {
    echo '<script type="text/javascript" > alert("El usuario ' . $usuario . ' no existe, ingrese uno valido");
   window.location.href="login2.php";
    </script >';
  
  }

  $registro = $sentencia->fetch(PDO::FETCH_OBJ);
  //imprimir 
  //print_r($registro);
  //guardar el valor de la columna tipo_usuario que devolvio la consulta
  $rol = $registro->tipo;

  /*comparar el valor del texto que el usuario escribio como contraseña con la contraseña en la BD */
if (password_verify($contra, $registro->contraseña)) {

  //si el tipo de usuario es administrador
  if ($rol == "administrador" && $usuarioExistencia > 0) {
    /* ------------------------- SESIONES EN PHP ---------------------------- */
    // -----------------------------------------------------------------------
    $user = $registro->usuario;
    session_start();
    $_SESSION['usuario'] = $user;

    // -----------------------------------------------------------------------
    echo "<script> window.location.href='administrador.php?ad=$registro->usuario&pagina=1' </script>";

    //si el tipo de usuario es empleado
  } else if ($rol == "empleado" && $usuarioExistencia > 0) {

    /* ------------------------- SESIONES EN PHP ---------------------------- */
    // -----------------------------------------------------------------------
    $user = $registro->usuario;
    session_start();
    $_SESSION['usuario'] = $user;

    // -----------------------------------------------------------------------
    echo "<script> window.location.href='empleadoos.php?emp=$registro->usuario&id_e=$registro->id_empleado' </script>";
  }
} else {

?>
  <br>
  <!--  Mostrar Mensaje de error -->

  <script type="text/javascript">
    alert("Contraseña Invalida");
    window.location.href = "login2.php";
  </script>

<?php
  //cerrar las estructuras if
}

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
    <link rel="stylesheet" href="css/estilo.css">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body >

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                        <h1 style="margin-left: 20%; color: rgb(96, 125, 139);">Inicio de sesion</h1>
                            
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="img/logoo2.png" width="250" height="" style="margin-left:18%; margin-top:-20%;">
                                        <br><br>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="uss"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="pass"
                                                id="exampleInputPassword" placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            
                                        </div>
                                        <button type="submit" class="btn btn-user btn-block" 
                                          style="background-color: rgb(0,204,204); color: white;">
                                            <font size="3">Iniciar sesión</font>
                                        </button>
                                        <hr>
                                        
                                    </form>

                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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