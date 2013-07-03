<?php
	class Resty_Route implements Yaf_Route_Interface
	{
		public function route($request)
		{
			$config = Yaf_Registry::get('config');
			$reg = $config->get('route')->get('regex');
			$uri = $request->getRequestUri();
			$action = $this->getActionFromMethod($request);
			if (preg_match($reg, $uri, $matchs)) {
				$request->controller = $matchs[1];
				$request->action = $action;
				$request->setParam('Id',$matchs[2]);
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