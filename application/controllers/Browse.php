<?php
class BrowseController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		$this->getResponse()->setBody("Hello World");	
		echo $this->getRequest()->getParam("Id");
	}

	public function showAction()
	{
		$User = Active_Record::getObject("User");
		$hotUsers = $User->find('all','1',"0,30","Temperature");

		$this->getView()->assign("hostUsers",$hotUsers);
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
}
?>