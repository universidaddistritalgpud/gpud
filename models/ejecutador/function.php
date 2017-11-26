<?php 

Class Ejecutador{

	private $elements;
	private $module;
	private $info;
	private $connection;
	private $security;
	private $publicKey;

	function __construct(){

		$this->module = array_pop(explode("/", dirname(__FILE__)));
		$this->elements = array();
		$this->security = new Security();
	}

	public function executeFuntion($info, $connection, $publickey){
		$this->info = $info;
		$this->connection = $connection;
		$this->publicKey = $publickey;

		shell_exec("sh " . $info . "> /dev/null 2>/dev/null &");		
	}
	
}

?>