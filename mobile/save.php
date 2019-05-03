<?php
$t = isset($_POST['txt']) ?
     trim(stripslashes(
	 htmlspecialchars(
	     $_POST['txt']))) : die();
if(empty($t)) die();

$f = fopen("QA.txt", "a");
fwrite($f, $t."\nend\n");
fclose($f);
echo "1";
?>
