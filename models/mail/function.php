<?php 

Class Mail{

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
		$this->info = $info['action'];
		$this->connection = $connection;
		$this->publicKey = $publickey;

		if($info['action'] == "send"){
			$this->sendMail($info['type'], $info['email'], $info['token']);
		}else if($info == "config"){
			$this->configurationMail();
		}
		
	}
	
	private function sendMail($type, $email, $token){
		
		require('framework' . DS . "PHPMailer" . DS . "PHPMailerAutoload.php");
		
		
		
		$mail = new \PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
		$mail->Username = "xxxxxx@gmail.com"; // Correo completo a utilizar
		$mail->Password = "xxxxxx"; // Contraseña
		$mail->Port = 587; // Puerto a utilizar
		$mail->From = "xxxxxx@gmail.com"; // Desde donde enviamos (Para mostrar)
		$mail->FromName = "GPUD";
		$mail->AddAddress($email); // Esta es la dirección a donde enviamos
// 		$mail->AddCC("cuenta@dominio.com"); // Copia
// 		$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
		$mail->IsHTML(true); // El correo se envía como HTML
		
		if($type == "registre"){
			$mail->Subject = "Activar GPUD"; // Este es el titulo del email.
			$body = "Gracias por registrarte en el Geoportal de Procesamiento de la Universidad Distrital Francisco Jose de Caldas.<br />";
			$body .= "Para confirmar tu registro en <strong>GPUD</strong> Da clic en el siguiente ";
			$body .= "<a href='" .MY_URL . "index.php?url=session/ft/confirmRegistration/" . $token . "'>" . "enlace</a>";
		}else if($type == "restart"){
			$mail->Subject = "Restaurar Contraseña GPUD"; // Este es el titulo del email.
			$body = "Hemos recibido una solicitud de cambio de contraseña, si realizaste dicha solicitud ingresa al siguiente ";
			$body .= "<a href='" .MY_URL . "index.php?url=session/ft/restartPassword/" . $token . "'>" . "enlace</a>, ";
			$body .= "de lo contrario omite este mensaje.";
		}
		
		$mail->Body = $body; // Mensaje a enviar
		$mail->CharSet = 'UTF-8';
		
		$exito = $mail->Send(); // Envía el correo.
		
		return $exito;
	}
	
	private function configurationMail(){
	
		require(FRAMEWORK . DS . "PHPMailer" . DS . "PHPMailerAutoload.php");
		//Create a new SMTP instance
		$smtp = new \SMTP;
		//Enable connection-level debug output
		$smtp->do_debug = SMTP::DEBUG_CONNECTION;
		try {
			//Connect to an SMTP server
			if (!$smtp->connect('smtp.gmail.com', 587)) {
				throw new Exception('Connect failed');
			}
			//Say hello
			if (!$smtp->hello(gethostname())) {
				throw new Exception('EHLO failed: ' . $smtp->getError()['error']);
			}
			//Get the list of ESMTP services the server offers
			$e = $smtp->getServerExtList();
			//If server can do TLS encryption, use it
			if (is_array($e) && array_key_exists('STARTTLS', $e)) {
				$tlsok = $smtp->startTLS();
				if (!$tlsok) {
					throw new Exception('Failed to start encryption: ' . $smtp->getError()['error']);
				}
				//Repeat EHLO after STARTTLS
				if (!$smtp->hello(gethostname())) {
					throw new Exception('EHLO (2) failed: ' . $smtp->getError()['error']);
				}
				//Get new capabilities list, which will usually now include AUTH if it didn't before
				$e = $smtp->getServerExtList();
			}
			//If server supports authentication, do it (even if no encryption)
			if (is_array($e) && array_key_exists('AUTH', $e)) {
				if ($smtp->authenticate('xxxx@gmail.com', 'xxxxx')) {
					header("location: index.php?url=inicio/pg/message->configuration->true");
				} else {
					header("location: index.php?url=inicio/pg/message->configuration->false");
					throw new Exception('Authentication failed: ' . $smtp->getError()['error']);
				}
			}
		} catch (Exception $e) {
			echo 'SMTP error: ' . $e->getMessage(), "\n";
		}
		//Whatever happened, close the connection.
		$smtp->quit(true);
		
	}
}

?>
