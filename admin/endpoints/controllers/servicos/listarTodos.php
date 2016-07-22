<?php
session_start();

require_once("../../models/Servicos.class.php");

$u = new Servicos($_SESSION['sudo_su']);
echo json_encode($u->findAll());
?>