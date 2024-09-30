<?php
//include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');
require_once "../../assets/php/connection.php";
$connection=connection();

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,$str = utf8_decode("CONSEJO DE EDUCACIÓN \n FUNDACIÓN EDUCACIONAL JULIÁN OCAMPO"),0,'C');
$pdf->Ln(8);
$pdf->Cell(0,6,$str = utf8_decode("DESCRIPCION Y RESPALDO DEL DETALLE DE HORAS DE CONTRATO "),1,0,'C');
$pdf->Ln(6);
//set width for each column (6 columns)
$pdf->SetWidths(Array(65,65,30,30));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
//$json = file_get_contents('MOCK_DATA.json');
//$data = json_decode($json,true);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',12);
$pdf->Cell(65,5,"NOMBRE PROFESIONAL",1,0);
$pdf->Cell(65,5,"ASIGNATURA",1,0);
$pdf->Cell(30,5,"HORAS",1,0);
$pdf->Cell(30,5,"SUBVENCION",1,0);

$pdf->Ln();

$sql_requirements="SELECT requerimientos.nombre,requerimientos.precio, requerimientos.cantidad, (requerimientos.cantidad*requerimientos.precio) 
as total_unitario, subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion= subvenciones.id 
WHERE requerimientos.id_solicitud='68';";

$result_requirements=mysqli_query($connection,$sql_requirements);



$pdf->SetFont('Arial','',12);
while($row=mysqli_fetch_row($result_requirements)){ 
	$pdf->Row(Array(
		utf8_decode($row[0]),
		$row[1],
		$row[2],
		$row[3],
	));
}


//output the pdf
$pdf->Output();






