<?php
require_once("Conexao.class.php");

/**
* Essa classe sera responsavel por todo o crud da aba de Nine Box
* Alterar configurações e mostrar configurações
*
* @param Está em __construct o ID do usuario que está na sessão
*/
class NineBox extends Conexao{

	protected $pdo;
	protected $id_usuario;

	private $layout = array();
	public $conf    = array();

	function __construct($_id_usuario){
		$this->id_usuario = $_id_usuario;
		$this->pdo        = parent::getDB();

		$this->verificaExistencia();
	}

	/**
	* @param Array de informações do layout
	*/
	public function setLayout($layout){
		
		// Seta vetical
		$this->layout["seta_up_titulo"]        = $layout["seta_up_titulo"];
		$this->layout["seta_up_sub_titulo"]    = $layout["seta_up_sub_titulo"];
		
		// Seta horizontal
		$this->layout["seta_right_titulo"]     = $layout["seta_right_titulo"];
		$this->layout["seta_right_sub_titulo"] = $layout["seta_right_sub_titulo"];

		// Box B1
		$this->layout["desc_B1"]  = $layout["desc_B1"];
		$this->layout["color_B1"] = $layout["color_B1"];

		// Box B2
		$this->layout["desc_B2"]  = $layout["desc_B2"];
		$this->layout["color_B2"] = $layout["color_B2"];

		// Box B3
		$this->layout["desc_B3"]  = $layout["desc_B3"];
		$this->layout["color_B3"] = $layout["color_B3"];

		// Box B4
		$this->layout["desc_B4"]  = $layout["desc_B4"];
		$this->layout["color_B4"] = $layout["color_B4"];

		// Box B5
		$this->layout["desc_B5"]  = $layout["desc_B5"];
		$this->layout["color_B5"] = $layout["color_B5"];

		// Box B6
		$this->layout["desc_B6"]  = $layout["desc_B6"];
		$this->layout["color_B6"] = $layout["color_B6"];

		// Box B7
		$this->layout["desc_B7"]  = $layout["desc_B7"];
		$this->layout["color_B7"] = $layout["color_B7"];

		// Box B8
		$this->layout["desc_B8"]  = $layout["desc_B8"];
		$this->layout["color_B8"] = $layout["color_B8"];

		// Box B9
		$this->layout["desc_B9"]  = $layout["desc_B9"];
		$this->layout["color_B9"] = $layout["color_B9"];
	}

	public function setConf($conf){

		// Nota1 Baixo
		$this->conf["nota1_de1"]  = $conf["nota1_de1"];
		$this->conf["nota1_ate1"] = $conf["nota1_ate1"];

		// Nota1 Médio
		$this->conf["nota1_de2"]  = $conf["nota1_de2"];
		$this->conf["nota1_ate2"] = $conf["nota1_ate2"];

		// Nota1 Alto
		$this->conf["nota1_de3"]  = $conf["nota1_de3"];
		$this->conf["nota1_ate3"] = $conf["nota1_ate3"];

		// Nota2 Baixo
		$this->conf["nota2_de1"]  = $conf["nota2_de1"];
		$this->conf["nota2_ate1"] = $conf["nota2_ate1"];

		// Nota2 Médio
		$this->conf["nota2_de2"]  = $conf["nota2_de2"];
		$this->conf["nota2_ate2"] = $conf["nota2_ate2"];

		// Nota2 Alto
		$this->conf["nota2_de3"]  = $conf["nota2_de3"];
		$this->conf["nota2_ate3"] = $conf["nota2_ate3"];
	}

	public function getLayout($attr){
		return $this->layout[$attr];
	}

	public function getConf($attr){
		return $this->conf[$attr];
	}

	public function getUsuario(){
		return $this->id_usuario;
	}

	protected function verificaExistencia(){
		
		$verifica = $this->pdo->prepare("SELECT * FROM configuracoes WHERE id_usuario = ?");
		$verifica->bindValue(1, $this->getUsuario());
		$verifica->execute();

		if(!$verifica->rowCount()){
			$this->create();
		}
	}

	public function create(){

		$first = $this->pdo->prepare("INSERT INTO configuracoes (id_usuario, dtcadastro, dtalteracao) VALUES (?, NOW(), NOW())");
		$first->bindValue(1, $this->getUsuario());
		$first->execute();
	}

