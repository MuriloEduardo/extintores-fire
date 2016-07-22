<?php
session_start();

require_once("../../models/Usuarios.class.php");

$data = json_decode(file_get_contents("php://input"));

$id_user = $data->Id_Usuario;
$nome = filter_var($data->Nome, FILTER_SANITIZE_MAGIC_QUOTES);
$tipo_usuario = filter_var($data->Tipo_User, FILTER_SANITIZE_MAGIC_QUOTES);
$login = filter_var($data->Login, FILTER_SANITIZE_MAGIC_QUOTES);
$senha = filter_var(md5($data->Senha), FILTER_SANITIZE_MAGIC_QUOTES);

$c = new Usuarios($_SESSION['sudo_su']);
$c->setDados($nome, $login, $senha, $tipo_usuario);

if($c->editar($id_user)){
	// Sucesso
	echo json_encode(array('status' => true));
}else{
	// Ja existe
	echo json_encode(array('status' => false));
}
?>