<?php

$t = htmlspecialchars($_POST['txt']);
$t = stripslashes($t);
if(empty($t))   die();

$f = fopen("QA.txt", "a");
fwrite($f, $t . "\nend\n");
fclose($f);

echo "1";

?>
