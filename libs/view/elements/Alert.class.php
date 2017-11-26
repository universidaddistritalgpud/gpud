<?php

		
class Alert{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el id (id)
	//Definir tipo de Alerta (class: success, info, warning, danger)
	//Definir el titulo (title)
	//Definir una mensaje para la alerta (message)
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['class']){
			case 'success':
				$params['class'] = 'alert alert-success';
				break;
			case 'info':
				$params['class'] = 'alert alert-info';
				break;
			case 'warning':
				$params['class'] = 'alert alert-warning';
				break;
			case 'danger':
				$params['class'] = 'alert alert-danger';
				break;
		}
		
		switch ($params['closed']){
			case 'yes':
				$params['closed'] = '<a href="#" class="close" data-dismiss="alert" aria-label="close" data-toggle="tooltip" title="Hooray!">&times;</a>';
				break;
			case 'no':
				$params['closed'] = '';
				break;
			default:
				$params['closed'] = '';
				break;
		}
		
		$this->params = $params;
	}
	 function alert($params) {
	 	
	 	$this->parameterize($params);
	 	
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="';
		$this->element['html'] .= $this->params['class'];
		$this->element['html'] .= ' fade in" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= $this->params['closed'];
		$this->element['html'] .= '<strong>';
		$this->element['html'] .= $this->params['title'];
		$this->element['html'] .= '!  ';
		$this->element['html'] .= '</strong>';
		$this->element['html'] .= $this->params['message'];
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '';
		
		return $this->element;
	}
}

?>
