<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 06.05.2017
 * Time: 10:14
 */

$config = [];

$config['base_dir'] = dirname(__DIR__);
$config['entity_dir'] = $config['base_dir'] . '/src/Entities';


/**
 * DATABASE CONNECTIONS
 */

/*
 * MySQL
 */
$config['db']['mysql'] = [
	'driver'	=> 'pdo_mysql',
	'host'		=> 'localhost',
	'user'		=> 'root',
	'password'	=> '',
	'dbname'	=> 'test',
	'port'		=> 3306,
	'driver'	=> 'pdo_mysql'
];
$usedDB = $config['db']['mysql'];


/**
 * APPLICATION OPTIONS
 */
$config['options']['debug_mode'] = true;