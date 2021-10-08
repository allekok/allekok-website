<?php
$image_dir = "image";
$image_archive = "image.tar";
$image_dir_path = "capture/$image_dir";
$image_archive_path = "capture/$image_archive";

function remove_dir($path) {
	global $ignore;
	$files = array_diff(scandir($path), $ignore);
	foreach($files as $f) {
		if(is_dir("$path/$f"))
			remove_dir("$path/$f");
		else
			unlink("$path/$f");
	}
	rmdir($path);
}
function copy_dir($from, $to) {
	global $ignore;
	$files = array_diff(scandir($from), $ignore);
	
	if(!is_dir($to))
		mkdir($to, 0755, true);

	foreach($files as $f) {
		copy($from . $f, $to . $f);
	}
}
function archive($from_dir, $to_archive) {
	$phar = new PharData($to_archive);
	$phar->buildFromDirectory($from_dir);
}
function unarchive($archive_path, $to, $overwrite) {
	$phar = new PharData($archive_path);
	$phar->extractTo($to, null, $overwrite);
}
?>
