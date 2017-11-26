<?php

		
class Menu{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe como parametro un arreglo el cual debe contener: 
	//Definir el estilo (style: default, inverse)
	//Definir el menú compañia (company: array('compañia'=>'link')) *(opcional)
	//Definir el menú página de inicio (home: array('Home'=>'link')) *(opcional)
	//Definir el menú Inicio de sesión (login: array('login'=>'link')) *(opcional)
	//Definir el menú Registrarse (signup: array('signup'=>'link')) *(opcional)
	//Definir el menú general (menu: 
	//$item1 = array('id'=>'item1','label'=>'item1','link'=>'#');
	//$item2 = array('id'=>'item2','label'=>'item2','link'=>'#');
	//$menu1 = array('id'=>'menu1','label'=>'label1','items'=>array($item1,$item2));
	//$menu2 = array('id'=>'menu2','label'=>'label2','link'=>'#');
	//array($menu1,$menu2);
	//)
	
	function __construct(){
		
	}

	private function parameterize($params){
		$this->params = $params;
	}
	
	function menu($params, $contentEnc) {

		$this->parameterize($params);
		
		$this->element['html'] = '';
		$this->element['html'] .= '<nav class="navbar navbar-';
		$this->element['html'] .= $this->params['style'];
		$this->element['html'] .= ' ';
		
		if(isset($this->params['fixed']) && $this->params['fixed']==true){
			$this->element['html'] .= 'navbar-fixed-top';
		}
		
		$this->element['html'] .= '" id="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= '<div class="container-fluid">';
		
		if(isset($this->params["company"])){
// 			$this->element['html'] .= '<div class="navbar-header">';
			
// 			$this->element['html'] .= '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nabvar';
// 			$this->element['html'] .= $this->params['id'];
// 			$this->element['html'] .= '">';
//         	$this->element['html'] .= '<span class="icon-bar"></span>';
//         	$this->element['html'] .= '<span class="icon-bar"></span>';
//        	 	$this->element['html'] .= '<span class="icon-bar"></span>';
//       		$this->element['html'] .= '</button>';

      		$this->element['html'] .= '<a class="navbar-brand" href="';
			$this->element['html'] .= array_values($this->params["company"])[0];
			$this->element['html'] .= '">';
			$this->element['html'] .= key($this->params["company"]);
			$this->element['html'] .= '</a>';
// 			$this->element['html'] .= '</div>';
		}
		
		$this->element['html'] .= '<div class="navbar-collapse collapse" id="nabvar'.  $this->params['id'];
		$this->element['html'] .= '">';
		
		$this->element['html'] .= '<ul class="nav navbar-nav">';
		
		if(isset($this->params["home"])){
			
			if( $this->params["home"]['active'] == true){
				$this->element['html'] .= '<li class="dropdown">';
			}else{
				$this->element['html'] .= '<li>';
			}
			
			$this->element['html'] .= '<a href="';
			$this->element['html'] .= $this->params["home"]['link'];
			$this->element['html'] .= '">';
			$this->element['html'] .=  $this->params["home"]['label'];
			$this->element['html'] .= '</a>';
			$this->element['html'] .= '</li>';
		}
	
		foreach ($this->params['menu'] as $menu){
			
			if(isset($menu['items']) && is_array($menu['items'])){

						
				if( $menu['active'] == true){
					$this->element['html'] .= '<li class="dropdown active">';
				}else{
					$this->element['html'] .= '<li class="dropdown">';
				}
						
				$this->element['html'] .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="';
				$this->element['html'] .= $menu['id'];
				$this->element['html'] .= '">';
				$this->element['html'] .= $menu['label'];
				$this->element['html'] .= '<span class="caret"></span></a>';
				$this->element['html'] .= '<ul class="dropdown-menu">';
				
				foreach ($menu['items'] as $item){
					
					$link = $item['link'];
					$link = str_replace ( "#" , "" , $link); 
					if(array_key_exists($link, $contentEnc)){
						$item['link'] = '#'. $contentEnc[$link];
					}
					
					$this->element['html'] .= '<li>';
					$this->element['html'] .= '<a href="';
					$this->element['html'] .= $item['link'];
					$this->element['html'] .= '" id="';
					$this->element['html'] .= $item['id'];
					$this->element['html'] .= '">';
					$this->element['html'] .= $item['label'];
					$this->element['html'] .= '</a>';
					$this->element['html'] .= '</li>';
				}
				
				$this->element['html'] .= '</ul>';
				$this->element['html'] .= '</li>';
				
			}else{
				$this->element['html'] .= '<li>';
				$this->element['html'] .= '<a href="';
				$this->element['html'] .= $menu['link'];
				$this->element['html'] .= '" id="';
				$this->element['html'] .= $menu['id'];
				$this->element['html'] .= '">';
				$this->element['html'] .= $menu['label'];
				$this->element['html'] .= '</a>';
				$this->element['html'] .= '</li>';
			}
		}
		
		$this->element['html'] .= '</ul>';
		$this->element['html'] .= '<ul class="nav navbar-nav navbar-right">';
		if(isset($this->params["login"])){
			$this->element['html'] .= '<li>';
			$this->element['html'] .= '<a href="';
			$this->element['html'] .= $this->params["login"]['link'];
			$this->element['html'] .= '" id="';
			$this->element['html'] .= $this->params["login"]['id'];
			$this->element['html'] .= '">';
			$this->element['html'] .= '<span class="glyphicon glyphicon-log-in"></span>';
			$this->element['html'] .= $this->params["login"]['label'];
			$this->element['html'] .= '</a>';
			$this->element['html'] .= '</li>';
		}
		
		if(isset($this->params["signup"])){
			$this->element['html'] .= '<li>';
			$this->element['html'] .= '<a href="';
			$this->element['html'] .=  $this->params["signup"]['link'];
			$this->element['html'] .= '" id="';
			$this->element['html'] .= $this->params["signup"]['id'];
			$this->element['html'] .= '">';
			$this->element['html'] .= '<span class="glyphicon glyphicon-user"></span>';
			$this->element['html'] .= $this->params["signup"]['label'];
			$this->element['html'] .= '</a>';
			$this->element['html'] .= '</li>';
		}
		
		if(isset($this->params["logout"])){
			$this->element['html'] .= '<li>';
			$this->element['html'] .= '<a href="';
			$this->element['html'] .=  $this->params["logout"]['link'];
			$this->element['html'] .= '" id="';
			$this->element['html'] .= $this->params["logout"]['id'];
			$this->element['html'] .= '">';
			$this->element['html'] .= '<span class="glyphicon glyphicon-log-out"></span>';
			$this->element['html'] .= $this->params["logout"]['label'];
			$this->element['html'] .= '</a>';
			$this->element['html'] .= '</li>';
		}
		
		$this->element['html'] .= '</ul>';
		$this->element['html'] .= '</nav>';
		$this->element['html'] .= '</div>';
		$this->element['html'] .= '</div>';
		
		$this->element['html'] .= '';
		
		return $this->element;
	}
}

?>
