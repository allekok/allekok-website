<?php

    require_once("../constants.php");
    require_once("../functions.php");
    

    $_id = !(filter_var($_GET['id'], FILTER_VALIDATE_INT)===false) ? $_GET['id'] : die();
    
    $q = "select id, name, takh, hdesc, bks, kind from auth where id=$_id";
    $db = "index";
    
    require_once("../condb.php");
    
    if(mysqli_num_rows($query) === 1) {
        $res = mysqli_fetch_assoc($query);
        $res['img'] = get_poet_image($res['id'], "pro-460", 1);
        
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($res);
    }
    
    mysqli_close($conn);

?>