<?php
session_start();

require_once("../../models/Produtos.class.php");

$data = json_decode(file_get_contents("php://input"));

$id_prdt = $data->Id_Produto;
$produto = filter_var($data->Produto, FILTER_SANITIZE_MAGIC_QUOTES);
$valor = filter_var($data->Valor, FILTER_SANITIZE_MAGIC_QUOTES);
$qtde_atual = filter_var($data->Qtde_Atual, FILTER_SANITIZE_MAGIC_QUOTES);
$qtde_minima = filter_var(md5($data->Qtde_Minima), FILTER_SANITIZE_MAGIC_QUOTES);

$c = new Produtos($_SESSION['sudo_su']);
$c->setDados($produto, $valor, $qtde_atual, $qtde_minima);

if($c->editar($id_prdt)){
	// Sucesso
	echo json_encode(array('status' => true));
}else{
	// Ja existe
	echo json_encode(array('status' => false));
}
?>