<?php 

Class Registro{

	private $elements;
	private $module;
	private $info;
	private $connection;
	private $security;
	private $publicKey;
	private $token;

	function __construct(){
		$this->module = array_pop(explode("/", dirname(__FILE__)));
		$this->elements = array();
		$this->security = new Security();
	}

	public function executeFuntion($info, $connection, $publickey){
		$this->info = $info;
		$this->connection = $connection;
		$this->publicKey = $publickey;
		$this->token = substr(md5(uniqid(time())), 0, 6);
		
		$response = $this->searchUser();
		
		if(!$response){
			
			$response = $this->createUser();
			
			if($response){
				
				$date = array('action' => 'send', 'type' => 'registre', 'email' => $_POST['email'], 'token' => $this->token);
				
				$mail = new Mail();
				$mail->executeFuntion($date, $connection, $publickey);
				
				header("location: index.php?url=inicio/pg/message->registry->true");
			}else{
				header("location: index.php?url=inicio/pg/message->registry->false");
			}
		}else{
			header("location: index.php?url=inicio/pg/message->registry->exist");
		}
	}
	
	private function createUser(){

		$response =  $this->connection->insert("users", [
			"id" => md5($_POST['email'] . $this->token),
			"name" => $_POST['nombre'],
			"lastname" =>  $_POST['apellido'],
			"email" =>  $_POST['email'],
			"password" =>  $_POST['password'],
			"occupation" =>  $_POST['ocupacion'],
			"token" =>  $this->token
		], "stateQuery");

		return $response;
	}
	
	private function searchUser(){
	
		$response =  $this->connection->select("users", 'email', array("email" =>  $_POST['email']));
	
		return $response;
	}
	
}

?>