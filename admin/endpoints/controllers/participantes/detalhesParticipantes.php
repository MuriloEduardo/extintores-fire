<?php
session_start ();

require_once("./../../controllers/Participantes.class.php");

$participante = new Participantes($_SESSION['sudo_su']);

$dado_url = explode('/', $_SERVER ['REQUEST_URI']);

echo json_encode($participante->find(end($dado_url)));
?>