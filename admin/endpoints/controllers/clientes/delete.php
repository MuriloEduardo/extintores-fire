<?php
session_start();

require_once("../../models/Clientes.class.php");

$u = new Clientes($_SESSION['sudo_su']);
$data = json_decode(file_get_contents("php://input"));
echo json_encode($u->delete($data->id));
?>