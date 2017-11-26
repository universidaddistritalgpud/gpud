<?php

class WriteFiles {
	
	private $_info;
	
	public function writeFile($info){
	
		$this->_info = $info;
		
		$result['pathPPPConf'] = $this->writePPPConf();
		$result['pathScript'] = $this->createScriptExec();
		$result['pathScriptProcessing'] = $this->createScriptProcessing();
		$result['copyFiles'] = $this->copyFiles();
		$result['pathOut'] = $this->_info['strucFolder']['report'] . DS . $this->_info['markerName'] . ".out";
		$result['pathModel'] = $this->_info['strucFolder']['report'] . DS . $this->_info['markerName'] . ".model";
		
		return $result;
	}
	
	private function createFile() {
		
			$configuration = "";
		
			$configuration  .= "# THIS IS AN EXAMPLE OF A CONFIGURATION FILE.\n"
					.  "# THIS FILE WILL BE USED BY THE 'example9' APPLICATION.\n"
					.  "# CASE IS InDiFfErEnT FOR VARIABLE NAMES.\n"
					.  "\n"
					.  "# ALL SECTIONS OF THIS FILE, EXCEPT FOR \"Default\" SECTION, CORRESPOND TO\n"
					.  "# THE NAME OF A GIVEN GPS RECEIVER.\n"
					.  "\n"
					.  "# We curently are at \"Default\" section, because no section has been\n"
					.  "# declared so far...\n"
					.  "\n"
					.  "# Warning: You must use square brackets '[]' ONLY to declare section names!!!\n"
					.  "\n"
					.  "# Default variables. If field 'ConfDataReader::fallback2Default' is set to\n"
					.  "# TRUE, these variables are valid for ALL receivers unless one of them\n"
					.  "# declares its own version.\n"
					.  "\n";
			$configuration  .= "oceanLoadingFile =   " .  $this->_info['pathOceanicLoads'] . ", file with ocean loading parameters\n"
					.  "satDataFile      = PRN_GPS          , constellation data file\n"
					.  "precision        = 6                , number of decimal places in output file\n"
					.  "cutOffElevation, minimum allowed satellite elevation = 10.0, in degrees\n"
					.  "\n"
					.  "\n"
					.  "# Change the following parameter to TRUE if your RINEX observation files\n"
					.  "# don't include P1, and you want to use C1 instead. Please be aware that\n"
					.  "# if you use C1 instead of P1 to compute PC combination, instrumental errors\n"
					.  "# will NOT cancel, introducing a bias that must be taken into account by\n"
					.  "# other means. This bias won't be corrected in this application.\n"
					.  "\n"
					.  "useC1 = TRUE\n"
					.  "\n"
					.  "\n"
					.  "# The following parameters control some sanity checks for SP3 data. The values\n"
					.  "# are typical for 15-minutes-per-sample SP3 files\n"
					.  "\n"
					.  "checkGaps = TRUE, check for data gaps bigger than 901 seconds\n"
					.  "SP3GapInterval = 901, seconds\n"
					.  "\n"
					.  "checkInterval = TRUE, don't allow interpolation intervals bigger than 8105 s\n"
					.  "maxSP3Interval = 8105, seconds\n"
					.  "\n"
					.  "\n"
					.  "# Decimation parameters. Typical values for 15-minutes-per-sample SP3 files\n"
					.  "\n"
					.  "decimationInterval, interval between processed data   = 900, seconds\n"
					.  "decimationTolerance, tolerance allowed for decimation = 5, seconds\n"
					.  "\n"
					.  "\n"
					.  "# IMPORTANT NOTE:\n"
					.  "# It turns out that some receivers don't correct their clocks from drift.\n"
					.  "# When this happens, their code observations may drift well beyond what it is\n"
					.  "# usually expected from a pseudorange. In turn, this effect causes that\n"
					.  "# \"SimpleFilter\" objects start to reject a lot of satellites.\n"
					.  "# Thence, the \"filterCode\" option allows you to deactivate the \"SimpleFilter\"\n"
					.  "# object that filters out C1, P1 and P2, in case you need to.\n"
					.  "\n"
					.  "filterCode = FALSE\n"
					.  "\n"
					.  "# Like in the \"filterCode\" case, the \"filterPC\" option allows you to deactivate\n"
					.  "# the \"SimpleFilter\" object that filters out PC, in case you need to.\n"
					.  "\n"
					.  "filterPC = TRUE\n"
					.  "\n"
					.  "# By default, we won't print the model.\n"
					.  "\n"
					.  "printModel = FALSE\n"
					.  "\n"
					.  "\n"
					.  "# Antex-related variables\n"
					.  "useAntex, this variable tells if we'll use Antex files               = TRUE\n"
					.  "usePCPatterns, this variable activates use of Antex patterns         = FALSE\n"
					.  "useAzim, this variable activates use of azimuth-dependent patterns   = FALSE\n"
					.  "\n"
					.  "\n"
					.  "###\n"
					.  "### Application \"example9\" demands one section (and only one)\n"
					.  "### per GPS receiver station\n"
					.  "###\n"
					.  "\n"
					.  "\n"
					.  "\n";

			$configuration  .= "[" . $this->_info['markerName'] . "]\n"
						.  "\n";
			$configuration  .= "rinexObsFile, Rinex observation file = " . $this->_info['pathRinex'] . "\n";
			$configuration  .= "\n";
			$configuration  .= "dayOfYear = " . $this->_info['dayofyear'] . "," . " days of year for " . $this->_info['date']['monthInit'] ."/". $this->_info['date']['day'] ."/". $this->_info['date']['year'] . ".\n";
			$configuration  .= "\n"
						.  "\n";
			$configuration  .= "SP3List, SP3 ephemeris file list    = " . $this->_info['pathEphemeris']['0'] . " " . $this->_info['pathEphemeris']['1'] . " " . $this->_info['pathEphemeris']['2'] . "\n";
			$configuration  .= "\n";
					
			$configuration  .= "poleDisplacements, for " . $this->_info['date']['monthInit'] ."/". $this->_info['date']['day'] ."/". $this->_info['date']['year'] . "  =  " . $this->_info['displacementPolo']['X'] . " " . $this->_info['displacementPolo']['Y'] . ", arcsec\n";
			$configuration  .= "\n";
			$configuration  .= "nominalPosition, ECEF-IGS = " . $this->_info['position']['X'] ." ". $this->_info['position']['Y'] ." ". $this->_info['position']['Z'] . ", meters\n";
			$configuration  .= "\n"
						.  "\n"
						.  "# Antenna parameters\n"
						.  "useAntex          = TRUE                  # We will use Antex files\n"
						.  "\n"
						.  "antexFile      = ngs08.atx                # Name of Antex file (absolute PC)\n"
						.  "antennaModel   = TPSCR4          CONE     # Antenna model (with radome), in\n"
						.  "                                                          # strict IGS format\n"
						.  "\n"
						.  "# Should we use antenna phase variation patterns or just eccentricity?\n"
						.  "usePCPatterns = TRUE\n"
						.  "\n"
						.  "# Should we use elevation/azimuth patterns or just elevation?\n"
						.  "useAzim = TRUE\n"
						.  "\n"
						.  "offsetARP, dH dLon dLat (UEN) = " . $this->_info['heightAntenna']['H'] . "  0.000  0.000, meters\n"
						.  "\n"
						.  "\n"
						.  "# Solver-related variables\n"
						.  "\n"
						.  "coordinatesAsWhiteNoise = FALSE           # Static positioning\n"
						.  "\n"
						.  "forwardBackwardCycles = 0, an integer < 1 means forwards processing only\n"
						.  "\n"
						.  "# The following variable, if true, sets a NEU system. If false, an XYZ system\n"
						.  "USENEU = FALSE, results will be given in dLat, dLon, dH\n"
						.  "\n"
						.  "\n";
		
// 				$configuration  .= "#Parametros climaticos, algunos de ellos son requeridos para hace uso del algoritmo Saastamoinen.\n\n";
// 				$configuration  .= "Dia = " + dataSaastamoinen[0] + ", Dia del annio\n";
// 				$configuration  .= "Prec = " + dataSaastamoinen[1] + ", Precipitacion\n";
// 				$configuration  .= "Temp = " + dataSaastamoinen[2] + ", Temperatura\n";
// 				$configuration  .= "Rhum = " + dataSaastamoinen[3] + ", Humedad Relativa\n";
// 				$configuration  .= "PresHp = " + dataSaastamoinen[4] + ", Presion en hp\n";
// 				$configuration  .= "PresmmHg = " + dataSaastamoinen[5] + ", Presion en mmhg\n";
// 				$configuration  .= "Estado = " + dataSaastamoinen[6] + ", Estado de la Estacion\n";
// 				$configuration  .= "Lat = " + dataSaastamoinen[7] + ", Latitud\n";
// 				$configuration  .= "Lon = " + dataSaastamoinen[8] + ", Longitud\n";
// 				$configuration  .= "Alt = " + dataSaastamoinen[9] + ", Altura\n\n";
		
			$configuration  .= "# Output\n";
				
			$configuration  .= "outputFile = " . $this->_info['strucFolder']['report'] . DS . $this->_info['markerName'] . ".out\n";
			$configuration  .= "\n"
							.  "\n"
							.  "printModel = TRUE\n";
			$configuration  .= "modelFile  = " . $this->_info['strucFolder']['report'] . DS . $this->_info['markerName'] . ".model\n";
		
		
			$configuration  .= "\n"
					.  "\n"
					.  "# End of configuration file";
			
			return $configuration;

	}
	
