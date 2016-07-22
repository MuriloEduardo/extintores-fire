<?php
require_once("Conexao.class.php");

/**
* Classe responsável pela conexão com o banco Mysql
*/
class Logs extends Conexao{

	public $descricao;
	public $id_user;
	public $pdo;

	public function __construct(){
		$this->pdo = parent::getDB();
	}

	public function setDados($_descricao, $_id_user){
		$this->descricao = $_descricao;
		$this->id_user = $_id_user;
	}

	public function cadastrar(){
		$cadastrar = $this->pdo->prepare("INSERT INTO logs (descricao, _id_usuario) VALUES (?, ?)");
		$cadastrar->bindValue(1, $this->descricao);
		$cadastrar->bindValue(2, $this->id_user);
		$cadastrar->execute();
		
		if($this->pdo->lastInsertId()){
			// Criado com sucesso!
			return true;
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM logs INNER JOIN usuarios ON logs._id_usuario = usuarios.Id_Usuario ORDER BY _id DESC");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function findLimit(){
		$findAll = $this->pdo->prepare("SELECT * FROM logs INNER JOIN usuarios ON logs._id_usuario = usuarios.Id_Usuario ORDER BY _id DESC LIMIT 50");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}
}
?>