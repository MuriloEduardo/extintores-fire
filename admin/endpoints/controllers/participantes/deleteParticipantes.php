<?php
session_start ();

require_once("./../../controllers/Participantes.class.php");

$participante = new Participantes($_SESSION['sudo_su']);

$data = json_decode(file_get_contents("php://input"));
$arr = explode(",", $data->id);
foreach ($arr as $key => $value) {
	$participante->delete($value);
}
?>