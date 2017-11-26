<?php

Class SegundoPlano{
	
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
		
		$this->info = $_SESSION['id']; 
		
		$myProcessing = new MyProcessing();
		$information = $myProcessing->executeFuntion($this->info, $this->connection, $this->publicKey);

		$table = '<table class="table table-bordered" style="width:100%">
					<tr>
						<th class="bg-primary titulo">Nombre Estación</th>
						<th class="bg-primary titulo">Fecha Inicio</th>
						<th class="bg-primary titulo">Estado</th>
						<th class="bg-primary titulo">Ver</th>
						<th class="bg-primary titulo">Descargar</th>
					</tr>';
		
		$input = '<input type="hidden" name="estado" id="estado" value="norecargar">';
		
		$cont = 0;
		
		foreach ($information as $key => $value){

			$cont++;
			
			$informationProcessing = json_decode($value['content_json'], true);
			
			$params = 'general/' . $informationProcessing['strucFolder']['prefijo'] . '/' . $informationProcessing['markerName'];
			
			$link_ver = MY_URL . DS . "index.php?url=procesamiento/pg/" . $params;
			$link_descargar = MY_URL . DS . "index.php?url=pdf/ft/" . $params;
			$link_descargar = MY_URL . DS . 'files' . DS . $informationProcessing['strucFolder']['prefijo'] . "_" . $informationProcessing['markerName'] . "_" . $informationProcessing['date']['year'] . "_" . $informationProcessing['dayofyear'] . '.zip';
			
			if($value['processing_state'] == "TERMINADO"){
				$link_ver = '<a href="' . $link_ver . '"> <span class="glyphicon glyphicon-eye-open"></span> </a>';		
				$link_descargar = '<a href="' . $link_descargar . '"> <span class="glyphicon glyphicon-save"></span> </a>';		
			}else{
				$link_ver = "";
				$link_descargar = "";
				$params = "";
				$input = '<input type="hidden" name="estado" id="estado" value="recargar">';
			}
			
			$table .= '<tr>
					<td class="bg-info">' .  $informationProcessing['markerName'] .'</td>
					<td class="bg-info">' . explode(".", $value['registration_date'])[0] . '</td>
					<td class="bg-info">' . $value['processing_state'] . '</td>
					<td class="bg-info">' . $link_ver . '</td>
					<td class="bg-info">' . $link_descargar . '</td>
			</tr>';
		}
		
		$table .= '</table>';
		
		$procesamientos = "";
		
		if($cont == 0){
			$procesamientos = '<br><br><b>No ha realizado Ningún procesamiento</b>';
		}
	
		//Start Sidenav
		$sidenav1 = array('id'=>'sidenav1', 'column'=>'12', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array($table, $procesamientos));
		
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
		$sidenav22 = array('id'=>'sidenav22', 'column'=>'8', 'shadow'=>'sidenav', 'text'=>'text-center', 'content'=>array('sidenav1'));
		
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
		$params['content']=array('sidenav2', $input);
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
