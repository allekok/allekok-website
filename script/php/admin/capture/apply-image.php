<?php
require_once("../../constants.php");
require("library.php");

if(file_exists($image_archive_path))
    unarchive($image_archive_path, ABSPATH, true);
?>
