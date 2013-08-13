<?php
class SessionController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		echo json_encode(0);
	}

	public function showAction()
	{
		echo isset($_SESSION['USER']) ? json_encode($_SESSION['USER']) : json_encode(0);
	}
}
?>