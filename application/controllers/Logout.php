<?php
class LogoutController extends Yaf_Controller_Abstract {
	public function showAction()
	{
		setcookie('user' ,$result->UserId, time() - 3600);
		Yaf_Session::getInstance()->del('user');
		$this->getResponse()->setRedirect("/");
	}

}