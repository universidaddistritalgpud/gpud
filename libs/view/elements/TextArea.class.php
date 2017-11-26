<?php

		
class TextArea{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el elemento (element: Footer)
	//Definir el id (id)
	//Definir si se va a finar el píe de página (fixed: yes, no)
	//Definir el contenido del píe de página (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['disabled']){
			case true:
				$params['disabled'] = 'disabled';
				break;
			case false:
				$params['disabled'] = '';
				break;
			default:
				$params['disabled'] = '';
				break;
		}
		
		switch ($params['required']){
			case true:
				$params['required'] = 'required';
				break;
			case false:
				$params['required'] = '';
				break;
			default:
				$params['required'] = '';
				break;
		}
		
		$this->params = $params;
	}
	 	
	function textarea($params) {
		
	 	$this->parameterize($params);
	 	
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="form-group text-left">';
		$this->element['html'] .= '<label for="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= $this->params['label'];
		$this->element['html'] .= '</label>';
		$this->element['html'] .= '<textarea class="form-control" rows="';
		$this->element['html'] .= $this->params['rows'];
		$this->element['html'] .= '" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .=  '" ';
		$this->element['html'] .= $this->params['disabled'];
		$this->element['html'] .= ' ';
		$this->element['html'] .= $this->params['required'];
		$this->element['html'] .= '>';
		$this->element['html'] .=  '</textarea>';
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '';
		
		return $this->element;
	}
		
}

?>
