<?php

		
class RadioButton{
	
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
	 	
	function radiobutton($params) {
		
	 	$this->parameterize($params);
	 	
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="form-group text-left" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		
		foreach ($this->params['option'] as $radiobutton){
			$this->element['html'] .= '<div class="radio';
			$this->element['html'] .= $this->params['inline'];
			$this->element['html'] .= '">';
			$this->element['html'] .= '<label>';
			$this->element['html'] .= '<input type="radio" name="';
			$this->element['html'] .= $this->params['name'];
			$this->element['html'] .= '" id="';
			$this->element['html'] .= $radiobutton['id'];
			$this->element['html'] .= '" ';
			
			switch ($radiobutton['disabled']){
				case true:
					$radiobutton['disabled'] = 'disabled';
					break;
				case false:
					$radiobutton['disabled'] = '';
					break;
				default:
					$radiobutton['disabled'] = '';
					break;
			}
			
			$this->element['html'] .= $radiobutton['disabled'];
			$this->element['html'] .= '>';
			$this->element['html'] .= $radiobutton['label'];
			$this->element['html'] .= '</label>';
			$this->element['html'] .= '</div>';
		}
		
		$this->element['html'] .= '</div>';		
		$this->element['html'] .= '';
		
		return $this->element;
	}
		
}

?>
