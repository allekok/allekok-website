<?php
require_once(dirname(dirname(dirname(__DIR__)))."/script/php/functions.php");
echo isset($_POST['txt']) ?
     save_QA($_POST['txt']) : die();
?>
