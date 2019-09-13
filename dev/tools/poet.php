<?php
/*
 * Input: REQUEST:(poet,k)
 * Output: JSON
 */
require_once('../../script/php/constants.php');
require(ABSPATH . 'script/php/functions.php');

header('Content-type: application/json; charset=UTF-8');

$null = json_encode(null);
$pt = isset($_REQUEST['poet']) ?
      filter_var($_REQUEST['poet'],
		 FILTER_SANITIZE_STRING) : die($null);

if(isset($_REQUEST['k']))
{
    $k = $_REQUEST['k'];
    if($k == 'alive')
	$kind = "kind='alive'";
    elseif($k == 'dead')
	$kind = "kind='dead'";
    elseif($k == 'bayt')
	$kind = "kind='bayt'";
    else
	$kind = '1';
}
else
{
    $kind = '1';
}

function get_poet ()
{
    global $kind, $pt;
    $poets = explode(',', $pt);
    $reses = [];
    
    foreach ($poets as $pt)
    {
	if($pt == 'all')
	    $q = "SELECT * FROM auth WHERE $kind ORDER BY takh";
        elseif(filter_var($pt, FILTER_VALIDATE_INT))
	    $q = "SELECT * FROM auth WHERE id=$pt";
        else
	    $q = "SELECT * FROM auth WHERE 
name='$pt' or takh='$pt' or profname='$pt'";
	
        $db = "index";
        require(ABSPATH . 'script/php/condb.php');
        if($query)
	{
	    while($res = mysqli_fetch_assoc($query))
	    {
		unset($res['ord']);
		$res['hdesc'] = str_replace('[t]', ' : ', $res['hdesc']);
		$res['hdesc']= explode('[n]', $res['hdesc']);
		$res['bks'] = explode(',', $res['bks']);
		$res['bksdesc'] = explode(',', $res['bksdesc']);
		$res['bks_completion'] = explode(',', $res['bks_completion']);
		
		$res['img']['_130x130'] = _SITE . get_poet_image($res['id'], true);
		$res['img']['_460x460'] = _SITE . get_poet_image($res['id'], true);
		
		$res['id'] = intval($res['id']);
		$res['colors'] = ['#15c314', '#000', '#eee', '#444'];
		
		$reses[] = $res;
	    }
        }
        mysqli_close($conn);	
	if($pt == 'all') break;
    }
    if($reses) return $reses;    
}

function get_poet_to_json($get_poet)
{
    return json_encode($get_poet);
}

echo get_poet_to_json( get_poet() );
?>
