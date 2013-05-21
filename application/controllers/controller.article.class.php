<?php

	require_once("controller.base.class.php");
	class article extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
		
			echo "hello";
		}
		public function _world($p)
		{
			echo "hello world".$p;
		}
	}
?>