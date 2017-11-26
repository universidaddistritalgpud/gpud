<?php 

Class MyProcessing{

	private $elements;
	private $module;
	private $info;
	private $connection;
	private $security;
	private $publicKey;

	private $contenidoPagina;
	private $model;
	private $minMaxOut;
	private $minMaxModel;
	private $averageModel;
	private $averageOut;
	private $deviationOut;
	private $intervalo;
	private $duration;
	private $informationRinex;
	
	function __construct(){

		$this->module = array_pop(explode("/", dirname(__FILE__)));
		$this->elements = array();
		$this->security = new Security();
	}

	public function executeFuntion($info, $connection, $publickey){
		$this->info = $info;
		$this->connection = $connection;
		$this->publicKey = $publickey;
		
		if(count($info) <= 1){
			$exp = explode("-", $info);
			
			if(count($info) <= 1){
				$this->info = $info;
			}else{
				$this->info['option'] = $exp[0];
				$this->info['folder'] = $exp[1];
				$this->info['markerName'] = $exp[2];
			}
			
		}else{
			
			if(isset($this->info['option'])){
				$this->info = $info;
			}else{
				$this->info['option'] = $info[0];
				$this->info['folder'] = $info[1];
				$this->info['markerName'] = $info[2];
			}
		}
		
		
		if(!isset($this->info['option'])){
			return $this->cargarDatos();
		}else{
			$this->informationRinex = $this->getInformationProcess();
			$this->model = $this->readModel();
		}
		
	}
	
	private function  cargarDatos(){
		
		$response = $this->connection->select('processing', "*",  ['AND' => [
				'id_user' => $this->info, 'registration_state' => "true"]]);
		
		return $response;
			
	}
	
	public function getInformationProcess(){
	
		$response = $this->connection->select('processing', 'content_json',  array('AND' => array(
				'id' => $this->info['folder'])));
	
		$information = "";
		
		if(count($response) > 0 && $response != false){
			$information = (array) json_decode($response[0], true);
		}
		
		return $information;
	
	}
	
	private function  readModel(){
	
		require 'ReadFiles.class.php';
		$read = new ReadFiles();
		
		$result['out'] = (array) $read->readOut(MY_FOLDER . DS . "files" . DS . $this->informationRinex['strucFolder']['prefijo'] . "_" . $this->informationRinex['markerName'] . "_" . $this->informationRinex['date']['year'] . "_" . $this->informationRinex['dayofyear'] . ".zip",  $this->informationRinex['markerName']);
		$result['model'] = (array) $read->readModel(MY_FOLDER . DS . "files" . DS . $this->informationRinex['strucFolder']['prefijo'] . "_" . $this->informationRinex['markerName'] . "_" . $this->informationRinex['date']['year'] . "_" . $this->informationRinex['dayofyear'] . ".zip",  $this->informationRinex['markerName']);
		$result['img']['skyplot1'] = $read->showimage(MY_FOLDER . DS . "files" . DS . $this->informationRinex['strucFolder']['prefijo'] . "_" . $this->informationRinex['markerName'] . "_" . $this->informationRinex['date']['year'] . "_" . $this->informationRinex['dayofyear'] . ".zip",  $this->informationRinex['markerName'] . "_0.gif");
		$result['img']['skyplot2'] =  $read->showimage(MY_FOLDER . DS . "files" . DS . $this->informationRinex['strucFolder']['prefijo'] . "_" . $this->informationRinex['markerName'] . "_" . $this->informationRinex['date']['year'] . "_" . $this->informationRinex['dayofyear'] . ".zip",  $this->informationRinex['markerName'] . "_1.gif");
		$result['img']['skyplot3'] =  $read->showimage(MY_FOLDER . DS . "files" . DS . $this->informationRinex['strucFolder']['prefijo'] . "_" . $this->informationRinex['markerName'] . "_" . $this->informationRinex['date']['year'] . "_" . $this->informationRinex['dayofyear'] . ".zip",  $this->informationRinex['markerName'] . "_2.gif");
		
		return $result;
			
	}
	
	public function getValuesOut(){
	
		foreach ($this->model['out'] as $items => $value){
	
			if (count($value) == 18) {
				$DXDLAT[] =  $value[3];
				$DYDLON[] =  $value[4];
				$DZDH[] =  $value[5];
				$ZPD[] =  $value[6];
				$COVARIANCEDXDLAT[] =  $value[7];
				$COVARIANCEDYDLON[] =  $value[8];
				$COVARIANCEDZDH[] =  $value[9];
				$COVARIANCEZPD[] =  $value[10];
				$SATELLITES[] =  $value[11];
				$GDOP[] =  $value[12];
				$PDOP[] =  $value[13];
				$TDOP[] =  $value[14];
				$HDOP[] =  $value[15];
				$VDOP[] =  $value[16];
	
				$this->duration = $value[2];
			}
	
		}
	
	
		$this->minMaxOut = array("DXDLAT"=>$this->getMinMax($DXDLAT),"DYDLON"=>$this->getMinMax($DYDLON),"DZDH"=>$this->getMinMax($DZDH),"ZPD"=>$this->getMinMax($ZPD), "SATELLITES"=>$this->getMinMax($SATELLITES),"GDOP"=>$this->getMinMax($GDOP),"PDOP"=>$this->getMinMax($PDOP),"TDOP"=>$this->getMinMax($TDOP),"HDOP"=>$this->getMinMax($HDOP),"VDOP"=>$this->getMinMax($VDOP));
		$this->deviationOut = array("COVARIANCEDXDLAT"=>$this->getStandardDeviation($COVARIANCEDXDLAT) ,"COVARIANCEDYDLON"=>$this->getStandardDeviation($COVARIANCEDYDLON),"COVARIANCEDZDH"=>$this->getStandardDeviation($COVARIANCEDZDH),"COVARIANCEZPD"=>$this->getStandardDeviation($COVARIANCEZPD));
		$this->averageOut = array("DXDLAT"=>$this->getAverage($DXDLAT), "DYDLON"=>$this->getAverage($DYDLON), "DZDH"=>$this->getAverage($DZDH), "ZPD"=>$this->getAverage($ZPD));
	
		$this->duration = $this->conversorSegundosHoras($this->duration);
	
		return array("minMaxOut" => $this->minMaxOut, "deviationOut" => $this->deviationOut, "averageOut" => $this->averageOut, "duration" => $this->duration);
	
	}
	
	public function  getImages(){
		return $this->model['img'];
	}
	
	public function getValuesModel(){
	
		$startValue = 0;
		$timeCollection = '0.0000';
		$valuetime = array();
	
		foreach ($this->model['model'] as $items => $value){
	
			foreach ($value as $info){
	
				if (count($info) > 57) {
					$DRYTROPO[] =  $info['dryTropo'];
					$DRYTROPOMAP[] =  $info['dryTropoMap'];
					$WETTROPO[] =  $info['wetTropo'];
					$WETTROPOMAP[] =  $info['wetTropoMap'];
					$SLANTROPO[] =  $info['slantTropo'];
	
					$L1[$info['TimeCollection']][$info['GPS']] = $info['LC'];
	
					if($timeCollection == $info['TimeCollection']){
						$valuetime[] = $info['LC'];
					}else{
	
						$average = $this->getAverage($valuetime);
						$deviation = $this->getStandardDeviation($valuetime);
	
						foreach ($L1[$timeCollection] as $gps2 => $value2){
							$L1[$timeCollection][$gps2] = ($value2 - $average)/$deviation;
						}
	
						$timeCollection = $info['TimeCollection'];
					}
	
				}
			}
		}
	
		$average = $this->getAverage($valuetime);
		$deviation = $this->getStandardDeviation($valuetime);
	
		foreach ($L1[$timeCollection] as $gps2 => $value2){
			$L1[$timeCollection][$gps2] = ($value2 - $average)/$deviation;
		}
	
		$this->minMaxModel = array("DRYTROPO"=>$this->getMinMax($DRYTROPO),"DRYTROPOMAP"=>$this->getMinMax($DRYTROPOMAP),"WETTROPO"=>$this->getMinMax($WETTROPO),"WETTROPOMAP"=>$this->getMinMax($WETTROPOMAP),"SLANTROPO"=>$this->getMinMax($SLANTROPO));
		$this->averageModel = array("DRYTROPO"=>$this->getAverage($DRYTROPO),"DRYTROPOMAP"=>$this->getAverage($DRYTROPOMAP),"WETTROPO"=>$this->getAverage($WETTROPO),"WETTROPOMAP"=>$this->getAverage($WETTROPOMAP),"SLANTROPO"=>$this->getAverage($SLANTROPO));
	
		return array("minMaxModel" => $this->minMaxModel, "averageModel" => $this->averageModel);
	}
	
	function conversorSegundosHoras($tiempo_en_segundos) {
		$horas = floor($tiempo_en_segundos / 3600);
		$minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
		$segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
	
		return $horas . "H " . $minutos . "M " . $segundos . "S";
	}
	
	function getStandardDeviation($aValues, $bSample = false)
	{
		$fMean = array_sum($aValues) / count($aValues);
		$fVariance = 0.0;
		foreach ($aValues as $i)
		{
			$fVariance += pow($i - $fMean, 2);
		}
		$fVariance /= ( $bSample ? count($aValues) - 1 : count($aValues) );
		return (float) sqrt($fVariance);
	}
	
	private function getAverage($array){
	
		$average = 0;
	
		foreach ($array as $value){
			$average = $average + $value;
		}
	
		$average = $average/count($array);
	
		return $average;
	}
	
	private function getMinMax($array){
		$min = min($array);
		$max = max($array);
		$value = array("min"=>$min, "max"=>$max);
		return $value;
	}
	
	
	
	
	
}

?>