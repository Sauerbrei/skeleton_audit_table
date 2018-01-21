<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 06.05.2017
 * Time: 16:06
 */

// cli-config.php
require_once "inc/bootstrap.inc.php";
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
	'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
return $helperSet;