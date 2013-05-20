<?php
	/**
	 * 整体的配置文件
	 *
	 *  Copyright(c) 2011-2012 by surgesoft. All rights reserved
	 *
	 * To contact the author write to {@link mailto:surgesoft@gmail.com}
	 *
	 * @author surgesoft
	 * @version $Id: config.ini.php 2012-01-15 15:23
	 */
	 //数据库配置：
	 //主机名
	 defined('DB_HOST')  || define('DB_HOST', "localhost");  
	//数据库用户名
	defined('DB_USER_NAME')  || define('DB_USER_NAME', "crowd");
	//数据库密码
	defined('DB_USER_PASSWORD')  	|| define('DB_USER_PASSWORD', "crowd");
	//数据库名
	defined('DB_NAME')  || define('DB_NAME', "crowdwriting");
	//定义是否使用短URL...
	//短url： http://www.yourwebsite.com/say/hello
	//长url:  http://www.yourwebsite.com/?m=say&a=hello
	defined('SHORT_URI') || define('SHORT_URI',true);

	//定义app名称
    static $website_info = 
    array(
    		"domain"=>"your website title"
    	); 
    //定义数据库结构映射
	static $_Struct=
	array(
		"article"=>array("ArticleTitle","ArticleAuthor","CreateTime","EditTime"),
	);

	 
?>
