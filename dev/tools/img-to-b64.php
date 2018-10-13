<?php
    
    $pt = $_GET['pt'];
    $img = "../../style/img/poets/profile/profile_{$pt}.jpg";
    
    if(! file_exists($img)) {
        $img = "../../style/img/poets/profile/profile_0.jpg";
    }
    
    echo base64_encode(file_get_contents($img));
    

?>