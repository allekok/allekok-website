<?php

// before including this file. $db and $q have to be declared.
// $db = "database name without prefix(=_DB_PREFIX)"
// $q = "sql query string"

require_once("constants.php");

if(!isset($db)) $db=_DEFAULT_DB;

$conn = mysqli_connect(_HOST, _USER, _PASS) or die("mysql connection error. maybe user/password is wrong.");

mysqli_select_db($conn, _DB_PREFIX . $db);

mysqli_set_charset($conn,"utf8");

// running sql query
$query = mysqli_query($conn, $q);

?>
