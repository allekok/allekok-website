<?php
function functions($php_file)
{
    $php_blocks = php_blocks(
	file_get_contents($php_file));
    $functions = [];
    foreach($php_blocks as $block)
    {
	$block_funcs = functions_block($block);
	if($block_funcs)
	    $functions = array_merge($functions,$block_funcs);
    }
    return $functions;
}

function functions_block($block)
{
    $block = trim($block);
    $block = remove_comments_and_strings($block);
    $block = str_replace('(',' ( ',$block);
    $block = preg_replace('/\s+/',' ',$block);
    $block = explode(' ',$block);
    
    $functions = [];
    $carry = false;
    foreach($block as $word)
    {
	if($carry and $word!='(')
	{
	    $functions[] = $word;
	    $carry = false;
	    continue;
	}
	if($word == 'function')
	    $carry = true;
    }
    return $functions;
}

function list_php_files($path)
{
    $list = [];
    $ignore = ['.','..'];
    $dir = opendir($path);
    while(false !== ($e=readdir($dir)))
    {
	if(in_array($e,$ignore)) continue;
	
	if(is_dir("$path/$e"))
	    $list = array_merge($list,list_php_files("$path/$e"));
	elseif(strtolower(substr($e,-4)) == '.php')
	    $list[] = "$path/$e";
    }
    return $list;
}

function php_blocks($string)
{
    $php_blocks = [];
    $begin_str = '<?php';
    $end_str = '?>';
    while(false !==
	($begin = strpos($string,$begin_str)))
    {
	$string = substr($string,$begin+5);
	$end = strpos($string,$end_str);
	$php_blocks[] = trim(substr($string,0,$end));
	$string = substr($string,$end);
    }
    return $php_blocks;
}

function remove_comments_and_strings($string)
{
    $string = preg_replace("/\/\*.*\*\//u"," ",$string);
    $string = preg_replace("/\/\/.*\n/u"," ",$string);
    $string = preg_replace("/'.*'/u"," ",$string);
    $string = preg_replace("/\".*\"/u"," ", $string);
    return $string;
}
?>
