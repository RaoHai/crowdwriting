-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2013 at 06:14 PM
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
(45, 'ç©·é€¼å°±åˆ«åŽ»å¤é•‡äº†', 'æ¯ä¸ªå¤é•‡éƒ½æµä¼ ç€è¿™æ ·ä¸€ä¸ªä¼ è¯´ï¼ŒæŸäººä»Žç¹åŽçš„å¤§éƒ½å¸‚æ¼«æ­¥åˆ°ä¸½æ±Ÿ(å‡¤å‡°/è¥¿å¡˜/ä¹Œé•‡)è¢«è¿™é‡Œçš„ç¾Žæ™¯å’Œç¼“æ…¢çš„èŠ‚å¥æ‰“åŠ¨ï¼Œä¾¿è¾žæŽ‰äº†å¹´è–ªç™¾ä¸‡(åä¸‡/åƒä¸‡)çš„å·¥ä½œï¼Œç•™åœ¨å¤é•‡ï¼Œæ´—ç»ƒå†…å¿ƒï¼Œè¿½å¯»ç”Ÿæ´»çš„çœŸæ„ã€‚\n\näºŽæ˜¯å¤§æ‰¹ç¹åŽåŸŽå¸‚(é©»é©¬åº—/èæ³½/å‘¨å£)çš„æˆåŠŸé’å¹´(å¹´è–ªè¿‡ä¸‡/ä¸¤ä¸‡)çº·çº·èµ°å‘å¤é•‡ï¼ŒåŠŸååˆ©ç¦„å…¨æ”¾ä¸‹ï¼Œåªä¸ºå¯»æ‰¾ç”Ÿæ´»çš„çœŸæ„ï¼Œä»–ä»¬æŠ«ç€25å—é’±ä¸€ä»¶çš„æ°‘æ—é£ŽæŠ«è‚©ï¼Œæ‘‡æ›³ç€30å—é’±ä¸€æ¡çš„æ°‘æ—é£Žé•¿è£™ï¼Œç©¿ç€75å—é’±ä¸€åŒçš„åŒ¡å¨ä¸ç©¿è¢œå­çš„èµ°åœ¨1990å¹´ä»£çš„çŸ³æ¿è·¯ä¸Šï¼Œå¬ç€ding~da~ling~da~ling~da~ling~daçœ‹å°é›¨æ‹æ‰“ç€æ°´èŠ±ï¼Œä»–ä»¬æ¥è¿‡å°±ä¸æ›¾ç¦»å¼€ï¼Œä»–ä»¬åœ¨ä¸½æ±Ÿç­‰ä½ ï¼Œä»–ä»¬ç§å¥”åŽ»å‡¤å‡°ï¼Œä»–ä»¬åœ¨å’–å•¡é¦†å¿ƒä¸åœ¨ç„‰çš„ç¿»é˜…å’–å•¡é¦†é‡Œçš„ä¸ƒå ‡å¹´è½è½å®‰å¦®å®è´ï¼Œçœ¼ç¥žæš§æ˜§çš„å·¦é¡¾å³ç›¼ã€‚\n\nçº¦ç‚®åœ¨è¿™é‡Œä¼šé«˜é›…æˆè‰³é‡ï¼Œç¡äº†ä¸€ä¸ªæ™®é€šäººåœ¨è¿™é‡Œä¼šå˜æˆâ€œä¸Žä¸€ä¸ªæµ·è—»é•¿å‘/é’è‰å‘³é¦™æ°´çš„å¥³å­/ç”·å­çš„ä¸€æ®µçº è‘›â€ï¼Œå†éš¾åƒçš„é¥­åœ¨è¿™é‡Œéƒ½æˆäº†ç¾Žå‘³ä½³è‚´ï¼Œæœ¨å¤´æ™ƒæ™ƒæ‚ æ‚ æ‘‡æ‘‡æ¬²å çš„ç ´æ—…é¦†æ”¹åå«å®¢æ ˆä¹‹åŽå°±æ–‡è‰ºæ¸…æ–°äº†è®¸å¤šï¼Œä»–ä»¬ä¼šå½¢å®¹è¿™é‡Œâ€œæœ¨å¤´çš„è´¨æ„Ÿé€éœ²ç€æ—¶å…‰çš„æ°”æ¯â€ï¼Œå’–å•¡é¦†é‡Œé€Ÿæº¶çš„å’–å•¡éƒ½è¢…è¢…å‡ºæ³•å›½çš„å‘³é“ï¼Œé—®ä¸ªè·¯äººç»™ä½ æŒ‡å¯¹äº†é‚£éƒ½æ˜¯å› ä¸ºâ€œå¤é•‡æ°‘é£Žçº¯æœ´â€å°±å¥½åƒä»–åœ¨å¤–è¾¹åˆ«äººç»™ä»–æŒ‡çš„è·¯éƒ½æ˜¯é”™çš„ä¸€æ ·ã€‚\n\nåˆ°ä»–ä»¬å›žæ¥çš„æ—¶å€™ï¼Œé‚£ä¸€å®šæ˜¯ä¸ªä¸ä¸€æ ·çš„è„¸ï¼Œå¦‚æžœä½ é—®ï¼Œä»–ä»¬ä¼šè¯´çµé­‚æš‚æ—¶å¯„æ‰˜åœ¨å¤é•‡äº†ï¼Œå®ƒè¿˜æ²¡æœ‰å›žæ¥ã€‚å…¶å®žä»–ä»¬ç•™åœ¨é‚£å„¿çš„ä¸è¿‡æ˜¯ä¸€äº›ç”¨è¿‡çš„å®‰å…¨å¥—ã€å‡ å£°å˜¶å¼ã€ä¸€äº›çŽ°é‡‘ã€‚ä»–ä»¬æ‹æ‘„å¤é•‡è¡—å¤´çš„ä¸€åªçŒ«ï¼Œå¥½åƒè¿™è¾ˆå­æ²¡æœ‰è§è¿‡çŒ«ä¸€æ ·ï¼Œå‘åœ¨å¾®åšä¸Šä¸€å®šæ˜¯â€œå¤é•‡ç¼“æ…¢çš„èŠ‚å¥ï¼Œè¿žçŒ«éƒ½å˜å¾—æ…µæ‡’â€å°±å¥½åƒæ­¤å‰ä»–ä»¬ä¸çŸ¥é“æ¯å¤©ç¡çœ 10å°æ—¶çš„çŒ«éƒ½æ‡’çš„æƒŠäººä¸€æ ·ï¼›ä»–ä»¬åŽ»é…’å§å¬ä¸å…¥æµæ­Œæ‰‹å”±ç½‘ç»œæ­Œæ›²ï¼Œå¥½åƒæ­¤å‰æ²¡æœ‰å¬è¿‡ç½‘ç»œæ­Œæ›²ä¸€æ ·ï¼›æ»¡å¤§è¡—çš„è“èŽ²èŠ±æ›¾ç»çš„ä½ ä»–ä»¬è¯´ï¼Œé‚£æ˜¯å¿ƒåº•çš„å£°éŸ³ï¼Œå°±åƒåŽŸå”±æ²¡é•¿å¿ƒä¸€æ ·ï¼›å¦‚æžœæ˜¯ç¬¬äºŒæ¬¡åŽ»å¤é•‡ï¼Œä»–ä»¬ä¼šç”¨â€œå›žâ€è¿™ä¸ªè¯ï¼Œå°±åƒè¿™æ˜¯ä»–ä»¬çš„å®¶ä¹¡ï¼Œä»–çš„å®¶ä¹¡æ²¡æœ‰éœ“è™¹ç¯ï¼\n\næ¯ä¸ªå¤é•‡çš„å¤§è¡—éƒ½ä¸€è¡—çš„ç©·é€¼ï¼Œä¸¢ä¸ªç‚¸å¼¹ç‚¸æ­»çš„æ— ä¸€ä¾‹å¤–ç©·é€¼ï¼Œé€®ä¸ªæŠ«ç€æŠ«é£Žçš„ä¸€é¡¿ææžœæ–­æ˜¯ä¸ªç©·é€¼ï¼Œæ‹‰ä¸ªæ‹Žå•åçš„ä¸€é¡¿è¸¹æžœæ–­åˆæ˜¯ç©·é€¼ï¼Œä½†ä»–ä»¬ä¼šå‘Šè¯‰ä½ ä»–ä»¬ä¸æ˜¯ç©·é€¼ï¼Œä»–ä»¬æ˜¯èµ°å†…å¿ƒï¼Œä»–ä»¬å¯»æ‰¾ç”Ÿä¹‹å®‰ç¨³ï¼Œå¦‚åŒèŽ²èŠ±ï¼Œä»–ä»¬è¯´åŽŒå€¦äº†éƒ½å¸‚çš„èŠ‚å¥ï¼Œä»–ä»¬æ¸´æœ›åœ¨è¿™é‡Œå®‰ç¨³ç¼“æ…¢ã€‚\n\nå…¶å®žè°ä¸çŸ¥é“ï¼Œæ‰€è°“çš„å¤é•‡ï¼Œä¸è¿‡æ˜¯ä¸ªå¤§æ¸¸ä¹åœºï¼Œæ²¡æœ‰åŽ‹åŠ›ï¼Œæ‰€æœ‰å‘ç”Ÿçš„äº‹æƒ…éƒ½è·Ÿä½ æ— å…³ï¼Œé™¤äº†åƒå–çŽ©ä¹å•¥éƒ½æ²¡æœ‰ï¼Œé™¤äº†é†‰ç”Ÿæ¢¦æ­»ä»€ä¹ˆéƒ½ä¸åšï¼Œè¿™æ ·çš„çŽ¯å¢ƒä¸‹å†æœ‰åŽ‹åŠ›çš„é‚£å°±æ˜¯å¼ºè¿«ç—‡äº†å§ï¼Ÿä½†ç©·é€¼æ€»æ˜¯æœ‰ç†çš„ï¼Œç©·é€¼ä¼šè¯´ï¼Œä½ çœ‹åˆ°çš„éƒ½æ˜¯è‚¤æµ…çš„è¡¨é¢ï¼Œä½ æ²¡æœ‰çœ‹åˆ°å¤é•‡æœ¬è´¨çš„ä¸œè¥¿ï¼Œå®ƒåœ¨æ­ç¤ºç”Ÿæ´»æœ€æœ¬çœŸçš„ä¸€é¢ï¼Œå‘Šè¯‰ä½ åœä¸‹æ¥ç­‰ä¸€ç­‰ä½ çš„çµé­‚ã€‚\n\nä½†çµé­‚æ˜¯loserçš„ï¼Œè¯´çš„å†é«˜é›…é‚£ä¹Ÿæ˜¯loserã€‚\n\næˆ‘å¸‚æœ‰ä¸ªä¸‰è§‚å¥‡ç‰¹çš„ä¸»æŒäººï¼Œä¼ è¯´æ›¾æœ‰ä¸å°‘äººå‡†å¤‡é›‡å‡¶æä»–ï¼Œä½†æˆ‘å¾ˆå–œæ¬¢ä»–æœ´å®žçš„è§‚ç‚¹ã€‚æœ‰æ­¤è¯¥ä¸»æŒäººæŽ¥åˆ°ä¸€ä¸ªç”µè¯ï¼Œæ˜¯ä¸ªå¤±æ„çš„ç”·å¬ä¼—æ‰“æ¥çš„ï¼Œè¿™äººè¯´ï¼šâ€œä¸»æŒäººæˆ‘æƒ³è·Ÿä½ å’¨è¯¢ä¸ªé—®é¢˜ï¼Œæˆ‘å¥³æœ‹å‹å«Œæˆ‘ç©·é€¼è¦è·Ÿæˆ‘åˆ†æ‰‹ï¼Œæˆ‘è¯¥å’‹åŠžï¼Ÿâ€\n\nä¸»æŒäººè¯´ï¼šâ€œé‚£ä½ åˆ°åº•ç©·é€¼ä¸ç©·é€¼ï¼Ÿâ€\n\nç”·å¬ä¼—ï¼šâ€œæˆ‘è§‰å¾—æˆ‘æŒ£å¾—å¯ä»¥å•Šã€‚â€\n\nä¸»æŒäººï¼šâ€œä½ ä¸€ä¸ªæœˆè–ªæ°´å¤šå°‘ï¼Ÿâ€\n\nç”·å¬ä¼—ï¼šâ€œå¹³å‡ä¹Ÿå°±æ˜¯1800å·¦å³å§ã€‚â€\n\nä¸»æŒäººï¼šâ€œä½ å·¥èµ„è¿™ä¸ªæ•°ï¼Œé‚£ä½ æœ‰æ²¡æœ‰å‰¯ä¸šï¼Ÿâ€\n\nç”·å¬ä¼—ï¼šâ€œæ²¡æœ‰ã€‚â€\n\nä¸»æŒäººï¼šâ€œä½ å·¥ä½œæ˜¯æœä¹æ™šäº”å—ï¼Ÿä½ ä¸‹ç­åŽæœ‰ä»€ä¹ˆä¸šä½™æ´»åŠ¨ï¼Ÿâ€\n\nç”·å¬ä¼—ï¼šâ€œå¯¹å•Šï¼Œæˆ‘å·¥ä½œæ˜¯æœä¹æ™šäº”ï¼Œæˆ‘ä¸šä½™æ´»åŠ¨å–œæ¬¢æ—…æ¸¸ï¼Œæˆ‘å–œæ¬¢è¿œè¶³ï¼Œåˆ°å‘¨è¾¹çš„é‡Žå±±åŽ»äº²è¿‘è‡ªç„¶......â€\n\nä¸»æŒäººï¼šâ€œä½ è¿™ç§æƒ…å†µï¼Œä½ å°±ä¸è¦çƒ­çˆ±è‡ªç„¶äº†ï¼Œä½ å¹³å¸¸çš„æ´»åŠ¨è¯¥æ˜¯ä»€ä¹ˆä½ çŸ¥é“å—ï¼Ÿä½ åˆ°å’±ä»¬å¸‚æ¯”è¾ƒå¤§çš„å•†åœºåŽ»è½¬æ‚ ï¼Œä¸‹ç­ä½ å°±åŽ»è½¬æ‚ ï¼Œå¤šåŽ»æŽ¥è§¦å•†ä¸šç¤¾ä¼šçŸ¥é“å—ï¼Ÿæ³¨æ„çœ‹é‚£äº›å•†å“çš„æ ‡ä»·........å¥½äº†ï¼Œæˆ‘ä»¬æ¥æŽ¥å¬ä¸‹ä¸€ä½å¬ä¼—â€\n\nè¿™æœŸèŠ‚ç›®è¿‡åŽ»ä¸¤å¹´äº†ï¼Œä½†æˆ‘ä¸æ—¶å°±ä»Žè„‘å­˜å‚¨é‡Œæå–å‡ºæ¥é‡æ¸©ä¸€éï¼Œå“ªå¤©ç¢°è§å¤é•‡é€¼æˆ‘å°±æƒ³ä»Žè„‘å­é‡Œæå–å‡ºæ¥ç»™ä»–æ»šåŠ¨æ’­æ”¾ä¸€éï¼Œç©·é€¼å°±åˆ«åŽ»å¤é•‡äº†ï¼Œloseräº‘é›†çš„åœ°æ–¹åªä¼šè®©ä½ æ›´loserï¼Œè¿˜æ˜¯åŽ»çœ‹ä¸‹å¤§ç±³å¤šé’±ä¸€æ–¤ï¼Œçœ‹ä½ è¿˜èƒ½ä¸èƒ½åƒå¾—èµ·å§', '2013-09-03 14:11:51', '2013-09-03 14:11:51', '', 1, '2013-09-03 14:11:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentId` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ChapterId` int(10) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `CommentText` mediumtext NOT NULL,
  PRIMARY KEY (`CommentId`),
  KEY `UserId` (`UserId`),
  KEY `ChapterId` (`ChapterId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`CommentId`, `UserId`, `ChapterId`, `CreateTime`, `CommentText`) VALUES
(1, 1, 26, '2013-09-02 00:00:00', 'Test Comment'),
(2, 1, 26, '2013-09-03 13:57:41', 'æµ‹è¯•è¯„è®º');

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
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`),
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`ChapterId`) REFERENCES `Chapter` (`ChapterId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
