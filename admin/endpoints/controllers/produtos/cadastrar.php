<?php
session_start();

require_once("../../models/Produtos.class.php");

$data = json_decode(file_get_contents("php://input"));

$produto = filter_var($data->Produto, FILTER_SANITIZE_MAGIC_QUOTES);
$valor = filter_var($data->Valor, FILTER_SANITIZE_MAGIC_QUOTES);
$qtde_atual = $data->Qtde_Atual;
$qtde_minima = $data->Qtde_Minima;

if($data){
	
	$c = new Produtos($_SESSION['sudo_su']);
	$c->setDados($produto, $valor, $qtde_atual, $qtde_minima);

	if($c->cadastrar()){
		// Sucesso
		echo json_encode(array('status' => true));
	}else{
		// Ja existe
		echo json_encode(array('status' => false));
	}
}
?>