<?php
require_once("Conexao.class.php");
require_once("Logs.class.php");

/**
* Classe responsavel por incluir novos usuarios
*/
class Produtos extends Conexao{

	protected $pdo;
	protected $id_user;

	public $produto;
	public $valor;
	public $qtde_atual;
	public $qtde_minima;

	function __construct($_id_user){
		$this->id_user = $_id_user;
		$this->pdo = parent::getDB();
	}

	public function setDados($_produto, $_valor, $_qtde_atual, $_qtde_minima){
		$this->produto = $_produto;
		$this->valor = $_valor;
		$this->qtde_atual = $_qtde_atual;
		$this->qtde_minima = $_qtde_minima;
	}

	public function cadastrar(){

		$cadastrar = $this->pdo->prepare("INSERT INTO produtos (Produto, Valor, Qtde_Atual, Qtde_Minima, Id_Usuario) VALUES (?, ?, ?, ?, ?)");
		$cadastrar->bindValue(1, $this->produto);
		$cadastrar->bindValue(2, $this->valor);
		$cadastrar->bindValue(3, $this->qtde_atual);
		$cadastrar->bindValue(4, $this->qtde_minima);
		$cadastrar->bindValue(5, $this->id_user);
		$cadastrar->execute();

		$logs = new Logs;
		$logs->setDados('Criou um novo produto com o nome: ' . $this->produto, $this->id_user);
		$logs->cadastrar();

		if($this->pdo->lastInsertId()){
			// Criado com sucesso!
			return true;
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM produtos");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM produtos WHERE Id_Produto = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

		$logs = new Logs;
		$logs->setDados('Deletou um produto de nome: ' . $this->produto, $this->id_user);
		$logs->cadastrar();

		return $delete->rowCount();
	}

	public function editar($_id){
		$editar = $this->pdo->prepare("UPDATE produtos SET Produto = ?, Valor = ?, Qtde_Atual = ?, Qtde_Minima = ? WHERE Id_Produto = ?");
		$editar->bindValue(1, $this->produto);
		$editar->bindValue(2, $this->valor);
		$editar->bindValue(3, $this->qtde_atual);
		$editar->bindValue(4, $this->qtde_minima);
		$editar->bindValue(5, $_id);
		$editar->execute();

		$logs = new Logs;
		$logs->setDados('Editou um produto de nome: ' . $this->produto, $this->id_user);
		$logs->cadastrar();

		return $editar->rowCount();
	}
}
?>