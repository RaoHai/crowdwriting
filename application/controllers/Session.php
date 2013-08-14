<?php
class SessionController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		echo json_encode(0);
	}

	public function showAction()
	{
		$user = Yaf_Session::getInstance()->get('user');
		echo isset($user) ? json_encode($user) : json_encode(0);
	}
}
?>