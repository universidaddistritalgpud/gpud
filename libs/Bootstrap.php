<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    
    private $_controllerPath = 'controllers/'; // Always include trailing slash
    private $_modelPath = 'models/'; // Always include trailing slash
    private $_errorFile = 'error.php';
    private $_defaultFile = 'callcontroller';
    
    /**
     * Starts the Bootstrap
     * 
     * @return boolean
     */
    public function init()
    {
        // Sets the protected $_url
        $this->_getUrl();

        $this->initFunction();
        
        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        
        $info = array('validate');
        
        $connection = new Medoo([
        		'database_type' => 'pgsql',
        		'database_name' => 'gpud',
        		'server' => '127.0.0.1',
        		'username' => 'postgres',
        		'password' => 'tesis2017',
        		'charset' => 'utf8'
        ]);
        
        $publicKey = 'abcdefghijklmnopqrstuvwxyz123456';
        
        $session = new Session();
        $statusSession = $session->executeFuntion($info, $connection, $publicKey);
        
        $securityClass = new SecurityClass();
        $classOpen = $securityClass->executeFuntion($info, $connection, $publicKey);
        
        if((isset($this->_url[0]) && $statusSession == true) || (isset($this->_url[0]) && (in_array($this->_url[0], $classOpen)))){

        	$this->_loadExistingController();
        	$this->_callControllerMethod();
        }else{
        	$this->_loadDefaultController();
        	$this->_callControllerMethod();
        }
    }
    
    /**
     * (Optional) Set a custom path to controllers
     * @param string $path
     */
    public function setControllerPath($path)
    {
        $this->_controllerPath = trim($path, '/') . '/';
    }
    
    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path)
    {
        $this->_modelPath = trim($path, '/') . '/';
    }
    
    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: error.php
     */
    public function setErrorFile($path)
    {
        $this->_errorFile = trim($path, '/');
    }
    
    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: index.php
     */
    public function setDefaultFile($path)
    {
        $this->_defaultFile = trim($path, '/');
    }
    
    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }
    
    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController()
    {
        $file = $this->_controllerPath . $this->_defaultFile . '.php';

        if (file_exists($file)) {
        	
        	require $file;
        	
        	$this->_url = array();
        	
        	$this->_url[0] = "inicio";
        	$this->_url[1] = "pg";
        	$this->_url[2] = "sininformacion";
        	$this->_url[3] = "sininformacion";
        	
            $copyUrl =$this->_url;
            
            $this->_controller = $this->_url[0];
            
            array_shift ( $copyUrl );
            $action = $copyUrl [0];
            
            array_shift ( $copyUrl );
            $params = $copyUrl;
            
            array_shift ( $copyUrl );
            $queryString = $copyUrl;
            
            $controllerName = $this->_controller;
            $this->_controller = ucwords ( $this->_controller );
            $model = rtrim ( $this->_controller, 's' );
            $this->_controller .= 'Controller';
            
            $this->_controller = 'CallController';
            
            $connection = new Medoo([
            		'database_type' => 'pgsql',
            		'database_name' => 'gpud',
            		'server' => '127.0.0.1',
            		'username' => 'postgres',
            		'password' => 'tesis2017',
            		'charset' => 'utf8'
            ]);
            
            $publicKey = 'abcdefghijklmnopqrstuvwxyz123456';
            
            $this->_controller = new $this->_defaultFile;
            
            $this->_controller->loadModel( $model, $controllerName, $connection, $publicKey, $action, $params );
            
        }
    }
    
    /**
     * Load an existing controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
    private function _loadExistingController()
    {
    	$file = $this->_controllerPath . $this->_defaultFile . '.php';

        if (file_exists($file)) {
            require $file;
            
            $copyUrl =$this->_url;
            
            $this->_controller = $this->_url[0];
            
            array_shift ( $copyUrl );
            
            if(isset($copyUrl [0])){
            	$action = $copyUrl [0];
            }else{
            	$this->_controller = "cargarInfo";
            	$action = 'inicio';
            	$this->_url[0] = "cargarInfo";
            	$this->_url[1] = "pg";
            	$this->_url[2] = "sininformacion";
            	$this->_url[3] = "sininformacion";
            }
            
            array_shift ( $copyUrl );
            $params = $copyUrl;
            
            array_shift ( $copyUrl );
            $queryString = $copyUrl;
            
            $controllerName = $this->_controller;
            $this->_controller = ucwords ( $this->_controller );
            $model = rtrim ( $this->_controller, 's' );
            $this->_controller .= 'Controller';
            
            $this->_controller = 'CallController';
            
            $connection = new Medoo([
            		'database_type' => 'pgsql',
            		'database_name' => 'gpud',
            		'server' => '127.0.0.1',
            		'username' => 'postgres',
            		'password' => 'tesis2017',
            		'charset' => 'utf8'
            ]);
            
            
            
            
            
            $publicKey = 'abcdefghijklmnopqrstuvwxyz123456';
            
            $this->_controller = new $this->_defaultFile;
            
            define("MODEL", $model);
            
            $this->_controller->loadModel( $model, $controllerName, $connection, $publicKey, $action, $params );
            
        } else {
            $this->_error();
            return false;
        }
    }
    
    private function _callControllerMethod()
    {
        $length = count($this->_url);
        
        // Make sure the method we are calling exists
        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }
        
        $this->_controller->{$this->_url[1]}();

    }
    
    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error() {
        require $this->_controllerPath . $this->_errorFile;
        $this->_controller = new Error();
        $this->_controller->index();
        exit;
    }
    
    function initFunction(){
    	$scanner = ScannerModule::getInstance();
    	$function = $scanner->allFunctions();

    	foreach ($function as $add){
    		require_once ( "models" . DS . $add . DS  . 'function.php');
    	}
    }
}
