<?php
class UserController extends Yaf_Controller_Abstract {
	private function generate_salt()
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';  
		$salt = '';
		for ($i=0; $i < 5; $i++) { 
			$salt .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $salt;
	}
	public function showAction()
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
	public function newAction()
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
	public function createAction()
	{
		$User = Active_Record::getObject("User");
		$salt = $this->generate_salt();
		$postdata  = array();
		$postdata['UserName'] = $_POST['username'];
		$postdata['Email'] = $_POST['username'];
		$postdata['Salt'] = $salt;
		$postdata['Password'] = sha1($_POST['password'].$salt);
		$postdata['Permission'] = 'user';
		$User->getFromRequest($postdata);
		$User->save();
		Yaf_Session::getInstance()->set('error', 'Register Successed');
		$this->getResponse()->setRedirect("/login");
	}
}