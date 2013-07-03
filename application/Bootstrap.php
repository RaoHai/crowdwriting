<?php 
//include_once APP_PATH.'/application/library/ezSQL/ez_sql_core.php';
//include_once APP_PATH.'/application/library/ezSQL/ez_sql_mysql.php';
class Bootstrap extends Yaf_Bootstrap_Abstract{

    public function _initConfig() {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $config);
        $options = array(
          'snippet_num_lines' => 10,
          'background_text'  => 'Error!',
          'error_reporting_off' => E_WARNING | E_PARSE,
          'error_reporting_on' => 0
          );

        require( APP_PATH.'/application/library/PhpError/php_error.php' );
        \php_error\reportErrors($options);

    }

    public function _initRoute(Yaf_Dispatcher $dispatcher) {
            // $router = new Yaf_Route_Regex(
            //     '/^\/*(\w+)\/(\d+\/?)$/'
            // }
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        $route1 = new Resty_Route();
        $router->addRoute('product', $route1);

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