<?php

class Model {

    function __construct() {
    	
        $this->db = new medoo([
			'database_type' => 'pgsql',
			'database_name' => 'tiir',
			'server' => 'localhost',
			'username' => 'postgres',
			'password' => '880815',
			'charset' => 'utf8'
		]);
    }

}