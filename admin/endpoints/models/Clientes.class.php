<?php
require_once("Conexao.class.php");
require_once("Logs.class.php");

/**
* Classe responsavel por incluir novos usuarios
*/
class Clientes extends Conexao{

	protected $pdo;
	protected $id_user;

	public $nome;
	public $representante;
	public $cnpj;
	public $insc_estadual;
	public $endereco;
	public $numero;
	public $complemento;
	public $bairro;
	public $cidade;
	public $estado;
	public $cep;
	public $comprador;
	public $fone;
	public $celular;
	public $email;
	public $filename;

	function __construct($_id_user){
		$this->id_user = $_id_user;
		$this->pdo = parent::getDB();
	}

	public function setDados($_nome, $_representante, $_cnpj, $_insc_estadual, $_endereco, $_numero, $_complemento, $_bairro, $_cidade, $_estado, $_cep, $_comprador, $_fone, $_celular, $_email, $_filename){
		$this->nome = $_nome;
		$this->representante = $_representante;
		$this->cnpj = $_cnpj;
		$this->insc_estadual = $_insc_estadual;
		$this->endereco = $_endereco;
		$this->numero = $_numero;
		$this->complemento = $_complemento;
		$this->bairro = $_bairro;
		$this->cidade = $_cidade;
		$this->estado = $_estado;
		$this->cep = $_cep;
		$this->comprador = $_comprador;
		$this->fone = $_fone;
		$this->celular = $_celular;
		$this->email = $_email;
		$this->filename = $_filename;
	}

	public function cadastrar(){

		$cadastrar = $this->pdo->prepare("INSERT INTO clientes (Nome, Endereco, Numero, Complemento, Bairro, Cidade, Cep, Fone, Celular, Cnpj, Insc_Estadual, Representante, Email, Foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$cadastrar->bindValue(1, $this->nome);
		$cadastrar->bindValue(2, $this->endereco);
		$cadastrar->bindValue(3, $this->numero);
		$cadastrar->bindValue(4, $this->complemento);
		$cadastrar->bindValue(5, $this->bairro);
		$cadastrar->bindValue(6, $this->cidade);
		$cadastrar->bindValue(7, $this->cep);
		$cadastrar->bindValue(8, $this->fone);
		$cadastrar->bindValue(9, $this->celular);
		$cadastrar->bindValue(10, $this->cnpj);
		$cadastrar->bindValue(11, $this->insc_estadual);
		$cadastrar->bindValue(12, $this->representante);
		$cadastrar->bindValue(13, $this->email);
		$cadastrar->bindValue(14, $this->filename);

		$cadastrar->execute();

		$logs = new Logs;
		$logs->setDados('Criou um novo cliente com o nome: ' . $this->nome, $this->id_user);
		$logs->cadastrar();

		if($this->pdo->lastInsertId()){
			// Criado com sucesso!
			return true;
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM clientes");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM clientes WHERE Id_Cliente = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

		$logs = new Logs;
		$logs->setDados('Deletou um cliente de nome: ' . $this->nome, $this->id_user);
		$logs->cadastrar();

		return $delete->rowCount();
	}

	public function editar($_id){
		$editar = $this->pdo->prepare("UPDATE clientes SET Nome = ?, Endereco = ?, Numero = ?, Complemento = ?, Bairro = ?, Cidade = ?, Cep = ?, Fone = ?, Celular = ?, Cnpj = ?, Insc_Estadual = ?, Representante = ?, Email = ?, Foto = ? WHERE Id_Cliente = ?");

		$editar->bindValue(1, $this->nome);
		$editar->bindValue(2, $this->endereco);
		$editar->bindValue(3, $this->numero);
		$editar->bindValue(4, $this->complemento);
		$editar->bindValue(5, $this->bairro);
		$editar->bindValue(6, $this->cidade);
		$editar->bindValue(7, $this->cep);
		$editar->bindValue(8, $this->fone);
		$editar->bindValue(9, $this->celular);
		$editar->bindValue(10, $this->cnpj);
		$editar->bindValue(11, $this->insc_estadual);
		$editar->bindValue(12, $this->representante);
		$editar->bindValue(13, $this->email);
		$editar->bindValue(14, $this->filename);
		$editar->bindValue(15, $_id);
		$editar->execute();

		$logs = new Logs;
		$logs->setDados('Editou um cliente de nome: ' . $this->nome, $this->id_user);
		$logs->cadastrar();

		return $editar->rowCount();
	}
}
?>