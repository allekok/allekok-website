<?php

    require_once("functions.php");
    
    $_comment = filter_var($_REQUEST['comment'], FILTER_SANITIZE_STRING);

    if(empty($_comment))    die();

    
    $address = isset($_REQUEST['address']) ? explode("/", $_REQUEST['address']) : die('');
    
    $address = array_map("explde", $address);
    
    function explde($in) {
        return explode(":", $in);
    }
    
    $db = 'index';
    $q = 'select id,bks from auth order by id ASC';
    require("condb.php");
    
    if($query) {
        
        if( (mysqli_num_rows($query)+1) >= $address[0][1] ) {
            
            while($res = mysqli_fetch_assoc($query)) {
                
                if($res['id'] == $address[0][1]) {
                    
                    $res['bks'] = explode(',', $res['bks']);
                    if(! (count($res['bks']) >= $address[1][1]) ) {
                        
                        die("");
                    }
                
                }
                
            }
            
            $q = "select id from tbl{$address[0][1]}_{$address[1][1]} where id=$address[2][1]";
            $query = mysqli_query($conn, $q);
            
            if($query) {
                if(! ( mysqli_num_rows($query) > 0 ) ) {
                    
                    die("");
                }
            }
        }
        
    }
    
    $date = date("Y-m-d h:i:sa");
    
    $_date = $date . " " . $_SERVER['REMOTE_ADDR'];
    
    $_name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
    
    $__address = implode(":", $address[0]) . "/" . implode(":", $address[1]) . "/" . implode(":", $address[2]);
    
    
    $q = "INSERT INTO comments(address, date, name, comment) VALUES('$__address', '$_date', '$_name', '$_comment')";
    
    $query = mysqli_query($conn, $q);
    
    if($query) {
        
        $date = num_convert($date, "en", "ckb");
                
        $date = str_replace(["am","pm"], [" بەیانی "," پاش‌نیوەڕۆ "], $date);
        
        if($_name == "")    $_name = "ناشناس";
                
        $res = array(
            "message"=>"",
            "status"=>1,
            "name"=>$_name,
            "comment"=>$_comment,
            "date"=>$date,
            );
            
        echo json_encode($res);
    }
    
    mysqli_close($conn);
    
?>