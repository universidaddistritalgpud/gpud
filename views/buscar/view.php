<?php


Class Buscar{
	
	private $elements;
	private $module;
	private $info;
	
	function __construct(){
		
		$this->module = array_pop(explode("/", dirname(__FILE__)));
		$this->elements = array();
		
	}
	
	private function chargeElement(){
		
		//Start Information Module
		$params=array();
		$params['element']='Information';
		$params['id']='infor';
		$params['security']=true;
		$params['module']=$this->module;
		$params['title']='WallVoices';
		array_push($this->elements, $params);
		unset($params);
		//End Information Module
		
		
		//Start Jumbotron
		$params=array();
		$params['element']='Jumbotron';
		$params['id']='jumbotron1';
		$params['content']=array('<h1>' . $this->info . '</h1>', '<p>En esta sección encontraras el apartamento que estas buscando.</p>', );
		array_push($this->elements, $params);
		unset($params);
		//End Jumbotron
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='email';
		$params['label']='Email';
		$params['type']='email';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese su Usuario o Email';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='password';
		$params['label']='Contraseña';
		$params['type']='password';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese su contraseña';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='boton1';
		$params['type']='submit';
		$params['class']='primary';
		$params['state']='active';
		$params['size']='large';
		$params['block']='yes';
		$params['title']='Iniciar Sesión';
		$params['name']='boton1';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='form';
		$params['class']='default';
		$params['action']='index.php?url=items/';
		$params['method']='post';
		$params['content']=array('email','password','boton1');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		//Start Section
		$params=array();
		$params['element']='Section';
		$params['id']='section1';
		$params['background']='#ff9800';
		$params['height']='1000';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>', 'sidenav');
		array_push($this->elements, $params);
		unset($params);
		//End Section
		
		//Start Section
		$params=array();
		$params['element']='Section';
		$params['id']='section1';
		$params['background']='#ff9800';
		$params['height']='1000';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>', 'sidenav');
		array_push($this->elements, $params);
		unset($params);
		//End Section
		
		//Start Section
		$params=array();
		$params['element']='Section';
		$params['id']='section2';
		$params['background']='#ff9800';
		$params['height']='1000';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>', 'sidenav');
		array_push($this->elements, $params);
		unset($params);
		//End Section
		
		//Start Section
		$params=array();
		$params['element']='Section';
		$params['id']='section3';
		$params['background']='#ff9800';
		$params['height']='1000';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>', 'sidenav');
		array_push($this->elements, $params);
		unset($params);
		//End Section
		
		//Start Footer
		$params=array();
		$params['element']='Footer';
		$params['id']='footer';
		$params['fixed']='no';
		$params['content']=array("Copyright (c) 2016 Wallvoices");
		array_push($this->elements, $params);
		unset($params);
		//End Footer
		
		//Start Menú
		//Menú
		$item1 = array('id'=>'item1','label'=>'Casa', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/page/Casas/');
		$item2 = array('id'=>'item2','label'=>'Apartamento', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/page/Apartamentos/');
		$item3 = array('id'=>'item3','label'=>'Habitación', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/page/Habitaciones/');
		$item4 = array('id'=>'item4','label'=>'Casa', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=publicar/page/Casa/');
		$item5 = array('id'=>'item5','label'=>'Apartamento', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=publicar/page/Apartamento/');
		$item6 = array('id'=>'item6','label'=>'Habitación', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=publicar/page/Habitación/');
		
		//Ítems Menú
		$buscar = array('id'=>'menu1', 'label'=>'Buscar', 'active'=>true, 'items'=>array($item1, $item2, $item3));
		$publicar = array('id'=>'menu2', 'label'=>'Publicar', 'active'=>false, 'items'=>array($item4,$item5,$item6));
		//
		
		$params=array();
		$params['element']='Menu';
		$params['id']='menu';
		$params['style']='inverse';
		$params['company']=array('WALLVOICES'=>'#');
		$params['home']=array('id'=>'home','label'=>'Inicio', 'active'=>false, 'link'=>'http://localhost/workspace/wallvoices/');
		$params['login']=array('id'=>'login1','label'=>'Iniciar Sesión','link'=>'#');
		$params['signup']=array('id'=>'regist','label'=>'Registrarse','link'=>'#');
		$params['menu']=array($buscar,$publicar);
		array_push($this->elements, $params);
		unset($params);
		//End Menú
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='login';
		$params['call']='login1';
		$params['title']='Inicio de Sesión';
		$params['content']=array('form');
		$params['footer']='<h5>Pie de Página<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
	}
	
	public function getElement($info){
		$this->info = $info;
		$this->chargeElement();
		return $this->elements;
	}
}

?>