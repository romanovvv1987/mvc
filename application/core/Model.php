<?php
	namespace Core;
	use PDO;

	/**
	 * Class Model
	 * @package Core
	 */
	abstract class Model
	{
		protected $db;
		protected $table;
		private $dataResult;
		private $config = './application/config/db.php';

		public function __construct($select = false) {

			$config = require($this->config);
			$this->configure($config);

			$this->db = Db::getInstance()->connect($this);

			$modelName   = get_class($this);
			$arrExp      = explode('\\', $modelName);
			$tableName   = strtolower($arrExp[1]);
			$this->table = $tableName;

			$sql = $this->_getSelect($select);
			if ($sql)
				$this->_getResult("SELECT * FROM $this->table" . $sql);
		}


		/**
		 * Config
		 *
		 * @param $config
		 */
		public function configure($config) {
			if (is_array($config)) {
				foreach ($config as $key => $value)
					$this->$key = $value;
			}
		}

		/**
		 * Get table name
		 * @return string
		 */
		public function getTableName() {
			return $this->table;
		}

		/**
		 * Get all rows
		 * @return bool
		 */
		function getAllRows() {
			if (!isset($this->dataResult) OR empty($this->dataResult))
				return false;

			return $this->dataResult;
		}


		/**
		 * Query
		 *
		 * @param $select
		 *
		 * @return bool|string
		 */
		private function _getSelect($select) {
			if (is_array($select)) {
				$allQuery = array_keys($select);
				array_walk($allQuery, function (&$val) {
					$val = strtoupper($val);
				});

				$querySql = "";
				if (in_array("WHERE", $allQuery)) {
					foreach ($select as $key => $val) {
						if (strtoupper($key) == "WHERE") {
							$querySql .= " WHERE " . $val;
						}
					}
				}

				if (in_array("GROUP", $allQuery)) {
					foreach ($select as $key => $val) {
						if (strtoupper($key) == "GROUP") {
							$querySql .= " GROUP BY " . $val;
						}
					}
				}

				if (in_array("ORDER", $allQuery)) {
					foreach ($select as $key => $val) {
						if (strtoupper($key) == "ORDER") {
							$querySql .= " ORDER BY " . $val;
						}
					}
				}

				if (in_array("LIMIT", $allQuery)) {
					foreach ($select as $key => $val) {
						if (strtoupper($key) == "LIMIT") {
							$querySql .= " LIMIT " . $val;
						}
					}
				}

				return $querySql;
			}

			return false;
		}


		/**
		 * @param $sql
		 *
		 * @return array
		 */
		private function _getResult($sql) {
			try {

				$db               = $this->db;
				$stmt             = $db->query($sql);
				$rows             = $stmt->fetchAll();
				$this->dataResult = $rows;
			} catch (\PDOException $e) {
				echo $e->getMessage();
				exit;
			}

			return $rows;
		}


	}