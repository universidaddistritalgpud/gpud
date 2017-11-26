<?php

Class GPSTK{
	
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
		
		$imagen = '<IMG SRC="' . MY_URL . 'views/gpstk/img/logo-small.png" ALT="Logo de GPStk">';
		
		$titulo = '<h1>¿QUÉ ES GPSTk?</h1>';
		
		$texto = '<p>Los Laboratorios de Investigación Aplicada (Applied Research Laboratories, ARL) de
				la Universidad de Texas en Austin (ARL: UT) han establecido el proyecto de un software de
				código abierto denominado GPS Toolkit o GPSTk. El proyecto GPSTk proporciona una
				librería principal ó núcleo y una colección de aplicaciones definidas como apoyo a la
				investigación, análisis y desarrollo del GPS. El código es liberado bajo los términos de
				Lesser GNU Public License (LGPL), ésta otorga al usuario una serie de derechos, en
				particular la capacidad de elegir si desea modificar y redistribuir el código fuente.
				El código GPSTk está escrito en ANSI C + + que es una plataforma independiente y
				ha sido instalado y probado con éxito en Linux, Solaris y Windows.
				<br><br>
				El proyecto GPSTk consiste en una librería central, unas librerías auxiliares y una
				serie de aplicaciones algunas de las cuales se utilizan para testear o comprobar partes de la
				librería. La librería central contiene las funciones necesarias para leer, procesar y escribir
				datos GPS. Estos programas de testeo o de pruebas proporcionan tanto una prueba de
				validación de la instalación como un ejemplo de utilización de la librería en programas
				independientes.
				</p>';
		
		$link = ' <p> Para encontrar más información acerca de GPSTk y la documentación completa de cada una de sus aplicaciones de click en el siguiente <a target="_blank" href="http://www.gpstk.org/bin/view/Documentation/WebHome">link</a>.';
		
		$menu2 = '<nav class="navbar navbar-default sidebar" role="navigation">				
		    <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
		    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li ><a href="#">Inicio<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
		        <li ><a href="index.php?url=cargarinfo/pg/sininfo">Procesar<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-globe"></span></a></li>
		        <li ><a href="index.php?url=segundoplano/pg/sininfo">Mis Procesamientos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
		        <li ><a href="index.php?url=modelocarga/pg/sininfo"">Módelo de Cargas Oceánicas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-random"></span></a></li>
		        <li class="active"><a href="index.php?url=gpstk/pg/sininfo">GPSTk<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>
				<li ><a href="index.php?url=session/ft/logout">Cerrar Sesión<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a></li>
		      </ul>
		    </div>
		  </div>
		</nav>';
		
		//Start Sidenav
		$sidenav21 = array('id'=>'sidenav21', 'column'=>'4', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($menu2));
		$sidenav22 = array('id'=>'sidenav22', 'column'=>'8', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($imagen, $titulo, $texto, $link));
		
		$params=array();
		$params['element']='Sidenav';
		$params['id']='sidenav2';
		$params['content']=Array('alerta2', 'alerta3', 'puerto', 'cargas_oceanicas', 'sidenav', 'botonprocesar', 'botonpdf');
		$params['sidenav']=array($sidenav21,$sidenav22);
		array_push($this->elements, $params);
		unset($params);
		//End Sidenav
		
		//Start Form
		$params=array();
		$params['element']='Form';
		$params['id']='formregistro';
		$params['class']='default';
		$params['container']=true;
		$params['action']='index.php?url=mail/ft/send';
		$params['method']='post';
		$params['content']=array(/*'alerta1',*/'sidenav2');
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
		$params['company']=array('GPUD'=>'#');
		$params['menu']=array();		
		array_push($this->elements, $params);
		unset($params);
		//End Menú
		
		//Start Footer
		$params=array();
		$params['element']='Footer';
		$params['id']='footer';
		$params['fixed']='yes';
		$params['content']=array("Copyright (c) 2017 GPUD");
		array_push($this->elements, $params);
		unset($params);
		//End Footer
		
		//Start Modal
// 		$params=array();
// 		$params['element']='Modal';
// 		$params['id']='login';
// 		$params['call']='login1';
// 		$params['icon']='glyphicon-user';
// 		$params['title']='Inicio de Sesión';
// 		$params['content']=array('form');
// 		$params['footer']='<h5>¿olvido su contraseña?<h5>';
// 		array_push($this->elements, $params);
// 		unset($params);
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
