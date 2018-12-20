<?php 
	class Usuario {
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}

		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}

		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}

		//Lista Usuário correspodente ao seu ID especificado
		public function loadById($id){
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios_dois WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			//Validar os registros: count ou isset
			// if (isset($results[0])){};

			if (count($results) > 0){
				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
			}
		}//End: loadById

		//Listar todos os Usuários da Tabela
		public static function getList(){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios_dois ORDER BY idusuario;");
		}//End: getList

		//Faz uma busca de Usuario
		public static function search($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios_dois WHERE deslogin LIKE :SEARCH ORDER BY idusuario", array(
				':SEARCH'=>"%".$login."%"
			));
		}//End: search

		//Obter dados do usuário Autenticado, tem que passar os dois parametros Login e Senha
		public function login($login, $password){
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios_dois WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));

			//Validar os registros: count ou isset
			// if (isset($results[0])){};

			if (count($results) > 0){
				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
			}else{
				throw new Exception("Login e/ou senha inválidos.");
			}

		}//End: login

		public function __toString(){
			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		}

	}//End: class Usuario

?>