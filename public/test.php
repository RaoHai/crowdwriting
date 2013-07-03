<?php
	$redis = new Redis();
	$redis->connect('127.0.0.1',6379);
	$redis->set('test','hello world!');
	echo $redis->get('test');	
	phpinfo();
