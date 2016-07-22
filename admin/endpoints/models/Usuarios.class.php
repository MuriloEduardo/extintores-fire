<?php
require_once("Conexao.class.php");
require_once("Logs.class.php");

/**
* Classe responsavel por incluir novos usuarios
*/
class Usuarios extends Conexao{

	protected $pdo;
	protected $id_user;

	public $nome;
	public $login;
	public $tipo_usuario;
	public $senha;

	function __construct($_id_user){
		$this->id_user = $_id_user;
		$this->pdo = parent::getDB();
	}

	public function setDados($_nome, $_login, $_senha, $_tipo_usuario){
		$this->nome = $_nome;
		$this->login = $_login;
		$this->tipo_usuario = $_tipo_usuario;
		$this->senha = $_senha;
	}

	public function cadastrar(){

		// Verifica se ja possui algum usuario com este email
		$cadastrar = $this->pdo->prepare("SELECT * FROM usuarios WHERE Login = ?");
		$cadastrar->bindValue(1, $this->login);
		$cadastrar->execute();

		if($cadastrar->rowCount()){
			// Já existe
			return false;
		}else{
			$cadastrar = $this->pdo->prepare("INSERT INTO usuarios (Nome, Login, Tipo_User, Senha) VALUES (?, ?, ?, ?)");
			$cadastrar->bindValue(1, $this->nome);
			$cadastrar->bindValue(2, $this->login);
			$cadastrar->bindValue(3, $this->tipo_usuario);
			$cadastrar->bindValue(4, $this->senha);
			$cadastrar->execute();

			$logs = new Logs;
			$logs->setDados('Criou um novo usuário com o nome de: ' . $this->nome . ', login: ' . $this->login, $this->id_user);
			$logs->cadastrar();

			if($this->pdo->lastInsertId()){
				// Criado com sucesso!
				return true;
			}
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM usuarios");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM usuarios WHERE Id_Usuario = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

		$logs = new Logs;
		$logs->setDados('Deletou um usuário com o nome de: ' . $this->nome . ', login: ' . $this->login, $this->id_user);
		$logs->cadastrar();

		return $delete->rowCount();
	}

	public function editar($_id){
		$editar = $this->pdo->prepare("UPDATE usuarios SET Nome = ?, Tipo_User = ?, Login = ?, Senha = ? WHERE Id_Usuario = ?");
		$editar->bindValue(1, $this->nome);
		$editar->bindValue(2, $this->tipo_usuario);
		$editar->bindValue(3, $this->login);
		$editar->bindValue(4, $this->senha);
		$editar->bindValue(5, $_id);
		$editar->execute();

		$logs = new Logs;
		$logs->setDados('Editou um usuário para o nome: ' . $this->nome . ', login: ' . $this->login, $this->id_user);
		$logs->cadastrar();

		return $editar->rowCount();
	}

	public function logout(){
        if (isset($_SESSION['sudo_logado'])) {

        	$logs = new Logs;
			$logs->setDados('Saiu no sistema', $this->id_user);
			$logs->cadastrar();

            unset($_SESSION['sudo_logado']);
            session_destroy();
            header("Location: ./");
        }
    }
}
?>