	public function updateLayout($_id){
		
		$update = $this->pdo->prepare("UPDATE configuracoes SET 
		seta_up_titulo        = ?,
		seta_up_sub_titulo    = ?,
		seta_right_titulo     = ?,
		seta_right_sub_titulo = ?,
		desc_B1  = ?,
		color_B1 = ?,
		desc_B2  = ?,
		color_B2 = ?,
		desc_B3  = ?,
		color_B3 = ?,
		desc_B4  = ?,
		color_B4 = ?,
		desc_B5  = ?,
		color_B5 = ?,
		desc_B6  = ?,
		color_B6 = ?,
		desc_B7  = ?,
		color_B7 = ?,
		desc_B8  = ?,
		color_B8 = ?,
		desc_B9  = ?,
		color_B9 = ?, 
		dtalteracao = NOW()
		WHERE id = ?");
		$update->bindValue(1, $this->getLayout('seta_up_titulo'));
		$update->bindValue(2, $this->getLayout('seta_up_sub_titulo'));
		$update->bindValue(3, $this->getLayout('seta_right_titulo'));
		$update->bindValue(4, $this->getLayout('seta_right_sub_titulo'));
		$update->bindValue(5, $this->getLayout('desc_B1'));
		$update->bindValue(6, $this->getLayout('color_B1'));
		$update->bindValue(7, $this->getLayout('desc_B2'));
		$update->bindValue(8, $this->getLayout('color_B2'));
		$update->bindValue(9, $this->getLayout('desc_B3'));
		$update->bindValue(10, $this->getLayout('color_B3'));
		$update->bindValue(11, $this->getLayout('desc_B4'));
		$update->bindValue(12, $this->getLayout('color_B4'));
		$update->bindValue(13, $this->getLayout('desc_B5'));
		$update->bindValue(14, $this->getLayout('color_B5'));
		$update->bindValue(15, $this->getLayout('desc_B6'));
		$update->bindValue(16, $this->getLayout('color_B6'));
		$update->bindValue(17, $this->getLayout('desc_B7'));
		$update->bindValue(18, $this->getLayout('color_B7'));
		$update->bindValue(19, $this->getLayout('desc_B8'));
		$update->bindValue(20, $this->getLayout('color_B8'));
		$update->bindValue(21, $this->getLayout('desc_B9'));
		$update->bindValue(22, $this->getLayout('color_B9'));
		$update->bindValue(23, $_id);
		$update->execute();

		return $update->rowCount();
	}

	public function updateConf($_id){

		$update = $this->pdo->prepare("UPDATE configuracoes SET 
		nota1_de1  = ?,
		nota1_ate1 = ?,
		nota1_de2  = ?,
		nota1_ate2 = ?,
		nota1_de3  = ?,
		nota1_ate3 = ?,
		nota2_de1  = ?,
		nota2_ate1 = ?,
		nota2_de2  = ?,
		nota2_ate2 = ?,
		nota2_de3  = ?,
		nota2_ate3 = ?,
		dtalteracao = NOW()
		WHERE id = ?");
		$update->bindValue(1, $this->getConf('nota1_de1'));
		$update->bindValue(2, $this->getConf('nota1_ate1'));
		$update->bindValue(3, $this->getConf('nota1_de2'));
		$update->bindValue(4, $this->getConf('nota1_ate2'));
		$update->bindValue(5, $this->getConf('nota1_de3'));
		$update->bindValue(6, $this->getConf('nota1_ate3'));
		$update->bindValue(7, $this->getConf('nota2_de1'));
		$update->bindValue(8, $this->getConf('nota2_ate1'));
		$update->bindValue(9, $this->getConf('nota2_de2'));
		$update->bindValue(10, $this->getConf('nota2_ate2'));
		$update->bindValue(11, $this->getConf('nota2_de3'));
		$update->bindValue(12, $this->getConf('nota2_ate3'));
		$update->bindValue(13, $_id);
		$update->execute();

		return $update->rowCount();
	}

	public function findAll(){

		$findAll = $this->pdo->prepare("SELECT * FROM configuracoes WHERE id_usuario = ?");
		$findAll->bindValue(1, $this->getUsuario());
		$findAll->execute();

		return parent::utf8ize($findAll->fetchAll());
	}

	public function find($_id){
		
		$find = $this->pdo->prepare("SELECT * FROM configuracoes WHERE id = ?");
		$find->bindValue(1, $_id);
		$find->execute();

		return $find->fetch();
	}

	public function delete($_id){
		$delete = $this->pdo->prepare("DELETE FROM configuracoes WHERE id = ?");
		$delete->bindValue(1, $_id);
		$delete->execute();

		return $delete->rowCount();
	}
}
?>