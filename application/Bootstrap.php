<?php 
class Bootstrap extends Yaf_Bootstrap_Abstract{

        public function _initConfig() {
                $config = Yaf_Application::app()->getConfig();
                Yaf_Registry::set("config", $config);
        }

        public function _initDefaultName(Yaf_Dispatcher $dispatcher) {
                $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
        }

        public function _initView(Yaf_Dispatcher $dispatcher) {
        	$view= new Templar_Adapter(null);
            //$view->loadDefaultVars();
			Yaf_Dispatcher::getInstance()->setView($view);
    	}
}