<?php
include_once("../../script/php/constants.php");
include_once(ABSPATH . "script/php/functions.php");
include_once(ABSPATH . "script/php/colors.php");

// output: JSON
header("Content-type: application/json; charset=UTF-8");

$pt = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);

if($pt == "all") {
    $k = $_GET['k'];
    if($k == "alive") {
        $k = " WHERE kind='alive'";
    } elseif($k == "dead") {
        $k = " WHERE kind='dead'";
    } elseif($k == "bayt") {
        $k = " WHERE kind='bayt'";
    } else {
        $k = "";
    }
    
    $all = [];
    $db = "index";
    $q = "select id from auth{$k} order by takh ASC";
    include(ABSPATH . "script/php/condb.php");
    
    while($res = mysqli_fetch_assoc($query)) {
        $all[] = get_poet($res['id'], $colors)[0];
    }
    
    echo json_encode($all);
    
    mysqli_close($conn);
    
} else {

    echo get_poet_to_json(get_poet($pt, $colors));

}

function get_poet($pt, $colors) {
    $reses = [];
    $pts = explode(",", $pt);
    
    foreach($pts as $pt) {
        
        if(filter_var($pt, FILTER_VALIDATE_INT)) {
            $q = "SELECT * FROM `auth` WHERE `id`={$pt}";
        } else {
            $q = "SELECT * FROM `auth` WHERE `name`='{$pt}' or `takh`='{$pt}' or `profname`='{$pt}'";
        }
        $db = "index";
        require(ABSPATH . "script/php/condb.php");
        
        if(mysqli_num_rows($query) == 1) {
            $res = mysqli_fetch_assoc($query);
            unset($res['ord']);
            $res['hdesc'] = str_replace("[t]", " : ", $res['hdesc']);
            $res['hdesc']= explode("[n]", $res['hdesc']);
            $res['bks'] = explode(",", $res['bks']);
            $res['bksdesc'] = explode(",", $res['bksdesc']);
            $res['bks_completion'] = explode(",", $res['bks_completion']);
            
            $res['img']['_130x130'] = _SITE . get_poet_image($res['id'], "profile", false);
            $res['img']['_460x460'] = _SITE . get_poet_image($res['id'], "pro460", false);
            
            $res['id'] = intval($res['id']);
            $res['colors'] = $colors[color_num($res['id'])];
            
            $reses[] = $res;
        }
        
        mysqli_close($conn);
        
    }
    
    if(!empty($reses))  return $reses;
    
}

function get_poet_to_json($get_poet) {
    if($get_poet)   return json_encode($get_poet);
}

?>
