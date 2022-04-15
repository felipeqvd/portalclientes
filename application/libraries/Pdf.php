<?php
	if (!defined('BASEPATH'))
	    exit('No direct script access allowed');

	require_once APPPATH.'/libraries/TCPDF/tcpdf.php';

	class Pdf extends TCPDF
	{
		private $imagen;
		private $header;
		private $footer;
		private $img_footer;
		private $tipo;		// Consulta (1) o Flash (2)

		public function __construct($params){
			parent::__construct('P', 'mm', 'Letter');	// Orientatio=portrait, Unit=mm, Size=Letter

			$this->imagen = $params['imagen'];
			$this->header = $params['header'];
			$this->footer = $params['footer'];
			$this->img_footer = $params['img_footer'];
			$this->tipo = $params['tipo'];
		}

		public function Header()
		{
                    if ($this->tipo == 1)
                    {
                            if ($this->imagen != null && $this->imagen != '')
                                    $this->Image(dirname(FCPATH) . '/' . $this->imagen, 20, 10, 80);
                            
                            $this->SetFont('helvetica', '', 7);
                            $this->SetTextColor(0, 45, 98);
                            
                            $this->MultiCell(50, 0, $this->header, 0, 'L', 0, 0, '135', '', true);
                    }
		}

		public function Footer()
		{
			$this->SetY(-15);	// Posición relativa al final de la página (signo negativo)
			$this->SetFont('helvetica', 'I', 8);
			$this->SetTextColor(150, 150, 150);
			//$this->Cell(0, 10, "Crowe CO S.A. is member of Crowe International, a Swiss Verein.", 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$this->Cell(0, 0, $this->footer, 0, false, 'L', 0, '', 0, false, 'T', 'M');

			if($this->tipo == 1)
			{
				$this->Cell(0, 0, $this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
			}
			elseif($this->tipo == 2)
			{
				$this->Image(FCPATH . $this->img_footer, 167, 280, 18);
				if ($this->page != 1)
				{
					$this->Cell(0, 0, $this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
				}
			}
			elseif($this->tipo == 3)
			{
				if ($this->img_footer != null && $this->img_footer != '')
					$this->Image(FCPATH . $this->img_footer, 167, 280, 18);
				$this->Cell(0, 0, $this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
			}
		}


		public function setUpPDF ($codigo)
		{
		    // Permisos (print, modify, copy, ..), user password, owner password, mode, pubkeys
		    //$this->SetProtection(array(), '', null, 1, null);

		    $this->SetCreator('Portal clientes Crowe Co');
		    $this->SetAuthor('Crowe Co');

		    if ($this->tipo == 1)
		    {
		    	$this->SetTitle('Cliente ' . $codigo);
		        $this->SetSubject('Cliente');
		        $this->SetKeywords('Cliente');
		    }
		    

		    // Header logo, logo width, header title, header string
		    //$this->pdf->SetHeaderData(FCPATH.'img\logosHead.png', 10, "PDF_HEADER_TITLE", "PDF_HEADER_STRING");

		    // Main font name, '', Main font size
		    $this->setHeaderFont(Array('helvetica', '', 10));
		    // Data font name, '', Data font Size
		    $this->setFooterFont(Array('helvetica', '', 10));

		    // Font
		    $this->SetDefaultMonospacedFont('helvetica');

		    
		    // Header margin
		    $this->SetHeaderMargin(10);
		    // Footer margin
                    $this->SetFooterMargin(20);
                    // boolean, margin bottom
		    $this->SetAutoPageBreak(true, 20);

		    $espacios_verticales = array('p' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'h1' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'h2' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'h3' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'h4' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'h5' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'h6' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'blockquote' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'span' => array(0 => array('h' => 0.001, 'n' => 1), 1 => array('h' => 0.001, 'n' => 1)), 'li' => array(0 => array('h' => 1, 'n' => 2), 1 => array('h' => 0, 'n' => 1)));
		    
		    if ($this->tipo < 3)
		    {
		    	// Margin left, Margin top, margin right
		    	$this->SetMargins(10, 35, 10);  
		    }
		    
		    $this->setHtmlVSpace($espacios_verticales);

		    $this->setImageScale(1);

		    $this->setCellHeightRatio(1.3);       // Alto de la linea (genera espaciado entre lineas)
		    $this->SetCellPadding(0);

		    $this->SetFont('helvetica', '', 12);
		}
	}
?>