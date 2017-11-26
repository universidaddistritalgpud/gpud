<?php

class Download{
	
	private $_path;
	private $_pathUncompress;
	private $_url;
	private $_dayGNSS;
	private $_weekGNSS;
	private $_nameFile;
	private $_nameFileGns;
	private $_name;
	private $_extension;
	private $_folder;
	
	public function initDownload($dayGNSS, $weekGNSS, $folder){
		
		$this->_extension = ".sp3.Z";
		$this->_folder = $folder;
		$downloadEphe = array();
		$cont = 0;
		for($i= ($dayGNSS - 1); $i <= ($dayGNSS + 1); $i++){
			
			if ($i == -1) {
				$this->_dayGNSS = 6;
				$this->_weekGNSS = $weekGNSS - 1;
			} else if ($i == 7) {
				$this->_dayGNSS = 0;
				$this->_weekGNSS = $weekGNSS + 1;
			}else{
				$this->_dayGNSS = $i;
				$this->_weekGNSS = $weekGNSS;
			}
			
			$this->generateName();
			$this->generatePath();
			$this->generateUrl();
			
			if($this->downloadEphemeride()){
				$downloadEphe[$cont] = $this->uncompressFile();
					
				if($cont == 1){
					$this->generateNameGns();
					$this->generatePath();
					$downloadEphe['ngs'] = $this->_pathUncompress;
					include_once MY_FOLDER . DS . 'models/procesar/Conversion.class.php';
					$conversion =new Convertion();
					$conversion->igs2ngs($downloadEphe[$cont], $downloadEphe['ngs']);
				}
			}else{
				$downloadEphe[$cont] = false;
				$downloadEphe['ngs'] = false;
			}
			
			$cont++;
			
		}
		
		return $downloadEphe;
	}
	
	private function generateName(){
		
		$this->_nameFile = "igs" . $this->_weekGNSS . $this->_dayGNSS . $this->_extension;
		$this->_name = "igs" . $this->_weekGNSS . $this->_dayGNSS . ".sp3";
		
	}
	
	private function generateNameGns(){
		$this->_nameFile = "ngs" . $this->_weekGNSS . $this->_dayGNSS . $this->_extension;
		$this->_name = "ngs" . $this->_weekGNSS . $this->_dayGNSS . ".sp3";
	}
	
	private function generatePath(){
		
		$this->_path = $this->_folder . DS . $this->_nameFile;
		$this->_pathUncompress = $this->_folder . DS . $this->_name;
	}
	
	private function generateUrl(){
		
		$value = "";
		
		if ($this->_weekGNSS < 1000) {
			$value = "0";
		}
		
		$urlSP3 = "http://igscb.jpl.nasa.gov/igscb/product"; //Se reemplaza la url por fallas
		$urlSP3 = "ftp://cddis.gsfc.nasa.gov/gnss/products";
		$this->_url = $urlSP3 . DS  . $this->_weekGNSS  . DS . $this->_nameFile;
	}
	
	private function downloadEphemeride(){
		
		$newfname = $this->_path;
		$url = $this->_url;
		
		$downloaded = false;
		
		$context = stream_context_create( array(
				'http'=>array(
						'timeout' => 2.0
				)
		));
		
		$file = @fopen($url, 'rb', false, $context);
		
		if ($file) {		
			
			$newf = fopen ($newfname, 'wb');
			if ($newf) {
				while(!feof($file)) {
					fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
				}
				
				fclose($file);
				fclose($newf);
				
				$downloaded = true;
				
			}
		}else{
			$downloaded = false;
		}
		
		return $downloaded;
		
	}
	
	private function uncompressFile(){
		 
		chmod($this->_path, 0777);
		
		shell_exec("gunzip $this->_path");
    	
		if(file_exists($this->_pathUncompress)){
			return $this->_pathUncompress ;
		}
		
    	return false;
	}	
	
}

?>