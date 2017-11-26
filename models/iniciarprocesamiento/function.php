<?php 

Class IniciarProcesamiento{

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
		
		$this->procesar();

	}
	
	private function procesar(){
					
		$infoJson = $this->cargarDatos();
		
		if(count($infoJson) > 0 && $infoJson != false){
			
			$info = $infoJson[0];
			
			$files = json_decode($info['content_json'], true);
			
			$script =  $files['files']['pathScript'];
		
			$this->procesando($info['id']);
			
			//Para solucionar el problema de la libreria libgpstk.so ejecute la linea
			//ldconfig /usr/local/lib
			
			$info['processResult'] = exec("sh " . $script);
				
			chmod($files['files']['pathModel'], 0777);
			chmod($files['files']['pathOut'], 0777);
			
			$data = array("option" => "model", "markerName" => $files['markerName'], "folder" =>  $files['strucFolder']['prefijo']);
			
			include_once  'WriteScriptSkyPlot.class.php';
			
			//Para generar el skyplot se debe instalar la libreria gmt
			//yum install GMT
			
			//Para convertir archivo de formato ps a gif se debe instalar ImageMagick
			//yum install ImageMagick
			
			$skyplot = new WriteScriptSkyPlot();
			
			$this->pathImage = $skyplot->writeFile($files);
			
			$files = array_merge($files, array("gif" => $this->pathImage));
			
			$this->actualizarInformacion($info['id'], json_encode($files));
			
			$pdf = new PDF();
			
			$pdf->executeFuntion($data, $this->connection, $this->publicKey);
			
			$carpeta = substr ($files['strucFolder']['folder'], 0, strlen($files['strucFolder']['folder']) - 1);
				
			$this->comprimirArchivos($files);
			
			//$this->eliminarDir($carpeta, null);
			
			$this->procesado($info['id']);

			echo 1;
			
		}else{
			echo 0;
		}
			
	}
	
	private function  cargarDatos(){
	
		$response = $this->connection->select('processing', "*",  ['AND' => [
				'processing_state' => "EN ESPERA", 'registration_state' => "true"], "ORDER" => [ "registration_date" => "ASC"] , "LIMIT" => 1]);
	
		return $response;
			
	}
	
	private function  procesando($id){
	
		$response = $this->connection->update('processing', ['processing_state' => "PROCESANDO"], [
				'id' => $id]);
	
	}
	
	private function  procesado($id){
	
		$response = $this->connection->update('processing', ['processing_state' => "TERMINADO"], [
				'id' => $id]);
	
	}
	
	private function  actualizarInformacion($id, $json){
	
		$response = $this->connection->update('processing', ['content_json' => $json], [
				'id' => $id]);
		
	}
	
	private function eliminarDir($carpeta, $omitirCarpeta)
	{
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
	
			if (is_dir($archivos_carpeta))
			{
				if($archivos_carpeta != $omitirCarpeta){
					$this->eliminarDir($archivos_carpeta, $omitirCarpeta);
				}
			}
			else
			{
				unlink($archivos_carpeta);
			}
		}
	
		@rmdir($carpeta);
	}
	
	function comprimirArchivos($info) {
	
		$zip = new ZipArchive();
	
		$filename = MY_FOLDER . DS . 'files' .DS . $info['strucFolder']['prefijo'] . "_" . $info['markerName'] . "_" . $info['date']['year'] . "_" . $info['dayofyear'] . '.zip';
	
		if($zip->open($filename,ZIPARCHIVE::CREATE)===true) {
				
			$gestor_dir = opendir($info['strucFolder']['report']);
				
			while (false !== ($nombre_fichero = readdir($gestor_dir))) {
	
				if($nombre_fichero !== "." && $nombre_fichero !== ".."){
					//$zip->addFile($this->informationRinex['strucFolder']['report'] . DS . $nombre_fichero);
					$file = $info['strucFolder']['report'] . DS . $nombre_fichero;
					$zip->addFile($file,basename($file));
	
				}
			}
				
			$zip->close();
				
			chmod($filename, 0777);
			//echo 'Creado '.$filename;
		}
		else {
			//echo 'Error creando '.$filename;
		}
	
	}
	
}

?>