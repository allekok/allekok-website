<?php

include_once("constants.php");
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

$uri = filter_var(@$_GET['uri'],FILTER_SANITIZE_STRING);
$address = explode("/", $uri);

if(count($address) != 3) die();

$db = 'search';
$q = "SELECT C,Cipi,imp FROM poems WHERE poet_address='$address[0]' and book_address='$address[1]' and poem_address='$address[2]'";
include("condb.php");

if(mysqli_num_rows($query)===1) {
    $res = mysqli_fetch_assoc($query);
    $imp = $res['imp'];
    $C = $res['C']+1;
    $Cipi = $C / $imp;
    
    $query = mysqli_query($conn,"UPDATE `poems` SET `C`=$C, `Cipi`=$Cipi WHERE poet_address='$address[0]' and book_address='$address[1]' and poem_address='$address[2]'");

    mysqli_close($conn);
    
    if($query)
        redirect(_SITE.$uri);
}

?>
