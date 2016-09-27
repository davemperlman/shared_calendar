<?php
require 'class.db.php';
session_start();
$config = array(
	'host'     => '',
	'dbname'   => '',
	'user'     => '',
	'password' => ''
	);


$conn = new DB($config['host'], $config['dbname'], $config['user'], $config['password']);
