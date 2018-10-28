<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 10.06.2017
 * Time: 12:17
 */

namespace Configuration;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Configuration;
use Doctrine\Common\EventManager;

class DoctrineDatabase  extends Database {

	/**
	 * @var ArrayCache
	 */
	protected $arrayCache;
	/**
	 * @var AnnotationReader
	 */
	protected $annotationReader;
	/**
	 * @var CachedReader
	 */
	protected $cachedReader;
	/**
	 * @var MappingDriverChain
	 */
	protected $driverChain;
	/**
	 * @var AnnotationDriver
	 */
	protected $annotationDriver;
	/**
	 * @var Configuration
	 */
	protected $doctrineConfig;
	/**
	 * @var EventManager
	 */
	protected $eventManager;
	/**
	 * @var string
	 */
	var $entityDir = '';

	/**
	 * DoctrineDatabase constructor.
	 * @param array $array
	 * @param $loader
	 * @throws \Exception
	 */
	public function __construct(array $array = [], $loader , $entityDir = __DIR__ . '/../src/Entities') {
		parent::__construct($array);
		$this->setEntityDir($entityDir);
		if ($loader) {
			$loader->add('Entities', $this->getEntityDir());
			\Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
				__DIR__.'/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
			);
			$this->getDriverChain()->addDriver(
				$this->getAnnotationDriver(),
				basename($this->getEntityDir())
			);
		} else {
			throw new \Exception("The autoloader is necessary to use the Database-Class.");
		}
	}

	/**
	 * @return ArrayCache
	 */
	public function getArrayCache(): ArrayCache {
		if (!$this->arrayCache) {
			$this->arrayCache = new ArrayCache();
		}
		return $this->arrayCache;
	}

	/**
	 * @return AnnotationReader
	 */
	public function getAnnotationReader(): AnnotationReader {
		if (!$this->annotationReader) {
			$this->annotationReader = new AnnotationReader();
		}
		return $this->annotationReader;
	}

	/**
	 * @return CachedReader
	 */
	public function getCachedReader(): CachedReader {
		if (!$this->cachedReader) {
			$this->cachedReader = new CachedReader(
				$this->getAnnotationReader(),
				$this->getArrayCache()
			);
		}
		return $this->cachedReader;
	}

	/**
	 * @return MappingDriverChain
	 */
	public function getDriverChain(): MappingDriverChain {
		if (!$this->driverChain) {
			$this->driverChain = new MappingDriverChain();
		}
		return $this->driverChain;
	}

	/**
	 * @return AnnotationDriver
	 */
	public function getAnnotationDriver(): AnnotationDriver {
		if (!$this->annotationDriver) {
			$this->annotationDriver = new AnnotationDriver(
				$this->getCachedReader(),
				$this->getEntityDir()
			);
		}
		return $this->annotationDriver;
	}

	/**
	 * @return Configuration
	 */
	public function getDoctrineConfig(): Configuration {
		if (!$this->doctrineConfig) {
			$configDoctrine = new Configuration();
			$configDoctrine->setProxyDir(sys_get_temp_dir() . '/doctrine');
			$configDoctrine->setProxyNamespace('Proxy');
			$configDoctrine->setAutoGenerateProxyClasses(false);
			$configDoctrine->setMetadataDriverImpl($this->getDriverChain());
			$configDoctrine->setMetadataCacheImpl($this->getArrayCache());
			$configDoctrine->setQueryCacheImpl($this->getArrayCache());
			$this->doctrineConfig = $configDoctrine;
		}
		return $this->doctrineConfig;
	}

	/**
	 * @return EventManager
	 */
	public function getEventManager(): EventManager {
		if (!$this->eventManager) {
			$this->eventManager = new EventManager();
		}
		return $this->eventManager;
	}

	/**
	 * @return EntityManager
	 */
	public function getEntityManager(): EntityManager {
		return EntityManager::create(
			$this->getCredentials(),
			$this->getDoctrineConfig()
		);
	}

	/**
	 * @return string
	 */
	public function getEntityDir(): string {
		return $this->entityDir;
	}

	/**
	 * @param string $entityDir
	 * @return Database
	 */
	public function setEntityDir(string $entityDir): Database {
		$this->entityDir = realpath($entityDir);
		return $this;
	}
}