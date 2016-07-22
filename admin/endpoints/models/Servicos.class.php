<?php
require_once("Conexao.class.php");
require_once("Logs.class.php");

/**
* Classe responsavel por incluir novos usuarios
* TABLE SERVICOS: Id_Servico, Id_Cliente, tpServico, Id_Administrador, Data_Cadastro, Valor_Total;
* TABLE ITEM_SERVICO: Id_Item_Servico, Id_Servico, Quantidade, Unitario, Valor;
*/
class Servicos extends Conexao{

	protected $pdo;
	protected $id_user;

	public $id_cliente;
	public $tpServico;
	public $valor_total;
	public $obs;

	function __construct($_id_user){
		$this->id_user = $_id_user;
		$this->pdo = parent::getDB();
	}

	public function setDados($_id_cliente, $_tpServico, $_valor_total, $_obs){
		$this->id_cliente = $_id_cliente;
		$this->tpServico = $_tpServico;
		$this->valor_total = $_valor_total;
		$this->obs = $_obs;
	}

	protected function tpServico($tp) {
		if($tp == '1'){
			return 'Pedido';
		}else{
			return 'Orcamento';
		}
	}

	public function cadastrar(){

		$cadastrar = $this->pdo->prepare("INSERT INTO servicos (Id_Cliente, tpServico, Id_Administrador, Valor_Total, observacao) VALUES (?, ?, ?, ?, ?)");
		$cadastrar->bindValue(1, $this->id_cliente);
		$cadastrar->bindValue(2, $this->tpServico);
		$cadastrar->bindValue(3, $this->id_user);
		$cadastrar->bindValue(4, $this->valor_total);
		$cadastrar->bindValue(5, $this->obs);

		$cadastrar->execute();

		$logs = new Logs;
		$logs->setDados('Criou um novo servico do tipo: ' . $this->tpServico($this->tpServico) . ', no valor de: R$' . $this->valor_total, $this->id_user);
		$logs->cadastrar();

		if($this->pdo->lastInsertId()){
			// Criado com sucesso!
			return $this->pdo->lastInsertId();
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("
		SELECT * 
		FROM servicos AS srv
		 
		INNER JOIN clientes AS clt
		ON srv.Id_Cliente = clt.Id_Cliente 

		INNER JOIN usuarios AS usr
		ON srv.Id_Administrador = usr.Id_Usuario");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM servicos WHERE Id_Servico = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

		$logs = new Logs;
		$logs->setDados('Deletou um servico do tipo: ' . $this->tpServico($this->tpServico) . ', no valor de: R$' . $this->valor_total, $this->id_user);
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
		$logs->setDados('Editou um servico do tipo: ' . $this->tpServico($this->tpServico) . ', no valor de: R$' . $this->valor_total, $this->id_user);
		$logs->cadastrar();

		return $editar->rowCount();
	}
}
?>