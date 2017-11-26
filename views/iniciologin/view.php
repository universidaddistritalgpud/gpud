<?php

Class InicioLogin{
	
	private $elements;
	private $module;
	private $info;
	private $security;
	
	function __construct(){
		
		$this->module = array_pop(explode("/", dirname(__FILE__)));
		$this->elements = array();	
	}
	
	private function chargeElement(){
		
		//Start Information Module
// 		$params=array();
		$params['element']='Information';
		$params['id']='infor';
		$params['security']= $this->security;
		$params['module']=$this->module;
		$params['title']='Wallvoices';
		array_push($this->elements, $params);
		unset($params);
		//End Information Module
		
		//Start Carousel
// 		$img1 = array('title'=>'Imagen 1', 'description'=>'The atmosphere in Chania has a touch of Florence and Venice.', 'path'=> 'image/planet-571901_1920.jpg');
// 		$img2 = array('title'=>'Imagen 2', 'description'=>'The atmosphere in Chania has a touch of Florence and Venice.', 'path'=>'http://localhost/workspace/wallvoices/module'. DS.'pg_inicio'.DS.'img'.DS.'satellite-1030779_1920.jpg');
// 		$img3 = array('title'=>'Imagen 3', 'description'=>'The atmosphere in Chania has a touch of Florence and Venice.', 'path'=>'http://localhost/workspace/wallvoices/module'. DS.'pg_inicio'.DS.'img'.DS.'radio-telescope-1031303_1920.jpg');
// 		$img4 = array('title'=>'Imagen 4', 'description'=>'The atmosphere in Chania has a touch of Florence and Venice.', 'path'=>'http://localhost/workspace/wallvoices/module'. DS.'pg_inicio'.DS.'img'.DS.'world-1138035_1920.jpg');
		
// // 		$img2 = array('title'=>'Imagen 2', 'description'=>'Imagen Tomada de Internet', 'path'=>'https://image.freepik.com/fotos-gratis/predios-da-cidade_2709844.jpg');
// // 		$img3 = array('title'=>'Chicago', 'description'=>'Imagen Tomada de Internet', 'path'=> getImage($this->module, 'chicago.jpg'));
		
// 		$params=array();
// 		$params['element']='Carousel';
// 		$params['id']='myCarousel';
// 		$params['width']='500';
// 		$params['height']='500';
// 		$params['img']=array($img1,$img2,$img3,$img4);
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Carousel
		
		//Start Input
// 		$params=array();
// 		$params['element']='Input';
// 		$params['id']='usuario';
// 		$params['label']='Nombre de Usuario';
// 		$params['type']='text';
// 		$params['disabled']='no';
// 		$params['class']='default';
// 		$params['placeholder']='Ingrese su nombre de usuario o email';
// 		$params['required']= true;
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Input
		
		//Start Input
// 		$params=array();
// 		$params['element']='Input';
// 		$params['id']='password';
// 		$params['label']='Contraseña';
// 		$params['type']='password';
// 		$params['disabled']='no';
// 		$params['class']='default';
// 		$params['placeholder']='Ingrese su contraseña';
// 		$params['required']= true;
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Input
		
		
		//Start Button
// 		$params=array();
// 		$params['element']='Button';
// 		$params['id']='boton1';
// 		$params['type']='submit';
// 		$params['class']='primary';
// 		$params['state']='active';
// 		$params['size']='large';
// 		$params['block']='yes';
// 		$params['title']='Iniciar Sesión';
// 		$params['name']='boton1';
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Button
		
		//Start Form
// 		$params=array();
// 		$params['element']='Form';
// 		$params['id']='form';
// 		$params['class']='default';
// 		$params['action']='index.php?url=session/ft/';
// 		$params['method']='post';
// 		$params['content']=array('usuario','password','boton1');
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Form
		
		//Start Footer
		$params=array();
		$params['element']='Footer';
		$params['id']='footer';
		$params['fixed']='yes';
		$params['content']=array("Copyright (c) 2016 Wallvoices");
		array_push($this->elements, $params);
		unset($params);
		//End Footer
		
		//Start Jumbotron
// 		$params=array();
// 		$params['element']='Jumbotron';
// 		$params['id']='jumbotron1';
// 		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>', );
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Jumbotron
		
		//Start Sidenav
// 		$sidenav1 = array('id'=>'sidenav1', 'column'=>'4', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array('<h1>My Portfolio</h1>', 'form'));
// 		$sidenav2 = array('id'=>'sidenav2', 'column'=>'8', 'shadow'=>'', 'text'=>'text-center', 'content'=>array('myCarousel'));
		
// 		$params=array();
// 		$params['element']='Sidenav';
// 		$params['id']='sidenav';
// 		$params['content']=Array('myCarousel');
// 		$params['sidenav']=array($sidenav1,$sidenav2);
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Sidenav
		
		//Start Menú
		//Menú
		$item1 = array('id'=>'item1','label'=>'Opción 1', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/pg/Casas/');
		$item2 = array('id'=>'item2','label'=>'Opción 2', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/pg/Apartamentos/');
		$item3 = array('id'=>'item3','label'=>'Opción 3', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/pg/Habitaciones/');
		$item4 = array('id'=>'item4','label'=>'Casa', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=publicar/pg/Casa/');
		$item5 = array('id'=>'item5','label'=>'Apartamento', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=publicar/pg/Apartamento/');
		$item6 = array('id'=>'item6','label'=>'Habitación', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=publicar/pg/Habitación/');
		
		//Ítems Menú
		$buscar = array('id'=>'menu1', 'label'=>'Buscar', 'active'=>false, 'items'=>array($item1, $item2, $item3));
		$publicar = array('id'=>'menu2', 'label'=>'Publicar', 'active'=>false, 'items'=>array($item4,$item5,$item6));
		//
		
		$params=array();
		$params['element']='Menu';
		$params['id']='menu';
		$params['style']='inverse';
		$params['company']=array('WALLVOICES'=>'#');
		$params['home']=array('id'=>'home','label'=>'Inicio', 'active'=>true, 'link'=>'http://localhost/workspace/wallvoices/');
// 		$params['login']=array('id'=>'login1','label'=>'Iniciar Sesión','link'=>'#');
		$params['logout']=array('id'=>'regist','label'=>'Cerrar Sesión','link'=>'index.php?url=session/ft/logout');
		$params['menu']=array($buscar);
// 		$params['menu']=array();		
		array_push($this->elements, $params);
		unset($params);
		//End Menú
		
		//Start Modal
// 		$params=array();
// 		$params['element']='Modal';
// 		$params['id']='mod';
// 		$params['call']='login1';
// 		$params['title']='Inicio de Sesión';
// 		$params['content']=array('form');
// 		$params['footer']='<h5>Pie de Página<h5>';
// 		array_push($this->elements, $params);
// 		unset($params);
		//End Modal
		
	}
	
	public function getElement($info, $security){
		$this->info = $info;
		$this->security = $security;
		$this->chargeElement();
		return $this->elements;
	}
}

?>