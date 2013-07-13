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
		$id = $this->getRequest()->getParam("Id"); 

		$table = $Chapter->find($id);
		//$Chapter->getFromRequest($this->getRequest());
		/*$Chapter->ChapterTitle = 'hello';
		$Chapter->ChapterContent = 'world';
		$Chapter->UpdateTime = date('Y-m-d H:i:s');
		$Chapter->Uuid = 123456;
		$Chapter->UserId = 1;
		$Chapter->save();*/
		//$table = $Chapter->find('ChapterTitle',"ChapterId = $id");
		//$db = ezSQL_DB::getInstance();
		//$table = $db->query("SELECT * from Chapter where ChapterId = $id");
		$this->getResponse()->setBody(json_encode($table));
	}
	public function createAction()
	{
		
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
}
?>