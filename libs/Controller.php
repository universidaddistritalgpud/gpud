<?php


class Controller extends Html {

	

	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $_params;
	protected $_connection;
	protected $_publickey;
	
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($model, $controller, $connection, $publickey, $action, $params) {
    	$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;
		$this->_params = $params;
		$this->_connection = $connection;
		$this->_publickey = $publickey;
		
    }

}