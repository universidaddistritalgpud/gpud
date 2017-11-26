<?php

		
class ListSelect{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el elemento (element: Footer)
	//Definir el id (id)
	//Definir si se va a finar el píe de página (fixed: yes, no)
	//Definir el contenido del píe de página (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['multiselect']){
			case true:
				$params['multiselect'] = 'multiple';
				break;
			case false:
				$params['multiselect'] = '';
				break;
			default:
				$params['multiselect'] = '';
				break;
		}
		
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
	 	
	function listselect($params) {
		
		$this->parameterize($params);
		
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="form-group">';
		$this->element['html'] .= '<label for="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= $this->params['label'];
		$this->element['html'] .= '</label>';
		$this->element['html'] .= '<select ';
		$this->element['html'] .= $this->params['multiselect'];
		$this->element['html'] .= ' ';
		$this->element['html'] .= 'class="form-control" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'name="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= $this->params['disabled'];
		$this->element['html'] .= ' ';
		$this->element['html'] .= $this->params['required'];
		$this->element['html'] .= '>';
		
		if($this->params['multiselect'] == ""){
			$this->element['html'] .= '<option value="">Seleccione una Opción ...</option>';
		}
		
		foreach ($this->params['option'] as $id=>$select){
			$this->element['html'] .= '<option value="';
			$this->element['html'] .=  $id;
			$this->element['html'] .= '">';
			$this->element['html'] .= $select;
			$this->element['html'] .= '</option>';
		}
		$this->element['html'] .= '</select>';		
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '';
		
		return $this->element;
	}
		
}

?>
