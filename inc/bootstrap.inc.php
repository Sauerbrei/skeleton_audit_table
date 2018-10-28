<?php
$config = [];

$config['base_dir']   = dirname(__DIR__);
$config['entity_dir'] = $config['base_dir'] . '/src/Entities';

$loader = require $config['base_dir'] . "/vendor/autoload.php";
$dotenv = new Dotenv\Dotenv($config['base_dir']);
$dotenv->load();

$config['db']         = [
	'driver'   => getenv('DB_DRIVER'),
	'host'     => getenv('DB_HOST'),
	'user'     => getenv('DB_USER'),
	'password' => getenv('DB_PASS'),
	'dbname'   => getenv('DB_DATABASE'),
	'port'     => getenv('DB_PORT'),
];


/**
 * APPLICATION OPTIONS
 */
$config['options']['debug_mode'] = getenv('APP_DEBUG');

$database = new \Configuration\GedmoDatabase($config['db'], $loader, $config['entity_dir']);
$database->addLoggable(null);
$database->addTimestampable();
$em = $database->getEntityManager();