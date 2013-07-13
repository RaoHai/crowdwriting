<?php
	class Resty_Route implements Yaf_Route_Interface
	{
		public function route($request)
		{
			$config = Yaf_Registry::get('config');
			$reg = $config->get('route')->get('regex');
			$level0 = $reg->get('level0');
			$level1 = $reg->get('level1');
			$level2 = $reg->get('level2');
			$uri = $request->getRequestUri();
			$action = $this->getActionFromMethod($request);
			if ($action == 'Update') {//put
				parse_str(file_get_contents("php://input"),$post_vars);
				$request->_PUT = $post_vars;
			}
			if (preg_match($level0, $uri, $matchs)) {
				$request->controller = $matchs[1];
				$request->action = $action;
				return true;
			}
			if (preg_match($level1, $uri, $matchs)) {
				$request->controller = $matchs[1];
				$request->action = $action;
				$request->setParam('Id',$matchs[2]);
				return true;
			}
			if (preg_match($level2, $uri, $matchs)) {
				$request->controller = $matchs[1];
				$level1Obj = new stdClass();
				$level1Obj->Id = $matchs[2];
				$request->setParam($matchs[1],$level1Obj);
				$request->action = $matchs[3];
				$request->setParam('Id', $matchs[4]);
				return true;
			}

		}
		private function getActionFromMethod($request)
		{
			$query = $request->getQuery();
			if ($request->isGet()) {
				return 'Show';
			}
			if ($request->isPost()) {
				if ($query['_method'] == 'DELETE') {
					return 'Delete';
				}
				if ($query['_method'] == 'PUT') {
					return 'Update';
				}
				return 'Create';
			}
			if ($request->isPut()) {
				return 'Update';
			}
			if ($request->isDelete()) {
				return 'Delete';
			}

		}
	}