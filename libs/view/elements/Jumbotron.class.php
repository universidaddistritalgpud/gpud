<?php

		
class Jumbotron{
	
	private $element=array();
	private $params=array();

	/*
	 _________________________
	|						  |
	|					 	  |
	|	  					  |
	|		WallVoices		  |
	|  		  				  |
	|    					  |
	|_________________________|
	
	*/
	
	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el elemento (element: Jumbotron)
	//Definir el id (id)
	//Definir el contenido del jumbotron (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		$this->params = $params;
	}
	 	
	function jumbotron($params) {
		
	 	$this->parameterize($params);
	 	 
		$this->element['html'] = '';
		
		$this->element['html'] .= '<div class="jumbotron" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= '<div class="container text-center">';
		
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
