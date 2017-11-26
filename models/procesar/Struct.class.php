<?php

class Struct{
	
	public function generateStructFolder(){
		
		//Permisos que se tienen que dar a la carpeta files para poder crear directorios.
		//semanage fcontext -a -t httpd_sys_rw_content_t 'files'
		//restorecon -v 'files'
		//setsebool -P httpd_unified 1
		
		$prefijo = substr(md5(uniqid(time())), 0, 6);
		
		$path = MY_FOLDER . DS . "files" . DS;
		
		$folder = $path . $prefijo . DS;
		
		$struct['prefijo'] = $prefijo;
		$struct['folder'] = $folder;
		$struct['report'] = $folder . "Report";
		$struct['ephemeris'] = $folder . "Ephemeris";
		$struct['rinex'] = $folder . "Rinex";
		$struct['process'] = $folder . "Process";
		
		if (!file_exists($folder)) {
			
			mkdir($struct['folder'], 0777, true);
			chmod($struct['folder'], 0777);
			mkdir($struct['report'], 0777, true);
			chmod($struct['report'], 0777);
			mkdir($struct['ephemeris'], 0777, true);
			chmod($struct['ephemeris'], 0777);
			mkdir($struct['rinex'], 0777, true);
			chmod($struct['rinex'], 0777);
			mkdir($struct['process'], 0777, true);
			chmod($struct['process'], 0777);
			
			return $struct;
		}
		
		return false;
		
	}
	
}