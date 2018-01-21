<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 10.06.2017
 * Time: 12:03
 */

namespace Configuration;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Event\Listeners\MysqlSessionInit;

class GedmoDatabase extends DoctrineDatabase  {

	protected $gedmoDir = '';

	/**
	 * GedmoDatabase constructor.
	 * @param array $array
	 * @param $loader
	 * @param string $entityDir
	 * @param string $gedmoDir
	 */
	public function __construct(array $array = [], $loader , $entityDir = __DIR__.'/../src/Entities' , $gedmoDir = __DIR__
	.'/../lib') {
		parent::__construct($array, $loader, $entityDir);
		$this->setGedmoDir($gedmoDir);
		$loader->add('Gedmo', $this->getGedmoDir());
		\Gedmo\DoctrineExtensions::registerMappingIntoDriverChainORM(
			$this->getDriverChain(),
			$this->getCachedReader()
		);
	}

	public function addLoggable($user): Database {
		$listener = new \Gedmo\Loggable\LoggableListener;
		$listener->setAnnotationReader($this->getCachedReader());
		$listener->setUsername(($user ?? 'stranger'));
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}
	public function addSluggable(): Database {
		$listener = new \Gedmo\Sluggable\SluggableListener;
		$listener->setAnnotationReader($this->getCachedReader());
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}
	public function addTreelistener(): Database {
		$listener = new \Gedmo\Tree\TreeListener;
		$listener->setAnnotationReader($this->getCachedReader());
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}
	public function addTimestampable(): Database {
		$listener = new \Gedmo\Timestampable\TimestampableListener;
		$listener->setAnnotationReader($this->getCachedReader());
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}
	public function addBlameable($user): Database {
		$listener = new \Gedmo\Blameable\BlameableListener;
		$listener->setAnnotationReader($this->getCachedReader());
		$listener->setUserValue(($user ?? 'stranger'));
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}
	public function addTranslateable($default = 'de' , $locale = 'de'): Database {
		$listener = new \Gedmo\Translatable\TranslatableListener();
		$listener->setAnnotationReader($this->getCachedReader());
		$listener->setTranslatableLocale($locale);
		$listener->setDefaultLocale($default);
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}
	public function addSortablle(): Database {
		$listener = new \Gedmo\Sortable\SortableListener();
		$listener->setAnnotationReader($this->getCachedReader());
		$this->getEventManager()->addEventSubscriber($listener);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGedmoDir(): string {
		return $this->gedmoDir;
	}
	/**
	 * @param string $gedmoDir
	 * @return GedmoDatabase
	 */
	public function setGedmoDir(string $gedmoDir): GedmoDatabase {
		$this->gedmoDir = $gedmoDir;
		return $this;
	}

	/**
	 * @return EntityManager
	 */
	public function getEntityManager(): EntityManager {
		$this->getEventManager()->addEventSubscriber(new MysqlSessionInit());
		return EntityManager::create(
			$this->getCredentials(),
			$this->getDoctrineConfig(),
			$this->getEventManager()
		);
	}
}