<?php 

Class Session{

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
		
		@session_start();
		
		//$this->info = explode("-", $info[0]);
		$this->info = $info;
		$this->connection = $connection;
		$this->publicKey = $publickey;

		$response = false;
		
		if($this->info[0] == "login"){
			$response = $this->validateUser();
			
			if($response){
				header("location: index.php?url=cargarinfo/pg/sininfo");
			}else{
				header("location: index.php?url=inicio/pg/message->validate");
			}
				
		}else if($this->info[0] == "logout"){
			$response = $this->closeSession();
			
			header("location: index.php?url=inicio/pg/");
			
		}else if($this->info[0] == "validate"){
			$response = $this->validateSession();
		}else if($this->info[0] == 'confirmRegistration'){
				
			$response = $this->confirmRegistration($this->info[1]);

			if($response){
				header("location: index.php?url=cargarinfo/pg/sininfo");
			}else{
				header("location: index.php?url=inicio/pg/message->validate");
			}
			
		}else if($this->info[0] == 'restartPassword'){
			
			$response = $this->confirmRestart($this->info[1]);

			if(!$response){
				header("location: index.php?url=inicio/pg/message->validatePass->false");
			}else{
				header("location: index.php?url=inicio/pg/message->validatePass->true/" . $this->info[1]);
			}
		}
		
		return $response;
	}
	
	
	private function validateUser(){
		
		$response = $this->connection->select('users', array('name', 'lastname', 'status', 'id'),  array('AND' => array(
        'email' => $_POST['usuario'], 'password' => $_POST['contrasena'])));

		if(count($response) > 0 && $response != false){
			
			if(isset($response[0]['name']) && $response[0]['name'] != "" && isset($response[0]['lastname']) && $response[0]['lastname'] != ""){
				
				$username = $response[0]['name'] . " " . $response[0]['lastname'];
				$status = $response[0]['status'];
				$id = $response[0]['id'];
				
				$this->createSession($username, $status, $id);
				
				return true;
			}
				
		}
		
		return false;

	}
	
	private function createSession($username, $status, $id){
			
		$time = '1000M';
		$date = new DateTime();	
		$date->setTimezone(new DateTimeZone('America/Bogota'));		
		$date->add(new DateInterval('PT'.$time));
		
		$_SESSION['expiration'] = $date->getTimestamp();	
		$_SESSION['username']= $username;
		$_SESSION['status'] = $status;
		$_SESSION['id'] = $id;
		
	}
	
	private function closeSession(){
		
		session_destroy();
		
	}
	
	private function validateSession(){
	
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Bogota'));
		if( isset($_SESSION['expiration']) && isset($_SESSION['username']) ){
			if($date->getTimestamp() < $_SESSION['expiration']){
				return true;
			}
		}
			
		$this->closeSession();
		
		return false;
	}
	
	private function confirmRegistration($token){
		
		$response = $this->connection->select('users', array('name' , 'lastname', 'id'),  array('AND' => array(
        'status' => 'FALSE', 'token' => $token)));
		
		if(count($response) > 0 && $response != false){
			
			if(isset($response[0]['name']) && $response[0]['name'] != "" && isset($response[0]['lastname']) && $response[0]['lastname'] != ""){
			
				$username = $response[0]['name'] + " " + $response[0]['lastname'];
				$status = true;
				$id = $response[0]['id'];
				
				$this->createSession($username, $status, $id);
				
				$response = $this->connection->update('users', array('status' => 'TRUE' ),  array('AND' => array('token' => $token)));
	
				return true;
				
			}
			
		}
		
		return false;
	}
	
	private function confirmRestart($token){
		
		$response = $this->connection->select('restart_password', array('token'),  array('AND' => array(
        'status' => 'TRUE', 'token' => $token)));
		
		if(count($response) > 0 && $response != false){
			
			return true;
				
		}
		
		return false;

	}
}

?>