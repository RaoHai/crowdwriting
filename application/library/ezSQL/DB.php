<?php
include_once APP_PATH.'/application/library/ezSQL/ez_sql_core.php';
include_once APP_PATH.'/application/library/ezSQL/ez_sql_mysql.php';

class ezSQL_DB {
	static protected $db;
	static protected $query;
	static private $_instance = NULL;

	static private $dbName;

	private function __construct()
	{
		$dbConfig = Yaf_Registry::get('config')->get('db');
		$username = $dbConfig->get('user');
		$password = $dbConfig->get('password');
		$dbName = $dbConfig->get('database');
		self::$dbName = $dbName;
		$host = $dbConfig->get('host');
		self::$db = new ezSQL_mysql($username, $password, $dbName, $host);
	}
	static public function getInstance() 
	{
		if (is_null(self::$_instance) || !isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}	 
	static public function cachedQuery($command, $table, $id, $sql) {
		$key = $table.$id;
		$redis = Redis_Cache::getInstance();
		if ($command == 'select') {
			if ($result = Redis_Cache::queryFromCache($key, $sql)) {
				return $result;
			}
			$result = self::query($sql);
			Redis_Cache::cacheQuery($key, $sql, $result);
			return $result;
		}
	}
	static public function query($sql)
	{
		$file = fopen("sql.log","a");
		fwrite($file,$sql);
		fclose($file);

		$tables = self::$db->get_results($sql);
		return $tables;
	}
	static public function debug()
	{
		self::$db->debug();
	}
	static public function getDbName()
	{
		return self::$dbName;
	}


}