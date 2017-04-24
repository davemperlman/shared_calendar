<?php
require_once 'Class/DB.php';
require_once 'Class/Calendar.php';
require_once 'Class/DateControl.php';
require_once 'Class/Event.php';

session_start();
date_default_timezone_set('America/New_York');
$config = array(
	'host'     => '127.0.0.1',
	'dbname'   => 'calendar',
	'user'     => '',
	'password' => ''
	);

//Instatiate new connection to DB.
$conn = new DB($config['host'], $config['dbname'], $config['user'], $config['password']);
