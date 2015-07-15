<?php
	namespace Core;

	/**
	 * Class Route
	 * @package Core
	 */

	class Route
	{

		/**
		 * Routing
		 * @throws MyException
		 */
		public static function init() {

			$request = $_SERVER['REQUEST_URI'];
			$routes  = explode('/', trim($request, '/'));

			$controller_name = ($controller = array_shift($routes)) ? $controller : 'index';
			$action_name     = ($action = array_shift($routes)) ? $action : 'index';


			$controller_name = ucfirst($controller_name) . '_Controller';
			$action_name     = 'action_' . $action_name;

			$controller_file = $controller_name . '.php';
			$controller_path = "./application/controllers/" . $controller_file;

			if (!file_exists($controller_path))
				throw new MyException('404 Not Found Controller');

			require "./application/controllers/" . $controller_file;


			$controller = new $controller_name();
			$action     = $action_name;

			if (is_callable(array($controller_name, $action)) == false) {
				throw new MyException('404 Not Found action');
			}

			$controller->$action();

		}


	}
