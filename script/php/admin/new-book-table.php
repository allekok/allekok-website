<?php
require('session.php');

header("Content-type: text/plain; charset=UTF-8");
echo "GET pt_id, bk_id\n";

$pt_id = @filter_var($_GET['pt_id'], FILTER_VALIDATE_INT) ?
	 $_GET['pt_id'] : die("`pt_id` is not a valid number.\n");
$bk_id = @filter_var($_GET['bk_id'], FILTER_VALIDATE_INT) ?
	 $_GET['bk_id'] : die("`bk_id` is not a valid number.\n");


$tbl_name = "tbl{$pt_id}_$bk_id";
$q = "CREATE TABLE IF NOT EXISTS `{$tbl_name}` (`id` INT(16), `name` TEXT, `hon` TEXT, `hdesc` TEXT, `link` TEXT, `lang` TEXT)";
require("../condb.php");

if($query)
    echo "Table `{$tbl_name}` created successfully.\n";
else
    echo "Table `{$tbl_name}` creating failed.\n";
?>
