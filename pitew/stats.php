<?php
/*
 * Number of poems a contributor wrote.
 * Input: GET:(contributor)
 * Output: TEXT:(Kurdish Number)
 */
include_once("../script/php/constants.php");
include(ABSPATH."script/php/functions.php");

header("Content-type:text/plain; Charset=UTF-8");

$_name = isset($_GET['contributor']) ?
	 filter_var($_GET['contributor'],
		    FILTER_SANITIZE_STRING) : die();

$db = 'index';
$q = "SELECT id FROM pitew WHERE 
contributor='$_name' and status 
LIKE '{\"status\":1%'";
require(ABSPATH."script/php/condb.php");

if($query)
    echo num_convert(mysqli_num_rows($query),"en","ckb");

mysqli_close($conn);
?>
