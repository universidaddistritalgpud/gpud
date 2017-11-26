<?php

		
class Section{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el elemento (element: Footer)
	//Definir el id (id)
	//Definir si se va a finar el píe de página (fixed: yes, no)
	//Definir el contenido del píe de página (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		$this->params = $params;
	}
	 	
	function section($params) {
		
	 	$this->parameterize($params);
	 	
		$this->element['html'] = '';
		$this->element['html'] .= '<div id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" class="container-fluid">';
		
		foreach ($this->params['content'] as $content){
			$this->element['html'] .= $content;
		}
		
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '';
		
		$this->element['css'] = '';
		$this->element['css'] .= '<style>';
		$this->element['css'] .= 'body {';
		$this->element['css'] .= 'position: relative;';
		$this->element['css'] .= '}';
		$this->element['css'] .= '#';
		$this->element['css'] .= $this->params['id'];
		$this->element['css'] .= '{padding-top:';
		$this->element['css'] .= '50';
		$this->element['css'] .= 'px;height:';
		$this->element['css'] .= $this->params['height'];
		$this->element['css'] .= 'px;color:';
		$this->element['css'] .= '#fff';
		$this->element['css'] .= '; background-color:';
		$this->element['css'] .= '; background-color:';
		$this->element['css'] .=  $this->params['background'];
		$this->element['css'] .= ';}';
		$this->element['css'] .= '</style>';
		$this->element['css'] .= '';
		
		return $this->element;
	}
		
}

?>
