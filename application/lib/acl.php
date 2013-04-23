<?php
		/*访问控制列表 (ACL,access control list)类
		*2012-01-12，ACL类应该是一个单例模式
		*
		*
		*/
		class Acl
		{
			static protected $Rolelist = array();
			static protected $parents = array();
			static protected $allow = array();
			static protected $serializeFile;
			static private $_instance = NULL;
			private function __construct()
			{
				self::$serializeFile =  APPLICATION_PATH."/lib/aclserialize.ser";
			}
			private function __clone()
			{
			}
			
			static public function getInstance() 
			{
				if (is_null(self::$_instance) || !isset(self::$_instance)) {
					self::$_instance = new self();
				}
				return self::$_instance;
			}	 
			static public function serializeit()
			{
				
				$s= serialize($this);
				$f = fopen(serializeFile, 'w');
				fwrite($f,$s);
				fclose($f);
			}
			static public function addRole($rolename,$parent)
			{
				self::$Rolelist[$rolename] = 1;
				self::$parents[$rolename] =array();
				if(isset($parent))
				{
				if(is_array($parent))
				{
					foreach($parent as $pa)
						self::$parents[$rolename][]=$pa;
				}
				else self::$parents[$rolename][]=$parent;
				}
				//var_dump(self::$parents[$rolename]);
			}
			static public function allow($rolename,$controller,$action=0)
			{
				
				if(!isset(self::$allow[$rolename])) self::$allow[$rolename]=array();
				if(is_array($controller))
				{
					foreach($controller as $ctrl)
					{
						if(empty($action))
						{
							self::$allow[$rolename][$ctrl]=1;
						}
						else
						{
							if(is_array($action))
							{
								foreach($action as $a)
								{	
									self::$allow[$rolename][$ctrl][$a]=1;
								}
							}
							else
							{
								self::$allow[$rolename][$ctrl][$action]=1;
							}
						}
					}
				}
				else
				{
					if(empty($action))
					{
						self::$allow[$rolename][$controller]=1;
						//echo "设置：".$rolename.">>".$controller;
					}
					else
					{
						if(is_array($action))
						{
							foreach($action as $a)
							{	
								self::$allow[$rolename][$controller][$a]=1;
							}
						}
						else
						{
							self::$allow[$rolename][$controller][$action]=1;
						}
					}
				}
			}
			static public function isallowed($rolename,$controller,$action=0)
			{
				if(empty($rolename)) return false;
				//echo "校验：".$rolename.">>".$controller;
				if(isset(self::$allow[$rolename][$controller]))
				{
					//echo "校验：".$rolename.">>".$controller;
					if(self::$allow[$rolename][$controller]==1) return true;
					if(isset(self::$allow[$rolename][$controller][$action])) return true;
				}
				else 
				{
					//var_dump(self::$parents[$rolename]);
					//$check=0;
					foreach(self::$parents[$rolename] as $parentrole)
					{
						if(self::isallowed($parentrole,$controller,$action))return true;
					}
					return false;
				}
				return false;
			}
			
		}
	

?>