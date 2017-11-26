<?php

class ScannerModule {

	static private $instance = null;
	
	private $pathPages;
	private $pathFunctions;
	private $module;
	private $webservice;

	
	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new ScannerModule();
		}
		return self::$instance;
	}
	
	public function __construct() {
		$this -> pathPages = "views/";
		$this -> pathFunctions = "models/";
		$this -> module = array();
		$this -> webservice = array();
	}

	function existMethod($class, $method){
		get_class_methods($class);
		foreach (get_class_methods($class) as $search){
			if($search == $method){
				return true;
			}
		}
		return false;
	}
		
	function allModules() {
		$directory = opendir($this -> pathPages);

		if (is_dir($this -> pathPages)) {
			if ($directory = opendir($this -> pathPages)) {
				while (($file = readdir($directory)) !== false) {
					if (is_dir($this -> pathPages . $file) && $file != "." && $file != "..") {
						$segment = explode("_", $file);
						if ($segment[0] == "pg") {
							array_push($this -> module, $file);
						}
					}
				}
				closedir($directory);
			}
		}
		
		return $this -> module;
	}
	
	function allServices() {
		$directory = opendir($this -> path);
	
		if (is_dir($this -> path)) {
			if ($directory = opendir($this -> path)) {
				while (($file = readdir($directory)) !== false) {
					if (is_dir($this -> path . $file) && $file != "." && $file != "..") {
						$segment = explode("_", $file);
						if ($segment[0] == "ws") {
							array_push($this -> webservice, $file);
						}
					}
				}
				closedir($directory);
			}
		}
	
		return $this -> webservice;
	}
	
	function allFunctions() {
		$directory = opendir($this -> pathFunctions);
	
		if (is_dir($this -> pathFunctions)) {
			if ($directory = opendir($this -> pathFunctions)) {
				while (($file = readdir($directory)) !== false) {
					if (is_dir($this -> pathFunctions . $file) && $file != "." && $file != "..") {
						array_push($this -> webservice, $file);
					}
				}
				closedir($directory);
			}
		}
	
		return $this -> webservice;
	}
	
	function existModule($name) {
		$directory = opendir($this -> pathPages);
	
		if (is_dir($this -> pathPages)) {
			if ($directory = opendir($this -> pathPages)) {
				while (($file = readdir($directory)) !== false) {
					if (is_dir($this -> pathPages . $file) && $file != "." && $file != "..") {
						if($file == $name){
							closedir($directory);
							return true;
						}
					}
				}
				closedir($directory);
				return false;
			}
		}
	}
	
	function existWebService($name) {
		$directory = opendir($this -> path);
	
		if (is_dir($this -> path)) {
			if ($directory = opendir($this -> path)) {
				while (($file = readdir($directory)) !== false) {
					if (is_dir($this -> path . $file) && $file != "." && $file != "..") {
						$segment = explode("_", $file);
						if ($segment[0] == "ws") {
							if($segment[1]== $name){
								closedir($directory);
								return true;
							}
						}
					}
				}
				closedir($directory);
				return false;
			}
		}
	}
	
	function existFunction($name) {
		$directory = opendir($this -> pathFunctions);
	
		if (is_dir($this -> pathFunctions)) {
			if ($directory = opendir($this -> pathFunctions)) {
				while (($file = readdir($directory)) !== false) {
					if (is_dir($this -> pathFunctions . $file) && $file != "." && $file != "..") {
						if($file == $name){
							closedir($directory);
							return true;
						}
					}
				}
				closedir($directory);
				return false;
			}
		}
	}
}

?>