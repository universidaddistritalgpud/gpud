<?php

Class CargarInfo{
	
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
		
		//Start Alert
		$params=array();
		$params['element']='Alert';
		$params['id']='alerta1';
		$params['class']='info';
		$params['title']='Mensaje';
		$params['message']='Uno de los factores que influyen en la calidad de las coordenadas es el tiempo de observación el cual se recomienda de 24 horas.';
		$params['closed']='yes';
// 		array_push($this->elementsa, $params);
		unset($params);
		//End Alert
		
		//Start Alert
		$params=array();
		$params['element']='Alert';
		$params['id']='alerta2';
		$params['class']='info';
		$params['title']='Mensaje';
		$params['message']='Esta información se presenta de acuerdo al formato SINEX para mayor informacion dirijase a https://www.iers.org/IERS/EN/Organization/AnalysisCoordinator/SinexFormat/sinex.html';
		$params['closed']='yes';
		array_push($this->elements, $params);
		unset($params);
		//End Alert
		
		//Start Alert
		$params=array();
		$params['element']='Alert';
		$params['id']='alerta3';
		$params['class']='info';
		$params['title']='Mensaje';
		$params['message']='El  Procesamiento de archivos RINEX es valido únicamente para puntos  estáticos.';
		$params['closed']='yes';
		array_push($this->elements, $params);
		unset($params);
		//End Alert
		
		//Start Input
		$params=array();
		$params['element']='Input';
		$params['id']='puerto';
		$params['label']='Archivo Rinex';
		$params['type']='file';
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
		$params['id']='cargas_oceanicas';
		$params['label']='Cargas Oceánicas';
		$params['type']='file';
		$params['disabled']='no';
		$params['class']='default';
		$params['placeholder']='Búscar Archivo';
		$params['required']= true;
		array_push($this->elements, $params);
		unset($params);
		//End Input
		
		$link =  '<p><a href="index.php?url=modelocarga/pg/sininfo">¿Cómo obtener el modelo de carga oceánica?</a></p>';
		
		//Start Button
		$params=array();
		$params['element']='Button';
		$params['id']='botonprocesar';
		$params['type']='button';
		$params['class']='primary';
		$params['state']='active';
		$params['size']='medium';
		$params['block']='no';
		$params['title']='PROCESAR';
		$params['name']='boton1';
		array_push($this->elements, $params);
		unset($params);
		//End Button
		
		$table = '<table class="table table-sm table-inverse" style="width:100%">
					  <tr>
	    				<th class="bg-primary">Fecha</th>
	    			  	<td class="bg-info" id="date"></td>
	  				  </tr>
  				  	  <tr>
	    				<th class="bg-primary">Día GNSS</th>
	    			  	<td class="bg-info" id="daygnss"></td>
	  				  </tr>
				 	  <tr>
	    				<th class="bg-primary">Día de la Semana</th>
	    			  <td class="bg-info" id="dayofweek"></td>
	  				  </tr>
					  <tr>
					    <th class="bg-primary">Semana GNSS</th>
					    <td class="bg-info" id="weekgnss"></td>
					  </tr>
					  <tr>
					  <tr>
					    <th class="bg-primary">Día del Año</th>
					    <td class="bg-info" id="dayofyear"></td>
					  </tr>
					  <tr>
	    				<th class="bg-primary">Fecha Juliana</th>
	    			  <td class="bg-info" id="julian"></td>
	  				  </tr>
					  <tr>
					    <th class="bg-primary">Tipo de Antena</th>
					    <td class="bg-info" id="typeantenna"></td>
					  </tr>
					  <tr>
	    				<th class="bg-primary">Nombre del Punto</th>
	    			  	<td class="bg-info" id="station"></td>
	  				  </tr>
					</table>';

		$map2 = '<div id="mapdiv" style="height:300px"></div>';
		
		//Start Sidenav
		$sidenav1 = array('id'=>'sidenav1', 'column'=>'6', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($map2));
		$sidenav2 = array('id'=>'sidenav2', 'column'=>'6', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($table));
		
		$params=array();
		$params['element']='Sidenav';
		$params['id']='sidenav';
		$params['content']=Array();
		$params['sidenav']=array($sidenav1,$sidenav2);
		array_push($this->elements, $params);
		unset($params);
		//End Sidenav
		
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
		        <li class="active"><a href="index.php?url=cargarinfo/pg/sininfo">Procesar<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-globe"></span></a></li>
		        <li ><a href="index.php?url=segundoplano/pg/sininfo">Mis Procesamientos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
		        <li ><a href="index.php?url=modelocarga/pg/sininfo"">Módelo de Cargas Oceánicas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-random"></span></a></li>
		        <li ><a href="index.php?url=gpstk/pg/sininfo">GPSTk<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>
				<li ><a href="index.php?url=session/ft/logout">Cerrar Sesión<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a></li>

				</ul>
		    </div>
		  </div>
		</nav>'; 
		
		//Start Sidenav
		$sidenav21 = array('id'=>'sidenav21', 'column'=>'4', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($menu2));
		$sidenav22 = array('id'=>'sidenav22', 'column'=>'8', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array('alerta2', 'alerta3', '<br>', 'puerto', 'cargas_oceanicas', $link, 'sidenav', '<br>', 'botonprocesar'));
		
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
// 		$params['home']=array('id'=>'home','label'=>'Inicio', 'active'=>true, 'link'=>'http://localhost/workspace/wallvoices/');
// 		$params['login']=array('id'=>'login1','label'=>'Iniciar Sesión','link'=>'#');
// 		$params['logout']=array('id'=>'regist','label'=>'Cerrar Sesión','link'=>'index.php?url=session/ft/logout');
// 		$params['signup']=array('id'=>'regist','label'=>'Registrarse','link'=>'#');
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
		$params['id']='rinex_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Archivo Rinex No Valido';
		$params['content']=array("<p>El archivo seleccionado no corresponde a un archivo de tipo RINEX, \n por favor verifique e intente de nuevo.</p>");
		$params['footer']='<h5>Alerta<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='cargas_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Archivo Cargas Oceánicas No Valido';
		$params['content']=array("<p>El archivo seleccionado no corresponde a un archivo de Cargas Oceánicas, \n por favor verifique e intente de nuevo.</p>");
		$params['footer']='<h5>Alerta<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='estacion_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Sin Información de Estación';
		$params['content']=array("<p>El archivo de cargas oceánicas no contiene información de la estación a procesar.</p>");
		$params['footer']='<h5>Alerta<h5>';
		array_push($this->elements, $params);
		unset($params);
		//End Modal
		
		//Start Modal
		$params=array();
		$params['element']='Modal';
		$params['id']='efemerides_false';
		$params['icon']='glyphicon-log-out';
		$params['title']='Error Descargando Efemérides';
		$params['content']=array("<p>No se han podido descargar las Efemérides necesarias para el tiempo de observación del Rinex.<br> Esto puede suceder debido a que los datos observados son muy recientes, y aún no se encuentran disponibles en la página web de la nasa las Efemérides precisas (sp3) o porque la página no se encuentra disponible en este momento.</p>");
		$params['footer']='<h5>Alerta<h5>';
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
