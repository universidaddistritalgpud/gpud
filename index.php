<?php

require 'config.php';
require 'util/Auth.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
	if (file_exists ( LIBS . $class . '.php' )) {
		require LIBS . $class . ".php";
	}else if (file_exists ( ELEMENTS . $class . '.class.php' )) {
		require ELEMENTS . $class . ".class.php";
	}else if (file_exists ( DRAW . $class . '.class.php' )) {
		require DRAW . $class . ".class.php";
	}else if (file_exists ( BUILDER . $class . '.class.php' )) {
		require BUILDER . $class . ".class.php";
	}
}

// Load the Bootstrap!
$bootstrap = new Bootstrap();

//Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$bootstrap->init();

?>