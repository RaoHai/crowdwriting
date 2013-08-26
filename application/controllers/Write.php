<?php
class WriteController extends Yaf_Controller_Abstract {
	public function showAction() 
	{
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
}