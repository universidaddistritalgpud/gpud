<?php

		
class Carousel{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el id (id)
	//Definir tipo de Alerta (class: success, info, warning, danger)
	//Definir el titulo (title)
	//Definir una mensaje para la alerta (message)
	
	function __construct(){}

	private function parameterize($params){
		$this->params = $params;
	}
	 function Carousel($params) {
	 	
	 	$this->parameterize($params);

	 	$this->element['html'] = '';
		$this->element['html'] .= '<div id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" class="carousel slide" data-ride="carousel">';
		$this->element['html'] .= '<!-- Indicators -->';
		$this->element['html'] .= '<ol class="carousel-indicators">';
		
		for ($i=0; $i<count($params['img']); $i++){
			$this->element['html'] .= '<li data-target="#';
			$this->element['html'] .= $this->params['id'];
			$this->element['html'] .= '" data-slide-to="';
			$this->element['html'] .= $i;
			$this->element['html'] .= '"';
			if($i==0){
				$this->element['html'] .= 'class="active"';
			}
			$this->element['html'] .= '></li>';
		}
		
		$this->element['html'] .= '</ol>';
		
		$this->element['html'] .= '<!-- Wrapper for slides -->';
		$this->element['html'] .= '<div class="carousel-inner" role="listbox">';
		
		foreach ($params['img'] as $image){
			
			$this->element['html'] .= '<div class="item';
			
			if ($image === reset($this->params['img'])) {
				$this->element['html'] .= ' active';
			}
		
			$this->element['html'] .= '">';
			$this->element['html'] .= '<img src="';
			$this->element['html'] .= $image['path'];
			$this->element['html'] .= '" alt="';
			$this->element['html'] .= $image['title'];
			$this->element['html'] .= '" width="';
			$this->element['html'] .= $this->params['width'];
			$this->element['html'] .= '" height="';
			$this->element['html'] .= $this->params['height'];
			$this->element['html'] .= '">';
			$this->element['html'] .= '<div class="carousel-caption">';
          	$this->element['html'] .= '<h3>';
          	$this->element['html'] .= $image['title'];
          	$this->element['html'] .= '</h3>';
          	$this->element['html'] .= '<p>';
          	$this->element['html'] .= $image['description'];
          	$this->element['html'] .= '</p>';
         	$this->element['html'] .= '</div>';
			$this->element['html'] .= '</div>';
		
		}
		
		$this->element['html'] .= '</div>';
		
		$this->element['html'] .= '<!-- Left and right controls -->';
		$this->element['html'] .= '<a class="left carousel-control" href="#';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" role="button" data-slide="prev">';
		$this->element['html'] .= '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
		$this->element['html'] .= '<span class="sr-only">Previous</span>';
		$this->element['html'] .= '</a>';
		$this->element['html'] .= '<a class="right carousel-control" href="#';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" role="button" data-slide="next">';
		$this->element['html'] .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
		$this->element['html'] .= '<span class="sr-only">Next</span>';
		$this->element['html'] .= '</a>';
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '';
	
		return $this->element;
	}
}

?>
