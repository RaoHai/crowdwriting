<?php
class BrowseController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		$this->getResponse()->setBody("Hello World");	
		echo $this->getRequest()->getParam("Id");
	}

	public function showAction()
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
}
?>