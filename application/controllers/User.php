<?php
class UserController extends Yaf_Controller_Abstract {
	public function showAction()
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
	public function newAction($value='')
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
}