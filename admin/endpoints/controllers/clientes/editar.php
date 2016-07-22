<?php
session_start();

require_once("../../models/Clientes.class.php");

$data = json_decode(file_get_contents("php://input"));

$filename = $_FILES['Foto']['name'];
$meta = $_POST;
$destination = '../../../upload/' . $filename;
$id_cliente = $meta['Id_Cliente'];

move_uploaded_file($_FILES['Foto']['tmp_name'] , $destination);

$c = new Clientes($_SESSION['sudo_su']);
$c->setDados($meta['Nome'], $meta['Representante'], $meta['Cnpj'], $meta['Insc_Estadual'], $meta['Endereco'], $meta['Numero'], $meta['Complemento'], $meta['Bairro'], $meta['Cidade'], $meta['Estado'], $meta['Cep'], $meta['Comprador'], $meta['Fone'], $meta['Celular'], $meta['Email'], $filename);

if($c->editar($id_cliente)){
	// Sucesso
	echo json_encode(array('status' => true));
}else{
	// Ja existe
	echo json_encode(array('status' => false));
}
?>