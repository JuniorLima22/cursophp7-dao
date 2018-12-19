<?php 
	//Essa Classe Extende da Classe PDO que já é nativa do PHP
	//Então tudo o que o PDO faz a Classe Sql também sabe fazer
	class Sql extends PDO {		
		//** Inserir no Banco de Dados **//
		private $conn;

		//Ao fazer uma Instancia de Sql ela se conectara automaticamente no Banco de dados
		public function __construct(){
			$this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");
		}//End: public function __construction()

		private function setParams($statment, $parameters = array()){
			//Associar os Parametros aos Comandos
			foreach ($parameters as $key => $value) {
				$this->setParam($key, $value);
			}

		}//End: private function setParams

		private function setParam($statment, $key, $value){
			$statment->bindParam($key, $value);
		}//End: private function setParam

		//Executa os comandos
		public function query($rawQuery, $params = array()){

			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			//Executar no Banco de dados
			$stmt->execute();
			return $stmt;

		}//End: public function query()


		//** Exibir do Banco de Dados **//

		public function select($rawQuery, $params = array()):array{

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}//End: public function select


	}//End: class Sql extends PDO
?>