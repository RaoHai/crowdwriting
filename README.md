请预先安装php,php5-dev
=======================


你可能需要预先
apt-get install libpcre3 libpcre3-dev
apt-get install build-essential
apt-get install openssl
apt-get install libssl-dev

服务器使用nginx
================

wget http://nginx.org/download/nginx-1.4.1.tar.gz
tar zxvf ngin*
./configure
make
make install
嫌麻烦可以直接sudo apt-get install nginx
我建议还是编译安装比较好

PHP使用fast-cgi模式，
sudo apt-get install spawn-fcgi
以上可以参考
http://wiki.ubuntu.org.cn/Nginx#.E5.AE.89.E8.A3.85FastCgi
来配置好。

Yaf
==============
http://yaf.laruence.com/manual/yaf.install.html
编译Yaf时注意
先whereis phpize
比如我的phpize是在/usr/bin/phpize,$PHP_BIN/phpize 就是 /usr/bin/phpize
php-config 同上

```
 $PHP_BIN/phpize
      ./configure --with-php-config=$PHP_BIN/php-config
      make
      make install
```

安装好之后
php.ini最后一行，加
extension = yaf.so

php.ini找不到的自己输出一下phpinfo();看Loaded Configuration File指向哪个文件。。


重启php
sudo php5-fpm restart

phpinfo()看一下，yaf是不是开起来了。

nginx 配置url重写
网站地址注意，文件解压之后是crowdwriting，这里要指向/crowdwriting/public
server {
  listen 80;
  server_name  domain.com;
  root   document_root;	//这里写你网站放哪- -
  index  index.php index.html index.htm;

  if (!-e $request_filename) {
    rewrite ^/(.*)  /index.php/$1 last;
  }
}
配置文件自己找，，，

Redis
======
$ wget http://redis.googlecode.com/files/redis-2.6.14.tar.gz
$ tar xzf redis-2.6.14.tar.gz
$ cd redis-2.6.14
$ make
$ make install

请用sudo redis-server开启redis要不跑不起来

$ git clone https://github.com/nicolasff/phpredis.git
$ phpize
$ ./configure --with-php-config=$PHP_BIN/php-config
$ make
$ make install

php.ini最后一行，加
extension = redis.so


模板使用Twig
http://twig.sensiolabs.org/

安装方法
$ sudo apt-get install php-pear
$ sudo pear channel-discover pear.twig-project.org
$ sudo pear install twig/Twig

$ git clone git://github.com/fabpot/Twig.git

$ cd Twig/ext/twig
$ phpize
$ ./configure
$ make
$ sudo make install

php.ini最后加一行
extension=twig.so

