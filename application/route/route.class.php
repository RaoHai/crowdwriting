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
                //echo $uri."</br>";


                //var_dump($matches);

                $this->uriArr = array($mvc["controller"],$mvc["action"],$mvc["param"]);
            }

        }
        //die();
        $this->uriArr = explode('/',substr($uri,1));
        $this->uriArr && $this->uriArr = array_filter($this->uriArr);
        //var_dump($this->uriArr);
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
      if(SHORT_URI){
        $this->_module= (isset( $this->uriArr[0]) ? $this->uriArr[0] : 'index');
        $this->_controller=(isset( $this->uriArr[0]) ? $this->uriArr[0] : 'index');
        $this->_action =(isset( $this->uriArr[1]) ? $this->uriArr[1] : 'index');
        $this-> _param= (isset( $this->uriArr[2]) ? $this->uriArr[2] : '');
    }else{
        $this->_module = (isset($_GET['m'])?$_GET['m']:'index');
        $this->_controller=(isset($_GET['m'])?$_GET['m']:'index');
        $this->_action = (isset($_GET['a'])?$_GET['a']:'index');
        $this->_param  = (isset($_GET['p'])?$_GET['p']:'');
    }
        register_global_var("_MODULE",$this->_module);
        register_global_var("_CONTROLLER",$this->_controller);
        register_global_var("_ACTION",$this->_action);
        register_global_var("_PARAM",$this->_param);
        //echo $this->_module."|".$this->_controller."|".$this->_action.":".$this-> _param;

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
        $acl->allow("guest","article");
        $acl->allow("guest","columns");
        $acl->allow("guest","childcolumns");
        $acl->allow("guest","contents");
        $acl->allow("guest","paper");	
		$acl->allow("guest","catalog");	
		$acl->allow("guest","product");	
        $acl->allow("guest","paperfile");
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
