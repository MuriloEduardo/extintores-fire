<?php
session_start();

require_once("../../models/Produtos.class.php");

$u = new Produtos($_SESSION['sudo_su']);
echo json_encode($u->findAll());
?>