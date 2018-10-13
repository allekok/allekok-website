<?php

    $ver = $_GET['ver'];
    $pt = $_GET['pt'];
    
    $f = fopen("update-log.txt" , "r");

    while(! feof($f) ) {
        $l = fgets($f);
        $l = json_decode($l);
        if($l->ver > $ver && $pt == $l->poetID ) {
            echo "true";
            break;
        }
    }
    
    fclose($f);

?>