<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 10.06.2017
 * Time: 14:30
 */
namespace Traits\Database;

use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMInvalidArgumentException;
use Entities\Audit;
use PHPUnit\Framework\Exception;


trait Auditable {

	public function RemoveService() {
		include __DIR__ . '/../../config/default_config.php';
		include __DIR__ . '/../../inc/bootstrap.inc.php';

		$audit = new Audit($this, 'remove');
		/**
		 * @var $em EntityManager
		 */
		$em->persist($audit);
		$em->flush();
	}

}