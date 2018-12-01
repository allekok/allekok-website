<?php
    
    if(!empty($_POST['poet']) && !empty($_POST['poetDesc'])) {
        
        $_cntri = filter_var($_POST['contributor'], FILTER_SANITIZE_STRING);
        $_poet = filter_var($_POST['poet'], FILTER_SANITIZE_STRING);
        $_poetDesc = filter_var($_POST['poetDesc'], FILTER_SANITIZE_STRING);
        
        $_poet = str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_poet);
        $_cntri = $_cntri ? str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_cntri) : $_SERVER['REMOTE_ADDR'];
        
        $_filename = $_cntri . "_" . $_poet . ".txt";
        $_uri = "res/{$_filename}";
        
        $_poetDesc .= "\nend\n";
        
        $f = fopen($_uri, "a");
        fwrite($f, $_poetDesc);
        fclose($f);
        
        echo "ok";
    }

?>