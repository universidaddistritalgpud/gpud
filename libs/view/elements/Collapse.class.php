<?php

		
class Collapse{
	
	private $element=array();
	private $params=array();
	
	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el elemento (element: Collapse)
	//Definir el id (id)
	//Definir el título (title)
	//Definir tipo de estructura (class: default, primary, success, info, warning, danger)
	//Definir si esta abierto o cerrado (in: true, false)
	//Definir el contenido (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['in']){
			case true:
				$params['in'] = ' in';
				break;
			case false:
				$params['in'] = '';
				break;
			default:
				$params['in'] = '';
				break;
				
		}
		
		switch ($params['class']){
			case 'default':
				$params['class'] = 'panel-default';
				break;
			case 'primary':
				$params['class'] = 'panel-primary';
				break;
			case 'success':
				$params['class'] = 'panel-success';
				break;
			case 'info':
				$params['class'] = 'panel-info';
				break;
			case 'warning':
				$params['class'] = 'panel-warning';
				break;
			case 'danger':
				$params['class'] = 'panel-danger';
				break;
			default:
				$params['class'] = 'panel-default';
				break;
		}
		
		$this->params = $params;
	}
	 	
	function collapse($params) {
		
	 	$this->parameterize($params);
		
	 	$this->element['html'] = '';
		$this->element['html'] .= '<div class="panel-group">';
		$this->element['html'] .= '<div class="panel ';
		$this->element['html'] .= $this->params['class'];
		$this->element['html'] .= '">';
		$this->element['html'] .= '<div class="panel-heading">';
		$this->element['html'] .= '<h2 class="panel-title">';
		$this->element['html'] .= '<a data-toggle="collapse" href="#';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= $this->params['title'];
		$this->element['html'] .= '</a>';
		$this->element['html'] .= '</h2>';
		$this->element['html'] .= '</div>';
		
		$this->element['html'] .= '<div id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'class="collapse';
		$this->element['html'] .= $this->params['in'];
		$this->element['html'] .= '">';
		
		foreach ($this->params['content'] as $content){
			$this->element['html'] .= $content;
		}
		
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '</div>';
		
		return $this->element;
	}
		
}

?>
