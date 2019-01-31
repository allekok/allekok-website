<?php
include_once("../../../constants.php");

$exec = "cd " . ABSPATH . " && php -S localhost:8080";

exec($exec);
?>
