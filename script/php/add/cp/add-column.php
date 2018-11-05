<?php

$db = "index";
$q = "select id, takh, bks from auth";
require("../../condb.php");

$column_name = "link";


while($pt = mysqli_fetch_assoc($query)) {
    
    echo $pt['takh'] . "<br>";
    
    $pt['bks'] = explode("," , $pt['bks']);
    foreach( $pt['bks'] as $b => $bk ) {
        echo $bk . "<br>";
        $t = $b+1;
        
        $tbl = "tbl{$pt['id']}_{$t}";
        
        $q = "ALTER TABLE `{$tbl}` ADD `{$column_name}` TEXT NOT NULL AFTER `likes`;";
        if(mysqli_query($conn, $q)) {
            echo "true <hr>";
        } else {
            echo "false <hr>";
            die();
        }
    }
}



mysqli_close($conn);

?>