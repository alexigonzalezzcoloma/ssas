<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '2'){
        if (isset($_REQUEST["numero"])){
            $numero=$_REQUEST["numero"];
            require_once "../assets/php/connection.php";
            $connection=connection();
            require '../assets/php/fpdf/fpdf.php';

            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$numero';";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);
            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];
            if ($currentState >= 12){
                date_default_timezone_set("America/Santiago");
                $get_date = getdate();
                $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
                $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
                $date_time=$date.' '.$time;
                $year=$get_date['year'];
                $userName=$_SESSION["name"]; 

                $sql_recordData="SELECT colegios.nombre as nombre_colegio, solicitudes.titulo, solicitudes.fecha_hora, 
                solicitudes.precio_total, solicitudes.justificacion, solicitudes.rbd_colegio,solicitudes.voto_interno,
                solicitudes.fecha_voto_interno, solicitudes.tipo FROM `solicitudes` 
                INNER JOIN colegios on solicitudes.rbd_colegio=colegios.rbd WHERE solicitudes.id='$numero';";
                $result_recordData=mysqli_query($connection,$sql_recordData);
                $row_recordData=mysqli_fetch_row($result_recordData);
                $schoolName=$row_recordData[0];
                $recordTitle=$row_recordData[1];
                $totalPrice= $row_recordData[3];
                $justify=$row_recordData[4];
                $schoolRbd=$row_recordData[5];
                $internalVote=$row_recordData[6];
                $voteDate=$row_recordData[7];
                $reqType=$row_recordData[8];

                $sqlSubs="SELECT DISTINCT subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion=subvenciones.id WHERE requerimientos.id_solicitud='$numero';";
                $result1=mysqli_query($connection,$sqlSubs);
                $subs=mysqli_fetch_row($result1);
                
                $num_subs=mysqli_num_rows($result1);
                

                class PDF extends FPDF 
                {

                    function Footer()
                    {
                        $this->SetY(-15);
                        $this->SetFont('Arial','I',8);
                        $this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
                    }
                }
                $pdf= new PDF();
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFillColor(232,232,232);
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(0,10,$str = utf8_decode("FUNDACIÓN EDUCACIONAL JULIÁN OCAMPO - Solicitud N° $numero"),0,0,'C');
                $pdf->Ln(20);
                $pdf->SetFont('Arial','B',11);
                $pdf->Cell(0,10,$str = utf8_decode("$internalVote - $schoolName - $recordTitle "),0,0,'');                
                $pdf->Text(11,42,$txt="Subvenciones:");
                $sqlSubs="SELECT DISTINCT subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion=subvenciones.id WHERE requerimientos.id_solicitud='$numero';";
                $result1=mysqli_query($connection,$sqlSubs);
                $num_subs=mysqli_num_rows($result1);

                $subsGroup="";
                $count=1;
                while ($fila = mysqli_fetch_assoc($result1)) {
                    $subsGroup= $subsGroup.$fila["nombre_subvencion"];
                    if ($count<$num_subs){
                        $subsGroup=$subsGroup.", ";
                    }
                    $count++;
                }
                $pdf->Text(40,42,$txt="$subsGroup");
                $pdf->SetFont('Arial','',11);
                $pdf->Ln(20);
                $pdf->Multicell(190,8,$txt=utf8_decode("$justify"),0,'L');
                $pdf->Ln(10);

                if ($reqType=="Contratos"){
                    $pdf->Cell(90,6,utf8_decode('Nombre Escuela o Colegio'),1,0,'C','1');
                    $pdf->Cell(90,6,utf8_decode("$schoolName"),1,1,'C');
                    $pdf->Cell(90,6,utf8_decode("RBD"),1,0,'C','1');
                    $pdf->Cell(90,6,utf8_decode("$schoolRbd"),1,1,'C');
                    $pdf->Cell(90,6,utf8_decode("Nº Voto y Fecha Comisión Administrativa Colegio"),1,0,'C','1');
                    $pdf->Cell(90,6,utf8_decode("$internalVote, $voteDate"),1,1,'C');
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell(0,10,$str = utf8_decode("GESTIÓN PME"),0,0,'C');
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','',11);
                    $pdf->Cell(25,6,utf8_decode('Subvención'),1,0,'C',1);
                    $pdf->Cell(50,6,utf8_decode('Dimensión'),1,0,'C',1);
                    $pdf->Cell(50,6,utf8_decode('Subdimensión'),1,0,'C',1);
                    $pdf->Cell(65,6,utf8_decode('Acción'),1,1,'C',1);
                    $pdf->SetFont('Arial','',9);
                    $sql_pme="SELECT subvenciones.nombre as nombre_subvencion,dimesiones_gestion.nombre as nombre_dimension,
                    subdimensiones_gestion.nombre as nombre_subdimension, acciones_pme.nombre as nombre_accion,
                    acciones_pme.descripcion as descripcion_accion FROM `pme_solicitudes` 
                    LEFT JOIN subvenciones on subvenciones.id = pme_solicitudes.id_subvencion
                    LEFT JOIN dimesiones_gestion on dimesiones_gestion.id = pme_solicitudes.id_dimension
                    LEFT JOIN subdimensiones_gestion on subdimensiones_gestion.id=pme_solicitudes.id_subdimension
                    LEFT JOIN acciones_pme on acciones_pme.id=pme_solicitudes.id_accion WHERE pme_solicitudes.id_solicitud='$numero';";
                    $result_pme=mysqli_query($connection,$sql_pme);
                    while($pme=mysqli_fetch_row($result_pme)){ 
                        $pdf->Cell(25,6,$pme[0],1,0,'C');
                        $pdf->Cell(50,6,utf8_decode($pme[1]),1,0,'C');
                        $pdf->Cell(50,6,utf8_decode($pme[2]),1,0,'C');
                        $pdf->Cell(65,6,utf8_decode($pme[3]),1,1,'C');
                    }
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell(0,10,$str = utf8_decode("DESCRIPCION Y RESPALDO DEL DETALLE DE HORAS DE CONTRATO "),0,0,'C');
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','',11);
                    $pdf->Cell(60,6,utf8_decode('Nombre Profesional'),1,0,'C',1);
                    $pdf->Cell(60,6,utf8_decode('Asignatura'),1,0,'C',1);
                    $pdf->Cell(30,6,utf8_decode('Horas'),1,0,'C',1);
                    $pdf->Cell(30,6,utf8_decode('Subvención'),1,1,'C',1);
    
                    $sql_requirements="SELECT requerimientos.nombre_profesional, requerimientos.nombre, requerimientos.cantidad,subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion= subvenciones.id WHERE requerimientos.id_solicitud='$numero';";
                    $result_requirements=mysqli_query($connection,$sql_requirements);
                   
                    while($row=mysqli_fetch_row($result_requirements)){ 
                        $pdf->Cell(60,6,utf8_decode($row[0]),1,0,'C');
                        $pdf->Cell(60,6,utf8_decode($row[1]),1,0,'C');
                        $pdf->Cell(30,6,$row[2],1,0,'C');
                        $pdf->Cell(30,6,$row[3],1,1,'C');
                    }
                }else{
                    $pdf->Cell(90,6,utf8_decode('Nombre Escuela o Colegio'),1,0,'C','1');
                    $pdf->Cell(90,6,utf8_decode("$schoolName"),1,1,'C');
                    $pdf->Cell(90,6,utf8_decode("RBD"),1,0,'C','1');
                    $pdf->Cell(90,6,utf8_decode("$schoolRbd"),1,1,'C');
                    $pdf->Cell(90,6,utf8_decode('Monto Solicitado'),1,0,'C','1');
                    $pdf->Cell(90,6,number_format($totalPrice,0,',','.'),1,1,'C');
                    $pdf->Cell(90,6,utf8_decode("Nº Voto y Fecha Comisión Administrativa Colegio"),1,0,'C','1');
                    $pdf->Cell(90,6,utf8_decode("$internalVote, $voteDate"),1,1,'C');
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell(0,10,$str = utf8_decode("GESTIÓN PME"),0,0,'C');
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','',11);
                    $pdf->Cell(25,6,utf8_decode('Subvención'),1,0,'C',1);
                    $pdf->Cell(50,6,utf8_decode('Dimensión'),1,0,'C',1);
                    $pdf->Cell(50,6,utf8_decode('Subdimensión'),1,0,'C',1);
                    $pdf->Cell(65,6,utf8_decode('Acción'),1,1,'C',1);
                    $pdf->SetFont('Arial','',9);
                    $sql_pme="SELECT subvenciones.nombre as nombre_subvencion,dimesiones_gestion.nombre as nombre_dimension,
                    subdimensiones_gestion.nombre as nombre_subdimension, acciones_pme.nombre as nombre_accion,
                    acciones_pme.descripcion as descripcion_accion FROM `pme_solicitudes` 
                    LEFT JOIN subvenciones on subvenciones.id = pme_solicitudes.id_subvencion
                    LEFT JOIN dimesiones_gestion on dimesiones_gestion.id = pme_solicitudes.id_dimension
                    LEFT JOIN subdimensiones_gestion on subdimensiones_gestion.id=pme_solicitudes.id_subdimension
                    LEFT JOIN acciones_pme on acciones_pme.id=pme_solicitudes.id_accion WHERE pme_solicitudes.id_solicitud='$numero';";
                    $result_pme=mysqli_query($connection,$sql_pme);
                    while($pme=mysqli_fetch_row($result_pme)){ 
                        $pdf->Cell(25,6,$pme[0],1,0,'C');
                        $pdf->Cell(50,6,utf8_decode($pme[1]),1,0,'C');
                        $pdf->Cell(50,6,utf8_decode($pme[2]),1,0,'C');
                        $pdf->Cell(65,6,utf8_decode($pme[3]),1,1,'C');
                    }    
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Cell(0,10,$str = utf8_decode("DESCRIPCION Y RESPALDO DEL DETALLE DE GASTOS/COMPRA "),0,0,'C');
                    $pdf->Ln(10);
                    $pdf->SetFont('Arial','',11);
                    $pdf->Cell(60,6,utf8_decode('Detalle'),1,0,'C',1);
                    $pdf->Cell(30,6,utf8_decode('Valor Unidad'),1,0,'C',1);
                    $pdf->Cell(30,6,utf8_decode('Cantidad'),1,0,'C',1);
                    $pdf->Cell(30,6,utf8_decode('Subvención'),1,0,'C',1);
                    $pdf->Cell(40,6,utf8_decode('Valor Total'),1,1,'C',1);
    
                    $sql_requirements="SELECT requerimientos.nombre,requerimientos.precio, requerimientos.cantidad, (requerimientos.cantidad*requerimientos.precio) as total_unitario, subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion= subvenciones.id WHERE requerimientos.id_solicitud='$numero';";
                    $result_requirements=mysqli_query($connection,$sql_requirements);
                   
                    while($row=mysqli_fetch_row($result_requirements)){ 
                        $pdf->Cell(60,6,utf8_decode($row[0]),1,0,'C');
                        $pdf->Cell(30,6,number_format($row[1],0,',','.'),1,0,'C');
                        $pdf->Cell(30,6,$row[2],1,0,'C');
                        $pdf->Cell(30,6,$row[4],1,0,'C');
                        $pdf->Cell(40,6,number_format($row[3],0,',','.'),1,1,'C');
                    }
                }
                $pdf->Output();
                mysqli_close($conexion);
            }else{
                header("Location: inicio.php");
                echo "<script>alert('no estas autorizad@ para revisar esta solicitud');</script>";
            }
        }else{
            echo "<script>alert('no se detecta un número de solicitud');</script>";
            header("Location: inicio.php");
        }   
    }else{
        echo"<script>alert('No estas autorizad@ para ingresar al perfil Departamental');</script>";
        header("Location: ../inicio_sesion.php");   
    }
}else{
    echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
    header("Location: ../inicio_sesion.php");
}
?>
