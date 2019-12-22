<?php
/*
 * Fetch comments from 'comments' table.
 * Input: GET:(address)
 * Output: JSON
 */
require_once('constants.php');
include(ABSPATH.'script/php/functions.php');

header("Content-Type: application/json; charset=UTF-8");
$address = isset($_GET['address']) ?
	   filter_var($_GET['address'], FILTER_SANITIZE_STRING) :
	   die(json_encode(['err'=>1]));

$q = "select date,name,comment from comments where address='$address' and blocked=0 order by id DESC";
include(ABSPATH.'script/php/condb.php');

if($query)
{
    $comms = [];
    while($res = mysqli_fetch_assoc($query))
    {    
        if($res['name'] == '')
            $res['name'] = 'ناشناس';
        
        $res['comment'] = str_replace("\n", "<br>\n", $res['comment']);
        $res['date'] = explode(' ', $res['date']);
        $res['date'] = $res['date'][0] . ' ' . $res['date'][1];
        $res['date'] = num_convert($res['date'], 'en', 'ckb');
        $res['date'] = str_replace(['am','pm'],
				   [' بەیانی ',' پاش‌نیوەڕۆ '],
				   $res['date']);

	$comms[] = $res;
    }

    echo json_encode($comms);
}

mysqli_close($conn);
?>
