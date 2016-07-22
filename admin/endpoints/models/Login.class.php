<?php
require_once("Conexao.class.php");
require_once("Logs.class.php");

/**
* Classe responsavel pelo Login
*/
class Login extends Conexao{

	public $login;
	public $senha;
	public $remember;
	private $pdo;

	function __construct(){
		$this->pdo = parent::getDB();
		$this->remember = md5('sudo_' . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
	}

	public function setDados($_login, $_senha){
		$this->login = $_login;
		$this->senha = $_senha;
	}

	public function logar(){

		$logar = $this->pdo->prepare("SELECT * FROM usuarios WHERE Login = ? AND Senha = ?");
		$logar->bindValue(1, $this->login);
		$logar->bindValue(2, $this->senha);
		$logar->execute();

		if($logar->rowCount()){

			$dados = $logar->fetch(PDO::FETCH_OBJ);

			setcookie("_token", $this->remember, time() + (86400 * 30), "/");

			$_SESSION['sudo_su']     = $dados->Id_Usuario;
			$_SESSION['sudo_email']  = $dados->Login;
			$_SESSION['sudo_nome']   = $dados->Nome;
			$_SESSION['sudo_logado'] = true;

			$logs = new Logs;
			$logs->setDados('Se logou no sistema', $dados->Id_Usuario);
			$logs->cadastrar();

			return $dados;
		}else{
			return false;
		}
	}
}
?>