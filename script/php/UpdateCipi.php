<?php


require_once("constants.php");
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

$address = explode("/",filter_var($_GET['uri'],FILTER_SANITIZE_STRING));

    $db = 'search';
	$q = "SELECT * FROM poems WHERE poet_address='$address[0]' and book_address='$address[1]' and poem_address='$address[2]'";
	require("condb.php");
    
    if(mysqli_num_rows($query)==1) {
        $res = mysqli_fetch_assoc($query);
        $id = $res['id'];
        $imp = $res['imp'];
        $C = $res['C']+1;
        $Cipi = $C / $imp;
        
        $query = mysqli_query($conn,"UPDATE `poems` SET `C`=$C, `Cipi`=$Cipi WHERE poet_address='$address[0]' and book_address='$address[1]' and poem_address='$address[2]'");
        
        if($query) {
            
            redirect(_SITE.$_GET['uri']);
        }
    }
    
    mysqli_close($conn);

?>