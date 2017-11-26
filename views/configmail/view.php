<?php

require_once 'image/GetImage.php';

Class ConfigMail{
	
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
		
		
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='host';
		$params['label']='Host';
		$params['type']='url';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese su nombre(s)';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='usuario';
		$params['label']='Usuario';
		$params['type']='email';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese su apellido(s)';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='contrasena';
		$params['label']='Contraseña';
		$params['type']='password';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese una contraseña';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='puerto';
		$params['label']='Puerto';
		$params['type']='number';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese su email';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='botonregistrar';
		$params['type']='submit';
		$params['class']='primary';
		$params['state']='active';
		$params['size']='large';
		$params['block']='yes';
		$params['title']='GUARDAR';
		$params['name']='boton1';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='formregistro';
		$params['class']='default';
		$params['container']=true;
		$params['action']='index.php?url=mail/ft/send';
		$params['method']='post';
		$params['content']=array('host','usuario','contrasena', 'puerto', 'botonregistrar');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		
		
		//Start Menú
		//Menú
		$item1 = array('id'=>'item1','label'=>'Opción 1', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/pg/Casas/');
		$item2 = array('id'=>'item2','label'=>'Opción', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/pg/Apartamentos/');
		$item3 = array('id'=>'item3','label'=>'Opción', 'link'=>'http://localhost/workspace/wallvoices/index.php?url=buscar/pg/Habitaciones/');
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
		$params['style']='default';
		$params['fixed']=true;
		$params['company']=array('WALLVOICES'=>'#');
// 		$params['home']=array('id'=>'home','label'=>'Inicio', 'active'=>true, 'link'=>'http://localhost/workspace/wallvoices/');
		$params['login']=array('id'=>'login1','label'=>'Iniciar Sesión','link'=>'#');
		$params['signup']=array('id'=>'regist','label'=>'Registrarse','link'=>'#');
// 		$params['menu']=array($buscar,$publicar);
		$params['menu']=array();		
		array_push($this->elements, $params);
		unset($params);
		//End Menú
		
		
		
		//Start Footer
		$params=array();
		$params['element']='Footer';
		$params['id']='footer';
		$params['fixed']='yes';
		$params['content']=array("Copyright (c) 2016 Wallvoices");
		array_push($this->elements, $params);
		unset($params);
		//End Footer
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='login';
		$params['call']='login1';
		$params['icon']='glyphicon-user';
		$params['title']='Inicio de Sesión';
		$params['content']=array('form');
		$params['footer']='<h5>¿olvido su contraseña?<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='validate';
		$params['icon']='glyphicon-warning-sign';
		$params['title']='Mensaje';
		$params['content']=array("<p>El usuario o contraseña ingresados no son correctos, por favor verifiquelos e intente de nuevo.</p>");
		$params['footer']='<h5>mensaje de alerta<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='alert';
		$params['icon']='glyphicon-warning-sign';
		$params['title']='Mensaje de Alerta';
		$params['content']=array("<p>El usuario o contraseña ingresados no son correctos, por favor verifiquelos e intente de nuevo.</p>");
		$params['footer']='<h5>mensaje de alerta<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='session';
		$params['icon']='glyphicon-log-out';
		$params['title']='Sesión Finalizada';
		$params['content']=array("<p>El tiempo de su sesión a finalizado, por favor ingrese nuevamente.</p>");
		$params['footer']='<h5>mensaje de alerta<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='registry';
		$params['icon']='glyphicon-log-out';
		$params['title']='Registro Exitoso';
		$params['content']=array("<p>El registro ha sido exitoso, Se ha enviado un correo para la activación de su cuenta.</p>");
		$params['footer']='<h5>BIENVENIDO<h5>';
		array_push($this->elements, $params);
		unset($params);
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