<?php

class Conexao {

	public static $instance; 
	
	private static $host 	  = "localhost";
	private static $user 	  = "root"; //criar usuário no banco de dados
	private static $password  = ""; //senha do usuário
	private static $database  = "bd_evento"; //banco de dados

	private function __construct() {
		// 
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {			
			self::$instance = new mysqli(self::$host,self::$user, self::$password, self::$database);
		}
		return self::$instance;
	}
}

//$conexao = Conexao::getInstance(); // testar a conexão com o bd
?>