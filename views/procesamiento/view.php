<?php

Class Procesamiento{
	
	private $elements;
	private $module;
	private $info;
	private $security;
	private $publicKey;
	private $connection;
	
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

		$myProcessing = new MyProcessing();
		$myProcessing->executeFuntion($this->info, $this->connection, $this->publicKey);
		
		$information = $myProcessing->getInformationProcess();
		
		define('LATITUD', $information['position']['latitude']);
		define('LONGITUD', $information['position']['longitude']);
		define('PUNTO', $information['markerName']);
		

		$out = $myProcessing->getValuesOut();
	
		$model = $myProcessing->getValuesModel();
		
		$img = $myProcessing->getImages();
		
		$titulo = '<h4>REPORTE DEL PROCESAMIENTO</h4>';

		$descripcion = '<p class="text-justify">A continuación se presentan datos básicos generados a partir del encabezado del archivo rinex procesado, y la información mas relevante presente en el resultado del procesamiento.' . '</p>';
		
		$descripcionSkyplot = '<p class="text-justify">Aquí va la descripción del SkyPlot' . '</p>';
		
		$descripcionSkyplot = '';
		
		$tablaInformacionPunto = '<table class="table table-bordered" style="width:100%">
					<tr>
						<th class="bg-primary titulo" colspan="2">INFORMACIÓN DEL PUNTO</th>
					</tr>
					<tr>
						<th class="text-left bg-primary">NOMBRE DEL PUNTO</th>
						<td class="bg-info titulo">' . $information['markerName'] . '</td>
					</tr>
					<tr>
						<th class="text-left bg-primary">FECHA/DÍA DEL AÑO RINEX</th>
						<td class="bg-info titulo">' . $information['date']['day'] . " de " . $information['date']['monthText'] . " del " . $information['date']['year'] . '/' . $information['dayofyear'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">TIPO DE RECEPTOR GNSS</th>
						<td class="bg-info titulo">' . $information['antenna'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">ALTURA DE LA ANTENA</th>
						<td class="bg-info titulo">' . $information['heightAntenna']['H'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">INTERVALO DE OBSERVACIÓN</th>
						<td class="bg-info titulo">' . $information['intervalPrecise'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">HORA DE INICIO</th>
						<td class="bg-info titulo">' . $information['datePrecise'] ['dateStart'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">HORA DE FINALIZACIÓN</th>
						<td class="bg-info titulo">' . $information['datePrecise'] ['dateEnd'] . '</td>
					</tr>
				</table>';
		
		
		$tablaSeleccionSatelites = '<table class="table table-bordered" style="width:100%">
					<tr>
						<th class="bg-primary titulo" colspan="3">SELECCIÓN DE SATÉLITES</th>
					</tr>
					<tr>
						<th class="bg-primary titulo">ÍTEM</th>
						<th class="bg-primary titulo">MÍNIMO</th>
						<th class="bg-primary titulo">MÁXIMO</th>
					</tr>
					<tr>
						<th class="text-left bg-primary">NÚMERO DE SATÉLITES</th>
						<td class="bg-info titulo">' . $out['minMaxOut']['SATELLITES']['min'] . '</td>
						<td class="bg-info titulo">' . $out['minMaxOut']['SATELLITES']['max'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">GDOP</th>
						<td class="bg-info titulo">' . $out['minMaxOut']['GDOP']['min'] . '</td>
						<td class="bg-info titulo">' . $out['minMaxOut']['GDOP']['max'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">PDOP</th>
						<td class="bg-info titulo">' . $out['minMaxOut']['PDOP']['min'] . '</td>
						<td class="bg-info titulo">' . $out['minMaxOut']['PDOP']['max'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">TDOP</th>
						<td class="bg-info titulo">' . $out['minMaxOut']['TDOP']['min'] . '</td>
						<td class="bg-info titulo">' . $out['minMaxOut']['TDOP']['max'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">HDOP</th>
						<td class="bg-info titulo">' . $out['minMaxOut']['HDOP']['min'] . '</td>
						<td class="bg-info titulo">' . $out['minMaxOut']['HDOP']['max'] . '</td>
					</tr>
					<tr>
						<th class="bg-primary">VDOP</th>
						<td class="bg-info titulo">' . $out['minMaxOut']['VDOP']['min'] . '</td>
						<td class="bg-info titulo">' . $out['minMaxOut']['VDOP']['max'] . '</td>
					</tr>
				</table>';
		
		$imagen1 = "";
		$imagen2 = "";
		$imagen3 = "";
	
		if(isset( $information['gif'][0])){
			if( $img['skyplot1']){
				$imagen1 = '<span id="spanimg1" class="roll glyphicon" ><img id="img1" src="data:image/gif;base64,' . $img['skyplot1'] . '" border="0" width="230" height="250" alt="skyplot"></span>';
			}
		}
		if(isset( $information['gif'][1])){
			if( $img['skyplot2']){
				$imagen2 = '<span id="spanimg2" class="roll glyphicon" ><img id="img2" src="data:image/gif;base64,' . $img['skyplot2'] . '" border="0" width="230" height="250" alt="skyplot"></span>';
			}
		}
		if(isset( $information['gif'][2])){
			if( $img['skyplot3']){
				$imagen3 = '<span id="spanimg3" class="roll glyphicon" ><img id="img3" src="data:image/gif;base64,' . $img['skyplot3'] . '" border="5" width="230" height="250" alt="skyplot"></span>';
			}
		}

		$modal =  '

		<!-- Modal -->
		<div id="myModal" class="modal fade text-center" role="dialog" style="height:100%">
		  <div class="modal-dialog modal-lg">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<button type="button" class="close" data-dismiss="modal">&times;</button>
				<img id="img01" style="height:500px">
		    </div>
		
		  </div>
		</div>
		';
		
		$map2 = '<div id="mapdiv" style="height:300px"></div>';
		
		//Start Sidenav
		$sidenav1 = array('id'=>'sidenav1', 'column'=>'12', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($imagen1, $imagen2, $imagen3));
		
		$params=array();
		$params['element']='Sidenav';
		$params['id']='sidenav1';
		$params['content']=Array();
		$params['sidenav']=array($sidenav1);
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
		        <li ><a href="index.php?url=cargarinfo/pg/sininfo">Procesar<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-globe"></span></a></li>
		        <li class="active"><a href="index.php?url=segundoplano/pg/sininfo">Mis Procesamientos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
		        <li ><a href="index.php?url=modelocarga/pg/sininfo"">Módelo de Cargas Oceánicas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-random"></span></a></li>
				<li ><a href="index.php?url=gpstk/pg/sininfo">GPSTk<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>
				<li ><a href="index.php?url=session/ft/logout">Cerrar Sesión<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a></li>
		      </ul>
		    </div>
		  </div>
		</nav>';
		
		
		
		//Start Sidenav
		$sidenav21 = array('id'=>'sidenav21', 'column'=>'4', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($menu2));
		$sidenav22 = array('id'=>'sidenav22', 'column'=>'8', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($titulo, $descripcion, $map2, '<br>', $tablaInformacionPunto, $tablaSeleccionSatelites, $descripcionSkyplot, 'sidenav1'));
		
		$params=array();
		$params['element']='Sidenav';
		$params['id']='sidenav2';
		$params['content']=Array('sidenav1');
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
		$params['content']=array('sidenav2', $modal);
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
	
	public function getElement($info, $security, $publicKey, $connection){
		$this->info = $info;
		$this->security = $security;
		$this->publicKey = $publicKey;
		$this->connection = $connection;
		
		$this->chargeElement();
		
		return $this->elements;
	}
}

?>
