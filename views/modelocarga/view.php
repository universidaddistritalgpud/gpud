<?php

Class ModeloCarga{
	
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
		
		$imagen1 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/pagina_carg900as.png" width="600" ALT="Página para obtener módelo de cargas oceánicas http://holt.oso.chalmers.se/loading/"></p>';
		
		$imagen2 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/seleccion_modelo.png" width="300" ALT="Seleccion modelo FES2004"></p>';
		
		$imagen3 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/seleccion_fenomeno_carga.png" width="300" ALT="Seleccion fenomeno carga"></p>';
		
		$imagen4 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/seleccion_formato.png" width="500" ALT="Seleccion formato salida"></p>';
		
		$imagen5 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/informacion_estacion.png" width="500" ALT="Sección Información"></p>';
		
		$imagen6 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/datos_estacion.png" width="500" ALT="Ingresando datos estación"></p>';
		
		$imagen7 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/ingresar_email.png" width="600" ALT="Ingresando correo electrónico"></p>';
		
		$imagen8 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/pantalla_confirmacion.png" width=600" ALT="Confirmación solicitud"></p>';
		
		$imagen9 = '<p><img SRC="' . MY_URL . 'views/modelocarga/img/datos_estacion.png" width="500" ALT="Ingresando datos estación"></p>';
		
		$titulo = '<h1>MÓDELO DE CARGAS OCEANICAS</h1>';
		
		$texto = '<p>La Carga Oceánica es responsable del 10 % del efecto gravitatorio, 25 % sobre las deformaciones y el 90 % de la desviación de la vertical.</p>';
		
		$pasos = '<p>Para obtener el modelo de carga oceánica solicitado en el módulo de procesamiento, siga los siguientes pasos:</p>';
		
		$pasos1 = '<p>1. Diríjase a la página de oso haciendo clic en el siguiente <a href="http://holt.oso.chalmers.se/loading/" target="_blank"> link </a></p>';
		
		$pasos2 = '<p>2. Seleccione el modelo de la marea oceánica FES2004</p>';
		
		$pasos3 = '<p>3. En el tipo de fenómeno de carga a considerar seleccione los desplazamientos verticales y horizontales (vertical and horizontal displacements).</p>';
		
		$pasos4 = '<p>4. Verifique que el formato de salida seleccionado sea BLQ (normal).</p>';
		
		$pasos5 = '<p>5. Los demás campos déjelos con el valor predefinido.</p>';
		
		$pasos6 = '<p>6. En la sección donde estas sus estaciones, debe ingresar la información correspondiente a la estación que desea procesar. Para ello diríjase al módulo <b>Procesar</b> y cargue el archivo Rinex que desea procesar. Una vez cargue el archivo se generara un mapa y una tabla que contiene la información que debe ingresar en la página. A continuación se presentan dos imágenes que le ayudaran a entender de mejor manera como obtener e ingresar los datos.</p>';
		
		$pasos7 = '<p>7. Una vez realizados los pasos anteriores. Ingrese un correo electrónico válido, ya que será allí donde le llegara la información de la carga oceánica del modelo seleccionado.</p>';
		
		$pasos8 = '<p>8. De clic sobre el botón submit. Se generara una ventana confirmando que se ha recibido la solicitud de generación de modelo de cargas oceánicas para el punto ingresado.</p>';
		
		$pasos9 = '<p>9. Cuando llegue el correo con la información del modelo de cargas oceánicas para el punto, copie la información y péguela en un archivo y guarde este con extensión .dat.</p>';
		
		$final = '<p>De esta manera, habrá finalizado el proceso para obtener el archivo de cargas oceánicas el cual podrá utilizar en el módulo <b>Procesar</b>.</p>';
		
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
		        <li class="active"><a href="index.php?url=modelocarga/pg/sininfo"">Módelo de Cargas Oceánicas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-random"></span></a></li>
				<li ><a href="index.php?url=gpstk/pg/sininfo">GPSTk<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench"></span></a></li>
				<li ><a href="index.php?url=session/ft/logout">Cerrar Sesión<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a></li>

				</ul>
		    </div>
		  </div>
		</nav>'; 
		
		//Start Sidenav
		$sidenav21 = array('id'=>'sidenav21', 'column'=>'4', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($menu2));
		$sidenav22 = array('id'=>'sidenav22', 'column'=>'8', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($titulo, $texto, $pasos, $pasos1, $pasos2, $imagen2, $pasos3, $imagen3, $pasos4, $imagen4, $pasos5, $pasos6, $imagen5, $imagen6, $pasos7, $imagen7, $pasos8, $imagen8, $pasos9, $final));		
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
