<?php
require_once APP_PATH.'/application/library/Twig/Autoloader.php';
Twig_Autoloader::register();

class Templar_Adapter implements Yaf_View_Interface
{
	public $_templar;

	public function __construct($tmplPath = null, $extraParams = array())
	{
		$this->_templar = array();
	}

	public function getEngine()
	{
		return $this->_templar;
	}
	public function setScriptPath($path)
	{
		if (is_readable($path)) {
			$this->_templar->template_dir = $path;
			return;
		}

		throw new Exception('Invalid path provided');
	}
	public function loadDefaultVars()
	{
		$this->_templar['scripts'] = $this->loadPartical('scripts');
		$this->_templar['nav'] = $this->loadPartical('nav');
	}
	public function getScriptPath()
	{
		return $this->_templar->template_dir;
	}

	public function assign($spec, $value = null) {
		$this->_templar[$spec] = $value;
	}


	public function display($name, $value = NULL) {
		return "hello".$name.$value;
	}

	public function render($name, $valor = NULL) {
		$this->assign('controller', Yaf_Dispatcher::getInstance()->getRequest()->getControllerName());
		$path = APP_PATH.'/application/views/';		
		$loader = new Twig_Loader_Filesystem($path);
		// $twig = new Twig_Environment($loader, array(
  //   		'cache' => APP_PATH.'/cache/compilation_cache',
		// ));
		$twig = new Twig_Environment($loader);
		return $twig->render($name, $this->_templar);
	}

}