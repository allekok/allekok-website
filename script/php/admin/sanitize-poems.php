<?php
/*
 * Make Some modifications to databases for making them
 * Unicode compatible.
 */
require_once("../constants.php");
require_once(ABSPATH . "script/php/functions.php");

$poets = [];

$q = "SELECT id,bks FROM auth ORDER BY id ASC";
require(ABSPATH . "script/php/condb.php");
while ($res = mysqli_fetch_assoc($query))
{
    $res['bks'] = explode(',' , $res['bks']);
    $poets[] = $res;
}

foreach($poets as $pt)
{
    foreach($pt['bks'] as $bk=>$bk_name)
    {
	$poems = [];
	$tabel = "tbl".$pt['id'].
		 "_".($bk+1);
	$q = "SELECT id,name,hdesc,hon FROM $tabel";
	$query = mysqli_query($conn, $q);
	while ($res = mysqli_fetch_assoc($query))
	{
	    $res['name'] = addslashes(
		num_convert($res['name'],
			    'fa', 'ckb'));
	    $res['hdesc'] = addslashes(
		num_convert($res['hdesc'],
			    'fa', 'ckb'));
	    $res['hon'] = addslashes(
		num_convert($res['hon'],
			    'fa', 'ckb'));
	    $poems[] = $res;
	}

	foreach ($poems as $pm)
	{
	    $q = "UPDATE $tabel SET 
name='{$pm['name']}', hdesc='{$pm['hdesc']}', 
hon='{$pm['hon']}' WHERE id={$pm['id']}";
	    $query = mysqli_query($conn, $q);
	    if(!$query)
		echo $pt['id'].','.($bk+1).
		     ','.$pm['id'].'<br>';
	}
    }
}

mysqli_close($conn);
?>
