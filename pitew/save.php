<?php
/*
 * Save comments on poets came from 'edit-poet.php'.
 * Input: POST:(poet,poetDesc,contributor)
 * Output: TEXT:('','ok')
 */
if(isset($_POST['poet']) and isset($_POST['poetDesc']))
{
    require_once("../script/php/constants.php");
    require(ABSPATH."script/php/functions.php");

    header("Content-type:text/plain; Charset=UTF-8");
    
    $_cntri = @filter_var($_POST['contributor'], FILTER_SANITIZE_STRING);
    $_poet = filter_var($_POST['poet'], FILTER_SANITIZE_STRING);
    $_poetDesc = trim(filter_var($_POST['poetDesc'], FILTER_SANITIZE_STRING));
    
    $_poet = str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_poet);
    $_cntri = $_cntri ?
	      str_replace(["/","\\",":","*","?","|","\"","<",">"],"",$_cntri) :
	      $_SERVER['REMOTE_ADDR'];
    $_filename = $_cntri . "_" . $_poet . ".txt";
    $_uri = "res/$_filename";
    
    $_poetDesc .= "\nend\n";
    
    $f = fopen($_uri, "a");
    fwrite($f, $_poetDesc);
    fclose($f);
    
    echo "ok";

    list_dir(ABSPATH.'pitew/res');
}
?>
