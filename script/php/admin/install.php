<?php
/* Just set Constants in 'script/php/constants.php' correctly 
   and run 'php install.php' or navigate to 'install.php' in your browser. */
/* If you need help contact me on telegram: @allekok */

require("../constants.php");

/* Tables */
const MAIN_TABLES = [
	[
		"name" => "auth",
		"columns_str" => "`id` INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `name` TEXT, `takh` TEXT, `profname` TEXT, `hdesc` TEXT, `bks` TEXT, `bksdesc` TEXT, `bks_completion` TEXT, `kind` TEXT"
	],
	[
		"name" => "comments",
		"columns_str" => "`id` INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `address` TEXT, `date` TEXT, `name` TEXT, `comment` TEXT, `read` INT(1), `blocked` INT(1)"
	],
	[
		"name" => "pitew",
		"columns_str" => "`id` INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `contributor` TEXT, `email` TEXT, `poet` TEXT, `book` TEXT, `poem-name` TEXT, `poem-desc` TEXT, `poem` TEXT, `date` TEXT, `status` TEXT, `poetDesc` TEXT"
	]
];

const SEARCH_TABLES = [
	[
		"name" => "poets",
		"columns_str" => "`id` INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `name` TEXT, `takh` TEXT, `profname` TEXT, `hdesc` TEXT, `rtakh` TEXT, `len` INT(16)"
	],
	[
		"name" => "books",
		"columns_str" => "`id` INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `book` TEXT, `book_desc` TEXT, `poet_id` INT(16), `book_id` INT(16), `rbook` TEXT, `rtakh` TEXT, `len` INT(16)"
	],
	[
		"name" => "poems",
		"columns_str" => "`id` INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `name` TEXT, `hdesc` TEXT, `poet_id` INT(16), `book_id` INT(16), `poem_id` INT(16), `poem` TEXT, `poem_true` TEXT, `rname` TEXT, `rbook` TEXT, `rtakh` TEXT, `Cipi` INT(16), `len` INT(16)"
	]
];

/* MySQL Connection */
$sql = mysqli_connect(_HOST, _USER, _PASS);
if(!$sql)
	die("Mysql connection failed. Maybe your username or password is wrong.\n");

/* Database */
$query = "CREATE DATABASE IF NOT EXISTS `" . _DEFAULT_DB . "`";
$result = mysqli_query($sql, $query);
if(!$result)
	die("Mysql database creation failed.\nDatabase:" . _DEFAULT_DB . "\n");

$query = "CREATE DATABASE IF NOT EXISTS `" . _SEARCH_DB . "`";
$result = mysqli_query($sql, $query);
if(!$result)
	die("Mysql database creation failed.\nDatabase:" . _SEARCH_DB . "\n");

/* Tables */
mysqli_select_db($sql, _DEFAULT_DB);
foreach(MAIN_TABLES as $tbl)
{
	$query = "CREATE TABLE IF NOT EXISTS `{$tbl['name']}` ({$tbl['columns_str']}) ENGINE = MyISAM CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
	$result = mysqli_query($sql, $query);
	if(!$result)
		die("Mysql table creation failed.\nDatabase:" .
		    _DEFAULT_DB . "\nTable:{$tbl['name']}\n");
}

mysqli_select_db($sql, _SEARCH_DB);
foreach(SEARCH_TABLES as $tbl)
{
	$query = "CREATE TABLE IF NOT EXISTS `{$tbl['name']}` ({$tbl['columns_str']}) ENGINE = MyISAM CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci";
	$result = mysqli_query($sql, $query);
	if(!$result)
		die("Mysql table creation failed.\nDatabase:" .
		    _SEARCH_DB . "\nTable:{$tbl['name']}\n");
}

mysqli_close($sql);
echo "Done.\n";
?>
