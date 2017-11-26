<?php

class WriteScriptSkyPlot {
	
	private $_info;
	
	public function writeFile($info){
	
		$this->_info = $info;
		
		$totalTime  =  explode(".", $this->_info['datePrecise']['hourEnd'])[0] -  explode(".", $this->_info['datePrecise']['hourStart'])[0];
		
		$totalTime = $totalTime + 1;
		
		$var = 0;
		
		if($totalTime <= 8){
			$var = 1;
		}else if($totalTime <= 16){
			$var = 2;
		}else if($totalTime <= 24){
			$var = 3;
		}
		
		
		for($i=0; $i<$var; $i++){
			
			$interval = intval($totalTime/$var);
			$point = "";
			
			if($i==0){
				$point = "start";
			}else  if($i==$var-1){
				$point = "end";
			}
				
			$pathInp = $this->createInp($i, $interval, $point);
			$path = $this->createScriptExec($pathInp , $i);
			$pathImage[] = $path['img'];
			exec("sh " . $path['script']);
		}
		
		return  $pathImage;

	}
	
	private function createScriptExec($inp, $i){
		
		$path['script'] = $this->_info['strucFolder']['process'] . DS . "script_exec_skyplot.sh";
		$path['img'] = MY_URL . "files" . DS . $this->_info['strucFolder']['prefijo'] . DS . "Report" . DS . $this->_info['markerName'] . "_" . $i . ".gif";
		
		touch($path['script']);
		chmod($path['script'], 0777);
		$file = fopen($path['script'], "w") or die("Unable to open file!");
		$txt = "";
		$txt .= "#!/bin/bash" . "\n";
		$txt .= "cd " . $this->_info['strucFolder']['process'] . "\n";
		$txt .= "./teqc +qc " . $this->_info['pathRinex'] . "\n";
		$txt .= "./azelplot " . $inp . "\n";
		$txt .= "sh " . $this->_info['markerName'] . ".bat\n";
		$txt .= "convert -density 300 " . $this->_info['markerName'] . ".ps -resize 1024x1024 " . $this->_info['strucFolder']['report'] . DS . $this->_info['markerName'] . "_" . $i . ".gif";
		fwrite($file, $txt);
		fclose($file);
		
		return $path;
		
	}
	
	private function createInp($i, $interval, $point){
	
		$hourStart = 0;
		$minStart = 0;
		$segStart = 0;
		$hourEnd = 0;
		$minEnd = 0;
		$segEnd = 0;
		
		if($point=="start"){
			$hourStart = explode(".", $this->_info['datePrecise']['hourStart'])[0];
			$minStart =  explode(".", $this->_info['datePrecise']['minStart'])[0];
			$segStart =  explode(".", $this->_info['datePrecise']['segStart'])[0];
			$hourEnd = ($interval * $i) + $interval;
		}else if($point == "end"){
			$hourStart = $interval * $i;
			$hourEnd = explode(".", $this->_info['datePrecise']['hourEnd'])[0];
			$minEnd =  explode(".", $this->_info['datePrecise']['minEnd'])[0];
			$segEnd =  explode(".", $this->_info['datePrecise']['segEnd'])[0];
		}else{
			$hourStart = $interval * $i;
			$hourEnd = ($interval * $i) + $interval;
		}
		
		$rinexName = explode(".", $this->_info['rinexName'])[0];
		
		$path = $this->_info['strucFolder']['process'] . DS .  $this->_info['markerName'] . ".inp";
		
		touch($path);
		chmod($path, 0777);
		$file = fopen($path, "w") or die("Unable to open file!");
		$txt = "";
		$txt .= "SKYPLOT " . $this->_info['markerName'] . "\n";
		$txt .= " " . $this->_info['date']['year'] . "  " . $this->_info['date']['month'] . "  " . $this->_info['date']['day']  . "   " . $hourStart . " " . $minStart . " " . $segStart . "\n";
		$txt .= " " . $this->_info['date']['year'] . "  " . $this->_info['date']['month'] . "  " . $this->_info['date']['day']  . "   " . $hourEnd . " " . $minEnd . " " . $segEnd . "\n";
		$txt .= $this->_info['pathEphemeris']['ngs'] . "\n";
		$txt .= "15" . "\n";
		$txt .= $this->_info['pathRinex'] . "\n";
		$txt .= $this->_info['strucFolder']['rinex'] . DS . $rinexName . ".mp1" . "\n";
		$txt .= " " .
		fwrite($file, $txt);
		fclose($file);
	
		return $path;
	
	}
}

?>