<?php
    
    require_once("../script/php/functions.php");
    header("Content-Type: application/json; charset=UTF-8");
    $new = 1;
    $_id = $_id2 = $_id3 = $img = 0;
    
    if(!empty($_GET['poet'])) {
        
        $_poet = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);
        
        $db = "search";
        $q = "select id, name, takh, profname from poets order by rtakh ASC";
        require("../script/php/condb.php");
        
        while($res = mysqli_fetch_assoc($query)) {
            $_poet = san_data($_poet);
            
            if( $res['takh'] == $_poet ) {
                
                $_id = $res['id'];
                $new=0;

                break 1;
            }
            
            if( $res['profname'] == $_poet ) {
                
                $_id2 = $res['id'];
                $new=0;

                //break 1;
            }
            
            if( stristr($res['name'], $_poet) ) {
                
                $_id3 = $res['id'];
                $new=0;

                //break 1;
            }
        }
        
        if( $_id === 0 && $_id2 !== 0 )
        {
            $_id = $_id2;
        }
        elseif( $_id === 0 && $_id2 === 0 )
        {
            $_id = $_id3;
        }
        
        mysqli_close($conn);
    } else {
        $new=0;
    }
    
    if(file_exists("../style/img/poets/profile/profile_{$_id}.jpg")) {
        $img = $_id;
    }
    
    $_res = [
        "new"=>$new,
        "id"=>$_id,
        "img"=>$img,
        ];
        
    echo json_encode($_res);

?>