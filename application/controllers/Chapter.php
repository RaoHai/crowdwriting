<?php
class ChapterController extends Yaf_Controller_Abstract {
	public function indexAction() 
	{
		$this->getResponse()->setBody("Hello World");	
		echo $this->getRequest()->getParam("Id");
	}
	public function showAction()
	{
		$Chapter = Active_Record::getObject("Chapter");
		$User = Active_Record::getObject("User");
		$Comment = Active_Record::getObject("Comment");

		$Chapter->left_join("UserId",$User,"UserId");
		$Comment->left_join("UserId",$User,"UserId");

		$id = $this->getRequest()->getParam("Id"); 
		$table = $Chapter->uncached_find($id);

		$comments = $Comment->find("all","ChapterId = $id");
		foreach ($table as $item) {
			$item->ChapterContent = rawurldecode($item->ChapterContent);
			$item->avatar = App_Helper::getInstance()->get_gravatar($item->Email, 70);
			$item->CreateTime = App_Helper::getInstance()->get_chinese_time($item->CreateTime);
			$item->UpdateTime = App_Helper::getInstance()->get_chinese_time($item->UpdateTime);
		}
		foreach ($comments as $comment) {
			$comment->avatar =  App_Helper::getInstance()->get_gravatar($comment->Email, 40);
		}
		if ($this->getRequest()->isXmlHttpRequest()) {
			$this->getResponse()->setBody(json_encode($table));
		} else {
			$this->getView()->assign("domain", $_SERVER['SERVER_NAME']);
			$this->getView()->assign("Chapter", $table);
			$this->getView()->assign("Comments",$comments);
		}
		
	}
	public function createAction()
	{
		$Chapter = Active_Record::getObject("Chapter");
		$Chapter->getFromRequest($_POST);
		$Chapter->UserId = Yaf_Session::getInstance()->get('user');
		$Chapter->save();
		$this->getResponse()->setBody(json_encode($Chapter));
	}
	public function updateAction()
	{
		$Chapter = Active_Record::getObject("Chapter");
		$Chapter->getFromRequest($this->getRequest()->_PUT);
		//$Chapter->update();
		$this->getResponse()->setBody(json_encode($Chapter->update()));
		//$this->getResponse()->setBody(json_encode($Chapter));
		/*$R  = $this->getRequest();
		$db = ezSQL_DB::getInstance();
		$Chapter = new stdClass();
		$Chapter->ChapterId = $R->getParam('id');
		$Chapter->ChapterTitle = $R->getParam('ChapterTitle');
		$Chapter->ChapterContent = $R->getParam('ChapterContent');
		$Chapter->UpdateTime = date('Y-m-d H:i:s');
		$db->
		# code...*/
	}

	public function list_hot()
	{
		$Chapter = Active_Record::getObject("Chapter");
		$User = Active_Record::getObject("User");
		$Chapter->left_join("UserId",$User,"UserId");

		$arr =  $Chapter->uncached_find('all');
		foreach ($arr as $c) {
			$c->Summary = App_Helper::getInstance()->get_lines(rawurldecode($c->ChapterContent), 10);
		}
		return $arr;
	}
}
?>