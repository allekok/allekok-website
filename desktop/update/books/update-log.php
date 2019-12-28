<?php

$ver = $_GET['ver'];
$bk = $_GET['bk'];
$pt = $_GET['pt'];

$f = fopen("update-log.txt" , "r");
$ls = [];

while(! feof($f) ) {
    $l = fgets($f);
    $l = json_decode($l);
    if($l->ver > $ver && $bk == $l->bookID && $pt == $l->poetID ) {
        echo "true";
        break;
    }
}

fclose($f);

?>
