<?php
require_once("../../../script/php/functions.php");
echo isset($_POST['txt']) ?
     save_QA($_POST['txt']) : die();
?>
