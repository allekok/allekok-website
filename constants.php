<?php

/** Absolute path **/
define("ABSPATH", __DIR__ . "/");

/** Mysql configuration **/
define("_HOST", "localhost");
define("_USER","phpmyadmin");
define("_PASS","1234");
define("_DEFAULT_DB","index");
// default database name without prefix
define("_DB_PREFIX","allekokc_");
// Database prefixes, this constant is used in "condb.php". -> Database name = _DB_PREFIX . $db;

/** Site constants **/
define("_SITE",
       "http://".$_SERVER["HTTP_HOST"]."/");
// could be "https://..."
define("_TITLE","ئاڵەکۆک");
define("_DESC",
       "شێعری شاعیرانی کورد");
define("_KEYS",
       "شیعر,هۆنراوە,کورد,کوردستان,شاعیرانی کورد,هەڵبەست,شعر,کرد,کردستان,شاعر,کوردی,allakok,alakok,alekok,ئاڵەکۆک,allekok,آلکوک,هەڵەکووک,هەڵەکوک");

?>
