<?php
session_start();

require_once("../../models/Logs.class.php");

$u = new Logs($_SESSION['sudo_su']);
echo json_encode($u->findAll());
?>