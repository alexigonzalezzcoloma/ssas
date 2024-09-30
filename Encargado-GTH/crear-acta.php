<?php
session_start();
if (isset($_SESSION['user_rut'])){
   if ($_SESSION["id_rol"] == '7'){
      require_once "../assets/php/connection.php";
      $connection=connection();
      include('../assets/php/fpdf17/pdf_mc_table.php');
      $foundRut=$_SESSION["rut_fundacion"];
      
      
      $pdf = new PDF_MC_Table();
      $pdf->SetMargins(25.1,15.0,25.1);
      if(isset($_POST["lastPage"])){
         $lastPage=$_POST["lastPage"];
         $pdf->setPrevNumber($lastPage);
      }

      $pdf->AliasNbPages();
      $pdf->AddPage();

      $concept=array();
      $prefix=array();
      $voteList=array();

      if(isset($_POST["preComission"])){
         $requestsList=$_POST["reqid"];
         $voteList=$requestsList;
         $num_req=count($requestsList); 
         $prefixDoc="AGENDA";
         $isRecord=0;
         for ($i = 0; $i < $num_req; $i++) {
                array_push($concept,"AUTORIZAR");
                array_push($prefix,"SE PROPONE");
         }
      }

      if(isset($_POST["postComission"])){
         $prefixDoc="COMISIÓN";
         $isRecord=1;
         $realizedOn=$_POST["realizedOn"];
         $realizedOnTime=$_POST["realizedOnTime"];
         $realizedBy=$_POST["realizedBy"];
         $participants=$_POST["participants"];
         $pray=$_POST["pray"];
         $finalPray=$_POST["finalPray"];
         if (isset($_POST["checkrequest"])){
            $requestsList=$_POST["checkrequest"];
            $queryLastId="SELECT id_anual FROM `votos_aprobacion` ORDER BY id DESC LIMIT 1;";
            $resultLastId=mysqli_query($connection,$queryLastId);
            $numResults=mysqli_num_rows($resultLastId);
            
            $counter=intval($numResults);
            if($numResults==1){
               $rowsLastId=mysqli_fetch_array($resultLastId);
               $counter= intval($rowsLastId[0]);
            }
            
            $num_req=count($requestsList);
            for ($j = 0; $j < $num_req; $j++){
               $counter= $counter +1;
               array_push($concept,"AUTORIZAR");
               array_push($prefix,"ACORDADO");
               array_push($voteList,$counter);
            }
         }else{
            header("Location: comision-interna.php");
         }
      }
      
      $pdf->setHeaderDesign($realizedOn,$isRecord);
      $pdf->SetFont('Times','B',12);
      $pdf->Ln(10);
      $pdf->MultiCell(0,5,$str = utf8_decode("$prefixDoc DE EDUCACIÓN \n FUNDACIÓN EDUCACIONAL JULIÁN OCAMPO"),0,'C');
      if($isRecord==1){
         $pdf->Ln(6);
         $pdf->SetFont('Times','',12);
         $pdf->MultiCell(0,6,$str = utf8_decode("Realizada en Modalidad $realizedBy \n $realizedOn, $realizedOnTime"),0,'C');
         $pdf->Ln(6);
         $pdf->SetFont('Times','B',12);
         $realizedByMayus=strtoupper($realizedBy);
         $pdf->Write(5,$str = utf8_decode("MIEMBROS PRESENTES:"));
         $pdf->SetFont('Times','',12);
         $pdf->Write(5,$str = utf8_decode("  $participants"));
         $pdf->Ln(12);
         $pdf->SetFont('Times','B',12);
         $pdf->Write(5,$str = utf8_decode("ORACIÓN:  "));
         $pdf->SetFont('Times','',12);
         $pdf->Write(5,$str = utf8_decode("$pray ")); 
      }
      $pdf->Ln(12);
      for ($i=0;$i<$num_req;$i++){
         
         $sql_recordData="SELECT colegios.nombre as nombre_colegio, solicitudes.titulo,DATE_FORMAT(solicitudes.fecha_hora , '%Y')anio, 
         solicitudes.precio_total, solicitudes.justificacion, solicitudes.rbd_colegio,solicitudes.voto_interno,
         solicitudes.fecha_voto_interno, solicitudes.tipo FROM `solicitudes` 
         INNER JOIN colegios on solicitudes.rbd_colegio=colegios.rbd WHERE solicitudes.id='$requestsList[$i]';";

         $result_recordData=mysqli_query($connection,$sql_recordData);
         $row_recordData=mysqli_fetch_row($result_recordData);
         $schoolName=$row_recordData[0];
         $recordTitle=$row_recordData[1];
         $yearRequest=$row_recordData[2];
         $totalPrice= $row_recordData[3];
         $justify=$row_recordData[4];
         $schoolRbd=$row_recordData[5];
         $internalVote=$row_recordData[6];
         $voteDate=$row_recordData[7];
         $reqType=$row_recordData[8];

         date_default_timezone_set("America/Santiago");
         $get_date = getdate();
         $thisyear = $get_date['year'];

         $sqlSubs="SELECT DISTINCT subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion=subvenciones.id WHERE requerimientos.id_solicitud='$requestsList[$i]';";
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
         $pdf->SetFont('Times','B',12);
         $mayusSchool=strtoupper($schoolName);
         $pdf->Write(5,$str = utf8_decode("$thisyear - $voteList[$i]  $mayusSchool - $recordTitle - RECURSOS $subsGroup - $concept[$i]"));
         $pdf->SetFont('Times','',12);
         $pdf->Ln(10);
         $pdf->Write(5,$txt=utf8_decode("$prefix[$i] $justify"));
         $pdf->Ln(10);
         if ($reqType=="Contratos"){
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(80,6,utf8_decode('Nombre Escuela o Colegio'),1,0,'C');
            $pdf->Cell(80,6,utf8_decode("$schoolName"),1,1,'C');
            $pdf->SetFont('Times','',10);
            $pdf->Cell(80,6,utf8_decode("RBD"),1,0,'C');
            $pdf->Cell(80,6,utf8_decode("$schoolRbd"),1,1,'C');
            $pdf->Cell(80,6,utf8_decode("Nº Voto y Fecha Comisión Administrativa Colegio"),1,0,'C');
            $pdf->Cell(80,6,utf8_decode("$internalVote, $voteDate"),1,1,'C');
            $pdf->Ln(6);

            $sql_pme="SELECT subvenciones.nombre as nombre_subvencion,dimesiones_gestion.nombre as nombre_dimension,
            subdimensiones_gestion.nombre as nombre_subdimension, acciones_pme.nombre as nombre_accion,
            acciones_pme.descripcion as descripcion_accion FROM `pme_solicitudes` 
            LEFT JOIN subvenciones on subvenciones.id = pme_solicitudes.id_subvencion
            LEFT JOIN dimesiones_gestion on dimesiones_gestion.id = pme_solicitudes.id_dimension
            LEFT JOIN subdimensiones_gestion on subdimensiones_gestion.id=pme_solicitudes.id_subdimension
            LEFT JOIN acciones_pme on acciones_pme.id=pme_solicitudes.id_accion WHERE pme_solicitudes.id_solicitud='$requestsList[$i]';";
            $result_pme=mysqli_query($connection,$sql_pme);
            $num_rows_pme=mysqli_num_rows($result_pme);
            if($num_rows_pme>0){
               $pdf->SetFont('Times','B',10);
               $pdf->Cell(160,6,$str = utf8_decode("GESTIÓN PME"),1,0,'C');
               $pdf->Ln(6);

               $pdf->Cell(20,6,utf8_decode('SUBVEN.'),1,0,'L');
               $pdf->Cell(30,6,utf8_decode('DIMENSIÓN'),1,0,'L');
               $pdf->Cell(30,6,utf8_decode('SUBDIMENSIÓN'),1,0,'L');
               $pdf->Cell(80,6,utf8_decode('ACCIÓN'),1,1,'L');
               $pdf->SetFont('Times','',10);
               $pdf->SetWidths(Array(20,30,30,80));
               $pdf->SetLineHeight(5);
               while($pme=mysqli_fetch_row($result_pme)){ 
                  $pdf->Row(Array(
                     utf8_decode($pme[0]),
                     utf8_decode($pme[1]),
                     utf8_decode($pme[2]),
                     utf8_decode($pme[3])
                  ));
               }   
            }
            $pdf->Ln(6);

            $sql_requirements="SELECT requerimientos.nombre_profesional, requerimientos.nombre, requerimientos.cantidad,
            subvenciones.nombre as nombre_subvencion 
            FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion= subvenciones.id 
            WHERE requerimientos.id_solicitud='$requestsList[$i]';";
            $result_requirements=mysqli_query($connection,$sql_requirements);
            $num_rows_req=mysqli_num_rows($result_requirements);
            if($num_req>0){
               $pdf->SetFont('Times','B',10);
               $pdf->Cell(160,6,$str = utf8_decode("DESCRIPCION Y RESPALDO DEL DETALLE DE HORAS DE CONTRATO "),1,0,'C');
               $pdf->Ln(6);
               $pdf->Cell(40,6,utf8_decode('NOM. PROFESIONAL'),1,0,'L');
               $pdf->Cell(60,6,utf8_decode('ASIGNATURA'),1,0,'L');
               $pdf->Cell(30,6,utf8_decode('HORAS'),1,0,'L');
               $pdf->Cell(30,6,utf8_decode('SUBVENCIÓN'),1,1,'L');
               $pdf->SetFont('Times','',10);
               $pdf->SetWidths(Array(40,60,30,30));
               $pdf->SetLineHeight(5);
               while($row=mysqli_fetch_row($result_requirements)){ 
                  $pdf->Row(Array(
                     utf8_decode($row[0]),
                     utf8_decode($row[1]),
                     $row[2],
                     utf8_decode($row[3]),
                  ));
               }
            }
         }else{
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(80,6,utf8_decode('Nombre Escuela o Colegio'),1,0,'C');
            $pdf->Cell(80,6,utf8_decode("$schoolName"),1,1,'C');
            $pdf->SetFont('Times','',10);
            $pdf->Cell(80,6,utf8_decode("RBD"),1,0,'C');
            $pdf->Cell(80,6,utf8_decode("$schoolRbd"),1,1,'C');
            $pdf->Cell(80,6,utf8_decode('Monto Solicitado'),1,0,'C');
            $pdf->SetFont('Times','B',10);
            $pdf->Cell(80,6,'$'.number_format($totalPrice,0,',','.'),1,1,'C');
            $pdf->SetFont('Times','',10);
            $pdf->Cell(80,6,utf8_decode("Nº Voto y Fecha Comisión Administrativa Colegio"),1,0,'C');
            $pdf->Cell(80,6,utf8_decode("$internalVote, $voteDate"),1,1,'C');
            $pdf->Ln(6);

            $pdf->SetFont('Times','B',10);
            $pdf->Cell(160,6,$str = utf8_decode("GESTIÓN PME"),1,0,'C');
            $pdf->Ln(6);

            $pdf->Cell(20,6,utf8_decode('SUBVEN.'),1,0,'L');
            $pdf->Cell(30,6,utf8_decode('DIMENSIÓN'),1,0,'L');
            $pdf->Cell(30,6,utf8_decode('SUBDIMENSIÓN'),1,0,'L');
            $pdf->Cell(80,6,utf8_decode('ACCIÓN'),1,1,'L');
            $pdf->SetFont('Times','',10);
            $sql_pme="SELECT subvenciones.nombre as nombre_subvencion,dimesiones_gestion.nombre as nombre_dimension,
            subdimensiones_gestion.nombre as nombre_subdimension, acciones_pme.nombre as nombre_accion,
            acciones_pme.descripcion as descripcion_accion FROM `pme_solicitudes` 
            LEFT JOIN subvenciones on subvenciones.id = pme_solicitudes.id_subvencion
            LEFT JOIN dimesiones_gestion on dimesiones_gestion.id = pme_solicitudes.id_dimension
            LEFT JOIN subdimensiones_gestion on subdimensiones_gestion.id=pme_solicitudes.id_subdimension
            LEFT JOIN acciones_pme on acciones_pme.id=pme_solicitudes.id_accion WHERE pme_solicitudes.id_solicitud='$requestsList[$i]';";
            $result_pme=mysqli_query($connection,$sql_pme);
            $pdf->SetWidths(Array(20,30,30,80));
            $pdf->SetLineHeight(5);
            while($pme=mysqli_fetch_row($result_pme)){ 
               $pdf->Row(Array(
                  utf8_decode($pme[0]),
                  utf8_decode($pme[1]),
                  utf8_decode($pme[2]),
                  utf8_decode($pme[3])
               ));
            }   
            $pdf->Ln(6);

            $pdf->SetFont('Times','B',10);
            $pdf->Cell(160,6,$str = utf8_decode("DESCRIPCION Y RESPALDO DEL DETALLE DE GASTOS/COMPRA "),1,0,'C');
            $pdf->Ln(6);

            $pdf->Cell(66,6,utf8_decode('DETALLE'),1,0,'L');
            $pdf->Cell(22,6,utf8_decode('VALOR UN.'),1,0,'L');
            $pdf->Cell(22,6,utf8_decode('CANTIDAD'),1,0,'L');
            $pdf->Cell(22,6,utf8_decode('SUBVENCI.'),1,0,'L');
            $pdf->Cell(28,6,utf8_decode('VALOR TOTAL'),1,1,'L');
            $sql_requirements="SELECT requerimientos.nombre,requerimientos.precio, requerimientos.cantidad, (requerimientos.cantidad*requerimientos.precio) 
            as total_unitario, subvenciones.nombre as nombre_subvencion FROM requerimientos INNER JOIN subvenciones on requerimientos.id_subvencion= subvenciones.id 
            WHERE requerimientos.id_solicitud='$requestsList[$i]';";
            $result_requirements=mysqli_query($connection,$sql_requirements);
            $pdf->SetFont('Times','',10);
            $pdf->SetWidths(Array(66,22,22,22,28));
            $pdf->SetLineHeight(5);
            while($row=mysqli_fetch_row($result_requirements)){ 
               $pdf->Row(Array(
                  utf8_decode($row[0]),
                  number_format($row[1],0,',','.'),
                  $row[2],
                  utf8_decode($row[4]),
                  number_format($row[3],0,',','.')
               ));
            }         
         }
         
         if($i<$num_req-1){
            //$pdf->AddPage();
            $pdf->Ln(24);
         }
         
      }
      //$route=create_route($connection);
      //$internalUrl='acta'.$_SESSION['rut_fundacion'].'.pdf';
      if($isRecord==1){
         $queryPresident="SELECT usuarios.nombre, usuarios.ruta_firma FROM `fundaciones` INNER JOIN usuarios on presidente_comision=usuarios.rut WHERE fundaciones.rut='$foundRut';";
         $querySecretary="SELECT usuarios.nombre, usuarios.ruta_firma FROM `fundaciones` INNER JOIN usuarios on secretario_comision=usuarios.rut WHERE fundaciones.rut='$foundRut';";
         $resultPresident=mysqli_query($connection,$queryPresident);
         $resultSecretary=mysqli_query($connection,$querySecretary);
         $rowsPresident=mysqli_fetch_row($resultPresident);
         $rowsSecretary=mysqli_fetch_row($resultSecretary);
         $PresidentName=$rowsPresident[0];
         $SecretaryName=$rowsSecretary[0];
         $PresidentFirm=$rowsPresident[1];
         $SecretaryFirm=$rowsSecretary[1];
         $PresidentFirm='../assets/uploads/firms/'.$PresidentFirm;
         $SecretaryFirm='../assets/uploads/firms/'.$SecretaryFirm;
         $pdf->AddPage();
         $pdf->Ln(120);
         $pdf->SetFont('Times','B',12);
         $pdf->Cell(0,6,$str = utf8_decode("ORACIÓN: "),0,1,'L'); 
         $pdf->SetFont('Times','',12);
         $pdf->Cell(0,6,$str = utf8_decode("$finalPray "),0,0,'L');
         $pdf->Ln(100);
         $pdf->Image($PresidentFirm,20,230,60,30);
         $pdf->Image($SecretaryFirm,135,230,60,30);
         $pdf->Cell(0,6,$str = utf8_decode("$PresidentName, presidente"),0,0,'L');
         $pdf->Cell(0,6,$str = utf8_decode("$SecretaryName, secretario"),0,0,'R');
      }
      $pdf->Output();
      //$pdf->Output('D',$internalUrl);
      //$pdf->Output('F','acta1.pdf');
   }else{
      echo"<script>alert('No estas autorizad@ para ingresar al perfil Revisor');</script>";
      header("Location: ../inicio_sesion.php");   
  }
}else{
  echo "<script>alert('No se detecta su sesión, por favor inicie sesión');</script>";
  header("Location: ../inicio_sesion.php");
}
?>