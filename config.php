<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://workspace:82/mvc/');
define('LIBS', 'libs/');
define('DRAW', 'libs/draw/');
define('ELEMENTS', 'libs/view/elements/');
define('BUILDER', 'libs/view/builder/');
define('DS', '/');
define('MY_FOLDER', dirname( realpath( __FILE__ ) ) );
$url = parse_url("http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);
//define('MY_URL', str_replace ( "index.php", "" , $url['scheme'] . "://" . $url['host'] . ":" . $url['port'] . $url['path'] ) ) ;
define('MY_URL', str_replace ( "index.php", "" , $url['scheme'] . "://" . $url['host'] . $url['path'] ) ) ;
		
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASS', '');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');

?>
