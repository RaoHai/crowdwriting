<?php
class SessionController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		echo json_encode(0);
	}

	public function showAction()
	{
		$user = Yaf_Session::getInstance()->get('user');
		if (isset($user)) {
			$this->getResponse()->setBody(json_encode($user));
		}else{
			$this->getResponse()->setBody(json_encode(0));
		}
		
	}
}
?>