<?php

Class Inicio{
	
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
		$params['title']='GPUD';
		array_push($this->elements, $params);
		unset($params);
		//End Information Module
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='usuario';
		$params['label']='';
		$params['type']='email';
		$params['disabled']='no';
		$params['iconLeft']='glyphicon-user';
		$params['class']='default';
		$params['placeholder']='Ingrese su email';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='contrasena';
		$params['label']='';
		$params['type']='password';
		$params['disabled']='no';
		$params['iconLeft']='glyphicon-lock';
		$params['class']='default';
		$params['placeholder']='Ingrese su contraseña';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='nombre';
		$params['label']='Nombre(s)';
		$params['type']='text';
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
		$params['id']='apellido';
		$params['label']='Apellido(s)';
		$params['type']='text';
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
		$params['id']='email';
		$params['label']='Email';
		$params['type']='email';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese su email';
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
		$params['placeholder']='Ingrese una contraseña';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='confirmPassword';
		$params['label']='Confirmación Contraseña';
		$params['type']='password';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese nuevamente la contraseña';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='password_restart';
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
		$params['id']='confirmPassword_restart';
		$params['label']='Confirmación Contraseña';
		$params['type']='password';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Ingrese nuevamente la contraseña';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		//Start ListSelect
		$params=array();
		$params['element']='ListSelect';
		$params['id']='ocupacion';
		$params['multiselect']=false;
		$params['disabled']=false;
		$params['required']=true;
		$params['label']='Ocupación';
		$params['option']=array(0=>'Estudiante',1=>'Ingeniero', 2=>'Pensionado',3=>'Otro');
		array_push($this->elements, $params);
		unset($params);
		//End ListSelect
		
		
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
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='botonregistrar';
		$params['type']='submit';
		$params['class']='primary';
		$params['state']='active';
		$params['size']='large';
		$params['block']='yes';
		$params['title']='REGISTRARSE';
		$params['name']='boton1';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='botonenviorestauracion';
		$params['type']='submit';
		$params['class']='primary';
		$params['state']='active';
		$params['size']='large';
		$params['block']='yes';
		$params['title']='SOLICITAR RESTAURACIÓN';
		$params['name']='botonenviorestauracion';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='botonrestaurar';
		$params['type']='button';
		$params['class']='default';
		$params['state']='active';
		$params['size']='large';
		$params['block']='yes';
		$params['title']='¿olvido su contraseña?';
		$params['name']='botonrestaurar';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='botonrestaurarpass';
		$params['type']='submit';
		$params['class']='primary';
		$params['state']='active';
		$params['size']='large';
		$params['block']='yes';
		$params['title']='CAMBIAR CONTRASEÑA';
		$params['name']='botonrestaurarpass';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='form';
		$params['class']='default';
		$params['action']='index.php?url=session/ft/login/';
		$params['method']='post';
		$params['content']=array('usuario','contrasena','boton1', 'botonrestaurar');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='formregistro';
		$params['class']='default';
		$params['action']='index.php?url=registro/ft/sininformacion';
		$params['method']='post';
		$params['content']=array('nombre','apellido','email', 'password', 'confirmPassword', 'ocupacion', 'botonregistrar');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='formrestartpass';
		$params['class']='default';
		$params['action']='index.php?url=restaurar/ft/update/' . (isset($this->info[1])?$this->info[1]:'');
		$params['method']='post';
		$params['content']=array('password_restart', 'confirmPassword_restart', 'botonrestaurarpass');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='formrestauracion';
		$params['class']='default';
		$params['action']='index.php?url=restaurar/ft/sininformacion';
		$params['method']='post';
		$params['content']=array('email', 'botonenviorestauracion');
		array_push($this->elements, $params);
		unset($params);
		//End Form
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='imagenearth';
		$params['class']='default';
		$params['action']='index.php?url=registro/ft/';
		$params['method']='post';
		$params['content']=array('<div id="container"></div>','<div id="lower_left"></div>', '<div id="lower_center"></div>', '<div id="lower_right"></div>');
		array_push($this->elements, $params); 
		unset($params);
		//End Form
	
		//Start Footer
		$params=array();
		$params['element']='Footer';
		$params['id']='footer';
		$params['fixed']='yes';
		$params['content']=array("Copyright (c) 2017 GPUD");
		array_push($this->elements, $params);
		unset($params);
		//End Footer
		
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
		$params['fixed']='yes';
		$params['style']='inverse';
		$params['company']=array('GPUD'=>'#');
// 		$params['home']=array('id'=>'home','label'=>'Inicio', 'active'=>true, 'link'=>'http://localhost/workspace/wallvoices/');
		$params['login']=array('id'=>'login1','label'=>'Iniciar Sesión','link'=>'#');
		$params['signup']=array('id'=>'regist','label'=>'Registrarse','link'=>'#');
// 		$params['menu']=array($buscar,$publicar);
		$params['menu']=array();		
		array_push($this->elements, $params);
		unset($params);
		//End Menú
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='login';
		$params['call']='login1';
		$params['icon']='glyphicon-user';
		$params['title']='Inicio de Sesión';
		$params['content']=array('form');
		$params['footer']='Formulario Inicio Sesión';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='modalregistro';
		$params['icon']='glyphicon-edit';
		$params['call']='regist';
		$params['title']='Registro';
		$params['content']=array('formregistro');
		$params['footer']='<h5>Formulario de Registro<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='restart_password';
		$params['call']='botonrestaurar';
		$params['icon']='glyphicon-user';
		$params['title']='Restaurar Contraseña';
		$params['content']=array('formrestauracion');
		$params['footer']='Formulario de Restauración de Contraseña';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='validate';
		$params['icon']='glyphicon-warning-sign';
		$params['title']='Mensaje';
		$params['content']=array("<p>No se puede iniciar sesión por alguna de las siguiente razones: <br>- El usuario y/o contraseña ingresados no son correctos. <br>- La cuenta no ha sido activada<br>Por favor verifique e intente de nuevo.</p>");
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
		$params['id']='registry_exist';
		$params['icon']='glyphicon-log-out';
		$params['title']='Registro Fallido';
		$params['content']=array("<p>La cuenta de correo electrónico ingresado ya ha sido registrado, por favor intenta con otra cuenta.</p>");
		$params['footer']='<h5>Mensaje<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='registry_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Registro Fallido';
		$params['content']=array("<p>No hemos podido crear tu cuenta, por facor intenta de nuevo.</p>");
		$params['footer']='<h5>Mensaje<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='registry_true';
		$params['icon']='glyphicon-log-out';
		$params['title']='Registro Exitoso';
		$params['content']=array("<p>El registro ha sido exitoso, Te hemos enviado un correo para la activación de tu cuenta.</p>");
		$params['footer']='<h5>Mensaje<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='restart_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Envió de Enlace Fallido';
		$params['content']=array("<p>No te hemos podido enviar el enlace de restauración, por favor verifica el correo que ingresaste e intenta de nuevo.</p>");
		$params['footer']='<h5>Mensaje<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='restart_true';
		$params['icon']='glyphicon-log-out';
		$params['title']='Envió de Enlace Exitoso';
		$params['content']=array("<p>Te hemos enviado un enlace de restauración de contraseña a tu cuenta de correo electrónico.</p>");
		$params['footer']='<h5>Mensaje<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='restart_pass_true';
		$params['icon']='glyphicon-log-out';
		$params['title']='Restauración de Contraseña';
		$params['content']=array("formrestartpass");
		$params['footer']='<h5>Restauración de Contraseña<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='restart_succsess_true';
		$params['icon']='glyphicon-log-out';
		$params['title']='Contraseña Cambiada';
		$params['content']=array("<p>Tu contraseña ha sido cambiada correctamente. Ya puedes iniciar sesión con tu nueva contraseña.</p>");
		$params['footer']='<h5>Mensaje<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='restart_succsess_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Enlace No Valido';
		$params['content']=array("<p>El enlace usado no es valido o ya fue utilizado, solicita restaurar tu contraseña nuevamente para recibir un nuevo enlace.</p>");
		$params['footer']='<h5>Mensaje<h5>';
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
