<?php
//call main fpdf file
require('fpdf.php');

//create new class extending fpdf class
class PDF_MC_Table extends FPDF {
	// variable to store widths and aligns of cells, and line height
	var $widths;
	var $aligns;
	var $lineHeight;

	var $prevNumber=0;

	//Set the array of column widths
	function SetWidths($w){
		$this->widths=$w;
	}

	//Set the array of column alignments
	function SetAligns($a){
		$this->aligns=$a;
	}

	//Set line height
	function SetLineHeight($h){
		$this->lineHeight=$h;
	}

	//Calculate the height of the row
	function Row($data)
	{
		// number of line
		$nb=0;
		
		// loop each data to find out greatest line number in a row.
		for($i=0;$i<count($data);$i++){
			// NbLines will calculate how many lines needed to display text wrapped in specified width.
			// then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		}
		
		//multiply number of line with line height. This will be the height of current row
		$h=$this->lineHeight * $nb;
		
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		
		//Draw the cells of current row
		for($i=0;$i<count($data);$i++)
		{
			// width of the current col
			$w=$this->widths[$i];
			
			// alignment of the current col. if unset, make it left.
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function setHeaderDesign($realized,$isrec,$cieNum){
		global $realizedOn;
		global $isRecord;
		global $cieNum;
		$realizedOn=$realized;
		$isRecord=$isrec;
	}

	function Header()
	{	
		global $realizedOn;
		global $isRecord;
		global $cieNum;
		if ($isRecord==1){
			if ( $this->PageNo() !== 1 ) {
				$i=$this->PageNo();
				if (($i%2) == 0) {
					$align='L';
				 } else {
					$align='R';
				}
				$this->SetFont('Times','',12);
				$this->MultiCell(0,5,$str = utf8_decode("Comisión Interna de Educación \n Acta N°$cieNum del $realizedOn"),0,$align);
				// Line break
				$this->Ln(6);
			}
		}
		
	}
	function setPrevNumber($prev){
		global $prevNumber;
		$prevNumber=$prevNumber+intval($prev);
	}

	function Footer()
			{
					global $prevNumber;
					$this->SetY(-15);
					$this->SetFont('Times','',10);
					$this->Cell(0,10,$this->PageNo()+$prevNumber,0,0,'C');
					//$this->Cell(0,10,$this->PageNo(),0,0,'C');

			}

	

	function NbLines($w,$txt)
	{
		//calculate the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}
	  
?>
