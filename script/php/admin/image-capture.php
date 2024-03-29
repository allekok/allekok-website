<?php
require("session.php");
require("image-library.php");

$resources = [
	"last-update.txt",
	"pitew/news.txt",
	"pitew/QA.txt",
	"pitew/res/",
	"about/comments.txt",
	"desktop/QA.txt",
	"desktop/update/index/",
	"desktop/update/imgs/",
	"desktop/update/books/",
	"dev/tools/QA.txt",
	"dev/tools/CONTRIBUTING/QA.txt",
	".htaccess",
	"script/php/admin/.htaccess",
	"script/php/constants.php",
	"script/php/admin/IP-blacklist.php",
	"script/php/admin/password.php",
	"style/img/poets/new/",
];
$ignore = [".", "..", "README.md", "update-log.php"];

if(file_exists($image_dir_path))
	remove_dir($image_dir_path);
if(file_exists($image_archive_path))
	unlink($image_archive_path);

foreach($resources as $path) {
	$from = "../../../$path";
	$to = "$image_dir_path/$path";
	
	if(is_dir($from)) {
		copy_dir($from, $to);
	}
	elseif(file_exists($from)) {
		if(!file_exists(dirname($to)))
			mkdir(dirname($to), 0755, true);
		copy($from, $to);
	}
}

archive($image_dir_path, $image_archive_path);

remove_dir($image_dir_path);
?>
