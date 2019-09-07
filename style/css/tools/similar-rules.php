<?php
$css = file_get_contents('main.css');
function parse($string)
{
    preg_match_all('/{.*}/u', $string, $string);
    return $string[0];
}
$blocks = parse($css);
$blocks_len = count($blocks);
function similar_blocks ($blk)
{
    global $blocks;
    $res = [];
    foreach($blocks as $i => $o)
    {
	if($o == $blk)
	{
	    $res[] = [$i, $blk];
	}
    }
    return $res;
}

foreach($blocks as $i => $blk)
{
    if($i > $blocks_len/2)
	break;
    $res = similar_blocks($blk);
    if(count($res) > 1)
    {
	print_r($res);
	echo "\n============================================\n";
    }
}
?>
