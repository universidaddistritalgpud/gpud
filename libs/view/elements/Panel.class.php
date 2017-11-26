<?php

class Panel{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el tipo de elemento (element: Panel)
	//Definir tipo de estructura (class: default, primary, success, info, warning, danger)
	//Definir el contenido (content: array('element1', 'element2', ...))
	
	function __construct(){}

	private function parameterize($params){
		
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
	
	function panel($params) {
		
		$this->parameterize($params);
		
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="panel ';
		$this->element['html'] .= $this->params['class'];
		$this->element['html'] .= ' id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= '<div class="panel-heading">';
		$this->element['html'] .= $this->params['title'];
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '<div class="panel-body">';
		
		foreach ($this->params['content'] as $content){
			$this->element['html'] .= $content;
		}
		
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '';
		
		return $this->element;
	}
}

?>
