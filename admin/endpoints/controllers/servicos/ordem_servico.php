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

// NOVA LINHA
// Tipo de Ordem de Serviço
$pdf->SetFont("Arial","B",10);
$pdf->Cell(140,8,utf8_decode("Tipo de Ordem de Serviço: "), 1, 0, "R");
$pdf->SetFont("Arial","",10);
$pdf->Cell(50,8,utf8_decode("Pedido"), 1, 0, "C");
$pdf->Ln(8);

// NOVA LINHA
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

// NOVA LINHA
// Titulo - Serviço
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,10,utf8_decode("Produtos e/ou Serviços"), 1, 0, "L");
$pdf->Ln(10);


// CADA ITEM DE PRODUTO NA ORDEM //
// Descrição / Quantidade / Unit / Valor - Serviço

// key - Descrição
$pdf->SetFont("Arial","B",10);
$pdf->Cell(30,8,utf8_decode("Descrição: "), 1, 0, "L");
// value - Descrição
$pdf->SetFont("Arial","",10);
$pdf->Cell(55,8,utf8_decode("Extintor de porte pequeno"), 1, 0, "L");

// key - Quantidade
$pdf->SetFont("Arial","B",10);
$pdf->Cell(20,8,utf8_decode("Qntde.: "), 1, 0, "L");
// value - Quantidade
$pdf->SetFont("Arial","",10);
$pdf->Cell(10,8,utf8_decode("3"), 1, 0, "C");

// key - Unit
$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,8,utf8_decode("Unit.: "), 1, 0, "L");

// value - Unit
$pdf->SetFont("Arial","",10);
$pdf->Cell(20,8,utf8_decode("Unidade"), 1, 0, "L");

// key - Valor
$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,8,utf8_decode("Valor: "), 1, 0, "L");

// value - Valor
$pdf->SetFont("Arial","",10);
$pdf->Cell(25,8,utf8_decode("R$ 35,00"), 1, 0, "C");
$pdf->Ln(8);
// FIM DE CADA PRODUTO

// CADA ITEM DE PRODUTO NA ORDEM //
// Descrição / Quantidade / Unit / Valor - Serviço

// key - Descrição
$pdf->SetFont("Arial","B",10);
$pdf->Cell(30,8,utf8_decode("Descrição: "), 1, 0, "L");
// value - Descrição
$pdf->SetFont("Arial","",10);
$pdf->Cell(55,8,utf8_decode("Extintor de porte pequeno"), 1, 0, "L");

// key - Quantidade
$pdf->SetFont("Arial","B",10);
$pdf->Cell(20,8,utf8_decode("Qntde.: "), 1, 0, "L");
// value - Quantidade
$pdf->SetFont("Arial","",10);
$pdf->Cell(10,8,utf8_decode("3"), 1, 0, "C");

// key - Unit
$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,8,utf8_decode("Unit.: "), 1, 0, "L");

// value - Unit
$pdf->SetFont("Arial","",10);
$pdf->Cell(20,8,utf8_decode("Unidade"), 1, 0, "L");

// key - Valor
$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,8,utf8_decode("Valor: "), 1, 0, "L");

// value - Valor
$pdf->SetFont("Arial","",10);
$pdf->Cell(25,8,utf8_decode("R$ 35,00"), 1, 0, "C");
$pdf->Ln(8);
// FIM DE CADA PRODUTO

// CADA ITEM DE PRODUTO NA ORDEM //
// Descrição / Quantidade / Unit / Valor - Serviço

// key - Descrição
$pdf->SetFont("Arial","B",10);
$pdf->Cell(30,8,utf8_decode("Descrição: "), 1, 0, "L");
// value - Descrição
$pdf->SetFont("Arial","",10);
$pdf->Cell(55,8,utf8_decode("Extintor de porte pequeno"), 1, 0, "L");

// key - Quantidade
$pdf->SetFont("Arial","B",10);
$pdf->Cell(20,8,utf8_decode("Qntde.: "), 1, 0, "L");
// value - Quantidade
$pdf->SetFont("Arial","",10);
$pdf->Cell(10,8,utf8_decode("3"), 1, 0, "C");

// key - Unit
$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,8,utf8_decode("Unit.: "), 1, 0, "L");

// value - Unit
$pdf->SetFont("Arial","",10);
$pdf->Cell(20,8,utf8_decode("Unidade"), 1, 0, "L");

// key - Valor
$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,8,utf8_decode("Valor: "), 1, 0, "L");

// value - Valor
$pdf->SetFont("Arial","",10);
$pdf->Cell(25,8,utf8_decode("R$ 35,00"), 1, 0, "C");
$pdf->Ln(8);
// FIM DE CADA PRODUTO

// key - Valor
$pdf->SetFont("Arial","B",10);
$pdf->Cell(140,8,utf8_decode("Valor Total: "), 1, 0, "R");

// value - Valor
$pdf->SetFont("Arial","",10);
$pdf->Cell(50,8,utf8_decode("R$ 35,00"), 1, 0, "C");
$pdf->Ln(15);

// NOVA LINHA
// Titulo - Observações e Valor Total
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,10,utf8_decode("Observações"), 1, 0, "L");
$pdf->Ln(10);

$pdf->SetFont("Arial","",10);
$pdf->MultiCell(0,6,utf8_decode("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at ex libero. Cras elementum nunc lacus, ut ornare augue pharetra at. Cras purus odio, interdum maximus ornare eget, scelerisque ac nunc. Aenean faucibus nisl vitae facilisis interdum. In ullamcorper enim quis elit vulputate egestas."), 1, "L");
$pdf->Ln(20);

$pdf->Cell(85,0,"", 1, 0, "C");
$pdf->Ln(0);
$pdf->SetFont("Arial","B",10);
$pdf->Cell(85,8,"Assinatura da Empresa", 0, 0, "C");

$pdf->setX(115);
$pdf->Cell(85,0,"", 1, 0, "C");
$pdf->Ln(0);
$pdf->setX(115);
$pdf->SetFont("Arial","B",10);
$pdf->Cell(85,8,"Assinatura do Cliente", 0, 0, "C");

$pdf->Output();
?>