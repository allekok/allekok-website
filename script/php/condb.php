<?php

require_once("constants.php");

$conn = mysqli_connect(_HOST, _USER, _PASS) or die();

mysqli_select_db($conn,"allekokc_" . $db);

mysqli_set_charset($conn,"utf8");

$query = mysqli_query($conn, $q);

?>
