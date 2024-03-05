<?php
require('../vendor/pdf/fpdf.php');
include_once '../php/conexion.php';
//header('Content-Type: text/html; charset=ISO-8859-1');
$folio = $_GET['id'];
    $objConexion = new conexion();
    $BD = $objConexion->conectar(); 

    $sql2 = $BD->prepare('SELECT empleados.ID_empleado, empleados.nombre, empleados.apellido, asistencia.fecha,
    departamentos.nom_departamento, time_FORMAT((asistencia.H_salida-asistencia.H_entrada),"%H:%i:%S") as "hora_dia",
    asistencia.H_entrada,asistencia.H_salida from asistencia inner join empleados on
    asistencia.ID_empleado=empleados.ID_empleado
    inner join departamentos on
    departamentos.id=empleados.Departamento
    where empleados.ID_empleado=?');
   //pasar los parametros a la sentencia preparada
   $sql2->execute(array("$folio"));

   $resultado = $sql2->fetch(PDO::FETCH_OBJ);
  // print_r($paciente);

$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image('../img/logoo2.png',140,0,80);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(40,20, utf8_decode('Eco-Systec México - Sucursal Atlacomulco'));
$pdf->Text(20,35, 'Datos de empleado');
$pdf->setFont('Arial','' , 16);
$pdf->Text(20,45, 'ID de empleado:');
$pdf->Text(80,45,$resultado->ID_empleado);
$pdf->Text(20,55, 'Nombre empleado:');
$pdf->Text(80,55, utf8_decode($resultado->nombre.' '.$resultado->apellido));
$pdf->Text(20,65, 'Departamento:');
$pdf->Text(80 ,65,utf8_decode($resultado->nom_departamento));
$pdf->Text(20,75, 'Fecha de consulta:');
$pdf->Text(75,75,utf8_decode($resultado->fecha));
$pdf->Text(20,85, 'Horas trabajadas al dia:');
$pdf->Text(90,85,utf8_decode($resultado->hora_dia));
//$pdf->Text(80,100, 'Doctor');
//$pdf->Text(20,110, 'Nombre del doctor:');
//$pdf->Text(75,110,utf8_decode($paciente->Doctor.' '.$paciente->apellidos));
$pdf->Output();
?>