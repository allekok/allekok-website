<?php
/* ABSOLUTE PATH, eg: '/home/allekok.com/' */
const ABSPATH = '/';

/* MYSQL */
const _HOST = 'localhost';
const _USER = '';
const _PASS = '';
/* Default database name without prefix */
const _DEFAULT_DB = '';
/* Database prefix, this constant is used
   in 'condb.php'. -> Database_name = _DB_PREFIX . $db; */
const _DB_PREFIX = '';

/* WEBSITE */
/* Could be 'https://' */
define('_SITE', 'http://' . @$_SERVER['HTTP_HOST']);
const _TITLE = 'ئاڵەکۆک';
const _DESC = 'شێعری شاعیرانی کورد';
const _KEYS = 'ئاڵەکۆک,شێعر,شاعیر,بەیت,چیرۆک,هەڵبەست,شیعر,کورد,کوردستان';
?>
