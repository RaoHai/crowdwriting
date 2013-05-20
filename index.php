<?php
/*=============================================================================
#     FileName: index.php
#         Desc:  
#       Author: surgesoft
#        Email: surgesoft@gmail.com
#     HomePage: surgesoft.github.com
#      Version: 0.0.1
#   LastChange: 2012-08-09 11:23:15
#      History:
=============================================================================*/
//header("content-Type: text/html; charset=utf-8");
error_reporting(E_ALL);
if(empty($_REQUEST['debug'])){
 ini_set( 'display_errors', 'Off' );
}
defined('BASE_PATH')  
|| define('BASE_PATH', realpath(dirname(__FILE__)).'/');    
defined('INDEX_PATH')  
|| define('INDEX_PATH', realpath(dirname(__FILE__)));
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', BASE_PATH . '/application');
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
defined('WEB_ROOT')
|| define('WEB_ROOT', BASE_PATH . 'www');





session_start();
if(empty($_SESSION["PERMISSION"])) $_SESSION["PERMISSION"]="guest";
if(empty($_SESSION["USERID"])) $_SESSION["USERID"]=0;

define("WEB_AUTH",TRUE);

include_once APPLICATION_PATH.'/route.php';

?>
