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
		$text = mb_substr($text,0,1024)."...";
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
	public function generater_token($name)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  
		$salt = '';
		for ($i=0; $i < 16; $i++) { 
			$salt .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}

		Yaf_Session::getInstance()->set("{$name}_token",$salt);
		return $salt;
	}
	public function assert_token($name, $token)
	{
		if (Yaf_Session::getInstance()->get("{$name}_token") != $token) {
			http_response_code(401);
			die();
		}
		Yaf_Session::getInstance()->del("{$name}_token");
		return true;
	}
}
