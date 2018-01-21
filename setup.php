<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 06.05.2017
 * Time: 14:47
 */
require_once 'inc/bootstrap.inc.php';

$command = '"' . $config['base_dir'] . '/vendor/bin/doctrine" orm:schema-tool:update --force';
$output = system($command . ' 2>&1', $return);
d($command);
d($output);
d($return);
