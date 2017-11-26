<?php

class ProcessRinex{
	
	private $_date;
	private $_datePrecise;
	private $_antenna;
	private $_interval;
	private $_dateStart;
	private $_dateEnd;
	private $_markerName;
	private $_markerNumber;
	private $_head;
	private $_infoRinex;
	private $_position;
	private $_deltaAntenna;
	
	
	public function getInfoRinex($rinex){

		ini_set('memory_limit', '-1');
		
		$isRinex = false;
	
		$lines   = explode("\n", $rinex);
		
		$head = array();
			
		$cont = 0;
		
		foreach ($lines as $line){
			
			if(strripos($line, "END OF HEADER")){
				$isRinex = true;
				break;
			}
		
			if($cont > 100 ){
				break;
			}
		
			$cont++;
		
			$this->_head[] = $line;
		
		}
		
		if($isRinex){
			
			$this->_infoRinex['isRinex'] = $isRinex;
			$this->_infoRinex['antenna'] = $this->getAntenna();
			$this->_infoRinex['date'] = $this->getDate();
			$this->_infoRinex['position'] = $this->getGeodeticCoordinates();
			$this->_infoRinex['markerName'] = $this->getMarkerName();
			$this->_infoRinex['heightAntenna'] = $this->getHeightAntenna();
			$this->_infoRinex['datePrecise'] = $this->getIntervalTime($lines);
			$this->_infoRinex['interval'] = $this->getInterval();
			$this->_infoRinex['intervalPrecise'] = $this->getIntervalPrecise();
			
		}else{
			
			$this->_infoRinex['isRinex'] = $isRinex;
			
		}
		
		return $this->_infoRinex;
		
	}
	
	private function getIntervalTime($lines=''){
		
		$cont = 0;
		$cont3 = 0;
		
		$monthText = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$monthInit = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		
		foreach($lines as $line){
			
			if($cont > 0){
			
				$cont2 = 0;
			
				$info = explode(" ", $line);
			
				foreach ($info as $a){
			
					if($cont2 < 6 && $a != ""){
			
						switch ($cont2){
			
							case 0:
								$this->_datePrecise['year'] = $a;
								break;
							case 1:
								$this->_datePrecise['month'] = $a;
								$this->_datePrecise['monthText'] = $monthText[$a - 1];
								$this->_datePrecise['monthInit'] = $monthInit[$a - 1];
								break;
							case 2:
								$this->_datePrecise['day'] = $a;
								break;
							case 3:
								$this->_datePrecise['hourStart'] = $a;
								break;
							case 4:
								$this->_datePrecise['minStart'] = $a;
								break;
							case 5:
								$this->_datePrecise['segStart'] = $a;
								break;
						}
			
						$cont2++;
					}
			
				}
				
				break;
			}
			
			if(strripos($line, "END OF HEADER")){
				$cont++;			
			}
		}
		
		$day = '';
		$month = '';
		
		if($this->_datePrecise['day']<10){
			$day = "  " . $this->_datePrecise['day'];	
		}else{
			$day = " " . $this->_datePrecise['day'];
		}
		
		if($this->_datePrecise['month']<10){
			$month = "  " . $this->_datePrecise['month'];
		}else{
			$month = " " . $this->_datePrecise['month'];
		}
		
		$date = $this->_datePrecise['year'] . $month . $day;
		
		for($i=count($lines); $i>0; $i--){
			
			if(strripos($lines[$i - 1], $date)){
					
				if($cont3 == 0){
					
					$cont2 = 0;
						
					$info = explode(" ", $lines[$i - 1]);
						
					foreach ($info as $a){
					
						if($cont2 < 6 && $a != ""){
								
							switch ($cont2){
					
								case 0:
									$this->_datePrecise['year'] = $a;
									break;
								case 1:
									$this->_datePrecise['month'] = $a;
									$this->_datePrecise['monthText'] = $monthText[$a - 1];
									$this->_datePrecise['monthInit'] = $monthInit[$a - 1];
									break;
								case 2:
									$this->_datePrecise['day'] = $a;
									break;
								case 3:
									$this->_datePrecise['hourEnd'] = $a;
									break;
								case 4:
									$this->_datePrecise['minEnd'] = $a;
									break;
								case 5:
									$this->_datePrecise['segEnd'] = $a;
									break;
							}
								
							$cont2++;
						}
					
					}
					
					$cont3++;
					
				}else if($cont3 == 1){
					

					$cont2 = 0;
					
					$info = explode(" ", $lines[$i - 1]);
					
					foreach ($info as $a){
							
						if($cont2 < 6 && $a != ""){
					
							switch ($cont2){
									
								case 0:
									$this->_datePrecise['year'] = $a;
									break;
								case 1:
									$this->_datePrecise['month'] = $a;
									$this->_datePrecise['monthText'] = $monthText[$a - 1];
									$this->_datePrecise['monthInit'] = $monthInit[$a - 1];
									break;
								case 2:
									$this->_datePrecise['day'] = $a;
									break;
								case 3:
									$this->_datePrecise['hourMedium'] = $a;
									break;
								case 4:
									$this->_datePrecise['minMedium'] = $a;
									break;
								case 5:
									$this->_datePrecise['segMedium'] = $a;
									break;
							}
					
							$cont2++;
						}
							
					}
						
					$i = 0;
				}
					
			}
				
		}
		
		
		$this->_datePrecise['dateStart'] = $this->_datePrecise['hourStart'] . "H " . $this->_datePrecise['minStart'] . "M " . $this->_datePrecise['segStart'] . "S";
		
		$this->_datePrecise['dateEnd'] = $this->_datePrecise['hourEnd'] . "H " . $this->_datePrecise['minEnd'] . "M " . $this->_datePrecise['segEnd'] . "S";
		
		return $this->_datePrecise;
		
	}
	
