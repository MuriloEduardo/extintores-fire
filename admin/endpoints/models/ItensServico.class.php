<?php
require_once("Conexao.class.php");
require_once("Logs.class.php");

/**
* Classe responsavel por incluir novos usuarios
* TABLE SERVICOS: Id_Servico, Id_Cliente, tpServico, Id_Administrador, Data_Cadastro, Valor_Total;
* TABLE ITEM_SERVICO: Id_Item_Servico, Id_Servico, Quantidade, Unitario, Valor;
*/
class ItensServico extends Conexao{

	protected $pdo;
	protected $id_user;

	public $id_servico;
	public $id_produto;
	public $quantidade;
	public $unitario;
	public $valor;

	function __construct($_id_user){
		$this->id_user = $_id_user;
		$this->pdo = parent::getDB();
	}

	public function setDados($_id_servico, $_id_produto, $_quantidade, $_unitario, $_valor){
		$this->id_servico = $_id_servico;
		$this->id_produto = $_id_produto;
		$this->quantidade = $_quantidade;
		$this->unitario = $_unitario;
		$this->valor = $_valor;
	}

	public function cadastrar(){

		$cadastrar = $this->pdo->prepare("INSERT INTO itens_servico (Id_Servico, Id_Produto, Quantidade, Unitario, Valor) VALUES (?, ?, ?, ?, ?)");
		$cadastrar->bindValue(1, $this->id_servico);
		$cadastrar->bindValue(2, $this->id_produto);
		$cadastrar->bindValue(3, $this->quantidade);
		$cadastrar->bindValue(4, $this->unitario);
		$cadastrar->bindValue(5, $this->valor);

		$cadastrar->execute();

		if($this->pdo->lastInsertId()){
			// Criado com sucesso!
			return true;
		}
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM itens_servico");
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function findNomeProduto($_id_produto){
		$find = $this->pdo->prepare("SELECT * FROM produtos WHERE Id_Produto = ?");
		$find->bindValue(1, $_id_produto);
		$find->execute();

		return parent::utf8ize($find->fetch());
	}

	public function baixaEstoque($qntde) {
		$editar = $this->pdo->prepare("UPDATE produtos SET Qtde_Atual = Qtde_Atual - {$qntde} WHERE Id_Produto = ?");
		$editar->bindValue(1, $this->id_produto);
		$editar->execute();

		$logs = new Logs;
		$logs->setDados('Baixa de ' . $this->quantidade . ' unidades no estoque do produto: ' . $this->findNomeProduto($this->id_produto)['Produto'], $this->id_user);
		$logs->cadastrar();
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM itens_servico WHERE Id_Item_Servico = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

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

		return $editar->rowCount();
	}

	public function logout(){
        if (isset($_SESSION['sudo_logado'])) {
            unset($_SESSION['sudo_logado']);
            session_destroy();
            header("Location: ./");
        }
    }
}
?>