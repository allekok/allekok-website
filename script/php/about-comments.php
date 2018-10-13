<?php

/// *** Reading comments in {$uri} file and print them.

$uri = "res/about.comments";

if($fs = filesize($uri)) {

    $f = fopen($uri, "r");
    
    $content = fread($f,$fs);
    $conts = explode("[comment]",$content);
    $conts = array_reverse($conts);
    if( false == filter_var($_GET['num'], FILTER_VALIDATE_INT) )    $_GET['num'] = -1;    
    $_n = 0;
    foreach($conts as $c) {
        if($_n == $_GET['num']) break 1;
        
        $c = str_replace("\n", "<br>", $c);
        
        echo $c;
        $_n++;
    }
    
    fclose($f);
}
?>