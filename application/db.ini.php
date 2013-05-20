<?php
	/*
	*	2012-01-28
	*		数据库类静态化
	*	
	*/
	class database
	{
		static protected $db;
		static protected $query;
		static private $_instance = NULL;
		 private function  __construct()
		{
                  	self::$db=mysql_connect(SAE_MYSQL_HOST_M.":".SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
			mysql_select_db(SAE_MYSQL_DB, self::$db);
			mysql_query("SET NAMES 'UTF8'"); 
			//echo "db_connected";
		}
        static public function getinsertid()
        {
            return mysql_insert_id(self::$db);
        }
        
		static public function fetch($sql)
		{
			
			$fp=fopen("log.txt","a");
			fwrite($fp,"SQL:". $sql."\r\n"); 
			fclose($fp);
			self::$query=mysql_unbuffered_query($sql,self::$db);
		}
		static public function fetch2($sql)
		{
			self::$query=mysql_query($sql,self::$db);
		}
		static public function getRow () 
		 {
			if ( $row=mysql_fetch_array(self::$query,MYSQL_ASSOC) )
			{	
				return $row;
			}
			else
			{
				return false;
			}
		}
			static public function getInstance() 
			{
				if (is_null(self::$_instance) || !isset(self::$_instance)) {
					self::$_instance = new self();
				}
				return self::$_instance;
			}	 
}
?>
