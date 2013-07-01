<?php

	require_once("controller.base.class.php");
	class index extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		public function _index()
		{
			$this->RenderTemplate("index");
		}
		public function _session()
		{
			if (empty($_SESSION['USER'])) {
				$user = new stdClass();
				$user->UserId = 0;
				$user->UserName = 'Guest';
				$user->Permission = 'guest';
				$_SESSION['USER'] = $user;
			}
			return json($_SESSION['USER']);
		}
		
		
	}
?>
