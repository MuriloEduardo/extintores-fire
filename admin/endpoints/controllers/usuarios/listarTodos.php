<?php
session_start();

require_once("../../models/Usuarios.class.php");

$u = new Usuarios($_SESSION['sudo_su']);
echo json_encode($u->findAll());
?>