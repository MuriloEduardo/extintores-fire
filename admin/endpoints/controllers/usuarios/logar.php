<?php
session_start();

require_once("../../models/Login.class.php");

$data  = json_decode(file_get_contents("php://input"));
$login = filter_var($data->login, FILTER_SANITIZE_MAGIC_QUOTES);
$senha = filter_var($data->senha, FILTER_SANITIZE_MAGIC_QUOTES);

if (!empty($login) && !empty($senha)) {

	$l = new Login;
	$l->setDados($login, md5($senha));
	$res_login = $l->logar();
	
	if($res_login){
        echo json_encode($res_login);
    }else{
        echo 0;
    }
}
?>