<?php

class Table{
	
	private $element=array();
	private $params=array();

	//Esta clase recibe un parametro que es un arregle el cual debe contener:
	//Definir el elemento (element: Table)
	//Definir la clase a la cual corresponde la tabla (class: basic, striped, bordered, hover, condensed, contextual)
	//Definir el id (id)
	//Definir si es responsive (responsive: yes, no)
	//Definir el título de la tabla (title)
	//Definir la descripción de la tabla (description)
	//Definir los encabezados de la tabla (columns:  array("column1", "column2"))
	//Definir las filas de la tabla cada fila debe contener el mismo número de columnas correspondientes a los encabezados (rows: array(array("col1-row1", "col2-row1"), array("col1-row2", "col2-row2")))
	//Si se  desea asignar un color a cada fila debe agregar la columna (class: active, success, info, warning, danger)
	
	function __construct(){}

	private function parameterize($params){
		
		switch ($params['class']){
			case 'basic':
				$params['class'] = 'table';
				break;
			case 'striped':
				$params['class'] = 'table table-striped';
				break;
			case 'bordered':
				$params['class'] = 'table table-bordered';
				break;
			case 'hover':
				$params['class'] = 'table table-hover';
				break;
			case 'condensed':
				$params['class'] = 'table table-condensed';
				break;
			case 'contextual':
				$params['class'] = 'table';
				break;
			default:
				$params['class'] = 'table';
				break;
		}
		
		switch ($params['responsive']){
			case 'yes':
				$params['responsive'] = 'table-responsive';
				break;
			case 'no':
				$params['responsive'] = 'container';
				break;
			default:
				$params['responsive'] = 'container';
				break;
		}
		
		$this->params = $params;
		
	}
	
	function table($params) {
		
		$this->parameterize($params);
		
		$this->element['html'] = '';
		$this->element['html'] .= '<div class="';
		$this->element['html'] .= $this->params['responsive'];
		$this->element['html'] .='" id ="';
		$this->element['html'] .= $this->params['id'];
		$this->element['html'] .= '">';
		$this->element['html'] .= '<h2>';
		$this->element['html'] .= $this->params['title'];
		$this->element['html'] .= '</h2>';
		$this->element['html'] .= '<p>';
		$this->element['html'] .= $this->params['description'];
		$this->element['html'] .= '</p>';
		$this->element['html'] .= '<table class="';
		$this->element['html'] .= $this->params['class'];		
		$this->element['html'] .= '">';
		$this->element['html'] .= '<thead>';
		$this->element['html'] .= '<tr>';
		
		foreach ($this->params['columns'] as $colum){
			$this->element['html'] .= '<th>';
			$this->element['html'] .= $colum;
			$this->element['html'] .= '</th>';
		}
		
		$this->element['html'] .= '</thead>';
		$this->element['html'] .= '<tbody>';
		
		foreach ($this->params['rows'] as $row){
			$this->element['html'] .= '<tr';
			$this->element['html'] .= ' class="';
			
			if (isset($row['class'])){
				$this->element['html'] .= $row['class'];
				unset($row['class']);
			}
			
			$this->element['html'] .= '" ';
			$this->element['html'] .= '>';
			foreach ($row as $item){
				$this->element['html'] .= '<td>';
				$this->element['html'] .= $item;
				$this->element['html'] .= '</td>';
			}
			$this->element['html'] .= '</tr>';
		}
		
		$this->element['html'] .= '</tbody>';
		$this->element['html'] .= '</table>';
		$this->element['html'] .= '</div>';
		
		return $this->element;
	}
}

?>
