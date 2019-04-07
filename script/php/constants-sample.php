<?php

/** Absolute path **/
define("ABSPATH", "/");

/** Mysql configuration **/
define("_HOST", "localhost");
define("_USER","");
define("_PASS","");
define("_DEFAULT_DB","");
// default database name without prefix
define("_DB_PREFIX","");
// Database prefixes, this constant is used in "condb.php". -> Database name = _DB_PREFIX . $db;

/** Site constants **/
define("_SITE",
       "http://".@$_SERVER["HTTP_HOST"]."/");
// could be "https://..."
define("_TITLE","ئاڵەکۆک");
define("_DESC",
       "شێعری شاعیرانی کورد");
define("_KEYS",
       "شیعر,هۆنراوە,کورد,کوردستان,شاعیرانی کورد,هەڵبەست,شعر,کرد,کردستان,شاعر,کوردی,allakok,alakok,alekok,ئاڵەکۆک,allekok,آلکوک,هەڵەکووک,هەڵەکوک");

?>
