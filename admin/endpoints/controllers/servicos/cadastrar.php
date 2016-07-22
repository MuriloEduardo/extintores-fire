<?php
session_start();

require_once("../../models/Servicos.class.php");
require_once("../../models/ItensServico.class.php");

$data = json_decode(file_get_contents("php://input"));

$id_cliente = filter_var($data->Id_Cliente, FILTER_SANITIZE_MAGIC_QUOTES);
$tpServico = filter_var($data->TpServico, FILTER_SANITIZE_MAGIC_QUOTES);
$valor_total = filter_var($data->Valor_Total, FILTER_SANITIZE_MAGIC_QUOTES);
$obs = '';

if(isset($data->obs)){
	$obs = filter_var($data->obs, FILTER_SANITIZE_MAGIC_QUOTES);
}

if($data){

	$c = new Servicos($_SESSION['sudo_su']);
	$c->setDados($id_cliente, $tpServico, $valor_total, $obs);

	$id_servico = $c->cadastrar();

	if($id_servico){
		$item = new ItensServico($_SESSION['sudo_su']);
		foreach ($data->ItensServico as $key) {
			// Criar itens do servico apartir desse ponto
			$item->setDados($id_servico, $key->Id_Produto, $key->Quant, $key->Unit, $key->Valor);
			$cadastro_itens = $item->cadastrar();
			
			// Se o input Radio vier com valor 1
			// Entao dar baixa no estoque na quantidade escolhida
			if($tpServico == '1')
				$item->baixaEstoque($key->Quant);
		}
		
		if($cadastro_itens){
			echo json_encode(array('status' => true));
		}else{
			// Ja existe
			echo json_encode(array('status' => false));
		}
	}
}
?>