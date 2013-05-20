<?php
//固定形式路由配置
$routeArr = array(
'/^\/?(imagegroup)(\/?\d*\/?)?$/' => "/imagegroup/view$2",
'/^\/*(\w+)\/(\d+)$/'=>'/$1/index/$2',
'/^\/?(home)(\/?\d*\/?)?$/' => "/user/index$2",
'/^\/?(home)(\/\w+)(\/?\d*\/?)?$/' => "/user$2$3",
 );
			
			
 $Permissions = array(
	"admin"=>"admin");
?>