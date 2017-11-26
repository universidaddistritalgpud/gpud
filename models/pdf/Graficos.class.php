<?php

require_once('framework' . DS . 'jpgraph/src/jpgraph.php');
require_once('framework' . DS . 'jpgraph/src/jpgraph_line.php');
require_once('framework' . DS . 'jpgraph/src/jpgraph_bar.php');
require_once('framework' . DS . 'jpgraph/src/jpgraph_pie.php');
require_once('framework' . DS . 'jpgraph/src/jpgraph_pie3d.php');

class Graficos {

	public function __construct(){
	}

	function rand_color() {
		return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}
	
	public function graficar_lineas(array $L1, $path) {
		
		$epocas=array();
		$gps = array();
		
		$lineas = array();
		$lineas2 = array();
		
		$labels=array();
		
// 		foreach ($L1 as $key => $datos){
// 			foreach ($datos as $satellite => $valor){
// 				if (!in_array($satellite, $gps)) {
// 					$gps[] = $satellite;
// 				}
// 			}
// 			$epocas[] = $key;
// 		}
		
// 		foreach ($L1 as $key => $datos){
// 			var_dump($datos);die;
// 			foreach ($gps as $valor){
// 				if(isset($L1[$key][$valor])){
// 					$lineas[$valor][] = $L1[$key][$valor];
// 				}else{
// 					$lineas[$valor][] = "";
// 				}
// 			}
			
// 			$labels[] = explode(".", $key)[0];
// 			$labelsVacios[] = "";

// 		}

		foreach ($L1 as $key => $datos){
			$total = 0;
			foreach ($datos as $satellite => $valor){
				$countDatos = count($datos);
				$total += $valor;
				break;
			}
			
			$lineas[] = $total/$countDatos;
			
			$epocas[] = $key;
			$labelsVacios[] = "";
		}
		
		$grafico = new Graph(900,400,'auto');
		$grafico->SetScale("textlin");
		//$grafico->SetMargin(80,150,0,0);
		$grafico->SetMargin(40,0,0,0);
		$grafico->title->Set("GNSS");
		//$grafico->xaxis->title->Set("MES");
		$grafico->xaxis->SetTickLabels($labelsVacios);
		//$grafico->yaxis->title->Set("GASTOS");
		
		$grafico->xgrid->Show();
		$grafico->xgrid->SetLineStyle("solid");
		$grafico->xgrid->SetColor('#E3E3E3');
		
		//sort($lineas);
		
		//foreach ($lineas as $key => $satellite){
			//$p1 = new LinePlot($satellite);
			$p1 = new LinePlot($lineas);
			$grafico->Add($p1);
			$p1->SetWeight(4);
			//$p1->value->Show();
			$p1->SetColor('#e50000');
			//$p1->SetColor("#153f66");
			//$p1->SetLegend($key);
		//}
		
		$grafico->legend->SetFrameWeight(1);

		$grafico->legend->SetPos(0.05,0.06,'right','top');
		$grafico->legend->SetColumns(2);
		
		$grafico->title->SetFont(FF_FONT1,FS_BOLD);
		$grafico->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$grafico->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		$grafico->Stroke($path);
	}

	public function graficar_barras() {
		$data1y = array(100,300,250,200,350);
		$data2y = array(50,250,300,320,200);
		$labels=array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes');

		$grafico = new Graph(940,400,'auto');
		$grafico->SetScale("textlin");
		$grafico->SetMargin(50,30,30,40);
		$grafico->title->Set("VS. GASTOS DIA SEMANA PASADA/DIA SEMANA ACTUAL");
		$grafico->xaxis->title->Set("MES");
		$grafico->xaxis->SetTickLabels($labels);
		$grafico->yaxis->title->Set("GASTOS");

		$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);

		$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
		$grafico->Add($gbplot);

		$b1plot->value->Show();
		$b1plot->SetColor("white");
		$b1plot->SetFillColor("#B0C4DE");
		$b1plot->SetWidth(50);
		$b2plot->value->Show();
		$b2plot->SetColor("white");
		$b2plot->SetFillColor("#11CCCC");
		$b2plot->SetWidth(50);

		$grafico->title->SetFont(FF_FONT1,FS_BOLD);
		$grafico->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$grafico->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		$grafico->Stroke();
	}

	public function graficar_pastel() {
		$datos = array(100,300);

		$grafico = new PieGraph(940,400,'auto');
		$grafico->SetScale("textlin");
		$grafico->SetMargin(50,30,30,40);

		$tema= new VividTheme;
		$grafico->SetTheme($tema);

		$grafico->title->Set("% HOMBRES y MUJERES");

		$p1 = new PiePlot3D($datos);
		$grafico->Add($p1);

		$p1->ShowBorder();
		$p1->SetColor('white');
		$p1->ExplodeSlice(1);
		$grafico->Stroke();
	}
}
?>