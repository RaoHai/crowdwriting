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
		$this->_templar->scripts = 
<<<EOD
	<script src="javascripts/vendor/jquery.js"> </script>
	<script src="javascripts/foundation/foundation.js"></script>
	<script src="javascripts/foundation/foundation.alerts.js"></script>
	<script src="javascripts/foundation/foundation.clearing.js"></script>
	<script src="javascripts/foundation/foundation.cookie.js"></script>
	<script src="javascripts/foundation/foundation.dropdown.js"></script>
	<script src="javascripts/foundation/foundation.forms.js"></script>
	<script src="javascripts/foundation/foundation.joyride.js"></script>
	<script src="javascripts/foundation/foundation.magellan.js"></script>
	<script src="javascripts/foundation/foundation.orbit.js"></script>
	<script src="javascripts/foundation/foundation.placeholder.js"></script>
	<script src="javascripts/foundation/foundation.reveal.js"></script>
	<script src="javascripts/foundation/foundation.section.js"></script>
	<script src="javascripts/foundation/foundation.tooltips.js"></script>
	<script src="javascripts/foundation/foundation.topbar.js"></script>
	<script src="javascripts/app.js"></script>
EOD;
$this->_templar->nav = 
<<<EOD
	<nav class="top-bar">
  <ul class="title-area">
    <!-- Title Area -->
    <li class="name">
      <h1><a href="#"><img  class='logo' src='/img/logo.png'></a></h1>
    </li>
    <li class='actions'>
      <ul class="actionbar">
      	<li><a href="javascript:void(0)" class="new" id="action-new"><i class="icon-file-alt"></i></a></li>
        <li><a href="javascript:void(0)" class="save" id="action-save"><i class="icon-save"></i></a></li>
        <li><a href="javascript:void(0)" class="style" id="action-style"><i class="icon-columns"></i></a></li>
      </ul>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
 
    <ul class="left">
      <li><a href="/" class='active'><span><i class="icon-pencil"></i> Write</span></a></li>
      <li class="split"></li>
      <li><a href="browse"><span>Browse</span></a></li>
      <li class="split"></li>
      <li><a href="explore"><span>Explore</span></a></li>
      <li class="split"></li>
      <li><a href="about"><span>About</span></a></li>
    </ul>
    <ul class="right">
      <li>
        <a class='avatar'>
          <span>Ruly</span>
          <img src='img/avatar.jpg'>
          <span><i class="icon-angle-down"></i></span>
        </a>

        <ul class="action-dropdown">
          <span class="arrow"></span>
          <li class='top'>
            <img src='img/avatar1.jpg'>
            <span class="user-name">Ruly</span>
            <span class="user-email">surgesoft@gmail.com</span>
          </li>
          <li class='normal'><a href='#'><i class="icon-info"></i>Manager Profile</a></li>
          <li class='normal'><a href='#'><i class="icon-envelope"></i>Mail</a></li>
          <li class="split"></li>
          <li class='normal'><a href='#'>Invite someone to CW</a></li>
          <li class="split"></li>
          <li class='normal'><a href='#'><i class="icon-question"></i>Help</a></li>
          <li class="split"></li>
          <li class='normal'><a href='#'><i class="icon-signout"></i>Log Out</a></li>
          <span class="shadow shadow-left"></span>
          <span class="shadow shadow-right"></span>
          <span class="shadow shadow-bottom"></span>
        </ul>
      </li>
    </ul>
  </section>
</nav>
EOD;
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