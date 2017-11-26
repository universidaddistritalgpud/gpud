<?php

		
class CheckBox{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el elemento (element: Footer)
	//Definir el id (id)
	//Definir si se va a finar el píe de página (fixed: yes, no)
	//Definir el contenido del píe de página (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['inline']){
			case true:
				$params['inline'] = '-inline';
				break;
			case false:
				$params['inline'] = '';
				break;
			default:
				$params['inline'] = '';
				break;
		}
		
		$this->params = $params;
	}
	 	
	function checkbox($params) {
		
	 	$this->parameterize($params);
	 	
		$this->element['html'] = '';
		
		$this->element['html'] .= '<div class="form-group text-left" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		
		foreach ($this->params['option'] as $checkbox){
			$this->element['html'] .= '<div class="checkbox';
			$this->element['html'] .= $this->params['inline'];
			$this->element['html'] .= '">';
			$this->element['html'] .= '<label>';
			$this->element['html'] .= '<input type="checkbox" value="" id="';
			$this->element['html'] .= $checkbox['id'];
			$this->element['html'] .= '" ';
			
			switch ($checkbox['disabled']){
				case true:
					$checkbox['disabled'] = 'disabled';
					break;
				case false:
					$checkbox['disabled'] = '';
					break;
				default:
					$checkbox['disabled'] = '';
					break;
			}
			
			$this->element['html'] .= $checkbox['disabled'];
			$this->element['html'] .= '>';
			$this->element['html'] .= $checkbox['label'];
			$this->element['html'] .= '</label>';
			$this->element['html'] .= '</div>';
		}
		
		$this->element['html'] .= '</div>';		
		$this->element['html'] .= '';
		
		return $this->element;
	}
		
}

?>
