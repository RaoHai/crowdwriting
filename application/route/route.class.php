<?php

/* ---------------------------
路由类
-----------------------------//  */
defined("WEB_AUTH") || die("NO_AUTH");
include_once 'route.ini.php';

class Route
{
    private $_moudle;
    private $_controller;
    private $_action;
    private $_uri;
    private $_param;
    //mvc资源
    private $moudle_arr;
    //路由资源
    private $route_arr;

    private $_default = array('module' => 'default',
        'conttoller' => 'index',
        'action' => 'index');

    public function __construct($uri = NULL)
    {
        global $moduleArr,$routeArr;
        $this->moudle_arr  = $moduleArr;
        $this->route_arr   = $routeArr;
        $uri == NULL && $uri = $_SERVER['REDIRECT_URL'];
        $uri = isset($uri) ? $uri : $_REQUEST['url'];
        $this->_uri   = $uri;
        $this->init();


    }

    private function parseUri($uri = NULL)
    {
        global $routeArr;
        $uri == NULL && $uri = $this->_uri;

        foreach($routeArr as $regex=>$mvc)
        {

            if(preg_match($regex,$uri,$matches))
            {
                $uri =  preg_replace($regex,$mvc,$uri);
                $this->uriArr = explode("/",$uri);
                //$this->uriArr = array($mvc["controller"],$mvc["action"],$mvc["param"]);
                return;
            }

        }
        //die();
        $this->uriArr = explode('/',$uri);
        //$this->uriArr && $this->uriArr = array_filter($this->uriArr);
        //echo "==>".$this->uriArr[1];
    }

    private function init()
    {
        //$cache = Cache::getInstance();
        //Cache::op_cache_start();
        $this->parseUri();   
        $this->parseRoute();
        $this->dispatcher();
        //	Cache::op_cache_stop();
    }
    private function parseRoute()
    {
    //var_dump($this->uriArr);
      if(SHORT_URI){
        $this->_module= (!empty( $this->uriArr[0]) ? $this->uriArr[0] : 'index');
        $this->_controller=(!empty( $this->uriArr[0]) ? $this->uriArr[0] : 'index');
        $this->_action =(!empty( $this->uriArr[1]) ? $this->uriArr[1] : 'index');
        $this-> _param= (!empty( $this->uriArr[2]) ? $this->uriArr[2] : '');
    }else{
        $this->_module = (!empty($_GET['m'])?$_GET['m']:'index');
        $this->_controller=(!empty($_GET['m'])?$_GET['m']:'index');
        $this->_action = (!empty($_GET['a'])?$_GET['a']:'index');
        $this->_param  = (!empty($_GET['p'])?$_GET['p']:'');
    }

        if ($this->_action == 'index') {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $this->_action = 'post';
                    break;
                case 'DELETE':
                    $this->_action = 'del';
                    break;
                default:
                    break;
            }
        }
        register_global_var("_MODULE",$this->_module);
        register_global_var("_CONTROLLER",$this->_controller);
        register_global_var("_ACTION",$this->_action);
        register_global_var("_PARAM",$this->_param);
        //echo "controller:".$this->_controller." action:".$this->_action." param:".$this->_param;
    }

    private function dispatcher()
    {
        global $Permissions;
        $controllerfile = APPLICATION_PATH."/controllers/controller.{$this->_controller}.class.php";
        if(!file_exists($controllerfile))
        {
            Header("Location: 404.html");
            return;
        }
        $controllerName =$this->_controller;
        $func = "_".$this->_action;
        $param = $this->_param;
        // echo "C:". $controllerName.",A:".$this->_action;
        // echo $Permissions[$controllerName];
        //$acl= loadser();
        $permission = $_SESSION["PERMISSION"];


        $acl = Acl::getInstance();
        $acl->addRole("guest");
        $acl->allow("guest","index");
        $acl->allow("guest","Chapter");
        $acl->allow("guest","register");
        $acl->addRole("admin","guest");
        $acl->allow("admin","user");
        $acl->allow("admin","cms");
        //$acl->allow("guest","user");

        //echo $permission;
        if (file_exists($controllerfile) && ($acl->isallowed($permission,$controllerName)||$acl->isallowed($permission,$controllerName,$this->_action)))
        {
            $Instance = new $controllerName();
            $Instance-> $func ($param);	
        }
        else
        {
            Header("Location: ?m=register&a=login".$this->_uri."");
        }


    }

    public function GetModule()
    {
        if(empty($this->_module)) $this->_module="index";
        return $this->_module;
    }
    public function GetController()
    {
        if(empty($this->_controller)) $this->_controller="index";
        return $this->_controller;
    }
    public function GetAction()
    {
        if(empty($this->_action)) $this->_action="index";
        return $this->_action;
    }


}

?>
