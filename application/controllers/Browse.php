<?php
class BrowseController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		$this->getResponse()->setBody("Hello World");	
		echo $this->getRequest()->getParam("Id");
	}

	public function showAction()
	{
		$relations = ['friend','stranger'];
		$u = new UserController();
		$c = new ChapterController();

		$hotUsers = $u->list_hot();
		foreach ($hotUsers as $user) {
			$user->relation = $relations[mt_rand(0,1)];
			$user->avatar = App_Helper::getInstance()->get_gravatar($user->Email, 40);
		}

		$hotChapter = $c->list_hot();

		$this->getView()->assign("hotChapter",$hotChapter);

		$this->getView()->assign("hotUsers",$hotUsers);
		$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
	}
}
?>