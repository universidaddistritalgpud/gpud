<?php

		
class Input{
	
	private $element=array();
	private $params=array();
	private $has;
	private $icon;
	private $feedback;
	
	//Esta clase recibe como parametro un arreglo el cual debe contener:
	//Definir el identificador del input (id).
	//Definir el texto para la etiqueta del input (label).
	//Definir el tipo de input (type: text, password, email).
	//Definir si el input estará deshabilitado (disabled: yes, no).
	//Definir la clase de input (class: default, success, warning, error).
	//Definir el texto de fondo que va dentro del input (placeholder).
	
	function __construct(){}

	private function parameterize($params){
		
		$this->has = '';
		$this->icon = '';
		$this->feedback = '';
		 
		switch ($params['disabled']){
			case "yes":
				$params['disabled'] = 'disabled';
				break;
			case "no":
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
		 
		switch ($params['class']){
			case "default":
				$this->has = '';
				$this->icon = '';
				$this->feedback = '';
				break;
			case "success":
				$this->has = 'has-success';
				$this->icon = 'glyphicon glyphicon-ok';
				$this->feedback = 'form-control-feedback';
				break;
			case "warning":
				$this->has = 'has-warning';
				$this->icon = 'glyphicon glyphicon-warning-sign';
				$this->feedback = 'form-control-feedback';
				break;
			case "error":
				$this->has = 'has-error';
				$this->icon = 'glyphicon glyphicon-remove';
				$this->feedback = 'form-control-feedback';
				break;
			default:
				$this->has = '';
				$this->icon = '';
				$this->feedback = '';
				break;
		}
		
		$this->params = $params;
	}
	
	function input($params) {
	 	
		$this->parameterize($params);
	 	
	 	$this->element['html'] = '';
	 	$this->element['html'] .= '<div class="form-group ';
	 	$this->element['html'] .= $this->openFedeback();
	 	$this->element['html'] .= ' text-left">';
		$this->element['html'] .= $this->label();
		$this->element['html'] .= $this->openAddon();
		$this->element['html'] .= $this->attributesInput();
		$this->element['html'] .= $this->closeAddon();;
		$this->element['html'] .= $this->closeFedeback();
		$this->element['html'] .= '</div>';
		
		$this->element['html'] .= '';
		
		return $this->element;
	}
	
	private function label(){
		
		$label= '';
		
		if($this->params['label'] != ""){
			$label .= '<label for="';
			$label .= $this->params['id'];
			$label .= '">';
			$label .= $this->params['label'];
			$label .= '</label>';
		}
		
		return $label;
	}
	
	private function attributesInput(){
		
		if($this->params['type'] == "file"){
			$input = '';
			$input .= '<input name="';
			$input .= $this->params['id'];
			if(isset($this->params['multiple'])){
				$input .= "[]" ;
			}
			$input .= '" value="" class="" id="';
			$input .= $this->params['id'];
			$input .= '" type="';
			$input .= $this->params['type'];
			$input .= '" ';
			if(isset($this->params['multiple'])){
				$input .= $this->params['multiple'];
				$input .= '';
			}
			$input .= $this->params['disabled'];
			$input .= ' ';
			$input .= $this->params['required'];
			$input .= '>';
			
		}else{
			$input = '';
			$input .= '<input name="';
			$input .= $this->params['id'];
			$input .= '" value="" class="form-control" id="';
			$input .= $this->params['id'];
			$input .= '" type="';
			$input .= $this->params['type'];
			$input .= '" placeholder="';
			$input .= $this->params['placeholder'];
			$input .= '" ';
			$input .= $this->params['disabled'];
			$input .= ' ';
			$input .= $this->params['required'];
			$input .= '>';
		}
		
		return $input;
	}
	
	private function closeFedeback(){
		
		$fedeback = '';
		$fedeback .= '<span class="';
		$fedeback .= $this->icon;
		$fedeback .= ' ';
		$fedeback .= $this->feedback;
		$fedeback .= '"></span>';
		
		return $fedeback;
	}
	
	private function openFedeback(){
		
		$fedeback = '';
		$fedeback .= $this->has;
		$fedeback .= ' ';
		$fedeback .= 'has-feedback';
		
		return $fedeback;
	}
	
	private function openAddon(){
		
		$addon = '';

		if(isset($this->params['iconLeft']) || isset($this->params['iconRight']) | isset($this->params['symbolLeft']) |isset($this->params['symbolRight'])){
		
			$addon .= '<div class="input-group">';
			
			if(isset($this->params['iconLeft']) || (isset($this->params['iconLeft']) && isset($this->params['iconRight']))){
				$addon .= '<span class="input-group-addon">';
				$addon .= '<span class="glyphicon ';
				$addon .= $this->params['iconLeft'];
				$addon .= '"></span>';
				$addon .= '</span>';
			}
			
			if(isset($this->params['symbolLeft']) || (isset($this->params['symbolLeft']) && isset($this->params['symbolRight']))){
				$addon .= '<span class="input-group-addon">';
				$addon .= $this->params['symbolLeft'];
				$addon .= '</span>';
			}
		}
		
		return $addon;
	}
	
	private function closeAddon(){
	
		$addon = '';
		
		if(isset($this->params['iconLeft']) || isset($this->params['iconRight']) | isset($this->params['symbolLeft']) |isset($this->params['symbolRight'])){
		
			if(isset($this->params['iconRight']) || (isset($this->params['iconLeft']) && isset($this->params['iconRight']))){
				$addon .= '<span class="input-group-addon">';
				$addon .= '<span class="glyphicon ';
				$addon .= $this->params['iconRight'];
				$addon .= '"></span>';
				$addon .= '</span>';
			}
		
			if(isset($this->params['symbolRight']) || (isset($this->params['symbolLeft']) && isset($this->params['symbolRight']))){
				$addon .= '<span class="input-group-addon">';
				$addon .= $this->params['symbolRight'];
				$addon .= '</span>';
			}
			
			$addon .= '</div>';
		
		}
		
		return $addon;
	}
}

?>
