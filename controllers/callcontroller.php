<?php

class CallController extends Controller{
	
	private $security = false;
	private $scanner;
	private $pathFunctions; 
	private $pathPages;
	
	function pg(){

		$this -> pathPages = "views/";
		$this -> pathFunctions = "models/";
		
		$this->scanner = new ScannerModule();
		
		$pages = array($this->_model);
		$scanner = ScannerModule::getInstance();
		foreach ($pages as $pg){
			$pg = strtolower($pg);
			if($scanner->existModule($pg)){
				require_once($this -> pathPages . $pg  . '/view.php');
				$elements = new $pg();

 				if($scanner->existMethod($pg, 'getElement')){	
 					echo $this->draw($elements->getElement($this->_params, $this->security, $this->_publickey, $this->_connection), $this->_publickey);
 				}
			}else{
				$this->errorElement();
			}
		}
	}
	
	function ft(){

		$functions = array($this->_model);
		
		if($this->security){
			
			$security = new Security();
			
			foreach ($_POST as $key=>$value){
				$_POST[$security->decrypt($key, $this->_publickey)] = $value;
			}
			
		}
		
		$scanner = ScannerModule::getInstance();
		foreach ($functions as $funct){
			$funct = strtolower($funct);
			if($scanner->existFunction($funct)){
				$elements = new $funct();
				if($scanner->existMethod($funct, 'executeFuntion')){
					$elements->executeFuntion($this->_params, $this->_connection, $this->_publickey);
				}
			}else{
				$this->errorElement();
			}
		}
	}
	
	function ws(){
	
		$pages = array($this->_model);
	
		$scanner = ScannerModule::getInstance();
		foreach ($webservices as $ws){
			$ws = strtolower($ws);
			if($scanner->existModule($ws)){
				require_once(MODULE . DS . 'ws_' . $ws . DS . 'webservice.php');
// 				$elements = new $ws();
// 				if($scanner->existMethod($module, 'getElement')){
// 					echo $this->draw($elements->getElement($this->_params, $this->_connection));
// 				}
			}else{
				$this->errorElement();
			}
		}
	}
}

?>