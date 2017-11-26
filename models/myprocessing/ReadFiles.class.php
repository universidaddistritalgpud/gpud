

<?php
class ReadFiles {
	
	private $_info;
	
	public function readModel($info, $marker) {
		
		$file = $this->readZip ( $info, $marker . ".model" );
		
		if($file !== ""){
		
			$file = explode ( "\n", $file );
		
			$row = 0;
			
			$data = array ();
			
			foreach ( $file as $line ) {
				
				$items = explode ( " ", $line );
				
				$cont = 0;
				
				$key = "";
				
				$par = 0;
				
				$date = "";
				
				foreach ( $items as $a ) {
					
					if ($cont > 5) {
						
						if ($par == 0) {
							$key = $a;
							$par ++;
						} else {
							$data [$date] [$row] [$key] = $a;
							$par = 0;
						}
					} else {
						
						$date .= $a;
						
						if ($cont == 4) {
							$data [$date] [$row] ["TimeCollection"] = $a;
						}
					}
					
					$cont ++;
				}
				
				$row ++;
			}
			
			return $data;
		}
		
		return false;
		
		// if (file_exists($info)) {
		
		// $file = fopen($info, "r");
		
		// $row = 0;
		
		// $data = array();
		
		// while(!feof($file)) {
		
		// $items = explode(" ", fgets($file));
		
		// $cont = 0;
		
		// $key = "";
		
		// $par = 0;
		
		// $date = "";
		
		// foreach ($items as $a){
		
		// if($cont > 5){
		
		// if($par == 0){
		// $key = $a;
		// $par++;
		// }else{
		// $data[$date][$row][$key] = $a;
		// $par = 0;
		// }
		// }else{
		
		// $date .= $a;
		
		// if($cont == 4){
		// $data[$date][$row]["TimeCollection"] = $a;
		// }
		// }
		
		// $cont++;
		// }
		
		// $row++;
		
		// }
		
		// fclose($file);
		
		// return $data;
		
		// }
		
		// return false;
	}
	public function readOut($info, $marker) {
		
		$file = $this->readZip ( $info, $marker . ".out" );
		
		if($file !== ""){
			
			$file = explode ( "\n", $file );
					
			foreach ( $file as $line ) {
				
				$items [] = explode ( "  ", $line );
			}

			return $items;
		}
		
		return false;
		
// 		if (file_exists ( $info )) {
			
// 			$file = fopen ( $info, "r" );
			
// 			while ( ! feof ( $file ) ) {
				
// 				$items [] = explode ( "  ", fgets ( $file ) );
// 			}
			
// 			fclose ( $file );
			
// 			return $items;
// 		}
		
// 		return false;
	}
	public function readZip($ruta, $file) {
		
		$z = new ZipArchive ();
		
		if ($z->open ( $ruta )) {
			$string = $z->getFromName ( $file );
			return $string;
		}else{
			return "";
		}
		
	}
	function showimage($zip_file, $file_name) {
		
		$z = new ZipArchive ();
		
		if ($z->open ( $zip_file )) {
			
			$file = $z->getFromName ( $file_name );
			
			if($file){
				$image = imagecreatefromstring ( $file );
				
				if ($image) {
					
					ob_start ();
					imagegif ( $image );
					$stringdata = ob_get_contents (); // read from buffer
					imagedestroy ( $image );
					$thumb_data = ob_get_clean ();
					//echo '<img src="data:image/gif;base64,' . base64_encode ( $stringdata ) . '" />';
					return base64_encode ( $stringdata );
				}
				
				return false;
			}
		}
		
		return false;
	}
}

?>