<?php

class ReadFiles {
	
	private $_info;
	
	public function readModel($info){
		
		if (file_exists($info)) {
		
			$file = fopen($info, "r");
	
			$row = 0;
			 
			$data = array();
			
			while(!feof($file)) {
	
				$items = explode(" ", fgets($file));
			
				$cont = 0;
				
				$key = "";
				
				$par = 0;
				
				$date = "";
				
				foreach ($items as $a){
					
					if($cont > 5){
						
						if($par == 0){
							$key = $a;
							$par++;
						}else{
							$data[$date][$row][$key] = $a;
							$par = 0;
						}
					}else{
						
						$date .= $a;
						
						if($cont == 4){
							$data[$date][$row]["TimeCollection"] = $a;
						}
					}
					
					$cont++;
				}
				
				$row++;
	
			}
			
			fclose($file);
			
			return $data;
			
		}
		
		return false;

	}
	
	public function readOut($info){
	
		if (file_exists($info)) {
		
			$file = fopen($info, "r");
		
			while(!feof($file)) {
		
				$items[] = explode("  ", fgets($file));
		
			}
		
			fclose($file);
			
			return $items;
		}
		
		return false;
	}
}

?>
