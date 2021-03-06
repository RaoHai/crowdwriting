<?php 

class Bootstrap extends Yaf_Bootstrap_Abstract{

    public function _initConfig() {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $config); 

        // ini_set('display_errors', 'On');
        Yaf_Session::getInstance()->start();
        $request = Yaf_Dispatcher::getInstance()->getRequest();
        if (!$request->isXmlHttpRequest()) {
          $options = array(
          'snippet_num_lines' => 10,
          'background_text'  => 'Error!',
          'error_reporting_off' => E_WARNING | E_PARSE,
          'error_reporting_on' => 0
          );

          require( APP_PATH.'/application/library/PhpError/php_error.php' );
          \php_error\reportErrors($options);
        } else {
          header('Content-type: text/json');
          ini_set('display_errors', 'off');
        }

    }

    public function _initRoute(Yaf_Dispatcher $dispatcher) {
        
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        $route1 = new Resty_Route();
        $router->addRoute('product', $route1);

    }

    public function _initDefaultName(Yaf_Dispatcher $dispatcher) {
        $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
    }

    public function _initView(Yaf_Dispatcher $dispatcher) {
        $view= new Templar_Adapter(null);
        if (Yaf_Dispatcher::getInstance()->getRequest()->isXmlHttpRequest()) {
          Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        }
        Yaf_Dispatcher::getInstance()->setView($view);
        $view->assign('error',Yaf_Session::getInstance()->get('error'));
        
        if (Yaf_Session::getInstance()->get('user') == '') {
          if (isset($_COOKIE['user']) && $_COOKIE['user']) {
            Yaf_Session::getInstance()->set('user', $_COOKIE['user']);
            $view->assign('userid', $_COOKIE['user']);
          }  
        } else {
          $view->assign('userid',Yaf_Session::getInstance()->get('user'));
        }


   }
}