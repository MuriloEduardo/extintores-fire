<?php
session_start();

require_once("../../models/Usuarios.class.php");

$u = new Usuarios($_SESSION['sudo_su']);
$data = json_decode(file_get_contents("php://input"));
echo json_encode($u->delete($data->id));
?>