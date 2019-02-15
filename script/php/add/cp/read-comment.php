<?php

if(! (filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) ) {
    
    $id = $_GET['id'];
    
    $db = "index";
    $q = "UPDATE `comments` SET `read`=1 WHERE `id`={$id}";
    require("../../condb.php");
    
    if($query) {
        echo 1;
    }
    
    mysqli_close($conn);
}
?>
