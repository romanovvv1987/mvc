<?php
	namespace Core;
	use Exception;

	/**
	 * Class MyException
	 * @package Core
	 */
	class MyException extends Exception
	{

		public function __construct($message, $code = 0, Exception $previous = null) {

			parent::__construct($message, $code, $previous);
		}

		/**
		 * @return string
		 */
		public function __toString() {
			return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
		}


	}