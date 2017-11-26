<?php 

Class PostProcesar{

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

	public function executeFuntion($info, $connection = "" , $publickey = ""){
		
		$this->info = $info;
		
		$this->connection = $connection;
		$this->publicKey = $publickey;
		
		return $this->readModel();
		
	}
	
	private function  readModel(){
	
		require 'ReadFiles.class.php';
		$read = new ReadFiles();
	
		$result['out'] = (array) $read->readOut(MY_FOLDER . DS . "files" . DS . $this->info['folder'] . DS . "Report" . DS . $this->info['markerName'] . ".out");
		$result['model'] = (array) $read->readModel(MY_FOLDER . DS . "files" . DS . $this->info['folder'] . DS . "Report" . DS . $this->info['markerName'] . ".model");
	
		return $result;
			
	}
	
}

?>