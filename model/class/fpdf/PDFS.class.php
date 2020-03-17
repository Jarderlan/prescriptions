<?php  
	include_once 'FPDF.class.php';

	class Pdfs extends FPDF{
		 public $title;


		public function Header(){
			global $title;

		    $this->SetFont('Arial', 'B', 15);
		    $this->Cell(0, 20, $this->title, 1, 1, 'C',1);
		}

		public function Footer(){

			$f_title = date("d.m.Y").utf8_decode(" | Página ");

			// Vai para 1.5 cm da borda inferior
		    $this->SetY(-15);
		    // Seleciona Arial itálico 8
		    $this->SetFont('Arial','I',8);
		    // Imprime o número da página centralizado
		    $this->Cell(0,10,$f_title.$this->PageNo(),0,0,'R');
		}

	}


?>