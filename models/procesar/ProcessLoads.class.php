<?php

class ProcessLoads{
	
	private $_infoLoads;
	
	
	public function getInfoLoads($loads){
		
		$isLoads = false;
	
		$lines   = explode("\n", $loads);
		
		$station = array();
			
		$cont = 0;
		
		foreach ($lines as $line){
		
			if(strripos($line, "RADI TANG  lon/lat:")){
				$isLoads = true;
				$station[] = strtolower(explode(" ", $line)[1]);
			}
		
			if(strripos($line, "Ocean tide model: FES2004")){
				$isLoads = true;
			}
			
			$cont++;
		}
		
		if($isLoads){
			$this->_infoLoads['isLoads'] = $isLoads;
			$this->_infoLoads['station'] = $station;
		}else{
			$this->_infoLoads['isLoads'] = false;
		}
		
		return $this->_infoLoads;
		
	}
}