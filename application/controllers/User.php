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

	private function list_host()
	{
		$User = Active_Record::getObject("User");
		return $User->find('all','1',"0,30","Temperature");
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

	public function hotAction()
	{
		$this->getResponse()->setBody(json_encode($this->list_host()));
	}

	// public function randomAction()
	// {
	// 	$User = Active_Record::getObject("User");
	// 	for ($i=0; $i < 10; $i++) { 
	// 		$postdata = array();
	// 		$postdata['UserName'] = $this->generate_salt();
	// 		$postdata['Email'] = $this->generate_salt().'@gmail.com';
	// 		$postdata['Salt'] = $this->generate_salt();
	// 		$postdata['Password'] = $this->generate_salt();
	// 		$postdata['Permission'] = 'user';
	// 		$User->getFromRequest($postdata);
	// 		$User->save();
	// 		# code...
	// 	}
	// 	return 'ok';
	// }
}