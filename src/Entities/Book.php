<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 18.04.2017
 * Time: 12:39
 */

namespace Entities;

use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Traits\Database\Auditable;

/**
 * Class Book
 * @package Entities
 * @ORM\Entity
 * @ORM\Table(name="books")
 * @ORM\HasLifecycleCallbacks
 * @Gedmo\Loggable
 */
class Book extends ABaseEntity {

	use Auditable;

	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id = 0;
	/**
	 * @var string
	 * @ORM\Column(type="string", length=150)
	 * @Gedmo\Versioned
	 */
	protected $title = '';
	/**
	 * @var float
	 * @ORM\Column(type="decimal", precision=6, scale=2)
	 * @Gedmo\Versioned
	 */
	protected $price = 0.0;
	/**
	 * @var \DateTime
	 * @ORM\Column(name="created_at", type="datetime")
	 * @Gedmo\Timestampable(on="create")
	 */
	protected $createdAt;
	/**
	 * @var \DateTime
	 * @ORM\Column(name="updated_at", type="datetime", nullable=true)
	 * @Gedmo\Timestampable(on="update")
	 */
	protected $updatedAt;


	/**
	 * Book constructor.
	 * @param array $data
	 */
	public function __construct( array $data = [] ) {
		$this->setData($data);
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Book
	 */
	public function setId(int $id): Book {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return Book
	 */
	public function setTitle(string $title): Book {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getPrice(): float {
		return $this->price;
	}

	/**
	 * @param float $price
	 * @return Book
	 */
	public function setPrice(float $price): Book {
		$this->price = $price;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getGrossPrice(): float {
		return $this->getPrice() * 1.07;
	}

	/**
	 * @param float $price
	 * @return Book
	 */
	public function setGrossPrice( float $price ): Book {
		$this->setPrice($price / 1.07);
		return $this;
	}

	/**
	 * @return Book
	 * @ORM\PrePersist
	 */
	public function setCreatedAt(): Book {
		$this->createdAt = new \DateTime();
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): \DateTime {
		return $this->createdAt;
	}

	/**
	 * @return Book
	 * @ORM\PreUpdate
	 */
	public function setUpdatedAt(): Book {
		$this->updatedAt = new \DateTime();
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getUpdateAt(): \DateTime {
		return $this->updatedAt;
	}

	/**
	 * @ORM\PreRemove
	 */
	public function addToAuditBeforeRemove() {
		$this->RemoveService();
	}

}