	private function getDate(){
		
		$month = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$monthInit = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		
		foreach ($this->_head as $line){
		
			if(strripos($line, "TIME OF FIRST OBS")){
				
				$cont = 0;
				
				$info = explode(" ", $line);
				
				foreach ($info as $a){
					
					if($cont<3 && $a != ""){

						switch ($cont){
							
							case 0:
								$this->_date['year'] = $a;
								break;
							case 1:
								$this->_date['month'] = $a;
								$this->_date['monthText'] = $month[$a - 1];
								$this->_date['monthInit'] = $monthInit[$a - 1];
								break;
							case 2:
								$this->_date['day'] = $a;
								break;
								
						}
						
						$cont++;
					}
		
				}
			}
		}
			
		return $this->_date;
		
	}
	
	private function getAntenna(){
		
		foreach ($this->_head as $line){
		
			if(strripos($line, "ANT # / TYPE")){
				
				$cont = 0;
				
				$info = explode(" ", $line);
				
				foreach ($info as $a){
					if($cont > 0 && $cont < 3 && $a != ""){
						$this->_antenna .= $a . " ";
						$cont++;
					}else if($cont == 0){
						$cont++;
					}
				}
				break;
			}
			
		}
		
		return trim($this->_antenna);
		
	}
	
	private function getInterval(){
	
		foreach ($this->_head as $line){
	
			if(strripos($line, "INTERVAL")){
	
				$cont = 0;
	
				$info = explode(" ", $line);
	
				foreach ($info as $a){
					if($cont < 1 && $a != ""){
						$this->_interval .= $a . " ";
						$cont++;
					}
				}
				break;
			}
				
		}
	
		return trim($this->_interval);
	
	}
	
	private function getIntervalPrecise(){
	
		$hour = $this->_datePrecise['hourEnd'] - $this->_datePrecise['hourMedium'];
		$min = $this->_datePrecise['minEnd'] - $this->_datePrecise['minMedium'];
		$seg = $this->_datePrecise['segEnd'] - $this->_datePrecise['segMedium'];
		
		return abs($hour) ."H " . abs($min) . "M " . abs($seg) . "S";
	}
	
	private function getMarkerName(){
	
		foreach ($this->_head as $line){
	
			if(strripos($line, "MARKER NAME")){
	
				$cont = 0;
	
				$info = explode(" ", $line);
	
				foreach ($info as $a){
					if($cont < 1 && $a != ""){
						$this->_markerName .= $a . " ";
						$cont++;
					}
				}
				break;
			}
				
		}
	
		return trim($this->_markerName);
	
	}
	
	private function getGeodeticCoordinates(){
		
		foreach ($this->_head as $line){
		
			if(strripos($line, "APPROX POSITION XYZ")){
				
				$cont = 0;
				
				$info = explode(" ", $line);
				
				foreach ($info as $a){
					
					if($cont<3 && $a != ""){

						switch ($cont){
							
							case 0:
								$this->_position['X'] = $a;
								break;
							case 1:
								$this->_position['Y'] = $a;
								break;
							case 2:
								$this->_position['Z'] = $a;
								break;
								
						}
						
						$cont++;
					}
		
				}
			}
		}
			
		return $this->_position;
		
	}
	
	private function getHeightAntenna(){
	
		foreach ($this->_head as $line){
	
			if(strripos($line, "ANTENNA: DELTA H/E/N")){
	
				$cont = 0;
	
				$info = explode(" ", $line);
	
				foreach ($info as $a){
						
					if($cont<3 && $a != ""){
	
						switch ($cont){
								
							case 0:
								$this->_deltaAntenna['H'] = $a;
								break;
							case 1:
								$this->_deltaAntenna['E'] = $a;
								break;
							case 2:
								$this->_deltaAntenna['N'] = $a;
								break;
	
						}
	
						$cont++;
					}
	
				}
			}
		}
			
		return $this->_deltaAntenna;
	
	}
	
	
}
