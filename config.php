<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'class.db.php';
session_start();
require 'DateControl.php';
require 'Calendar.php';
date_default_timezone_set('America/New_York');
$config = array(
	'host'     => '127.0.0.1',
	'dbname'   => 'calendar',
	'user'     => '',
	'password' => ''
	);


$conn = new DB($config['host'], $config['dbname'], $config['user'], $config['password']);
