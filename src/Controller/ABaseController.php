<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 20.04.2017
 * Time: 15:26
 */

namespace Controller;

use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class ABaseController {
	/**
	 * @var string
	 */
	protected $basepath = '';
	/**
	 * @var array
	 */
	protected $context = [];
	/**
	 * @var EntityManager
	 */
	protected $em;
	/**
	 * @var string
	 */
	protected $template = '';

	/**
	 * ABaseController constructor.
	 * @param $basepath
	 * @param $em
	 */
	public function __construct($basepath, $em) {
		$this->basepath = $basepath;
		$this->em = $em;
	}

	/**
	 * Adds a variable to the Model
	 * @param $key
	 * @param $val
	 * @return ABaseController
	 */
	protected function addContext($key, $val): ABaseController {
		$this->context[$key] = $val;
		return $this;
	}

	/**
	 * @param $action
	 */
	public function run($action) {
		$this->addContext('action', $action);
		$method = $action . 'Action';
		$this->setTemplate($action);
		if (method_exists($this, $method)) {
			$this->$method();
		}
		$this->render();
	}

	/**
	 * Renders the HTML Page with Header
	 */
	protected function render() {
		extract($this->context);
		$template = $this->getTemplate();
		require_once realpath('templates/header.tpl.php');
	}

	/**
	 * @return EntityManager
	 */
	protected function getEntityManager(): EntityManager {
		return $this->em;
	}

	/**
	 * @param EntityManager $em
	 */
	protected function setEntityManager(EntityManager $em) {
		$this->em = $em;
	}

	/**
	 * @param $template
	 * @return string
	 */
	protected function setTemplate($template , $controller = null) {
		$reflection = new \ReflectionClass(get_class($this));
		$controller = $controller ?? $reflection->getShortName();
		$controllerFile = $controller . DIRECTORY_SEPARATOR . $template . '.tpl.php';
		$this->template = $controllerFile;
	}

	/**
	 * @return string
	 */
	protected function getTemplate(): string {
		return $this->template;
	}

	/**
	 * @return string
	 */
	protected function getNameSpace(): string {
		$reflection = new \ReflectionClass($this);
		return $reflection->getNamespaceName();
	}

	/**
	 * @return string
	 */
	protected function getShortName(): string {
		$reflection = new \ReflectionClass($this);
		return $reflection->getShortName();
	}
}
