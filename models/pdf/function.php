<?php 

Class PDF{

	private $elements;
	private $module;
	private $info;
	private $connection;
	private $security;
	private $publicKey;
	private $token;

	private $graficos;
	private $pathImage;
	private $pathGrafico;
	
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
		$this->token = substr(md5(uniqid(time())), 0, 6);	
		
		$postprecesar = new PostProcesar();
		
		$this->model = $postprecesar->executeFuntion($this->info, $this->connection, $connection);
	
		$this->getInformation($this->info['folder']);
		
		$this->pathImage = $this->informationRinex['gif'];
		
		// Se debe ejecutar el siguiente permiso para Selinux para que permita ejecutar teqc
		
		$this->getValuesOut();
		
		$this->getValuesModel();

		$this->estructurarPDF();
		
		$this->generarPDF();
		
	}
	
	private function getInformation($folder){
		
		$response = $this->connection->select('processing', 'content_json',  array('AND' => array(
				'id' => $folder)));
		
		if(count($response) > 0 && $response != false){
			$this->informationRinex = (array) json_decode($response[0], true);
		}		
		
	}
	
	private function generarPDF(){
	
		require('framework' . DS . "html2pdf" . DS . "html2pdf.class.php");		

		ob_start();
		
		$html2pdf = new \HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(
				2,
				10,
				2,
				10,
		));
		
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($this->contenidoPagina);
		$html2pdf->Output( $this->informationRinex['strucFolder']['report'] . DS . 'INFORME_PROCESAMIENTO_' . "USUARIO" . '_' . date('Y-m-d') . '.pdf', 'F');
		
	}
	
	private function getValuesOut(){
		
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
// 		var_dump($DYDLON);
// 		var_dump($DZDH);
// 		var_dump($this->minMaxOut);
// 		var_dump($this->averageOut);die;
	}
	
	private function getValuesModel(){
	
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
		
		require 'Graficos.class.php';
		
		//$grafico = new Graficos();
		
		//$this->pathGrafico = $this->informationRinex['strucFolder']['report'] . DS . "grafico.jpg";
		
		//$this->graficos = $grafico->graficar_lineas($L1, $this->pathGrafico);
		
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
	
	private function estructurarPDF(){

		$width = 350;
		$height = 380;
			
		if(count($this->pathImage) == 1){
			$width = 350;
			$height = 380;
		}else if(count($this->pathImage) == 2){
			$width = 300;
			$height = 320;
		}elseif(count($this->pathImage) == 3){
			$width = 200;
			$height = 210;
		}
		
		$contenidoPagina = "
                            <style type=\"text/css\">
                                table {
                                    font-family:Helvetica, Arial, sans-serif; /* Nicer font */
                                    border-collapse:collapse; border-spacing: 3px;
                                }
                                td, th {
                                    border: 1px solid #000000;
                                    height: 13px;
                                } /* Make cells a bit taller */
                                th {
                                    font-weight: bold; /* Make sure they're bold */
                                    text-align: center;
                                    font-size:10px;
                                }
                                td {
                                    text-align: left;
                                }
                            </style>
                        <page backtop='25mm' backbottom='10mm' backleft='10mm' backright='10mm' footer='page'>
                            <page_header>
                                 <table  style='width:100%;' >
                                          <tr>
                                                <td align='center' style='width:100%;border=none;' >
                    	                           <img src='" . MY_URL . DS . "models/pdf/img/logoud_0.jpg'  width='100' height='100'>
												   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                	                               <img src='" . MY_URL . DS . "models/pdf/img/icg.jpg'  width='130' height='100'>
                                                </td>
                                        </tr>
                                    </table>
                        </page_header>
		
                        <table  style='width:100%;' >
                        	<tr>
                            	<td style='width:100%;border:none;text-align:center;'><br><br><b>UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS</b><br><b>INGENIERÍA CATASTRAL Y GEODESIA</b></td>
                           	</tr>
                        </table>";
		
						$contenidoPagina .= "
                            <br>
							<table  style='width:100%;' >
                            	<tr>
                                	<td style='width:100%;border:none;text-align:left;'><b>INFORMACIÓN DEL PROYECTO</b></td>
                           		</tr>
                            </table>
        					<br>
							NOMBRE DE USUARIO: " . $_SESSION['username'] . "
							<br>
							AÑO : " . $this->model['out'][0][0] . " 
							<br>
							DÍA: " . $this->model['out'][0][1] . " 
							<br>
							<br>
							<table  style='width:100%;' >
                            	<tr>
                                	<td style='width:100%;border:none;text-align:left;'><b>INFORMACIÓN DEL PUNTO</b></td>
                           		</tr>
                            </table>
							<br>
							NOMBRE DEL PUNTO: " . $this->informationRinex['markerName'] . "
							<br>
							TIPO DE RECEPTOR GNSS: " . $this->informationRinex['antenna'] . "
							<br>
							ALTURA DE LA ANTENA: " . $this->informationRinex['heightAntenna']['H'] . "
							<br>
							INTERVALO DE OBSERVACIÓN: " . $this->informationRinex['intervalPrecise'] .  "
							<br>
							HORA DE INICIO: " . $this->informationRinex['datePrecise'] ['dateStart'] .  "
							<br>
							HORA DE FINALIZACIÓN: " . $this->informationRinex['datePrecise']['dateEnd'] .  "
							<br>
							<br>
							<table  style='width:100%;' >
                            	<tr>
                                	<td style='width:100%;border:none;text-align:left;'><b>SELECCIÓN DE SATÉLITES</b></td>
                           		</tr>
                            </table>
							<br>
							NÚMERO DE SATÉLITES: " . "[" . $this->minMaxOut['SATELLITES']['min'] . " - " . $this->minMaxOut['SATELLITES']['max'] . "]
							<br>
				 			GDOP: " . "[" . $this->minMaxOut['GDOP']['min'] . " - " . $this->minMaxOut['GDOP']['max'] . "]
							<br>
							PDOP: " . "[" . $this->minMaxOut['PDOP']['min'] . " - " . $this->minMaxOut['PDOP']['max'] . "]
							<br>
							TDOP: " . "[" . $this->minMaxOut['TDOP']['min'] . " - " . $this->minMaxOut['TDOP']['max'] . "]
							<br>
							HDOP: " . "[" . $this->minMaxOut['HDOP']['min'] . " - " . $this->minMaxOut['HDOP']['max'] . "]
							<br>
							VDOP: " . "[" . $this->minMaxOut['VDOP']['min'] . " - " . $this->minMaxOut['VDOP']['max'] . "]
							<br>
							<br>
							<table  style='width:100%;' >
                            	<tr>
                                	<td style='width:100%;border:none;text-align:left;'><b>ESTADÍSTICAS</b></td>
                           		</tr>
                            </table>
        					<br>
							RETRASO CENITAL TROPOSFÉRICO - ZPD (m):  " . "[" . $this->minMaxOut['ZPD']['min'] . " - " . $this->minMaxOut['ZPD']['max'] . "] - [". $this->averageOut['ZPD'] . "]
							<br>
							DESVIACIÓN ESTANDAR DX  (m): [" . $this->deviationOut['COVARIANCEDXDLAT'] . "]
							<br>
							DESVIACIÓN ESTANDAR DY (m):  [" . $this->deviationOut['COVARIANCEDYDLON'] . "]
							<br>
							DESVIACIÓN ESTANDAR DZ (m):  [" . $this->deviationOut['COVARIANCEDZDH'] . "]
							<br>
							COVARIANZA RETRASO CENITAL TROPOSFÉRICO (m):  [" . $this->deviationOut['COVARIANCEZPD'] . "]
							<br>
							<br>
							<table  style='width:100%;' >
                            	<tr>
                                	<td style='width:100%;border:none;text-align:left;'><b>MODELO IONOSFERICO</b></td>
                           		</tr>
                            </table>
        					<br>
							DRYTROPO: " . "[". $this->averageModel['DRYTROPO'] . "]
							<br>
							DRYTROPOMAP: " . "[" . $this->minMaxModel['DRYTROPOMAP']['min'] . " - " . $this->minMaxModel['DRYTROPOMAP']['max'] . "] - [". $this->averageModel['DRYTROPOMAP'] . "]
							<br>
							WETTROPO: " . "[". $this->averageModel['WETTROPO'] . "]
							<br>
							WETTROPOMAP: " . "[" . $this->minMaxModel['WETTROPOMAP']['min'] . " - " . $this->minMaxModel['WETTROPOMAP']['max'] . "] - [". $this->averageModel['WETTROPOMAP'] . "]
							<br>
							SLANTTROPO: " . "[" . $this->minMaxModel['SLANTROPO']['min'] . " - " . $this->minMaxModel['SLANTROPO']['max'] . "] - [". $this->averageModel['SLANTROPO'] . "]
							<br>
							<br>
							<table  style='width:100%;' >
                            	<tr>
                                	<td style='width:100%;border:none;text-align:left;'><b>COORDENADAS FINALES</b></td>
                           		</tr>
                            </table>
							<br>
							X: " . ( $this->informationRinex['position']['X'] + $this->averageOut['DXDLAT']) . "
							<br>
							Y:  " . ($this->informationRinex['position']['Y'] + $this->averageOut['DYDLON']) . "
							<br>
							Z:  " . ($this->informationRinex['position']['Z'] + $this->averageOut['DZDH']) . "
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<!--table  style='width:100%;'>
                            	<tr>
                                	<td align='center' style='width:100%;border=none;' >
                    	            	<img src='". $this->pathGrafico . "'  width='600' height='200'>
                                    </td>
                                </tr>
                            </table-->
							<br>
							<table  align='center' style='width:100%;' >
									<tr>";
									
									foreach ($this->pathImage as $imagen){
										echo file_exists($imagen). "hola";
										if(file_exists($imagen)){
											$contenidoPagina .= "<td>
                    	            							<img id='skyplot' src='". $imagen . "' width='". $width . "' height='" . $height . "' alt='on' style='background-color: none;'/>
                                    						 </td>";
										}
									}
									
           $contenidoPagina .= "</tr>
           					</table>";

		$contenidoPagina .= "</page>";
		
		$this->contenidoPagina = $contenidoPagina;
	}
	
}

?>