<?php

$p = $_GET['p'] or die("p is null;");
$b = $_GET['b'] or die("b is null;");
$resource = $_GET['res'] or die("res is null;");
$new_hdesc = ""; 

$tbl = "tbl{$p}_{$b}";

$db = "index";
$q = "select id, hdesc from {$tbl}";
require("script/php/condb.php");

$nALL = [
    "نووسین",
    "نوسین",
    "ئامادە",
    "کەماڵ ڕەحمانی",
    "ئای‌پی",
    "ئای پی"
    ];
while($pm = mysqli_fetch_assoc($query)) {
    $found = false;
    
    foreach($nALL as $nA) {
        if(stristr($pm['hdesc'], $nA))  $found = true;
    }
    
    if($found === false) {
        
        if( empty($pm['hdesc']) ) {
            $new_hdesc = $resource;
        } else {
            $new_hdesc = $pm['hdesc'] . "<br>{$resource}";
        }
        
        $new_hdesc = addslashes($new_hdesc);
        
        $q = "UPDATE `{$tbl}` SET `hdesc`='{$new_hdesc}' WHERE `id`={$pm['id']}";
        if(mysqli_query($conn, $q)) {
            echo "{$pm['id']} => true<br>";
        } else {
            die( "false" );
        }
    }
}

mysqli_close($conn);

?>