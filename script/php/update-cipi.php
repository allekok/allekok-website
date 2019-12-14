<?php
include_once('constants.php');
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

$uri = @filter_var($_GET['uri'],FILTER_SANITIZE_STRING);
$address = explode('/', $uri);
if(count($address) != 3) die();
foreach($address as $i=>$ad)
{
    $address[$i] = intval(explode(":",$ad)[1]);
}

$db = _SEARCH_DB;
$q = "SELECT Cipi FROM poems WHERE 
poet_id='$address[0]' and book_id='$address[1]' and poem_id='$address[2]'";
include("condb.php");

if(mysqli_num_rows($query)===1)
{
    $res = mysqli_fetch_assoc($query);
    $Cipi = $res['Cipi']+1;
    
    $query = mysqli_query($conn,"UPDATE `poems` SET 
`Cipi`=$Cipi WHERE poet_id='$address[0]' and 
book_id='$address[1]' and poem_id='$address[2]'");

    mysqli_close($conn);
    
    // if($query)
    redirect(_SITE.'/'.$uri);
}
?>
