-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2013 at 05:37 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.9-4ubuntu2.2

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
  `LastHeating` datetime NOT NULL,
  `Temperature` varchar(10) NOT NULL,
  PRIMARY KEY (`ChapterId`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `Chapter`
--

INSERT INTO `Chapter` (`ChapterId`, `ChapterTitle`, `ChapterContent`, `CreateTime`, `UpdateTime`, `Uuid`, `UserId`, `LastHeating`, `Temperature`) VALUES
(25, 'WELCOME', 'è¯·é¢„å…ˆå®‰è£…php,php5-dev\n=======================\n\næœåŠ¡å™¨ä½¿ç”¨nginx\n================\n\nwget http://nginx.org/download/nginx-1.4.1.tar.gz\ntar zxvf ngin*\nmake\nmake install\nå«Œéº»çƒ¦å¯ä»¥ç›´æŽ¥sudo apt-get install nginx\næˆ‘å»ºè®®è¿˜æ˜¯ç¼–è¯‘å®‰è£…æ¯”è¾ƒå¥½\n\nPHPä½¿ç”¨fast-cgiæ¨¡å¼ï¼Œ\nsudo apt-get install spawn-fcgi\nä»¥ä¸Šå¯ä»¥å‚è€ƒ\nhttp://wiki.ubuntu.org.cn/Nginx#.E5.AE.89.E8.A3.85FastCgi\næ¥é…ç½®å¥½ã€‚\n\nYaf\n==============\nhttp://yaf.laruence.com/manual/yaf.install.html\nç¼–è¯‘Yafæ—¶æ³¨æ„\nå…ˆwhereis phpize\næ¯”å¦‚æˆ‘çš„phpizeæ˜¯åœ¨/usr/bin/phpize,$PHP_BIN/phpize å°±æ˜¯ /usr/bin/phpize\nphp-config åŒä¸Š\n\n```\n $PHP_BIN/phpize\n      ./configure --with-php-config=$PHP_BIN/php-config\n      make\n      make install\n```\n\nå®‰è£…å¥½ä¹‹åŽ\nphp.iniæœ€åŽä¸€è¡Œï¼ŒåŠ \nextension = yaf.so\n\nphp.iniæ‰¾ä¸åˆ°çš„è‡ªå·±è¾“å‡ºä¸€ä¸‹phpinfo();çœ‹Loaded Configuration FileæŒ‡å‘å“ªä¸ªæ–‡ä»¶ã€‚ã€‚\n\n\né‡å¯php\nsudo php5-fpm restart\n\nphpinfo()çœ‹ä¸€ä¸‹ï¼Œyafæ˜¯ä¸æ˜¯å¼€èµ·æ¥äº†ã€‚\n\nnginx é…ç½®urlé‡å†™\nç½‘ç«™åœ°å€æ³¨æ„ï¼Œæ–‡ä»¶è§£åŽ‹ä¹‹åŽæ˜¯crowdwritingï¼Œè¿™é‡Œè¦æŒ‡å‘/crowdwriting/public\nserver {\n  listen 80;\n  server_name  domain.com;\n  root   document_root;	//è¿™é‡Œå†™ä½ ç½‘ç«™æ”¾å“ª- -\n  index  index.php index.html index.htm;\n\n  if (!-e $request_filename) {\n    rewrite ^/(.*)  /index.php/$1 last;\n  }\n}\né…ç½®æ–‡ä»¶è‡ªå·±æ‰¾ï¼Œï¼Œï¼Œ\n\nmemcache\n===========\nç…§è¿™ç¯‡é…ç½®å¥½memcache\nç‰ˆæœ¬æ³¨æ„ï¼š\nmemcache é€‰ 2.2.7\nmemcached é€‰ 1.4.15\nlibeventé€‰1.3\nhttp://www.ccvita.com/257.html\n\nå¯åŠ¨ï¼š\n# /usr/local/bin/memcached -d -m 10 -u root -l 127.0.0.1 -p 11211 -c 256 -P /tmp/memcached.pid', '2013-07-17 20:09:43', '2013-07-17 20:09:43', '''', 1, '0000-00-00 00:00:00', ''),
(26, 'WELCOME', 'è¯·é¢„å…ˆå®‰è£…php,php5-dev\n=======================\n\næœåŠ¡å™¨ä½¿ç”¨nginx\n================\n\nwget http://nginx.org/download/nginx-1.4.1.tar.gz\ntar zxvf ngin*\nmake\nmake install\nå«Œéº»çƒ¦å¯ä»¥ç›´æŽ¥sudo apt-get install nginx\næˆ‘å»ºè®®è¿˜æ˜¯ç¼–è¯‘å®‰è£…æ¯”è¾ƒå¥½\n\nPHPä½¿ç”¨fast-cgiæ¨¡å¼ï¼Œ\nsudo apt-get install spawn-fcgi\nä»¥ä¸Šå¯ä»¥å‚è€ƒ\nhttp://wiki.ubuntu.org.cn/Nginx#.E5.AE.89.E8.A3.85FastCgi\næ¥é…ç½®å¥½ã€‚\n\nYaf\n==============\nhttp://yaf.laruence.com/manual/yaf.install.html\nç¼–è¯‘Yafæ—¶æ³¨æ„\nå…ˆwhereis phpize\næ¯”å¦‚æˆ‘çš„phpizeæ˜¯åœ¨/usr/bin/phpize,$PHP_BIN/phpize å°±æ˜¯ /usr/bin/phpize\nphp-config åŒä¸Š\n\n```\n $PHP_BIN/phpize\n      ./configure --with-php-config=$PHP_BIN/php-config\n      make\n      make install\n```\n\nå®‰è£…å¥½ä¹‹åŽ\nphp.iniæœ€åŽä¸€è¡Œï¼ŒåŠ \nextension = yaf.so\n\nphp.iniæ‰¾ä¸åˆ°çš„è‡ªå·±è¾“å‡ºä¸€ä¸‹phpinfo();çœ‹Loaded Configuration FileæŒ‡å‘å“ªä¸ªæ–‡ä»¶ã€‚ã€‚\n\n\né‡å¯php\nsudo php5-fpm restart\n\nphpinfo()çœ‹ä¸€ä¸‹ï¼Œyafæ˜¯ä¸æ˜¯å¼€èµ·æ¥äº†ã€‚\n\nnginx é…ç½®urlé‡å†™\nç½‘ç«™åœ°å€æ³¨æ„ï¼Œæ–‡ä»¶è§£åŽ‹ä¹‹åŽæ˜¯crowdwritingï¼Œè¿™é‡Œè¦æŒ‡å‘/crowdwriting/public\nserver {\n  listen 80;\n  server_name  domain.com;\n  root   document_root;	//è¿™é‡Œå†™ä½ ç½‘ç«™æ”¾å“ª- -\n  index  index.php index.html index.htm;\n\n  if (!-e $request_filename) {\n    rewrite ^/(.*)  /index.php/$1 last;\n  }\n}\né…ç½®æ–‡ä»¶è‡ªå·±æ‰¾ï¼Œï¼Œï¼Œ\n\nmemcache\n===========\nç…§è¿™ç¯‡é…ç½®å¥½memcache\nç‰ˆæœ¬æ³¨æ„ï¼š\nmemcache é€‰ 2.2.7\nmemcached é€‰ 1.4.15\nlibeventé€‰1.3\nhttp://www.ccvita.com/257.html\n\nå¯åŠ¨ï¼š\n# /usr/local/bin/memcached -d -m 10 -u root -l 127.0.0.1 -p 11211 -c 256 -P /tmp/memcached.pid', '2013-07-17 20:09:54', '2013-07-17 20:09:54', '''', 1, '0000-00-00 00:00:00', ''),
(42, 'WELCOME2', '\r\n\r\n> Written with [StackEdit](http://benweet.github.io/stackedit/).', '2013-07-23 22:30:03', '2013-07-23 22:30:03', '''', 1, '0000-00-00 00:00:00', ''),
(45, 'WELCOME2', '%0A%23%20WAMP.IO%3A%20Autobahn%20WebSockets%20RPC%2FPubSub%0A%0AThis%20is%20an%20implentation%20of%20the%20%5BWebSocket%20Application%20Messaging%20Protocol%20%28WAMP%29%5D%28http%3A%2F%2Fwww.tavendo.de%2Fautobahn%2Fprotocol.html%29%20proposed%20by%20Travendo.%0A%0AIt%20attaches%20to%20a%20%5BWebSocket%20server%5D%28https%3A%2F%2Fgithub.com%2Feinaros%2Fws%2F%29%20and%20provides%20mechanisms%20for%0A%0A-%20%2A%2ARequest%20and%20Response%2A%2A%20and%0A-%20%2A%2APublish%20and%20Subscribe%2A%2A%0A%0A%23%23%20Usage%0A%0A%23%23%23%20Simple%20PubSub%20server%0A%0ABy%20default%2C%20wamp.io%20provides%20a%20simple%20PubSub%20server%20that%20enables%20client%20to%20subscribe%20to%20any%20topic%20and%20to%20send%20events%20to%20any%20topic.%0A%0A%23%23%23%23%20Attach%20WAMP%20to%20a%20WebSocket.IO%20server%0A%0A%60%60%60js%0Avar%20wsio%20%3D%20require%28%27websocket.io%27%29%0A%20%20%2C%20wamp%20%3D%20require%28%27wamp.io%27%29%3B%0A%0Avar%20ws%20%3D%20wsio.listen%289000%29%3B%0Avar%20app%20%3D%20wamp.attach%28ws%29%3B%0A%60%60%60%0A%0A%23%23%23%23%20Attach%20WAMP%20to%20an%20Engine.IO%20server%0A%0A%60%60%60js%0Avar%20eio%20%3D%20require%28%27engine.io%27%29%0A%20%20%2C%20wamp%20%3D%20require%28%27wamp.io%27%29%3B%0A%0Avar%20engine%20%3D%20eio.listen%289000%29%3B%0Avar%20app%20%3D%20wamp.attach%28engine%29%3B%0A%60%60%60%0A%0A%23%23%23%20Simple%20RPC%20server%0A%0AThe%20server%20emits%20the%20%60call%60%20event%20when%20an%20RPC%20function%20is%20called.%20Results%20can%20be%20returned%20using%20the%20callback%20parameter.%0A%0A%60%60%60js%0Avar%20wsio%20%3D%20require%28%27websocket.io%27%29%0A%20%20%2C%20wamp%20%3D%20require%28%27wamp.io%27%29%3B%0A%0Avar%20ws%20%3D%20wsio.listen%289000%29%3B%0Avar%20app%20%3D%20wamp.attach%28ws%29%3B%0A%0Aapp.on%28%27call%27%2C%20function%28procUri%2C%20args%2C%20cb%29%20%7B%0A%20%20if%20%28procUri%20%3D%3D%3D%20%27isEven%27%29%20%7B%0A%20%20%20%20cb%28null%2C%20args%5B0%5D%20%25%202%20%3D%3D%200%29%3B%0A%20%20%7D%0A%7D%29%3B%0A%60%60%60%0A%0A%23%23%23%20Simple%20RPC%20client%0A%60%60%60js%0Avar%20when%20%3D%20require%28%27when%27%29%0A%20%20%2C%20wamp%20%3D%20require%28%27wamp.io%27%29%3B%0A%20%20%0Avar%20app%20%3D%20wamp.connect%28%27ws%3A%2F%2Flocalhost%3A9000%27%2C%0A%20%20%20%20%2F%2F%20WAMP%20session%20was%20established%0A%20%20%20%20function%20%28session%29%20%0A%20%20%20%20%7B%0A%20%20%20%20%20%20console.log%28%27new%20wamp%20session%27%29%3B%0A%20%20%20%20%20%20%0A%20%20%20%20%20%20session.call%28%22test%3AisEven%22%2C%202%29%20%20%20%20%20%20%0A%20%20%20%20%20%20%20%20.promise.then%28%0A%20%20%20%20%20%20%20%20%20%20%20%20%2F%2F%20RPC%20success%20callback%0A%20%20%20%20%20%20%20%20%20%20%20%20function%20%28reply%29%0A%20%20%20%20%20%20%20%20%20%20%20%20%7B%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20console.log%28%22result%3A%20%22%20%2B%20reply%29%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%7D%2C%0A%0A%20%20%20%20%20%20%20%20%20%20%20%20%2F%2F%20RPC%20error%20callback%0A%20%20%20%20%20%20%20%20%20%20%20%20function%20%28error%2C%20desc%29%20%0A%20%20%20%20%20%20%20%20%20%20%20%20%7B%20%20%20%20%20%20%20%20%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20console.log%28%22error%3A%20%22%20%2B%20desc%29%3B%0A%20%20%20%20%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%20%20%20%20%29%3B%20%20%20%20%20%20%0A%20%20%20%20%7D%2C%0A%0A%20%20%20%20%2F%2F%20WAMP%20session%20is%20gone%0A%20%20%20%20function%20%28session%29%20%0A%20%20%20%20%7B%0A%20%20%20%20%20%20console.log%28%27wamp%20session%20is%20gone%27%29%3B%0A%20%20%20%20%7D%0A%20%20%29%3B%20%20%0A%60%60%60%0A%0A%0A%23%23%20License%20%0A%0A%28The%20MIT%20License%29%0A%0ACopyright%20%28c%29%202013%20Nico%20Kaiser%20%26lt%3Bnico%40kaiser.me%26gt%3B%0A%0APermission%20is%20hereby%20granted%2C%20free%20of%20charge%2C%20to%20any%20person%20obtaining%0Aa%20copy%20of%20this%20software%20and%20associated%20documentation%20files%20%28the%0A%27Software%27%29%2C%20to%20deal%20in%20the%20Software%20without%20restriction%2C%20including%0Awithout%20limitation%20the%20rights%20to%20use%2C%20copy%2C%20modify%2C%20merge%2C%20publish%2C%0Adistribute%2C%20sublicense%2C%20and%2For%20sell%20copies%20of%20the%20Software%2C%20and%20to%0Apermit%20persons%20to%20whom%20the%20Software%20is%20furnished%20to%20do%20so%2C%20subject%20to%0Athe%20following%20conditions%3A%0A%0AThe%20above%20copyright%20notice%20and%20this%20permission%20notice%20shall%20be%0Aincluded%20in%20all%20copies%20or%20substantial%20portions%20of%20the%20Software.%0A%0ATHE%20SOFTWARE%20IS%20PROVIDED%20%27AS%20IS%27%2C%20WITHOUT%20WARRANTY%20OF%20ANY%20KIND%2C%0AEXPRESS%20OR%20IMPLIED%2C%20INCLUDING%20BUT%20NOT%20LIMITED%20TO%20THE%20WARRANTIES%20OF%0AMERCHANTABILITY%2C%20FITNESS%20FOR%20A%20PARTICULAR%20PURPOSE%20AND%20NONINFRINGEMENT.%0AIN%20NO%20EVENT%20SHALL%20THE%20AUTHORS%20OR%20COPYRIGHT%20HOLDERS%20BE%20LIABLE%20FOR%20ANY%0ACLAIM%2C%20DAMAGES%20OR%20OTHER%20LIABILITY%2C%20WHETHER%20IN%20AN%20ACTION%20OF%20CONTRACT%2C%0ATORT%20OR%20OTHERWISE%2C%20ARISING%20FROM%2C%20OUT%20OF%20OR%20IN%20CONNECTION%20WITH%20THE%0ASOFTWARE%20OR%20THE%20USE%20OR%20OTHER%20DEALINGS%20IN%20THE%20SOFTWARE.', '2013-08-27 17:33:48', '2013-08-27 17:33:48', '', 1, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `CommentText` mediumtext NOT NULL,
  PRIMARY KEY (`CommentId`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Chapter`
--
ALTER TABLE `Chapter`
  ADD CONSTRAINT `Chapter_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
