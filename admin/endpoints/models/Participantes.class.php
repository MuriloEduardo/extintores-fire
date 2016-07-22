<?php
require_once("Conexao.class.php");

/**
* Classe responsável por todas ações dos participantes
*/
class Participantes extends Conexao{

	protected $pdo;
	protected $id_usuario;

	private $nome;
	private $cargo;
	private $nota1;
	private $nota2;

	function __construct($_id_usuario){
		$this->id_usuario = $_id_usuario;
		$this->pdo = parent::getDB();
	}

	public function setDados($_nome, $_cargo, $_nota1, $_nota2){
		$this->nome  = $_nome;
		$this->cargo = $_cargo;
		$this->nota1 = $_nota1;
		$this->nota2 = $_nota2;
	}

	public function getNome(){
		return $this->nome;
	}

	public function getCargo(){
		return $this->cargo;
	}

	public function getNota1(){
		return $this->nota1;
	}

	public function getNota2(){
		return $this->nota2;
	}

	public function getUsuario(){
		return $this->id_usuario;
	}

	public function cadastrar(){

		// Se nao cadastra novo participante
		$cadastrar = $this->pdo->prepare("INSERT INTO participantes (id_usuario, cargo, nome, nota1, nota2) VALUES (?, ?, ?, ?, ?)");
		$cadastrar->bindValue(1, $this->getUsuario());
		$cadastrar->bindValue(2, $this->getCargo());
		$cadastrar->bindValue(3, $this->getNome());
		$cadastrar->bindValue(4, $this->getNota1());
		$cadastrar->bindValue(5, $this->getNota2());
		$cadastrar->execute();

		if($this->pdo->lastInsertId() != 0){

			// 1 = Criado com sucesso!
			return 1;
		}else{

			// 2 = Erro interno
			return 2;
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM participantes WHERE id_usuario = ?");
		$findAll->bindValue(1, $this->getUsuario());
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function find($_id){
		
		$find = $this->pdo->prepare("SELECT * FROM participantes WHERE id = ?");
		$find->bindValue(1, $_id);
		$find->execute();

		return $find->fetch();
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM participantes WHERE id = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

		return $delete->rowCount();
	}

	public function update($_id){
		$update = $this->pdo->prepare("UPDATE participantes SET nome = ?, email = ?, sexo = ?, nota_competencia = ?, nota_meta = ? WHERE id = ?");
		$update->bindValue(1, $this->getNome());
		$update->bindValue(2, $this->getEmail());
		$update->bindValue(3, $this->getSexo());
		$update->bindValue(4, $this->getNotaCompetencia());
		$update->bindValue(5, $this->getNotaMeta());
		$update->bindValue(6, $_id);
		$update->execute();

		return $update->rowCount();
	}
}
?>