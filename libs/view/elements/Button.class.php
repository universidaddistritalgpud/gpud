<?php

class Button{

	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener:
	//Definir el id (id)
	//Definir el tipo (type: button, submit, reset)
	//Definir tipo de botón (class: default, primary, success, info, warning, danger, link)
	//Definir si el botón esta activado (state: active, disabled)
	//Definir el tamaño del boton (size: large, medium, small, xsmall)
	//Definir si el botón ocupa todo el bloque, es decir el ancho del contenedor (block: yes, no)
	//Definir el título para el botón (title)
	//Definir el nombre para el botón (name)

	function __construct(){}

	private function parameterize($params){
		
		switch ($params['class']){
			case 'default':
				$params['class'] = 'btn btn-default';
				break;
			case 'primary':
				$params['class'] = 'btn btn-primary';
				break;
			case 'success':
				$params['class'] = 'btn btn-success';
				break;
			case 'info':
				$params['class'] = 'btn btn-info';
				break;
			case 'warning':
				$params['class'] = 'btn btn-warning';
				break;
			case 'danger':
				$params['class'] = 'btn btn-danger';
				break;
			case 'link':
				$params['class'] = 'btn btn-link';
				break;
			default:
				$params['class'] = 'btn btn-default';
				break;
		}
		
		switch ($params['size']){
			case 'large':
				$params['size'] = 'btn-lg';
				break;
			case 'medium':
				$params['size'] = 'btn-md';
				break;
			case 'small':
				$params['size'] = 'btn-sm';
				break;
			case 'xsmall':
				$params['size'] = 'btn-xs';
				break;
			default:
				$params['size'] = 'btn-md';
				break;
		}
		
		switch ($params['block']){
			case 'yes':
				$params['block'] = 'btn-block';
				break;
			case 'no':
				$params['block'] = '';
				break;
			default:
				$params['block'] = '';
				break;
		}
		
		$this->params = $params;
	}
	
	function button($params) {

		$this->parameterize($params);
		
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="text-center">';
		$this->element['html'] .= '<button ';
		$this->element['html'] .= 'type=';
		$this->element['html'] .= '"';
		$this->element['html'] .= $this->params['type'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'class="';
		$this->element['html'] .= $this->params['class'];
		$this->element['html'] .= ' ';
		$this->element['html'] .= $this->params['size'];
		$this->element['html'] .= ' ';
		$this->element['html'] .= $this->params['block'];
		$this->element['html'] .= ' ';
		$this->element['html'] .= $this->params['state'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'name="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" value="';
		$this->element['html'] .= $this->params['name'];
		$this->element['html'] .= '" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= $this->params['title'];
		$this->element['html'] .= '</button>';
		$this->element['html'] .= '</div>';
		
		return $this->element;
	}
}

?>
