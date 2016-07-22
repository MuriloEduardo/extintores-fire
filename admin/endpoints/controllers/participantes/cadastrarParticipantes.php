<?php
session_start ();

require_once("../../controllers/Participantes.class.php");

$data = json_decode(file_get_contents("php://input"));

$cargo  = filter_var($data->cargo, FILTER_SANITIZE_MAGIC_QUOTES);
$nome = filter_var($data->nome, FILTER_SANITIZE_MAGIC_QUOTES);
$nota1   = filter_var($data->nota1, FILTER_SANITIZE_MAGIC_QUOTES);
$nota2 = filter_var(md5($data->nota2), FILTER_SANITIZE_MAGIC_QUOTES);

$participante = new Participantes($_SESSION['sudo_su']);
$participante->setDados($nome, $cargo, $nota1, $nota2);
$result = $participante->cadastrar();
?>