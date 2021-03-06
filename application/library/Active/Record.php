<?php
	include_once APP_PATH.'/application/library/Active/Record.Abstract.php';

	class Active_Record {
		static protected $db;
		static protected $_instance = NULL;
		static protected $tableList = NULL;

		private function __construct()
		{
			/*
			select
			    concat(table_name, '.', column_name) as 'foreign key',  
			    concat(referenced_table_name, '.', referenced_column_name) as 'references'
			from
			    information_schema.key_column_usage
			where
			    referenced_table_name is not null;
			*/
			$db = ezSQL_DB::getInstance();
			$tableList = array();
			$redis = Redis_Cache::getInstance();
			/* Generater CRM Object */
			// $redis->del('_table_list');
			if (!$redis->get('_table_list')) {
				$tables = $db->query('SHOW TABLES');
				$dbName = $db->getDbName();
				$tables_in_db = "Tables_in_$dbName";
				//Tables_in_crowd
				foreach ($tables as $table => $name) {
					$tableName = $name->$tables_in_db;				
					$columns = $db->query("DESC $tableName");
					$tableList[$tableName] = $columns;
				}
				$redis->set('_table_list', serialize($tableList));
			} else {
				$tableList = unserialize($redis->get('_table_list'));
			}
			// var_dump($tableList);
			self::$tableList = $tableList;



		}
		static public function getObject($objectName) 
		{
			if (is_null(self::$_instance) || !isset(self::$_instance)) {
				self::$_instance = new self();
			}

			$objectPrototype = self::$tableList[$objectName];
			$object = new Active_Record_Abstract($objectName);
			foreach ($objectPrototype as $idx => $prototype) {
				$key = $prototype->Field;
				$type = $prototype->Type;
				$object->$key = "";
				$object->typeMap($key, $type);
			}
			return $object;
		}	
	}
