<?php

require_once 'image/GetImage.php';

Class Example{
	
	private $elements;
	private $module;
	
	function __construct(){
		
		$this->module = array_pop(explode("/", dirname(__FILE__)));
		$this->elements = array();
		$this->chargeElement();
	}
	
	private function chargeElement(){
		
		//Start Information Module
		$params=array();
		$params['element']='Information';
		$params['id']='infor';
		$params['security']=true;
		$params['module']=$this->module;
		$params['title']='Wallvoices';
		array_push($this->elements, $params);
		unset($params);
		//End Information Module
		
		
		//Start Carousel
		$img1 = array('title'=>'Imagen 1', 'description'=>'The atmosphere in Chania has a touch of Florence and Venice.', 'path'=>'http://localhost/workspace/wallvoices/module'. DS.'md_example'.DS.'img'.DS.'bogota.jpg');
		$img2 = array('title'=>'Imagen 2', 'description'=>'Imagen Tomada de Internet', 'path'=>'https://image.freepik.com/fotos-gratis/predios-da-cidade_2709844.jpg');
		$img3 = array('title'=>'Chicago', 'description'=>'Imagen Tomada de Internet', 'path'=> getImage($this->module, 'chicago.jpg'));
		
		$params=array();
		$params['element']='Carousel';
		$params['id']='myCarousel';
		$params['width']='1200';
		$params['height']='1200';
		$params['img']=array($img1);
		array_push($this->elements, $params);
		unset($params);
		//End Carousel
		
		
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
		
		//Start Alert
		$params=array();
		$params['element']='Alert';
		$params['id']='alerta1';
		$params['class']='success';
		$params['title']='Error';
		$params['message']='Este es un mensaje en Boostrap';
		$params['closed']='yes';
		array_push($this->elements, $params);
		unset($params);
		//End Alert
		
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
		
		//Start Jumbotron
		$params=array();
		$params['element']='Jumbotron';
		$params['id']='jumbotron1';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>', );
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
		$params['placeholder']='Ingrese su Email';
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
		
		//Start TextArea
		$params=array();
		$params['element']='TextArea';
		$params['id']='textarea';
		$params['label']='Descripción';
		$params['rows']='4';
		$params['disabled']=false;
		$params['required']=true;
		array_push($this->elements, $params);
		unset($params);
		//End TextArea
		
		//Start CheckBox
		$option1 = array('id'=>'option1', 'label'=>'Option 1', 'disabled'=>false);
		$option2 = array('id'=>'option2', 'label'=>'Option 2', 'disabled'=>false);
		$option3 = array('id'=>'option3', 'label'=>'Option 3', 'disabled'=>false);
		
		$params=array();
		$params['element']='CheckBox';
		$params['id']='checkbox';
		$params['name']='checkbox';
		$params['inline']=false;
		$params['option']=array($option1,$option2,$option3);
		array_push($this->elements, $params);
		unset($params);
		//End CheckBox
		
		//Start RadioButton
		$option1 = array('id'=>'option1', 'label'=>'Option 1', 'disabled'=>false);
		$option2 = array('id'=>'option2', 'label'=>'Option 2', 'disabled'=>true);
		$option3 = array('id'=>'option3', 'label'=>'Option 3', 'disabled'=>false);
		
		$params=array();
		$params['element']='RadioButton';
		$params['id']='radiobutton';
		$params['name']='radiobutton';
		$params['inline']=false;
		$params['option']=array($option1, $option2, $option3);
		array_push($this->elements, $params);
		unset($params);
		//End RadioButton
		
		//Start ListSelect
		$params=array();
		$params['element']='ListSelect';
		$params['id']='select';
		$params['multiselect']=true;
		$params['disabled']=false;
		$params['required']=true;
		$params['label']='Seleccione una opción';
		$params['option']=array('Option1', 'Option 2', 'Option 3', 'Option 4');
		array_push($this->elements, $params);
		unset($params);
		//End ListSelect
		
		//Start Panel
		$params=array();
		$params['element']='Panel';
		$params['id']='panel';
		$params['class']='default';
		$params['title']='Inicio de Sesión';
		$params['content']=array('email', 'password', 'checkbox', 'select', 'textarea', 'boton1');
		array_push($this->elements, $params);
		unset($params);
		//End Panel
		
		//Start Collapse
		$params=array();
		$params['element']='Collapse';
		$params['id']='collapse';
		$params['in']=false;
		$params['title']='Collapse de Prueba';
		$params['class']='primary';
		$params['content']=array('panel');
		array_push($this->elements, $params);
		unset($params);
		//End Collapse
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='form';
		$params['class']='default';
		$params['action']='index.php?url=items/';
		$params['method']='post';
		$params['content']=array('panel');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		//Start Sidenav
		$sidenav1 = array('id'=>'sidenav1', 'column'=>'4', 'shadow'=>'', 'text'=>'text-center', 'content'=>array('<h1>My Portfolio</h1>', 'form'));
		$sidenav2 = array('id'=>'sidenav2', 'column'=>'8', 'shadow'=>'', 'text'=>'text-center', 'content'=>array('alerta1'));
		$sidenav3 = array('id'=>'sidenav3', 'column'=>'3', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array('<p> Esto es un parrafo de prueba.</p>'));
		
		$params=array();
		$params['element']='Sidenav';
		$params['id']='sidenav';
		$params['content']=Array('alerta1', 'email', 'boton1', 'form');
		$params['sidenav']=array($sidenav1,$sidenav2);
		array_push($this->elements, $params);
		unset($params);
		//End Sidenav
		
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
		$params['background']='#1E88E5';
		$params['height']='500';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>' );
		array_push($this->elements, $params);
		unset($params);
		//End Section
		
		//Start Section
		$params=array();
		$params['element']='Section';
		$params['id']='section3';
		$params['background']='#673ab7';
		$params['height']='500';
		$params['content']=array('<h1>WallVoices</h1>', '<p>WallVoices es una compañia dedicada al desarrollo de software.</p>' );
		array_push($this->elements, $params);
		unset($params);
		//End Section
		
		//Start Footer
		$params=array();
		$params['element']='Footer';
		$params['id']='footer';
		$params['fixed']='yes';
		$params['content']=array("Todos los derechos reservados©Wallvoices");
		array_push($this->elements, $params);
		unset($params);
		//End Footer
		
		//Start Menú
		//Menú
		$item1 = array('id'=>'item1','label'=>'item1', 'link'=>'#boton1');
		$item2 = array('id'=>'item2','label'=>'item2', 'link'=>'#');
		$item3 = array('id'=>'item3','label'=>'item3', 'link'=>'#section1');
		$item4 = array('id'=>'item4','label'=>'Casa', 'link'=>'#footer');
		$item5 = array('id'=>'item5','label'=>'Apartamento', 'link'=>'#');
		
		//Ítems Menú
		$compras = array('id'=>'menu1', 'label'=>'Compras', 'items'=>array($item1, $item2, $item3));
		$publicar = array('id'=>'menu2', 'label'=>'Publicar', 'items'=>array($item4,$item5));
		$ventas = array('id'=>'menu3', 'label'=>'Ventas', 'link'=>'#');
		//
		
		$params=array();
		$params['element']='Menu';
		$params['id']='menu';
		$params['style']='inverse';
		$params['company']=array('WALLVOICES'=>'#');
		$params['home']=array('Inicio'=>'#');
		$params['login']=array('Iniciar Sesión'=>'http://localhost/workspace/wallvoices/index.php?url=items/');
		$params['signup']=array('Registrarse'=>'#');
		$params['menu']=array($compras,$publicar,$ventas);
		array_push($this->elements, $params);
		unset($params);
		//End Menú
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='myModal';
		$params['call']='boton1,alerta1,menu3';
		$params['title']='Título';
		$params['content']=array('form');
		$params['footer']='<h5>Pie de Página<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
	}
	
	public function getElement(){
		return $this->elements;
	}
}



?>