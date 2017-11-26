<?php

		
class Struct{
	
	private $element;

	function __construct(){
		
	}

	 function Open($params) {
		$this->element['html'] = '';
		$this->element['html'] .= '<!DOCTYPE html>';
		$this->element['html'] .= '<html lang="en">';
		$this->element['html'] .= '<head>';
		$this->element['html'] .= '<title>';
		$this->element['html'] .= $params['title'];
		$this->element['html'] .= '</title>';
		$this->element['html'] .= '<meta charset="utf-8">';
		$this->element['html'] .= '<link rel="shortcut icon" href="views/inicio/img/favicon.ico">';
		
		$this->element['html'] .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
		$this->element['html'] .= '<link rel="stylesheet" href="' . 'framework' . DS .'bootstrap-3.3.6-dist/css/bootstrap.min.css">';
		$this->element['html'] .= '<link rel="stylesheet" href="' . 'framework' . DS .'bootstrap-3.3.6-dist/css/bootstrap.min.css">';
		
		if(isset($params['css'])){
			foreach ($params['css'] as $css){
				$this->element['html'] .= '<link rel="stylesheet" href="';
				$this->element['html'] .=  $css;
				$this->element['html'] .= '">';
			}
		}
		
		$this->element['html'] .= '<script src="' . 'framework' . DS . 'jquery-2.0.3/jquery.min.js"></script>';
		$this->element['html'] .= '<script src="' . 'framework' . DS . 'bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>';
		$this->element['html'] .= '<script src="' . 'framework' . DS . 'bootstrapvalidator-5.2-dist/js/bootstrapValidator.min.js"></script>';
		$this->element['html'] .= '<script src="' . 'framework' . DS . 'bootstrapvalidator-5.2-dist/js/language/es_ES.js"></script>';
		
		if(isset($params['js-prev'])){

			foreach ($params['js-prev'] as $key => $js){

				if($key === 'define'){
					$this->element['html'] .= $js;
				}else{
					$this->element['html'] .= '<script src="';
					$this->element['html'] .= $js;
					$this->element['html'] .= '"></script>';
				}
			}
		}
		
		$this->element['html'] .= $params['all'];

		$this->element['html'] .= '</head>';
		
		$this->element['html'] .= '<div id="modalLoad" class="modalLoad"></div>';
		
		$this->element['html'] .= '<body>';
		
		
		return $this->element;
	}
	
	function close($params) {
		$this->element['html'] = '';
		
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '</body>';
		
		if(isset($params['js'])){
			foreach ($params['js'] as $js){
				$this->element['html'] .= '<script src="';
				$this->element['html'] .= $js;
				$this->element['html'] .= '"></script>';
			}
		}
		
		$this->element['html'] .= $params['all'];
		
		$this->element['html'] .= '</html>';
		
		return $this->element;
	}
}

?>
