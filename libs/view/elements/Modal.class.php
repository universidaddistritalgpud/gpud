<?php

		
class Modal{
	
	private $element=array();
	private $params=array();
	
	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el identificador de la ventana modal (id).
	//Definir el identificador del control que llamará a la ventana modal, 
	// si mas de uns control llama la ventana modal los puede seprar por (,) (call).
	// cuando no se define el parametro call se asume que se va a mostrar cuando se reciba algún tipo de alerta desde la url. (message->validate, message->error, message->alert)
	//Definir el título de la ventana modal (title).
	//Definir el icono de la ventana modal (icon). Se debe hacer uso de los iconos disponibles por bootstrap glyphicon.
	//Definir el contenido principal de la ventana modal (content).
	//Definir el contenido del footer de la ventana modal (footer).
	
	function __construct(){}
	
	private function parameterize($params){
		$this->params = $params;
	}

	function modal($params, $contentEnc) {
	 	
		$this->parameterize($params);
		
	 	$this->element ['html'] = '';
		$this->element ['html'] .= '<div class="modal fade" id="';
		$this->element ['html'] .= $this->params['id'];
		$this->element ['html'] .= '" role="dialog">';
		$this->element ['html'] .= '<div class="modal-dialog">';
		$this->element ['html'] .= '<!--Modal content-->';
		$this->element ['html'] .= '<div class="modal-content">';
		$this->element ['html'] .= '<div class="modal-header">';
		$this->element ['html'] .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
		$this->element ['html'] .= '<h4><span class="glyphicon ';
		$this->element ['html'] .= $this->params['icon'];
		$this->element ['html'] .= '"></span> ';
		$this->element ['html'] .= $this->params['title'];
		$this->element ['html'] .= '</h4>';
		$this->element ['html'] .= '</div>';
		$this->element ['html'] .= '<div class="modal-body" style="padding:30px 30px;">';
		
		foreach ($this->params['content'] as $content){
			$this->element ['html'] .= $content;
		}
		
		$this->element ['html'] .= '</div>';
		$this->element ['html'] .= '<div class="modal-footer">';
		$this->element ['html'] .= $this->params['footer'];
		$this->element ['html'] .= '</div>';
		$this->element ['html'] .= '</div>';
		$this->element ['html'] .= '</div>';
		$this->element ['html'] .= '</div>';
		
		$this->scriptCallModal($contentEnc);
		
		return $this->element;
	}
	
	
	private function scriptCallModal($contentEnc){
		
		if(isset($this->params['call'])){
			
			$this->element ['script'] = '';
			
			$element = array();
			
			$element = explode(",", $this->params['call']);
				
			foreach ($element as $this->params['call']){
				$this->element ['script'] .= '<script>';
				$this->element ['script'] .= '$(document).ready(function(){';
				$this->element ['script'] .= '$("#';
				$this->element ['script'] .= $contentEnc[$this->params['call']];
				$this->element ['script'] .= '").click(function(){';
				$this->element ['script'] .= '$("#';
				$this->element ['script'] .= $this->params['id'];
				$this->element ['script'] .= '").modal();';
				$this->element ['script'] .= '});';
				$this->element ['script'] .= '});';
				$this->element ['script'] .= '</script>';
				$this->element ['script'] .= '';
			}
		}else{
			
			$this->element ['script'] = '';
			$this->element ['script'] .= '<script>';
			$this->element ['script'] .= '$(document).ready(function(){';
			$this->element ['script'] .= "function getGET(){ ";
			$this->element ['script'] .= "var loc = document.location.href; ";
			$this->element ['script'] .= "if(loc.indexOf('?')>0){ ";
			$this->element ['script'] .= "var getString = loc.split('?')[1]; ";
			$this->element ['script'] .= "var GET = getString.split('&'); ";
			$this->element ['script'] .= "var get = {}; ";
			$this->element ['script'] .= "for(var i = 0, l = GET.length; i < l; i++){ ";
			$this->element ['script'] .= "var tmp = GET[i].split('='); ";
			$this->element ['script'] .= "get[tmp[0]] = unescape(decodeURI(tmp[1]));} ";
			$this->element ['script'] .= "return get;}} ";
			$this->element ['script'] .= "$(window).load(function(){ ";
			$this->element ['script'] .= "var valores=getGET(); ";
			$this->element ['script'] .= "if(valores){ ";
			$this->element ['script'] .= "for(var index in valores){ ";
			$this->element ['script'] .= "var res = valores[index].split('/'); ";
			$this->element ['script'] .= "res.forEach(function(entry) { ";
			$this->element ['script'] .= "if(entry=='message->validate'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "validate";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->alert'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "alert";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->session'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "session";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->registry->true'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "registry_true";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->registry->false'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "registry_false";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->registry->exist'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "registry_exist";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->configuration->true'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "registry";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->configuration->false'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "registry";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->restart->false'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "restart_false";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->restart->true'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "restart_true";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->validatePass->false'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "restart_pass_false";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->validatePass->true'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "restart_pass_true";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->restart_succsess->false'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "restart_succsess_false";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "if(entry=='message->restart_succsess->true'){ ";
			$this->element ['script'] .= "$('#";
			$this->element ['script'] .= "restart_succsess_true";
			$this->element ['script'] .= "').modal('show');}";
			$this->element ['script'] .= "});}}});});</script>";			
			$this->element ['script'] .= '';
			
		}
		
	}
}

?>
