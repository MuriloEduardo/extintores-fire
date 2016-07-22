<?php
require("../../models/Pdf.class.php");

$pdf = new PDF();
$pdf->AddPage("P", "A4");
$pdf->Header();
$pdf->SetTitle("Ordem de Serviço", true);

// Titulo Abaixo do Logotipo
$pdf->Ln(35);
$pdf->SetFont("Arial","",16);
$pdf->Cell(0,10,utf8_decode("Ordem de Serviço"), 0, 0, "C");
$pdf->Ln(20);

// Titulo - Dados do Cliente
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,10,utf8_decode("Dados do Cliente"), 1, 0, "L");
$pdf->Ln(10);

// Nome - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Nome / Razão Social: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("Global Sistemas Web"), 1, 0, "L");
$pdf->Ln(8);

// Representante - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Representante: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("Murilo Eduardo dos Santos"), 1, 0, "L");
$pdf->Ln(8);

// Endereco - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Endereço: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("Av. Senador Salgado Filho, 359 - Apto. 1913"), 1, 0, "L");
$pdf->Ln(8);

// Cnpj / Incrição Estadual - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Cnpj: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(50,8,utf8_decode("78.425.986/0036-15"), 1, 0, "L");
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Inscrição Estadual: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("641.641.208.113"), 1, 0, "L");
$pdf->Ln(8);

// Bairro / Cep - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Bairro: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(50,8,utf8_decode("Centro Histórico"), 1, 0, "L");
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Cep: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("90010-221"), 1, 0, "L");
$pdf->Ln(8);

// Cidade / Estado - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Cidade: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(50,8,utf8_decode("Porto Alegre"), 1, 0, "L");
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Estado: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("RS"), 1, 0, "L");
$pdf->Ln(8);

// Comprador - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Comprador: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("João Nair Ribeiro"), 1, 0, "L");
$pdf->Ln(8);

// Email - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Email: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("muriloeduardoooooo@gmail.com"), 1, 0, "L");
$pdf->Ln(8);

// Fone / Celular - Dados do CLiente
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Fone: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(50,8,utf8_decode("(51)3226-3653"), 1, 0, "L");
$pdf->SetFont("Arial","B",10);
$pdf->Cell(40,8,utf8_decode("Celular: "), 1, 0, "L");
$pdf->SetFont("Arial","",10);
$pdf->Cell(0,8,utf8_decode("(51)9597-7756"), 1, 0, "L");
$pdf->Ln(15);

// Titulo - Serviço
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,10,utf8_decode("Produtos e Serviços"), 1, 0, "L");
$pdf->Ln(10);

$pdf->Output();
?>