	private function writePPPConf(){
	
		$path = $this->_info['strucFolder']['process'] . DS . "pppconf.txt";
		touch($path);
		chmod($path, 0777);
		$conffile = fopen($path, "w") or die("Unable to open file!");
		$txt = $this->createFile();
		fwrite($conffile, $txt);
		fclose($conffile);
		
		return $path;
	
	}
	
	private function createScriptExec(){
		
		$path = $this->_info['strucFolder']['process'] . DS . "script_exec_example9.sh";
		touch($path);
		chmod($path, 0777);
		$file = fopen($path, "w") or die("Unable to open file!");
		$txt = "";
		$txt .= "#!/bin/bash" . "\n";
		$txt .= "cd " . $this->_info['strucFolder']['process'] . "\n";
		$txt .= "ldconfig /usr/local/lib" . "\n";
		$txt .= "./example9";
		fwrite($file, $txt);
		fclose($file);
		
		return $path;
		
	}
	
	private function createScriptProcessing(){
	
		$path = $this->_info['strucFolder']['process'] . DS . "script_exec_processing.sh";
		
		touch($path);
		chmod($path, 0777);
		$file = fopen($path, "w") or die("Unable to open file!");
		$txt = "";
		$txt .= "#!/bin/bash" . "\n";
		$txt .= "procesos=$(ps -ef | grep ./script_processing.sh | wc -l)" . "\n";
		$txt .= "[ $" . "procesos -le 1 ]" . "\n";
		$txt .= "	result=1" . "\n";
		$txt .= "	while [ $" . "result -gt 0 ]; do" . "\n";
		$txt .= "		result=$(curl " . MY_URL .DS . "index.php?url=iniciarprocesamiento/ft/start)" . "\n";
	    $txt .= "		echo $" . "result" . "\n";
		$txt .= " 		done" . "\n";
		fwrite($file, $txt);
		fclose($file);
	
		return $path;
	
	}
	
	private function copyFiles(){
		
		$origin = MY_FOLDER . DS . "files" . DS . "gpstk" . DS; 
		$destination = $this->_info['strucFolder']['process'] . DS;
		$files= glob($origin.'*.*');
		$files[] = $origin . "example9";
		$files[] = $origin . "teqc";
		$files[] = $origin . "azelplot";
		
		foreach ($files as $file){
			$file_copy = str_replace($origin, $destination, $file);
			copy($file, $file_copy);
			chmod($file_copy, fileperms($file));
		}
		
		return true;
		
	}
	
}

?>
