<?php
	class Redis_Cache {
		static protected $_redis;
		static protected $_instance = NULL;

		private function __construct()
		{
			self::$_redis = new redis();
			try{
				self::$_redis->connect('127.0.0.1',6379);	
			} catch (Exception $e) {
				echo $e;
			}
		}

		static public function getInstance()
		{
			if (is_null(self::$_instance) || !isset(self::$_instance)) {
				self::$_instance = new self();
			}
			return self::$_redis;
		}
		static public function cacheQuery($key, $sql, $result)
		{
			self::$_redis->set("$key_$sql", serialize($result));
		}
		static public function queryFromCache($key, $sql)
		{
			return  unserialize(self::$_redis->get("$key_$sql"));
		}
		static public function unsetQuery($key, $sql)
		{
			self::$_redis->del("$key_$sql");
		}
	}
