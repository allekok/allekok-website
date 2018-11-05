<?php
    
    $res = $_GET['res'] or die();
    
    $res_uri = "res/{$res}";
    
    if(! file_exists($res_uri) )    die("{$res_uri} does not exists.");
    
    $f = fopen($res_uri , "r");
    $read = fread($f , filesize($res_uri));
    
    $read = explode("\n" , $read);
    $content = [];
    foreach($read as $r) {
        $content[] = json_decode($r, true);
    }
    
    fclose($f);
    
    $pb = explode("_" , $res);
    
    $p = $pb[0]; $b = $pb[1];
    
    $tbl = "tbl{$p}_{$b}";
    $db = "index";
    
    foreach($content as $c) {
        
        //if($c['v'] != "") {   
        
            $c['c'] = $c['c'][0] + $c['c'][1] + $c['c'][2] + $c['c'][3];
        
            $link = "ڤەژین بوکس[t]{$c['v']}[t]{$c['c']}";
            
            if($c['v'] == "")   $link="";

            $q = "UPDATE {$tbl} SET link='{$link}' WHERE id={$c['m']}";
            require("../../../condb.php");
            
            if($query) {
                echo "{$c['m']}\n";
            }
            else {
                die("false");
            }
            
        //}
        
    }
    
    mysqli_close($conn);

?>