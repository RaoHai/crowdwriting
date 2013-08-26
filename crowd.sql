-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2013 at 09:09 AM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crowd`
--

-- --------------------------------------------------------

--
-- Table structure for table `Chapter`
--

CREATE TABLE IF NOT EXISTS `Chapter` (
  `ChapterId` int(11) NOT NULL AUTO_INCREMENT,
  `ChapterTitle` varchar(255) NOT NULL,
  `ChapterContent` longtext NOT NULL,
  `CreateTime` datetime NOT NULL,
  `UpdateTime` datetime NOT NULL,
  `Uuid` varchar(16) NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`ChapterId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `Chapter`
--

INSERT INTO `Chapter` (`ChapterId`, `ChapterTitle`, `ChapterContent`, `CreateTime`, `UpdateTime`, `Uuid`, `UserId`) VALUES
(25, 'WELCOME', 'è¯·é¢„å…ˆå®‰è£…php,php5-dev\n=======================\n\næœåŠ¡å™¨ä½¿ç”¨nginx\n================\n\nwget http://nginx.org/download/nginx-1.4.1.tar.gz\ntar zxvf ngin*\nmake\nmake install\nå«Œéº»çƒ¦å¯ä»¥ç›´æŽ¥sudo apt-get install nginx\næˆ‘å»ºè®®è¿˜æ˜¯ç¼–è¯‘å®‰è£…æ¯”è¾ƒå¥½\n\nPHPä½¿ç”¨fast-cgiæ¨¡å¼ï¼Œ\nsudo apt-get install spawn-fcgi\nä»¥ä¸Šå¯ä»¥å‚è€ƒ\nhttp://wiki.ubuntu.org.cn/Nginx#.E5.AE.89.E8.A3.85FastCgi\næ¥é…ç½®å¥½ã€‚\n\nYaf\n==============\nhttp://yaf.laruence.com/manual/yaf.install.html\nç¼–è¯‘Yafæ—¶æ³¨æ„\nå…ˆwhereis phpize\næ¯”å¦‚æˆ‘çš„phpizeæ˜¯åœ¨/usr/bin/phpize,$PHP_BIN/phpize å°±æ˜¯ /usr/bin/phpize\nphp-config åŒä¸Š\n\n```\n $PHP_BIN/phpize\n      ./configure --with-php-config=$PHP_BIN/php-config\n      make\n      make install\n```\n\nå®‰è£…å¥½ä¹‹åŽ\nphp.iniæœ€åŽä¸€è¡Œï¼ŒåŠ \nextension = yaf.so\n\nphp.iniæ‰¾ä¸åˆ°çš„è‡ªå·±è¾“å‡ºä¸€ä¸‹phpinfo();çœ‹Loaded Configuration FileæŒ‡å‘å“ªä¸ªæ–‡ä»¶ã€‚ã€‚\n\n\né‡å¯php\nsudo php5-fpm restart\n\nphpinfo()çœ‹ä¸€ä¸‹ï¼Œyafæ˜¯ä¸æ˜¯å¼€èµ·æ¥äº†ã€‚\n\nnginx é…ç½®urlé‡å†™\nç½‘ç«™åœ°å€æ³¨æ„ï¼Œæ–‡ä»¶è§£åŽ‹ä¹‹åŽæ˜¯crowdwritingï¼Œè¿™é‡Œè¦æŒ‡å‘/crowdwriting/public\nserver {\n  listen 80;\n  server_name  domain.com;\n  root   document_root;	//è¿™é‡Œå†™ä½ ç½‘ç«™æ”¾å“ª- -\n  index  index.php index.html index.htm;\n\n  if (!-e $request_filename) {\n    rewrite ^/(.*)  /index.php/$1 last;\n  }\n}\né…ç½®æ–‡ä»¶è‡ªå·±æ‰¾ï¼Œï¼Œï¼Œ\n\nmemcache\n===========\nç…§è¿™ç¯‡é…ç½®å¥½memcache\nç‰ˆæœ¬æ³¨æ„ï¼š\nmemcache é€‰ 2.2.7\nmemcached é€‰ 1.4.15\nlibeventé€‰1.3\nhttp://www.ccvita.com/257.html\n\nå¯åŠ¨ï¼š\n# /usr/local/bin/memcached -d -m 10 -u root -l 127.0.0.1 -p 11211 -c 256 -P /tmp/memcached.pid', '2013-07-17 20:09:43', '2013-07-17 20:09:43', '''', 0),
(26, 'WELCOME', 'è¯·é¢„å…ˆå®‰è£…php,php5-dev\n=======================\n\næœåŠ¡å™¨ä½¿ç”¨nginx\n================\n\nwget http://nginx.org/download/nginx-1.4.1.tar.gz\ntar zxvf ngin*\nmake\nmake install\nå«Œéº»çƒ¦å¯ä»¥ç›´æŽ¥sudo apt-get install nginx\næˆ‘å»ºè®®è¿˜æ˜¯ç¼–è¯‘å®‰è£…æ¯”è¾ƒå¥½\n\nPHPä½¿ç”¨fast-cgiæ¨¡å¼ï¼Œ\nsudo apt-get install spawn-fcgi\nä»¥ä¸Šå¯ä»¥å‚è€ƒ\nhttp://wiki.ubuntu.org.cn/Nginx#.E5.AE.89.E8.A3.85FastCgi\næ¥é…ç½®å¥½ã€‚\n\nYaf\n==============\nhttp://yaf.laruence.com/manual/yaf.install.html\nç¼–è¯‘Yafæ—¶æ³¨æ„\nå…ˆwhereis phpize\næ¯”å¦‚æˆ‘çš„phpizeæ˜¯åœ¨/usr/bin/phpize,$PHP_BIN/phpize å°±æ˜¯ /usr/bin/phpize\nphp-config åŒä¸Š\n\n```\n $PHP_BIN/phpize\n      ./configure --with-php-config=$PHP_BIN/php-config\n      make\n      make install\n```\n\nå®‰è£…å¥½ä¹‹åŽ\nphp.iniæœ€åŽä¸€è¡Œï¼ŒåŠ \nextension = yaf.so\n\nphp.iniæ‰¾ä¸åˆ°çš„è‡ªå·±è¾“å‡ºä¸€ä¸‹phpinfo();çœ‹Loaded Configuration FileæŒ‡å‘å“ªä¸ªæ–‡ä»¶ã€‚ã€‚\n\n\né‡å¯php\nsudo php5-fpm restart\n\nphpinfo()çœ‹ä¸€ä¸‹ï¼Œyafæ˜¯ä¸æ˜¯å¼€èµ·æ¥äº†ã€‚\n\nnginx é…ç½®urlé‡å†™\nç½‘ç«™åœ°å€æ³¨æ„ï¼Œæ–‡ä»¶è§£åŽ‹ä¹‹åŽæ˜¯crowdwritingï¼Œè¿™é‡Œè¦æŒ‡å‘/crowdwriting/public\nserver {\n  listen 80;\n  server_name  domain.com;\n  root   document_root;	//è¿™é‡Œå†™ä½ ç½‘ç«™æ”¾å“ª- -\n  index  index.php index.html index.htm;\n\n  if (!-e $request_filename) {\n    rewrite ^/(.*)  /index.php/$1 last;\n  }\n}\né…ç½®æ–‡ä»¶è‡ªå·±æ‰¾ï¼Œï¼Œï¼Œ\n\nmemcache\n===========\nç…§è¿™ç¯‡é…ç½®å¥½memcache\nç‰ˆæœ¬æ³¨æ„ï¼š\nmemcache é€‰ 2.2.7\nmemcached é€‰ 1.4.15\nlibeventé€‰1.3\nhttp://www.ccvita.com/257.html\n\nå¯åŠ¨ï¼š\n# /usr/local/bin/memcached -d -m 10 -u root -l 127.0.0.1 -p 11211 -c 256 -P /tmp/memcached.pid', '2013-07-17 20:09:54', '2013-07-17 20:09:54', '''', 0),
(42, 'WELCOME2', '\n\n\n> Written with [StackEdit](http://benweet.github.io/stackedit/).', '2013-07-23 22:30:03', '2013-07-23 22:30:03', '''', 0);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `Permission` varchar(255) NOT NULL,
  `LastHeating` datetime NOT NULL COMMENT '上次活动时间',
  `Temperature` varchar(10) NOT NULL COMMENT '当前热度',
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserId`, `UserName`, `Email`, `Password`, `Salt`, `CreateTime`, `Permission`, `LastHeating`, `Temperature`) VALUES
(1, 'surgesoft@gmail.com', 'surgesoft@gmail.com', '2c8a18ba1c8d49bd9324c8fd990c1462243db4e1', 'C&!7I', '2013-08-17 08:58:23', 'user', '2013-08-21 22:57:45', '0.66728359'),
(32, 'iSa6u93', 'G4KMPg@gmail.com', 'eQn2c', '2GCEe', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.52472448'),
(33, '44scTyv', 'uVnvLgn@gmail.com', 'ZMQt62', 'YAtlEG2w', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.62177166'),
(34, 'KbB3M9oYtd', 'R2vym@gmail.com', 'eU77VL3I', 'eamrft53', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.53468488'),
(35, 'E6U0sG7zk', 'XKSZxVHwM@gmail.com', 'RGJSx', 'e5TrgT', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.80810945'),
(36, 'jW7NvZdct', '32NlPcd@gmail.com', 'Umo68HM', '8Qsz0rz', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.43649266'),
(37, 'pQYVz', 'JArlOm@gmail.com', 'VF05H', 'YoKVFLImhB', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.75813497'),
(38, 'xJsecd4v', '69LTk@gmail.com', 'wVFlUMx', 'F0O6Ld', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.4811969'),
(39, 'fRFcnVZcA', 'wn3BwF@gmail.com', 'qUSRc7', 'hNOH5pJ', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.13157964'),
(40, 'ePTgSyR', 'oV0Ob@gmail.com', 'EWrMb6chm', 'SX7wfwJI', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.2143075'),
(41, 'tuDzjE', 'VPja3zn@gmail.com', '8iQOwNW6', 'jHtIo9', '2013-08-21 22:45:07', 'user', '2013-08-21 22:57:45', '0.67679862');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
