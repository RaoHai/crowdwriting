<?php
	$text  = <<<EOF
è¯·é¢„å…ˆå®‰è£…php,php5-dev
=======================

æœåŠ¡å™¨ä½¿ç”¨nginx
================

wget http://nginx.org/download/nginx-1.4.1.tar.gz
tar zxvf ngin*
make
make install
å«Œéº»çƒ¦å¯ä»¥ç›´æŽ¥sudo apt-get install nginx
æˆ‘å»ºè®®è¿˜æ˜¯ç¼–è¯‘å®‰è£…æ¯”è¾ƒå¥½

PHPä½¿ç”¨fast-cgiæ¨¡å¼ï¼Œ
sudo apt-get install spawn-fcgi
ä»¥ä¸Šå¯ä»¥å‚è€ƒ
http://wiki.ubuntu.org.cn/Nginx#.E5.AE.89.E8.A3.85FastCgi
æ¥é…ç½®å¥½ã€‚

Yaf
==============
http://yaf.laruence.com/manual/yaf.install.html
ç¼–è¯‘Yafæ—¶æ³¨æ„
å…ˆwhereis phpize
æ¯”å¦‚æˆ‘çš„phpizeæ˜¯åœ¨/usr/bin/phpize,$PHP_BIN/phpize å°±æ˜¯ /usr/bin/phpize
php-config åŒä¸Š

```
 $PHP_BIN/phpize
      ./configure --with-php-config=$PHP_BIN/php-config
      make
      make install
```

å®‰è£…å¥½ä¹‹åŽ
php.iniæœ€åŽä¸€è¡Œï¼ŒåŠ 
extension = yaf.so

php.iniæ‰¾ä¸åˆ°çš„è‡ªå·±è¾“å‡ºä¸€ä¸‹phpinfo();çœ‹Loaded Configuration FileæŒ‡å‘å“ªä¸ªæ–‡ä»¶ã€‚ã€‚


é‡å¯php
sudo php5-fpm restart

phpinfo()çœ‹ä¸€ä¸‹ï¼Œyafæ˜¯ä¸æ˜¯å¼€èµ·æ¥äº†ã€‚

nginx é…ç½®urlé‡å†™
ç½‘ç«™åœ°å€æ³¨æ„ï¼Œæ–‡ä»¶è§£åŽ‹ä¹‹åŽæ˜¯crowdwritingï¼Œè¿™é‡Œè¦æŒ‡å‘/crowdwriting/public
server {
  listen 80;
  server_name  domain.com;
  root   document_root;	//è¿™é‡Œå†™ä½ ç½‘ç«™æ”¾å“ª- -
  index  index.php index.html index.htm;

  if (!-e $request_filename) {
    rewrite ^/(.*)  /index.php/$1 last;
  }
}
é…ç½®æ–‡ä»¶è‡ªå·±æ‰¾ï¼Œï¼Œï¼Œ

memcache
===========
ç…§è¿™ç¯‡é…ç½®å¥½memcache
ç‰ˆæœ¬æ³¨æ„ï¼š
memcache é€‰ 2.2.7
memcached é€‰ 1.4.15
libeventé€‰1.3
http://www.ccvita.com/257.html

å¯åŠ¨ï¼š
# /usr/local/bin/memcached -d -m 10 -u root -l 127.0.0.1 -p 11211 -c 256 -P /tmp/memcached.pid
EOF;

function get_lines($text, $number)
	{
		$arr = explode("\n",$text);
		if (count($arr) < $number) {
			return $text;
		} else {
			return implode("\n",array_slice($arr,0,$number));
		}
	}

var_dump(get_lines($text,10));
