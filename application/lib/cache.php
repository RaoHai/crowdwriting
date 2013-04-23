<?php
/* 缓存类
* 缓存前端：输出缓存、数据库抽象化缓存、文件缓存
* 缓存后端：memcache、数据库、文件
* 同样作为一个静态对象
*/
class Cache
{
	static protected $ob; 
	static private $_instance = NULL;
	private function __construct()
	{
	
	}
	static public function op_cache_start($Identy)//标识符包含了该缓存的所有上下文标识
	{
		$idstr=implode("_",$Identy);
		ob_start(); 
		
	}
	static public function op_cache_stop()
	{
		$out = ob_get_contents(); 
		ob_end_clean(); 
		echo $out ;
	}
	static public function getInstance() 
	{
		if (is_null(self::$_instance) || !isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}	
	static public function sql_cache()
	{
		
	}
	
}

?>