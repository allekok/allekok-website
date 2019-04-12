<?php
/* Print the number of poems a 
   contributor wrote and accepted. */

include_once("../script/php/constants.php");
include_once(ABSPATH."script/php/functions.php");

$_name = isset($_GET['contributor']) ?
	 filter_var($_GET['contributor'],
		    FILTER_SANITIZE_STRING) : die();

$db = 'index';
$q = "SELECT id FROM pitew WHERE 
contributor='{$_name}' and status 
LIKE '{\"status\":1%'";
require(ABSPATH."script/php/condb.php");

if($query)
    echo num_convert(mysqli_num_rows($query),"en","ckb");

mysqli_close($conn);
?>
