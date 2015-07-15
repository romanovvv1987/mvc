<?php
	namespace Core;
	class View
	{
		public $layouts;
		public $data;
		private $vars = array();
		private $controller;
		private $view;

		function __construct($layouts, $class) {
			$this->layouts    = $layouts;
			$arr              = explode('_', $class);
			$this->controller = strtolower($arr[0]);
		}

		/**
		 * Generate view
		 *
		 * @param $content_view
		 * @param null $data
		 */
		public function generate($content_view, $data = null) {

			if (is_array($data)) {
				foreach ($data as $key => $value) {
					$this->vars($key, $value);
				}
			}

			if ($content_view) {
				$this->view = $content_view;
			}

			if (!file_exists($url = $this->getPathLayout()))
				throw new MyException('404 Not Found layout');

			if (!file_exists($this->getPathAction()))
				throw new MyException('404 Not Found view');

			require $url;
		}


		/**
		 * Set vars
		 *
		 * @param $varname
		 * @param $value
		 *
		 * @return bool
		 */
		private function vars($varname, $value) {
			if (isset($this->$varname) == true) {
				return false;
			}
			$this->$varname = $value;

			return true;
		}

		/**
		 * Get Layout
		 * @return string
		 */
		protected function getPathLayout() {
			return './application/views/layout/' . $this->layouts;
		}


		/**
		 * Get view
		 * @return string
		 */
		protected function getPathAction() {
			return './application/views/' . $this->controller . '/' . $this->view . '.php';
		}
	}