<?php
require("Fpdf/fpdf.php");

class PDF extends FPDF {
	
	public function Header() {
	    $this->Image('../../../img/logo_extinfire.jpg',10,10,-400);
	    
	    $this->SetFont('Arial','B',16);
	    $this->Cell(0,20, utf8_decode('Extin Fire / Extintores'), 0, 0, "R");
	    $this->SetFont('Arial','',14);
	    $this->Cell(0,35, utf8_decode('(51)3682-2383'), 0, 0, "R");
	}
	
	public function Footer() {
	    // Go to 1.5 cm from bottom
	    $this->SetY(-15);
	    // Select Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Print centered page number
	    $this->Cell(0,10,utf8_decode('Página '.$this->PageNo()),0,0,'C');
	}
}
?>