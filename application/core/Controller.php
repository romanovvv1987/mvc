<?php
	namespace Core;
	/**
	 * Class Controller
	 * @package Core
	 */
	abstract class Controller
	{

		protected $layouts = 'main.php';

		/**
		 * @var View
		 */
		public $view;

		function __construct() {
			$this->view     = new View($this->layouts, get_class($this));

		}

		/**
		 * @return mixed
		 */
		abstract function action_index();
	}