<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 06.05.2017
 * Time: 14:02
 */


require_once dirname(__DIR__) . '/config/default_config.php';
$loader = require $config['base_dir'] . "/vendor/autoload.php";

$database = new \Configuration\GedmoDatabase($usedDB, $loader, $config['entity_dir']);
$database->addLoggable(null);
$database->addTimestampable();
$em = $database->getEntityManager();