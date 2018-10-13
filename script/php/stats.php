<?php

/// Connect to database.
    $db="index";
    $q= "select * from stats";
    require("condb.php");

    $rrr = mysqli_fetch_assoc($query);
    mysqli_close($conn);

    $aths_num = $rrr['aths_num'];
    // $bks_num = $rrr['bks_num'];
    $hons_num = $rrr['hons_num'];
    
    $respond = array(

        "poets-num"=>$aths_num,
        "poems-num"=>$hons_num
    );
    
    $respond = json_encode($respond);
    
    header("Content-Type: application/json; charset=UTF-8");

    echo($respond);
?>