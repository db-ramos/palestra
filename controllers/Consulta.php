<?php
//implementa funções genéricas de CRUD

require_once 'Conexao.php';

class Consulta{
	private $conexao;
	private $stmt;
	private $resultado;	//guarda o resultado vindo do banco
	private $vet_objetos; //para select - organiza o retorno em um vetor de objetos
	private $last_insert_id; //para insert - id atribuido ao último insert realizado
	
	public function __construct(){
		$this->vet_objetos = array();
		$this->conexao = Conexao::getInstance();	
		//codificar para UTF-8, tornar caracteres especiais compatíveis com o JSON
		$this->conexao->query("SET NAMES 'utf8'");
		$this->conexao->query('SET character_set_connection=utf8');
		$this->conexao->query('SET character_set_client=utf8');
		$this->conexao->query('SET character_set_results=utf8');
	}
	
	//executa uma consulta simples no banco
	private function query($sql){
		$this->conexao = Conexao::getInstance();
		$this->resultado = $this->conexao->query($sql); //executa a consulta $sql
	}
	
	protected function selectObjects(string $sql){
		$this->query($sql);
		$this->vet_objetos=array();
		if($this->resultado != null and $this->resultado->num_rows > 0){			
			while ($obj = $this->resultado->fetch_object() ) {
			 $this->vet_objetos[] = $obj;
			}
		}
		return $this->vet_objetos;				
	}

	protected function selectObject(string $sql){
		$obj = null;
		$this->query($sql);
		if($this->resultado!=null and $this->resultado->num_rows > 0){
			$obj = $this->resultado->fetch_object();
		}
		return $obj;				
	}


	protected function insert($sql){
		$this->query($sql);

		if(!$this->resultado or $this->conexao->affected_rows !=1){
			//echo "erro durante insert <br> erro em: $sql";
			return 0;
		}
		else{
			//echo "Cadastro realizado com sucesso.";
			$sql = "SELECT LAST_INSERT_ID()";
			$this->query($sql);
			$this->last_insert_id = $this->resultado->fetch_row()[0];
			return 1;
		}
	}

	public function getLastInsertId()
	{
		return $this->last_insert_id;
	}

	protected function update($sql){
		$this->query($sql);
		if(!$this->resultado or $this->conexao->affected_rows <1){
			//echo "erro durante alteração<br> erro em: $sql";
			return 0;
		}	
		else{
			//echo "alteração realizada com sucesso";
			return $this->conexao->affected_rows;
		}
	}

	protected function delete($sql){
		return $this->update($sql); //mesmo princípio
	}


	//converte tupla em JSON // usando em webservice
	protected function gerarJSON(){
		//converte o conteúdo do array associativo para uma string JSON
		header('Content-Type: text/html; charset=utf-8');
		$json_format = json_encode($this->vet_objetos);
		//imprime a string JSON para consumo
		echo "$json_format";
	}
	

	// retorna um hash com 20 caracteres,
	// usado para criar o token 
	public function codificar($var)
	{
		return crypt($var,'_DG..8REA'); 
	}

	protected function limpar($campo) {
		$regex = '/(from|select|insert|delete|where|drop table|show tables|=|#|*|--|\\\\)/i';
		$sql = preg_replace($regex,"",$campo);
		$sql = trim($campo);
		$sql = strip_tags($campo);
		$sql = addslashes($campo);
		  
		return $sql;            
	}
	   
}
?>