<?php

	define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
	// ini_set('display_errors', 'On');
	try {
		$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");
		$app
		->bootstrap()
		->run();
	} catch (Exception $e) {
		var_dump($e);
		// header('Location: 404.html');
	}
	