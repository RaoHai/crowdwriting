<?php
class App_Helper {
	static protected $_instance = NULL;

	private function __construct()
	{
	}
	static public function getInstance()
	{
		if (is_null(self::$_instance) || !isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'http://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}
	public function get_lines($text, $number)
	{
		$arr = explode("\n",$text);
		if (count($arr) < $number) {
			return $text;
		} else {
			return implode("\n",array_slice($arr,0,$number));
		}
	}
	public function get_chinese_time($timeStr)
	{
		$timestamp = strtotime($timeStr);
		return Date("Y年m月d日",$timestamp);

	}
}
