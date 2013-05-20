<?php
	class ui
	{
		static private $_instance = NULL;
		private function __construct()
		{
			
		}
		private function __clone()
		{
		}
		
		static public function getInstance() 
		{
			if (is_null(self::$_instance) || !isset(self::$_instance)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}	 
		/*public function doform($name,$action,$method)
		{
			global $_Struct;
			$varis = $_Struct[$name];
			if(!$method=='ajax')
			{
				echo "<form action='$action' method='$method' >\n";
				foreach($varis as $var)
				{
					echo "$var<input name='$var'/></br>\n";
				}	
				echo "</form>\n";
			}
		}*/
		static public function labelfor($name)
		{
			echo "<lable for='$name'>$name</lable></br>";
		}
		static public function textfield($name)
		{
			echo "<input name='$name' /></br>";
		}
		static public function upload($name)
		{
			self::labelfor($name);
			echo "<input type='file' name='$name'/></br> ";
		}
	}

?>
