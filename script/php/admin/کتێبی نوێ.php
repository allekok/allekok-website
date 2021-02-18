<?php
require('session.php');

header("Content-type: text/plain; charset=UTF-8");
echo "GET pt, bk\n";

$pt = @filter_var($_GET['pt'], FILTER_VALIDATE_INT) ?
      $_GET['pt'] : die("`pt` is not a valid number.\n");
$bk = @filter_var($_GET['bk'], FILTER_VALIDATE_INT) ?
      $_GET['bk'] : die("`bk` is not a valid number.\n");


$tbl_name = "tbl{$pt}_$bk";
$q = "CREATE TABLE IF NOT EXISTS `{$tbl_name}` (`id` INT(16) PRIMARY KEY, `name` TEXT, `hon` TEXT, `hdesc` TEXT, `link` TEXT, `lang` TEXT, `tag` TEXT) ENGINE = MyISAM CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
require("../condb.php");

if($query)
	echo "Table `{$tbl_name}` created successfully.\n";
else
	echo "Table `{$tbl_name}` creating failed.\n";
?>
