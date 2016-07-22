<?php
session_start ();

require_once("./../../controllers/Participantes.class.php");

$participante = new Participantes($_SESSION['sudo_su']);

echo json_encode($participante->findAll());
?>