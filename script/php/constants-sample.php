<?php
/* Absolute path, eg: '/home/allekok.com/' */
const ABSPATH = '/';

/* Include translation tools */
include_once(ABSPATH . 'Ps/init.php');

/* MySQL */
const _HOST = 'localhost';
const _USER = '';
const _PASS = '';
/* Databases */
const _DEFAULT_DB = 'allekok_main';
const _SEARCH_DB = 'allekok_search';

/* Website */
/* Relative path to web server's root */
const _R = '/';
/* Could be 'https://' */
define('_SITE', 'http://' . @$_SERVER['HTTP_HOST']);
$_TITLE = SP("title");
$_DESC = SP("desc");
$_KEYS = SP("keys");
?>
