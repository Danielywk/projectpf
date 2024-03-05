<?php  

//se importa la conexion a la BD
/*include_once 'conexion.php';
$objConexion = new conexion();
$BD = $objConexion->conectar();*/

// CONEXIÓN A LA BASE DE DATOS //
require_once 'conexion.php'; //libreria de conexion a la base

$banda_id = filter_input(INPUT_POST, 'banda_id'); //obtenemos el parametro que viene de ajax
//print_r($banda_id);

if($banda_id != ''){ //verificamos nuevamente que sea una opcion valida
    $objConexion = new conexion();
    $BD = $objConexion->conectar();

  /*Obtenemos los discos de la banda seleccionada
  $sql = "select id, nombre from discos where banda_id = ".$banda_id;  
  $query = mysqli_query($con, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($con);*/
  $query2 = $BD -> prepare ("SELECT horario.H_entrada,horario.H_salida,dia.dia from horario inner join dia on
  horario.dia_id = dia.dia_id 
  where horario.ID_departamento=:n_doc");
    $query2->execute(array(":n_doc" => $banda_id));
	$exitencia = $query2->rowCount();
    //$nom = $query2->fetchAll();
	$registro = $query2->fetchAll(PDO::FETCH_OBJ);
	//print_r($registro);

	
}

    $tabla="";
//$consulta="SELECT * FROM hospedaje ORDER BY id_h";

// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA //




//$buscarEmpleado=$conexion->query($consulta);
if ($exitencia > 0){
	$tabla.= 
	'<table class="table table-hover">
		<tr>
		
		<td class="table-secondary">Dia</td>
		<td class="table-success">Hora Entrada</td>
		<td class="table-danger">Hora Salida</td>
		</tr>';
		echo $tabla;
		
	foreach( $registro as $dato)

	{
	?>
		
		<tr>
			<td style="background-color: rgba(137, 43, 226, 0.411);"><?php echo $dato->dia?></td>
			<td class="table-secondary"><?php echo $dato->H_entrada?></td>
			<td class="table-success"><?php echo $dato->H_salida ?></td>
		 </tr>
    <?php		
	}

	//$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


//


?>