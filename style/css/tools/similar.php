<?php
$css = file_get_contents('main-comp.css');

function str_pop_0(&$string)
{
    $c = substr($string, 0, 1);
    $string = substr($string, 1);
    return $c;
}
function parse(&$string)
{
    $blocks = [];
    $block_name = '';
    $block = '';
    $carry = false;
    while($string)
    {
	$c = str_pop_0($string);
	if($c == '{')
	{
	    $carry = true;
	}
	elseif($c == '}')
	{
	    $blocks[] = [trim($block_name), trim($block)];
	    $block_name = '';
	    $block = '';
	    $carry = false;
	}
	elseif(!$carry)
	{
	    $block_name .= $c;
	}
	else
	{
	    $block .= $c;
	}
    }
    return $blocks;
}
function rules($block)
{
    return explode(';',$block);
}
function similar_blocks ($blk)
{
    global $blocks;
    $blk_name = $blk[0];
    $rules = $blk[1];
    $rules_len = count($rules);
    $els = [];

    foreach($blocks as $o)
    {
	// each block
	if(count($o[1]) == $rules_len)
	{
	    $carry = true;
	    foreach($o[1] as $r)
	    {
		// each rule
		if(!in_array($r, $rules))
		{
		    $carry = false;
		}
	    }
	    if($carry == true)
	    {
		$els[] = $o[0];
	    }
	}
    }
    return $els;
}
function common_rules ($rule)
{
    global $blocks;
    $res = [];
    foreach($blocks as $o)
    {
	if(in_array($rule, $o[1]))
	    $res[] = $o[0];
    }
    return $res;
}
function all_rules ()
{
    global $blocks;
    $rules = [];
    foreach($blocks as $o)
    {
	foreach($o[1] as $r)
	{
	    if(!in_array($r, $rules))
		$rules[] = $r;
	}
    }
    return $rules;
}

$old_blocks = parse($css);
$blocks = [];
foreach($old_blocks as $i => $o)
{
    if($o[0] and substr($o[0],0,1)!='@')
	$blocks[] = [$o[0], rules($o[1])];
}
$blocks_len = count($blocks);

/* foreach(all_rules() as $r)
 * {
 *     $res = common_rules($r);
 *     if(count($res) > 1)
 * 	print_r([$r, $res]);
 * }
 *  */
foreach($blocks as $i => $blk)
{
    //if($i > $blocks_len/2) break;
    
    $res = similar_blocks($blk);
    if(count($res) > 1)
    {
  	print_r($res);
  	echo "\n============================================\n";
    }
}
?>
