<?php
class LoginController extends Yaf_Controller_Abstract {
	public function showAction()
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}

	public function createAction()
	{
		$User = Active_Record::getObject("User");
		$username = $_POST['username'];
		$result = $User->find("all","UserName = '$username'")[0];
		$salt = $result->Salt;
		$hashedpass = sha1($_POST['password'].$salt);
		if ($hashedpass == $result->Password) {
			Yaf_Session::getInstance()->set('error', '');
			Yaf_Session::getInstance()->set('user', $result->UserId);
			setcookie('user' ,$result->UserId, time() + 36002430);
			$this->getResponse()->setRedirect("/");
		} else {
			Yaf_Session::getInstance()->set('error', 'Login Failed');
			$this->getResponse()->setRedirect("/login");
		}

	}
}