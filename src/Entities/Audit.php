<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 09.06.2017
 * Time: 19:43
 */

namespace Entities;

use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation AS Gedmo;
use PHPUnit\Framework\Exception;

/**
 * Class Audit
 * @package Entities
 * @ORM\Entity
 */
class Audit extends ABaseEntity  {
	/**
	 * @var int
	 * @ORM\Id()
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id = 0;
	/**
	 * @var
	 * @ORM\Column(type="string", length=15)
	 */
	protected $action = '';
	/**
	 * @var string
	 * @ORM\Column(type="string", length=100)
	 */
	protected $user = '';
	/**
	 * @var string
	 * @ORM\Column(type="string", length=50, name="tablename")
	 */
	protected $table = '';
	/**
	 * @var string
	 * @ORM\Column(type="string", length=50)
	 */
	protected $entity = '';
	/**
	 * @var int
	 * @ORM\Column(type="integer", name="entity_id")
	 */
	protected $entityId = 0;
	/**
	 * @var string
	 * @ORM\Column(type="text", name="data")
	 */
	protected $objectData = '';
	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $version = 0;
	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", name="logged_at")
	 */
	protected $loggedAt;

	/**
	 * Audit constructor.
	 * @param ABaseEntity $object
	 * @param $action
	 */
	public function __construct(ABaseEntity $object , $action) {
		$om = new \ReflectionClass($object);
		$this
			->setAction($action)
			->setTable(mb_strtolower($om->getShortName()))
			->setEntity(get_class($object))
			->setEntityId($object->getId())
			->setObjectData($object)
			->setUser('unknown')
			->setLoggedAt(new \DateTime());
		;
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @param mixed $action
	 * @return Audit
	 */
	public function setAction($action) {
		$this->action = $action;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEntity(): string {
		return $this->entity;
	}

	/**
	 * @param string $entity
	 * @return Audit
	 */
	public function setEntity(string $entity): Audit {
		$this->entity = $entity;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getEntityId(): int {
		return $this->entityId;
	}

	/**
	 * @param int $entityId
	 * @return Audit
	 */
	public function setEntityId(int $entityId): Audit {
		$this->entityId = $entityId;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getLoggedAt(): \DateTime {
		return $this->loggedAt;
	}

	/**
	 * @return \DateTime
	 */
	public function setLoggedAt(\DateTime $date): Audit {
		$this->loggedAt = $date;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getObjectData(): string {
		return $this->objectData;
	}

	/**
	 * @param mixed $objectData
	 * @return Audit
	 */
	public function setObjectData($objectData): Audit {
		if (is_object($objectData)) {
			$this->objectData = json_encode($objectData->toArray());
		} else if(is_array($objectData)) {
			$this->objectData = json_encode($objectData);
		} else {
			$this->objectData = $objectData;
		}
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTable(): string {
		return $this->table;
	}

	/**
	 * @param string $table
	 * @return Audit
	 */
	public function setTable(string $table): Audit {
		$this->table = $table;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUser(): string {
		return $this->user;
	}

	/**
	 * @param string $user
	 * @return Audit
	 */
	public function setUser(string $user): Audit {
		$this->user = $user;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getVersion(): int {
		return $this->version;
	}

	/**
	 * @param int $version
	 * @return Audit
	 */
	public function setVersion(int $version): Audit {
		$this->version = $version;
		return $this;
	}

}