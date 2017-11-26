<?php

class Form{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el tipo de elemento (element: Form)
	//Definir tipo de estructura (class: horizontal, inline)
	//Definir la acción (action)
	//Definir el metodo (method: get, post)
	//Definir el contenido (content: array('element1', 'element2', ...))
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['class']){
			case 'vertical':
				$params['class'] = '';
				break;
			case 'horizontal':
				$params['class'] = 'form-horizontal';
				break;
			case 'inline':
				$params['class'] = 'form-inline';
				break;
			default:
				$params['class'] = '';
				break;
		}
		
		$this->params = $params;
	}
	
	function form($params) {
		
		$this->parameterize($params);
		
		$this->element['html'] = '';
		
		if(isset($this->params['container'])){
			$this->element['html'] .= '<div class="container-fluid">';
			$this->element['html'] .= '<div class="row">';
			$this->element['html'] .= '<div class="col-md-10 col-md-offset-1">';
		}
		
		$this->element['html'] .= '<form ';
		$this->element['html'] .= 'id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'role="form" ';
		$this->element['html'] .= 'class="';
		$this->element['html'] .= $this->params['class'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'action="';
		$this->element['html'] .= $this->params['action'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= 'method="';
		$this->element['html'] .= $this->params['method'];
		$this->element['html'] .= '" ';
		$this->element['html'] .= '>';
		
		$this->element ['script'] = '';
		$encrypValues = array();
		
		foreach ($this->params['content'] as $id => $content){
			$this->element['html'] .= $content;	
			$encrypValues[] = $id;
		}
		$this->element['html'] .= '</form>';
		
		if(isset($this->params['container'])){
			$this->element['html'] .= '</div>';
			$this->element['html'] .= '</div>';
			$this->element['html'] .= '</div>';
		}
		
		$this->element ['script'] = '';
							
		$this->element ['script'] .= '<script>';
		$this->element ['script'] .= '$("#';
		$this->element ['script'] .= $encrypValues[count($encrypValues)-1];
		$this->element ['script'] .= '").click(function(event) {';
		
		
			// Change this to the encryption standard you want to us
// 			$this->element ['script'] .= 'var hash = CryptoJS.SHA1($("#';
// 			$this->element ['script'] .= $encrypValues[1];
// 			$this->element ['script'] .= '").val());';
// 			$this->element ['script'] .= "document.getElementById('";
// 			$this->element ['script'] .= $encrypValues[1];
// 			$this->element ['script'] .= "').value = hash;";
// 			$this->element ['script'] .= '';
				
		
		$this->element ['script'] .= '})';
		$this->element ['script'] .= '</script>';
		$this->element ['script'] .= '';
		$this->element ['script'] = '';
		
		
		return $this->element;
	}
}

?>
