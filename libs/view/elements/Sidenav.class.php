<?php

		
class Sidenav{
	
	private $element=array();
	private $params=array();

	/*
	 _______ ___________ _______
	|		|			|		|
	|		|			|		|
	|		|			|		|
	|		|			|		|
	|		|			|		|
	|_______|___________|_______|
	
	*/
	
	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el id (id)
	//Definir tipo de Alerta (class: success, info, warning, danger)
	//Definir el titulo (title)
	//Definir una mensaje para la alerta (message)
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['text']){
			
			case 'default':
				$params['text'] = '';
				break;
			case 'left':
				$params['text'] = 'text-left';
				break;
			case 'center':
				$params['text'] = 'text-center';
				break;
			case 'rigth':
				$params['text'] = 'text-rigth';
				break;
			default:
				$params['text'] = '';
				break;
			
		}
		
		switch ($params['sidenav']){
				
			case 'yes':
				$params['sidenav'] = 'sidenav';
				break;
			case 'no':
				$params['sidenav'] = '';
				break;
			default:
				$params['sidenav'] = '';
				break;
					
		}
		
		$this->params = $params;
	}
	 	
	function sidenav($params, $contentEnc) {
		
// 	 	$this->parameterize($params);

		$this->element['html'] = '';
		
		if(count($params['sidenav'])>1){
			$this->element['html'] .= '<div class="container-fluid text-center" id="';
			$this->element['html'] .= $params['id'];
			$this->element['html'] .= '">';
			$id='';
		}else{
			$id = ' id="'. $params['id'] . '"';
		}
		
		$this->element['html'] .= '<div class="row content';
		$this->element['html'] .= $id;
		$this->element['html'] .= '">';
		
		foreach ($params['sidenav'] as $attribute){
			
			$this->element['html'] .= '<div class="col-sm-';
			$this->element['html'] .= $attribute['column'];
			$this->element['html'] .= ' ';
			$this->element['html'] .= $attribute['shadow'];
			$this->element['html'] .= ' ';
			$this->element['html'] .= $attribute['text'];
			$this->element['html'] .= '">';

			foreach ($attribute['content'] as $content){
				
				if(isset($contentEnc[$content]) && array_key_exists($contentEnc[$content], $params['content'])){
					$this->element['html'] .= $params['content'][$contentEnc[$content]];
				}else{
					$this->element['html'] .= $content;
				}
			}
			
			$this->element['html'] .= '</div>';
		}
		
		$this->element['html'] .= '</div>';
		
		if(count($params['sidenav'])>1){
			$this->element['html'] .= '</div>';
		}
		$this->element['html'] .= '';
		
		return $this->element;
	}
		
}

?>
