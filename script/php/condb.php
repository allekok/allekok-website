<?php
/*
 * Before including this file. $db and $q have to be declared.
 * $db = "database name without prefix(=_DB_PREFIX)"
 * $q = "sql query string"
 */
require_once("constants.php");

if(! @$q)
    die();
if(! @$db)
    $db=_DEFAULT_DB;

$conn = mysqli_connect(_HOST, _USER, _PASS) or die();
mysqli_select_db($conn, _DB_PREFIX . $db);
mysqli_set_charset($conn,"utf8");
$query = mysqli_query($conn, $q);
?>
