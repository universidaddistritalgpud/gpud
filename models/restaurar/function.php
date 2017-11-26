<?php 

Class Restaurar{

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
		
		if($info[0] == "update"){
			
			$response = $this->searchUserToken($info[1]);
			
			if($response){
				
				$user = $response[0]['id_user'];
				$response = $this->updatePass($user);
				$response = $this->updateToken($user);
				
				header("location: index.php?url=inicio/pg/message->restart_succsess->true");
			}else{
				header("location: index.php?url=inicio/pg/message->restart_succsess->false");
			}
			
		}else{
		
			$response = $this->searchUser();
			
			if($response){
				
				$response = $this->createToken($response);
				
				if($response){
					$date = array('action' => 'send', 'type' => 'restart', 'email' => $_POST['email'], 'token' => $this->token);
						
					$mail = new Mail();
					$mail->executeFuntion($date, $connection, $publickey);
					
					header("location: index.php?url=inicio/pg/message->restart->true");
				}else{
					header("location: index.php?url=inicio/pg/message->restart->false");
				}
				
			}else{
				header("location: index.php?url=inicio/pg/message->restart->false");
			}
		}
	}
	
	private function createToken($params){

		$response =  $this->connection->insert("restart_password", [
			"id_user" => md5($params[0]['email'] .$params[0]['token']),
			"email" =>  $params[0]['email'],
			"token" =>  $this->token
		], "stateQuery");

		return $response;
	}
	
	private function searchUser(){
	
		$response =  $this->connection->select("users", ['email', 'token'], ['AND' => ["email" =>  $_POST['email'], 'status' => 'TRUE']]);

		return $response;
	}
	
	private function searchUserToken($token){
		$response =  $this->connection->select("restart_password", ['id_user'], ['AND' => ['token' =>  $token, 'status' => 'TRUE']]);
	
		return $response;
	}
	
	private function updatePass($user){
	
		$response =  $this->connection->update("users", [
				"password" =>  $_POST['password_restart'],
		], ["id" => $user]);
	
		return $response;
	}
	
	private function updateToken($user){

		$response =  $this->connection->update("restart_password", [
				'status' =>  'FALSE',
		], ["id_user" => $user]);
	
		return $response;
	}
	
}

?>