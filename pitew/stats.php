<?php

    require_once("../script/php/functions.php");

    if(isset($_GET['contributor'])) {
        
        $_name = filter_var($_GET['contributor'], FILTER_SANITIZE_STRING);

        $db = 'index';
        $q = "SELECT * FROM pitew WHERE contributor='{$_name}' and status LIKE '{\"status\":1%'";
        require("../script/php/condb.php");
        
        if( mysqli_num_rows($query) > 0 ) {
            
            echo num_convert(mysqli_num_rows($query),"en","ckb");
        }
    }

?>