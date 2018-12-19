<?php 
	// OBS: spl_autoload_register(); Passando Função Anônima
	spl_autoload_register(function($class_name){
		$filename = $class_name.".php";

		//NÃO CARREGOU A CLASSE SQL DA PASTA (assets/dao/Sql.php)
		// if (file_exists(($filename))) {
		// 	require_once($filename);
		// }

		//Inclui a Classe Sql da pasta (assets/dao/Sql.php)
		if (file_exists("assets/dao/class". DIRECTORY_SEPARATOR .$filename) === true) {
      require_once("assets/dao/class". DIRECTORY_SEPARATOR .$filename);
    }

	});
?>