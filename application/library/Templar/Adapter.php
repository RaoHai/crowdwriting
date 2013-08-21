<?php

class Templar_Adapter implements Yaf_View_Interface
{
	public $_templar;

	public function __construct($tmplPath = null, $extraParams = array())
	{
		$this->_templar = new StdClass();
		$this->loadDefaultVars();
	}

	public function getEngine()
	{
		return $this->_templar;
	}
	public function loadPartical($name)
	{
		return $this->render("partical/$name.phtml");

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
		$this->_templar->scripts = $this->loadPartical('scripts');
		$this->_templar->nav = $this->loadPartical('nav');
	}
	public function getScriptPath()
	{
		return $this->_templar->template_dir;
	}

	public function assign($spec, $value = null) {
		$this->_templar->$spec = $value;
	}


	public function display($name, $value = NULL) {
		return "hello".$name.$value;
	}

	public function render($name, $valor = NULL) {

		$controllerName = Yaf_Dispatcher::getInstance()->getRequest()->getControllerName();
		$this->assign('controller', Yaf_Dispatcher::getInstance()->getRequest()->getControllerName());
		$path = APP_PATH.'/application/views/'.$name;		
		$lines = file($path);
		//return ''.join($lines);
		$newLines = array();
		$matches = null;
		foreach($lines as $line)  {
			$num = preg_match_all('/\{[$]([^{}]+)\}/', $line, $matches);
		 	if($num > 0) {
		 		for($i = 0; $i < $num; $i++) {
		 			$match = $matches[0][$i];
		 			$new = $this->transformSyntax($matches[1][$i]);
		 			$line = str_replace($match, $new, $line);
		 		}
		 	}
		 	$newLines[] = $line;
		 }
		 return implode('', $newLines);
		// $f = fopen($compiledFile, 'w');
		// fwrite($f, implode('',$newLines));
		// fclose($f);
		// require_once($compiledFile);
	}

	private function transformSyntax($input) {
        $from = array(
            '/(^|\|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\|\+)/',
            '/(^|\|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\|\+)/', 
            '/\./',
        );
        $to = array(
            '$1$this->values["$2$3"]',
            '$1$this->values["$2$3"]',
            '->'
        );

        $parts = explode(':', $input);
        $string = $parts[0];
        

        return isset($this->_templar->$string) ? $this->_templar->$string : '';
        //return $this->_templar->$string;
    }
}