<?php

/* Reading comments in {$uri} file and print them. */

$uri = "res/about.comments";

if(file_exists($uri)) {
    
    $comments = file_get_contents($uri);
    $comments = explode("[comment]",$comments);
    $comments = array_reverse($comments);

    $limit = (false === filter_var(@$_GET['num'],
		   FILTER_VALIDATE_INT)) ? -1 :
	     $_GET['num'];
    $_n = 0;
    foreach($comments as $c) {
        if($_n == $limit) break;
        
        if(!@$_GET["plain"])
	    $c = str_replace("\n", "<br>", $c);
        
        echo $c;
        $_n++;
    }
}

?>
