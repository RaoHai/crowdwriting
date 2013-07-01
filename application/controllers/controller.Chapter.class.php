<?php

	require_once("controller.base.class.php");
	class Chapter extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		public function _index($Id)//自定义你的action方法
		{
			$this->Get_By_ChapterId($Id);
			echo $this->getJson();
		}
		public function _save()
		{

		}
		public function _post()
		{
			parent::_post();
			if ($_SESSION['USERID'] > 0) {
                $this->UserId = $_SESSION['USERID'];
			} else {
                $this->Uuid = gen_uuid();
            }
            $this->CreateTime = date('Y-m-d h:i:s');
            $this->save();
            $result = new stdClass();
            $result->Id = empty($_REQUEST['id']) ? mysql_insert_id() : $_REQUEST['id'];
            $result->Status = 'OK';
            json($result);

		}
		
	}
?>