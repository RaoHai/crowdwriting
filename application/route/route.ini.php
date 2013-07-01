<?php
//固定形式路由配置
$routeArr = array(
	'/^\/?(session)(\/)?$/' => "index/session",
	'/^\/*(\w+)\/(\d+\/?)$/'=>'$1/index/$2',
 );
			
			
 $Permissions = array(
	"admin"=>"admin");
?>