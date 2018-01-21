<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 08.05.2017
 * Time: 19:11
 */
require_once 'inc/bootstrap.inc.php';

if (isset($_GET['class'])) {
	$className = 'Entities\\' . $_GET['class'];
	$con = $em->getConnection();
	$cmd = $em->getClassMetadata($className);
	$repository = $em->getRepository($className);
	$con->beginTransaction();
	try {
		$con->query('SET FOREIGN_KEY_CHECKS=0');
		$con->query('DELETE FROM '.$cmd->getTableName());
		$con->query('SET FOREIGN_KEY_CHECKS=1');
		$con->commit();
		$con->query('ALTER TABLE ' . $cmd->getTableName() . ' AUTO_INCREMENT = 1');

		for($i = 1; $i<=5; $i++) {
			$books[$i] = new \Entities\Book([
				'title' => 'Test ' . $i,
				'price' => $i
			]);
			$em->persist($books[$i]);
		}
		$em->flush();

		echo "OK";

	} catch (Exception $e) {
		$con->rollBack();
	}
}

