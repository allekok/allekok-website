<?php

    require_once("../script/php/functions.php");

    header("Content-Type: application/json; charset=UTF-8");
    
    $n = filter_var($_GET['n'], FILTER_VALIDATE_INT) ? $_GET['n'] : 50;
    
    $db = 'index';
    $q = "select * from comments where blocked=0 order by id DESC LIMIT 0, {$n}";
    
    require("../script/php/condb.php");
    
    if($query) {

        if(mysqli_num_rows($query)>0) {
            
            $comms = array();
            while($res = mysqli_fetch_assoc($query)) {
                
                if($res['name'] == "") {
                    $res['name'] = "ناشناس";
                }
                
                $res['pt'] = substr($res['address'],5,strpos($res['address'], "/")-5);
                $res['comment'] = str_replace("\n", "<br>\n", $res['comment']);
                $res['date'] = explode(" ", $res['date']);
                $res['date'] = $res['date'][0] . " " . $res['date'][1];
                $res['date'] = num_convert($res['date'], "en", "ckb");
                
                $res['date'] = str_replace(["am","pm"], [" بەیانی "," پاش‌نیوەڕۆ "], $res['date']);
                unset($res['read']);
                unset($res['blocked']);
                

                $comms[] = $res;
                
            }
            

            foreach($comms as $b => $r) {
                $r['naddress'] = explode('/', $r['address']);
                for($a = 0; count($r['naddress'])> $a; $a++) {
                    
                    $r['naddress'][$a] = explode(":", $r['naddress'][$a]);
                    
                }
                
                $q = "select takh from auth where id={$r['naddress'][0][1]}";
                $query = mysqli_query($conn, $q);
                $r['ptn'] = mysqli_fetch_assoc($query)['takh'];
                
                $q = "select name from tbl{$r['naddress'][0][1]}_{$r['naddress'][1][1]} where id={$r['naddress'][2][1]}";
                $query = mysqli_query($conn, $q);
                $r['pmn'] = mysqli_fetch_assoc($query)['name'];
                unset($r['naddress']);
                $comms[$b] = $r;
            }
            
            echo json_encode($comms);
        } else {
            echo json_encode(["err"=>1]);
        }
    }
    
    mysqli_close($conn);
    
?>
