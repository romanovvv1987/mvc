<?php
	namespace Core;
	use PDO;

	/**
	 * Class DB
	 * @package Core
	 */
	class DB
	{
		protected  static $instance;

		private function __construct() {
		}

		private function __clone() {
		}

		private function __wakeup() {

		}

		/**
		 * @return DB
		 */
		public static function getInstance() {
			if (self::$instance === null) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		final public function __destruct() {
			self::$instance = null;
		}

		/**
		 * Connect db
		 * @param $data
		 *
		 * @return mixed
		 * @throws \PDOException
		 */
		public function connect($data)
		{
				$db=new PDO($data->connectionString, $data->username, $data->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$data->charset));
				if (!$db){
					throw new \PDOException('Error connect DB.');
				}

			return $db;

		}


	}