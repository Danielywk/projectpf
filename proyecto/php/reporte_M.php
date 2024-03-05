<?php
require('../vendor/pdf/fpdf.php');
include_once '../php/conexion.php';
//header('Content-Type: text/html; charset=ISO-8859-1');
$folio = $_GET['id'];
$fec = $_GET['dat'];
    $objConexion = new conexion();
    $BD = $objConexion->conectar(); 

    

    $sql =$BD->prepare('SELECT asistencia.ID_empleado,fecha,DATE_FORMAT(asistencia.fecha, "%m") AS mes from asistencia where 
    asistencia.ID_empleado=:em and asistencia.fecha=:fe');
    $sql->bindParam(':em', $folio);
    $sql->bindParam(':fe', $fec);
    $sql->execute();

    $res = $sql->fetch(PDO::FETCH_OBJ);
   // print_r($res);
    $me = $res->mes;

    

    $sql2 = $BD->prepare('SELECT empleados.ID_empleado, empleados.nombre, empleados.apellido, asistencia.fecha,DATE_FORMAT(asistencia.fecha, "%M") as "mess",
    departamentos.nom_departamento, time_FORMAT((asistencia.H_salida-asistencia.H_entrada),"%H:%i:%S") as "hora",
    time_FORMAT(sum(asistencia.H_salida-asistencia.H_entrada),"%H:%i:%S") as "hora_mes",
    asistencia.H_entrada,asistencia.H_salida from asistencia inner join empleados on
    asistencia.ID_empleado=empleados.ID_empleado
    inner join departamentos on
    departamentos.id=empleados.Departamento where
    empleados.ID_empleado=:id_e and DATE_FORMAT(asistencia.fecha, "%m") = :m ');
   //pasar los parametros a la sentencia preparada
    $sql2->bindParam(':id_e', $folio);
    $sql2->bindParam(':m', $me);
    $sql2->execute();

   $resultado = $sql2->fetch(PDO::FETCH_OBJ);
  // print_r($paciente);
  setlocale(LC_TIME,"es_MX");

$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image('../img/logoo2.png',140,0,80);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(40,20, utf8_decode('Eco-Systec México - Sucursal Atlacomulco'));
$pdf->Text(20,35, 'Datos de empleado');
$pdf->setFont('Arial','' , 16);
$pdf->Text(20,50, 'ID de empleado:');
$pdf->Text(80,50,$resultado->ID_empleado);
$pdf->Text(20,60, 'Nombre empleado:');
$pdf->Text(80,60, utf8_decode($resultado->nombre.' '.$resultado->apellido));
$pdf->Text(20,70, 'Departamento:');
$pdf->Text(80 ,70,utf8_decode($resultado->nom_departamento));
$pdf->Text(20,80, 'Fecha de consulta:');
$pdf->Text(80,80,utf8_decode($resultado->fecha));
$pdf->Text(20,90, 'Mes:');
$pdf->Text(80,90,utf8_decode($resultado->mess));
$pdf->Text(20,100, 'Horas mes:');
$pdf->Text(80,100,utf8_decode($resultado->hora_mes));
//$pdf->Text(80,100, 'Doctor');
//$pdf->Text(20,110, 'Nombre del doctor:');
//$pdf->Text(75,110,utf8_decode($paciente->Doctor.' '.$paciente->apellidos));
$pdf->Output();
?>