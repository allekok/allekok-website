<?php
require('session.php');
if(! (filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) ) {
    
    $id = $_GET['id'];
    
    $q = "UPDATE `comments` SET `blocked`=1, `read`=1 WHERE `id`={$id}";
    require("../condb.php");
    
    if($query) {
        echo 1;
    }
    
    mysqli_close($conn);
}
?>
