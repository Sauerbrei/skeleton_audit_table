<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 06.05.2017
 * Time: 14:19
 */

namespace Controller;


class Router {
	/**
	 * Router constructor.
	 * @param $controller
	 * @param $action
	 * @param $base_dir
	 * @param $em
	 * @return ABaseController
	 */
	public function __construct($controller, $action, $base_dir, $em) {
		$controllerNamespace = 'Controller\\';
		$controllerFound = false;

		$doController = $controllerNamespace . 'NotFoundController';
		$doAction = 'index';

		$controllerName = $controllerNamespace . ucfirst($controller) . 'Controller';
		$actionName = ucfirst($action) . 'Action';

		if (class_exists($controllerName)) {
			/** @var $requestController ABaseController */
			$doController = $controllerName;
			$controllerFound = true;
		}
		$myController = new $doController($base_dir, $em);

		if ($controllerFound && method_exists($myController, $actionName)) {
			$doAction = $action;
		} elseif ($controllerFound) {
			$doController = $controllerNamespace . 'NotFoundController';
			$myController = new $doController();
			$doAction = 'actionNotFound';
		}
		$myController->run($doAction);
	}
}