<?php

		
class Footer{
	
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
	//Definir el elemento (element: Footer)
	//Definir el id (id)
	//Definir si se va a finar el píe de página (fixed: yes, no)
	//Definir el contenido del píe de página (content: array('elemento1', 'elemento2'))
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['fixed']){
			case 'yes':
				$params['fixed'] = ' navbar-fixed-bottom';
				break;
			case 'no':
				$params['fixed'] = '';
				break;
			default:
				$params['fixed'] = '';
				break;
				
		}
		$this->params = $params;
	}
	 	
	function footer($params) {
		
	 	$this->parameterize($params);
	 	 
		$this->element['html'] = '';
		$this->element['html'] .= '<footer class="container-fluid text-center';
		$this->element['html'] .= $this->params['fixed'];
		$this->element['html'] .= '" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		
		foreach ($this->params['content'] as $content){
			$this->element['html'] .= $content;
		}
		
		$this->element['html'] .= '</footer>';
		$this->element['html'] .= '';
		
		return $this->element;
	}
		
}

?>
