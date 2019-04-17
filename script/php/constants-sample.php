<?php
/* 
 * Absolute path 
 * eg: /home/user/allekok.com/
 */
define('ABSPATH', '/');

/* Mysql configuration */
define('_HOST', 'localhost');
define('_USER','');
define('_PASS','');
/* Default database name without prefix */
define('_DEFAULT_DB','');
/* Database prefixes, this constant is used
   in 'condb.php'. -> Database_name = _DB_PREFIX . $db; */
define('_DB_PREFIX','');

/* Site constants */
define('_SITE',
       'http://'.@$_SERVER['HTTP_HOST'].'/');
/* Could be 'https://...' */
define('_TITLE','ئاڵەکۆک');
define('_DESC',
       'شێعری شاعیرانی کورد');
define('_KEYS',
       'شیعر,هۆنراوە,کورد,کوردستان,شاعیرانی کورد,هەڵبەست,شعر,کرد,کردستان,شاعر,کوردی,allakok,alakok,alekok,ئاڵەکۆک,allekok,آلکوک,هەڵەکووک,هەڵەکوک');
?>
