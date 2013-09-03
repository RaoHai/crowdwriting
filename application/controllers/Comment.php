<?php
	class CommentController extends Yaf_Controller_Abstract {
		public function createAction()
		{
			Yaf_Dispatcher::getInstance()->autoRender(FALSE);
			//assert token
			App_Helper::getInstance()->assert_token('comment',$_POST['token']);


			$comment = Active_Record::getObject("Comment");
			$comment->UserId = Yaf_Session::getInstance()->get('user');
			$comment->ChapterId = $_POST['ChapterId'];
			$comment->CreateTime = date('Y-m-d H:i:s');
			$comment->CommentText = $_POST['commentText'];
			$comment->save();
			// $this->getResponse()->setRedirect("/Chapter/".$_POST['ChapterId']);

		}
	}