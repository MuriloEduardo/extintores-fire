<?php
session_start();

require_once("../../models/Usuarios.class.php");

$u = new Usuarios($_SESSION['sudo_su']);
$u->logout();
?>