<?php 

Class Procesar{

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
		$this->info[] = $info;
		$this->connection = $connection;
		$this->publicKey = $publickey;

		if($this->info[0] == "information"){
			$this->information();
		}else if($this->info[0] == "cargas"){
			$this->cargasOceanicas();
		}else if($this->info[0] == "upload"){
			$this->uploadFile();
		}else if($this->info[0] == "delete"){
			$this->deleteFile();
		}

	}
	
	private function  uploadFile(){
		
		require 'Struct.class.php';
		$struct = new Struct();
		require 'WriteFiles.class.php';
		$write = new WriteFiles();
		
		$info['strucFolder'] = $struct->generateStructFolder();
		
		if($_FILES['cargas_oceanicas']['type'] == "application/octet-stream" && explode(".", $_FILES['cargas_oceanicas']['name'])[1] == "dat" && $_FILES['cargas_oceanicas']['size'] <= 10000){
				
			//Se debe configurar el archivo /etc/php.ini en los siguientes atributos de cargue de información.
			//upload_max_filesize = 7MB
			//memory_limit = 64M
			//post_max_size = 8MB
				
			$loads = file_get_contents($_FILES['cargas_oceanicas']['tmp_name'], true);
				
			require 'ProcessLoads.class.php';
			$process = new ProcessLoads();
		
			$info = array_merge($info, $process->getInfoLoads($loads));
				
			if($info['isLoads']){
				$info['loadsOceanicName'] = isset($_FILES['cargas_oceanicas']['name'])?$_FILES['cargas_oceanicas']['name']:null;
				$info['pathOceanicLoads'] = $info['strucFolder']['process'] .  DS . $info['loadsOceanicName'];
				
				$tempName = isset($_FILES['cargas_oceanicas']['tmp_name'])?$_FILES['cargas_oceanicas']['tmp_name']:null;
				
				move_uploaded_file($tempName, $info['pathOceanicLoads']);
			}
		
		}else{
			$arr = array("isLoads"=>false);
			echo json_encode($arr);
		}
		
		if($_FILES['puerto']['type'] == "application/octet-stream" && $_FILES['puerto']['size'] <= 100000000){
	
			//Se debe configurar el archivo /etc/php.ini en los siguientes atributos de cargue de información.
			//upload_max_filesize = 7MB
			//memory_limit = 64M
			//post_max_size = 8MB

			$rinex = file_get_contents($_FILES['puerto']['tmp_name'], true);
				
			require 'ProcessRinex.class.php';
			$process = new ProcessRinex();
			require 'GNSS.class.php';
			$gnss = new GNSS();
			require 'Transformation.class.php';
			$trans = new Transformation();
			require 'Download.class.php';
			$download = new Download();
			require 'DisplacementPole.class.php';
			$disPolo = new DisplacementPole();
			
			$info = array_merge($info, $process->getInfoRinex($rinex)); 
			if($info['isRinex']){
				if(in_array(strtolower($info['markerName']) . ",", $info['station'])){
						
					$info['notLoadOceanic'] = false;
					$info['rinexName'] = isset($_FILES['puerto']['name'])?$_FILES['puerto']['name']:null;
					$info['daygnss'] = $gnss->getDayGPS($info['date']['day'], $info['date']['month'], $info['date']['year']);
					$info['dayofyear'] = $gnss->getDayofYear($info['date']['day'], $info['date']['month'], $info['date']['year']);
					$info['weekgnss'] = $gnss->getWeekGPS($info['date']['day'], $info['date']['month'], $info['date']['year']);
					$info['dayjulian'] = GregorianToJD($info['date']['month'], $info['date']['day'], $info['date']['year']);
					
					$day  = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
					$info['date']['dayText'] = $day[$info['daygnss']];
					
					//Parametros Sistema de Referencia WGS84.
					$a = 6378137;
					$f = 1/298.257223563;
					
					$info['position'] = $trans->getGeodeticCoordinates($info['position']['X'], $info['position']['Y'], $info['position']['Z'], $a, $f);
					
					
					$info['dayjulian'] = $trans->getDateJulian($info['date']['day'], $info['date']['month'], $info['date']['year']);
					
					
					$info['displacementPolo'] = $disPolo->getDisplacementPole($info['date']['day'], $info['date']['month'], $info['date']['year']);
					
					$info['pathEphemeris'] = $download->initDownload($info['daygnss'], $info['weekgnss'], $info['strucFolder']['ephemeris']);
					
					if($info['pathEphemeris'][0] == false || $info['pathEphemeris'][1] == false || $info['pathEphemeris'][2] == false){
						$arr = array("notEphemeris"=>true);
						echo json_encode($arr);
						exit();
					}
					
					$info['pathRinex'] = $info['strucFolder']['rinex'] .  DS . $info['rinexName'];
					
					$tempName = isset($_FILES['puerto']['tmp_name'])?$_FILES['puerto']['tmp_name']:null;
					
					move_uploaded_file($tempName, $info['pathRinex']);
					
					$info['files'] = $write->writeFile($info);
				
					$this->registre($info);
					
					$execScript = new Ejecutador();
					
					$pathScriptProcessing = $info['files']['pathScriptProcessing'];
					
					$execScript->executeFuntion($pathScriptProcessing, $this->connection, $this->publicKey);
					
					echo json_encode($info);
					
				}else{
					$arr = array("notLoadOceanic"=>true);
					echo json_encode($arr);
					exit();
				}
				
			}
			
		}else{
			
			$arr = array("isRinex"=>false);
			echo json_encode($arr);
						
		}
			
	}
	
	private function  information(){
		

		//Se debe configurar el archivo /etc/php.ini en los siguientes atributos de cargue de información.
		//upload_max_filesize = 40MB
		//memory_limit = 64M
		//post_max_size = 15MB
		
		if($_FILES['puerto']['type'] == "application/octet-stream" && $_FILES['puerto']['size'] <= 100000000){
	
			$rinex = file_get_contents($_FILES['puerto']['tmp_name'], true);
	
			require 'ProcessRinex.class.php';
			$process = new ProcessRinex();
			require 'GNSS.class.php';
			$gnss = new GNSS();
			require 'Transformation.class.php';
			$trans = new Transformation();
				
			$info = $process->getInfoRinex($rinex);
				
			if($info['isRinex']){
	
				$info['rinexName'] = isset($_FILES['puerto']['name'])?$_FILES['puerto']['name']:null;
				$info['daygnss'] = $gnss->getDayGPS($info['date']['day'], $info['date']['month'], $info['date']['year']);
				$info['dayofyear'] = $gnss->getDayofYear($info['date']['day'], $info['date']['month'], $info['date']['year']);
				$info['weekgnss'] = $gnss->getWeekGPS($info['date']['day'], $info['date']['month'], $info['date']['year']);
				$info['dayjulian'] = GregorianToJD($info['date']['month'], $info['date']['day'], $info['date']['year']);
	
				$day  = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
				$info['date']['dayText'] = $day[$info['daygnss']];
	
				//Parametros Sistema de Referencia WGS84.
				$a = 6378137;
				$f = 1/298.257223563;
	
				$info['position'] = $trans->getGeodeticCoordinates($info['position']['X'], $info['position']['Y'], $info['position']['Z'], $a, $f);
				
				$info['positionGK'] = $trans->ll2gk($info['position']['latitude'],$info['position']['longitude']);
				
				$info['dayjulian'] = $trans->getDateJulian($info['date']['day'], $info['date']['month'], $info['date']['year']);
	
			}
	
			echo json_encode($info);
				
		}else{
				
			$arr = array("isRinex"=>false);
			echo json_encode($arr);
	
		}
			
	}
	
	private function cargasOceanicas(){
		
		if($_FILES['cargas_oceanicas']['type'] == "application/octet-stream" && $_FILES['cargas_oceanicas']['size'] <= 10000 && isset(explode(".", $_FILES['cargas_oceanicas']['name'])[1]) && explode(".", $_FILES['cargas_oceanicas']['name'])[1] == "dat"){
	
			//Se debe configurar el archivo /etc/php.ini en los siguientes atributos de cargue de información.
			//upload_max_filesize = 7MB
			//memory_limit = 64M
			//post_max_size = 8MB
	
			$loads = file_get_contents($_FILES['cargas_oceanicas']['tmp_name'], true);
	
			require 'ProcessLoads.class.php';
			$process = new ProcessLoads();
	
			$info = $process->getInfoLoads($loads);
	
			echo json_encode($info);
	
		}else{
	
			$arr = array("isLoads"=>false);
			echo json_encode($arr);
	
		}
			
	}
	
	private function registre($info){

		$response =  $this->connection->insert("processing", [
				"id" => $info['strucFolder']['prefijo'],
				"id_user" =>  $_SESSION['id'],
				"content_json" =>  json_encode($info),
				"processing_state" => "EN ESPERA"
		], "stateQuery");
		
		return $response;
		
	}
	
}

?>