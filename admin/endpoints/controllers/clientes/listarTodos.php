<?php
session_start();

require_once("../../models/Clientes.class.php");

$u = new Clientes($_SESSION['sudo_su']);
echo json_encode($u->findAll());
?>