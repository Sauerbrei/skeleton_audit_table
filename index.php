<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 18.04.2017
 * Time: 14:14
 */
session_start();

require_once 'inc/functions.inc.php';
require_once 'inc/bootstrap.inc.php';

$action = $_GET['action'] ?? 'index';
$controller = $_GET['controller'] ?? 'index';

$route = new \Controller\Router($controller, $action, $config['base_dir'], $em);