<?php 

Class SecurityClass{

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
		
		$classOpen = array('iniciarprocesamiento', 'session', 'registro', 'inicio', 'restaurar');
		
		return $classOpen;
	}
}

?>