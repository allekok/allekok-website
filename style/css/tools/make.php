<?php
exec('php tools/compress.php');
echo "`compress` Done.\n";

exec("php tools/update_ver.php");
echo "`update_ver` Done.\n";
?>
