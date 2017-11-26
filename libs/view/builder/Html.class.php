<?php

Class Html{
	
	private static $html;
	private static $page;
	private static $script;
	private static $css;
	private static $id;
	private static $idClearString;
	private static $process;
	private static $struct;
	private static $elementsIn;
	private static $search;
	private static $publicKey;
	private static $security;
	private static $securityStatus;
	private static $module;
	private static $title;
	
	function __construct(){}
	
	protected  function  processElement($element){
		
		foreach ($element as $draw){
			
			self::$search = array();
			
			self::searchKey($draw, 'id');
			
			if(self::$securityStatus == true){
				$draw = self::replaceContentKey($draw);
			}else{
				self::getContentKey($draw);
			}
			
			$content = array();
			
			if(array_key_exists("element", $draw)){
				$class = $draw['element']; 
				if(in_array($class, self::$elementsIn)){
					
					if(isset($draw['content'])){
						
						foreach ($draw['content'] as $elem){
							if(isset(self::$idClearString[$elem]) && in_array (self::$idClearString[$elem], self::$process)){
								$content[self::$idClearString[$elem]] = self::$html[self::$idClearString[$elem]]['content'];
								self::$html[self::$idClearString[$elem]]['visible'] = false;
							}else{
								$content[] = $elem;
							}
							
						}
						
						$draw['content'] = $content;
						
					}
					
				}
				
				if($class=="Information"){
					
					self::$securityStatus = $draw['security'];
					self::$module = $draw['module'];
					self::$title = $draw['title'];
				}else{
					$elementDraw = new  $class();

					$result = $elementDraw->$class($draw, self::$idClearString);
					
					if(isset($result['html'])){
						
						if($draw["element"] == "Menu"){
							$menu[$draw['id']]['content'] = '<div class="menu">';
							$menu[$draw['id']]['content'] .= $result['html'];
							$menu[$draw['id']]['content'] .= '</div>';
							$menu[$draw['id']]['content'] .= '<div class="cont">';
							$menu[$draw['id']]['visible'] = true;
							self::$html = array_merge($menu,self::$html);
						}else{
							self::$html[$draw['id']]['content'] = $result['html'];
							self::$html[$draw['id']]['visible'] = true;
							
						}
					}
					if(isset($result['script'])){
						self::$script .= $result['script'];
					}
					if(isset($result['css'])){
						self::$css .= $result['css'];
					}
					
					array_push(self::$process, $draw['id']);
				}
				
			}
		}
	}
	
	protected  function  errorElement($element){

	}
	
	protected  function  draw($element,$publickey){

		self::$elementsIn = array('Menu', 'Sidenav','Jumbotron','Form','Panel','Modal','Collapse','Section');
		self::$security = new Security();
		self::$publicKey = $publickey;
		self::$idClearString = array();
		self::$struct = new Struct();
		self::$process = array();
		self::$search = array();
		self::$html = array();
		self::$id = array();
		self::$module = '';
		self::$title = '';
		self::$script = '';
		self::$page = '';
		self::$css = '';
		
		self::processElement($element);

		self::open();
		
		self::close();
		
		foreach (self::$html as $content){
			if($content['visible'] == true){
				self::$page .= $content['content'];
			}
		}
		
		return self::$page;
	}
	
	private function getContentKey($draw){
	
		foreach (self::$search as $path){
			$keyExp = explode("<>", $path);
			
			switch (count($keyExp)){
				case 1:
					self::$idClearString[$draw[$keyExp[0]]] = $draw[$keyExp[0]];
					break;
				case 2:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]]]  = $draw[$keyExp[0]][$keyExp[1]];
					break;
				case 3:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]];
					break;
				case 4:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]];
					break;
				case 5:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]];
					break;
				case 6:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]];
					break;
				case 7:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]];
					break;
				case 8:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]];
					break;
				case 9:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]];
					break;
				case 10:
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]]]  = $draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]];
					break;
				default:
			}
		}
	}
	private function replaceContentKey($draw){
		
		foreach (self::$search as $path){
			$keyExp = explode("<>", $path);
			
			switch (count($keyExp)){
				case 1:
					self::$id[$draw[$keyExp[0]]] = self::$security->encrypt($draw[$keyExp[0]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]]] = self::clearString(self::$id[$draw[$keyExp[0]]]);
					$draw[$keyExp[0]] = self::$idClearString[$draw[$keyExp[0]]];
					break;
				case 2:
					self::$id[$draw[$keyExp[0]][$keyExp[1]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]]]);
					$draw[$keyExp[0]][$keyExp[1]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]]];
					break;
				case 3:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]]];
					break;
				case 4:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]]];
					break;
				case 5:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]]];
					break;
				case 6:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]]]  = self::clearString( self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]]];
					break;
				case 7:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]]];
					break;
				case 8:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]]];
					break;
				case 9:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]]];
					break;
				case 10:
					self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]]]  = self::$security->encrypt($draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]],self::$publicKey);
					self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]]]  = self::clearString(self::$id[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]]]);
					$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]]  = self::$idClearString[$draw[$keyExp[0]][$keyExp[1]][$keyExp[2]][$keyExp[3]][$keyExp[4]][$keyExp[5]][$keyExp[6]][$keyExp[7]][$keyExp[8]][$keyExp[9]]];
					break;
				default:
			}
		}
		
		return $draw;
	}
	
	private static function clearString($text)
	{
		$textClear = preg_replace('([^A-Za-z0-9])', '', $text);
		return $textClear;
	}
	
	private function searchKey($matriz, $word="id",$beforeKey=""){
	
		if($word === ""){
			self::searchAll($matriz, $beforeKey);
		}else{
			foreach($matriz as $key=>$value){
				if (is_array($value)){
					if($beforeKey != ""){
						$key = $beforeKey.'<>'. $key;
					}
					self::searchKey($value, $word, $key);
				}else{
					if($key===$word){
						if($beforeKey != ""){
							$key = $beforeKey.'<>'. $key;
							self::$search[] = $key;
						}else{
								self::$search[] = $key;
						}
					}
				}
			}
		}
	}
	
	private function searchAll($matriz, $beforeKey){
	
		foreach($matriz as $key=>$value){
			if (is_array($value)){
				if($beforeKey != ""){
					$key = $beforeKey.'<>'. $key;
					self::$search[] = $key;
				}else{
					self::$search[] = $key;
				}
				self::searchAll($value, $key);
			}else{
				if($beforeKey != ""){
					$key = $beforeKey.'<>'. $key;
					self::$search[] = $key.'<<'.$value;
				}else{
					self::$search[] = $key.'<<'.$value;
				}
			}
	
		}
	}
	
	private  function  open(){
		$params = array();
		
		$params['title'] = self::$title;
		
		$ruta = 'views' . DS . self::$module . DS . 'css' . DS;
		
		if (is_dir($ruta)) {
			if ($dh = opendir($ruta)) {
				while (($file = readdir($dh)) !== false) {
					if (is_file($ruta . $file)){
						$params['css'][] = $ruta.$file;
					}
				}
				closedir($dh);
			}
		}
		
		$ruta = 'views' . DS . self::$module . DS . 'js-prev' . DS;
		
		if (is_dir($ruta)) {
			if ($dh = opendir($ruta)) {
				while (($file = readdir($dh)) !== false) {
					if (is_file($ruta . $file)){
						
						if($file == "define-php-js.js"){
							$params['js-prev']['define'] = self::encryptScripts2($ruta . $file);
						}else{
							$order[strtolower($file)] = $ruta.$file;
						}
					}
				}
				closedir($dh);
			}
		}

		ksort ($order);
		
		foreach ($order as $key => $value) {
		
			$params['js-prev'][] = $value;
		
		}
		
		$params['all'] = self::$css;
		
		$result = self::$struct->close($params);
		
		$result = self::$struct->Open($params);
		
		if(isset($result['html'])){
			$op['visible'] = true;
			$op['content'] = $result['html'];
			
			array_unshift(self::$html, $op);
		}
		
	}
	
	private  function  close(){
		
		$ruta = 'views' . DS . self::$module . DS . 'js-local' . DS;
		
		self::encryptScripts($ruta);
		
		$params['all'] = self::$script;
		
		$ruta = 'views' . DS . self::$module . DS . 'js' . DS;
		
		if (is_dir($ruta)) {
			if ($dh = opendir($ruta)) {
				while (($file = readdir($dh)) !== false) {
					if (is_file($ruta . $file)){
						$params['js'][] = $ruta.$file;
					}
				}
				closedir($dh);
			}
		}
		
		$result = self::$struct->close($params);
	
		if(isset($result['html'])){
			self::$html['close']['visible'] = true;
			self::$html['close']['content'] = $result['html'];
		}
	}
	
	public  function  getId($element){
		return self::$idClearString[$element];
	}
	
	private function encryptScripts($ruta){
		
		if (is_dir($ruta)) {
			if ($dh = opendir($ruta)) {
				while (($file = readdir($dh)) !== false) {
						
					self::$script .= '<script type=text/javascript>';
					self::$script .= '$(document).ready(function(){';
						
					$fp = fopen($ruta.$file, 'r');
						
					while(!feof($fp)) {
		
						$linea = fgets($fp);
		
						if(strpos($linea, "encrypt") !== false ){
							$linea = self::encryptField($linea);
						}
						
						if(strpos($linea, "getDefine") !== false ){
							$linea = self::getdefine($linea);
						}
		
						self::$script .= $linea;
		
					}
		
					fclose($fp);
						
					self::$script .= '});</script>';
						
				}
		
				closedir($dh);
			}
		}
		
	}
	
	private function encryptScripts2($ruta){
	
		$script = "";
				
					$script = '<script type=text/javascript>';
	
					$fp = fopen($ruta, 'r');
	
					while(!feof($fp)) {
	
						$linea = fgets($fp);
	
						if(strpos($linea, "encrypt") !== false ){
							$linea = self::encryptField($linea);
						}
	
						if(strpos($linea, "getDefine") !== false ){
							$linea = self::getdefine($linea);
						}
	
						$script .= $linea;
	
					}
	
					fclose($fp);
	
					$script .= '</script>';
		
		return $script;
	
	}
	
	private function encryptField($linea){
	
		$characters = str_split($linea);
		$cont = 0;
		$id = "";
		$word = "";
	
		foreach ($characters as $a){
	
			$word .= $a;
	
			if($a == "(" && strpos($word, "encrypt") !== false){
				$cont++;
			}else if($cont > 0 && $a == ")"){
				$cont++;
			}else if($cont > 0 && $cont < 2){
				$id .= $a;
			}
	
		}
	
		if(isset(self::$idClearString[$id])){
			$linea = str_replace (  "encrypt(" . $id . ")", self::$idClearString[$id], $linea);
		}else{
			$security = new Security();
			$linea = str_replace (  "encrypt(" . $id . ")", $security->encrypt($id, self::$publicKey), $linea);
		}
	
		return $linea;
			
	}
	
	
	private function encryptUrl($linea){
	
	}
	
	private function getDefine($linea){
	
		$characters = str_split($linea);
		$cont = 0;
		$define = "";
		$word = "";
	
		foreach ($characters as $a){
	
			$word .= $a;
	
			if($a == "(" && strpos($word, "getDefine") !== false){
				$cont++;
			}else if($cont > 0 && $a == ")"){
				$cont++;
			}else if($cont > 0 && $cont < 2){
				$define .= $a;
			}
	
		}
	
		$var_def = get_defined_constants();

		if(isset($var_def[$define])){
			$linea = str_replace (  "getDefine(" . $define . ")", $var_def[$define], $linea);
		}
	
		return $linea;
			
	}
}

?>

