<?php
require_once("session.php");
require_once("image-library.php");

if(file_exists($image_archive_path))
	unarchive($image_archive_path, "../../../", true);
?>
