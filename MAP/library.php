<?php
function functions_php($file_path)
{
    $code_blocks = php_blocks(file_get_contents($file_path));
    return functions($code_blocks);
}

function functions_js($file_path)
{
    $string = file_get_contents($file_path);
    
    if(substr($file_path,-3) == '.js')
	$code_blocks = [$string];
    else
	$code_blocks = js_blocks($string);
    
    return functions($code_blocks);
}

function functions($code_blocks)
{
    $functions = [];
    foreach($code_blocks as $block)
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
	if($carry)
	{
	    if($word!='(' && $word!='*')
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
    return list_files_by_ext($path, ['.php']);
}

function list_js_files($path)
{
    return list_files_by_ext($path,
			     ['.php','.html','.htm','.js'],
			     ['build-tools']);
}

function list_files_by_ext ($path, $ext_list, $ignore=[])
{
    $ext_list_count = [];
    foreach($ext_list as $o)
    {
	$ext_list_count[] = 0 - strlen($o);
    }
    $list = [];
    $ignore = array_merge($ignore, ['.','..']);
    $dir = opendir($path);
    while(false !== ($e=readdir($dir)))
    {
	if(in_array($e,$ignore)) continue;
	
	if(is_dir("$path/$e"))
	    $list = array_merge($list,
				list_files_by_ext("$path/$e", $ext_list));
	else
	{
	    foreach($ext_list as $i => $o)
	    {
		if(strtolower(substr($e,$ext_list_count[$i])) == $o)
		    $list[] = "$path/$e";
	    }
	}
    }
    return $list;
}

function php_blocks($string)
{
    return code_blocks($string, '<?php', '?>');
}

function js_blocks($string)
{
    return code_blocks($string, '<script>', '</script>');
}

function code_blocks($string, $begin_str, $end_str)
{
    $begin_str_len = strlen($begin_str);
    $code_blocks = [];
    while(false !==
	($begin = strpos($string,$begin_str)))
    {
	$string = substr($string,$begin+$begin_str_len);
	$end = strpos($string,$end_str);
	$code_blocks[] = trim(substr($string,0,$end));
	$string = substr($string,$end);
    }
    return $code_blocks;
}

function remove_comments_and_strings($string)
{
    $string = preg_replace("/\/\*.*\*\//u"," ",$string);
    $string = preg_replace("/\/\/.*\n/u"," ",$string);
    $string = preg_replace("/'.*'/u"," ",$string);
    $string = preg_replace("/\".*\"/u"," ", $string);
    return $string;
}

function output($lang, $list_path)
{
    $lang = strtolower($lang);
    $lang_upper = strtoupper($lang);
    $list_function = "list_{$lang}_files";
    $functions_func = "functions_$lang";
    
    $output = fopen("MAP-$lang_upper.org", 'w');
    fwrite($output,"#+TITLE: $lang_upper Functions\n#+AUTHOR: MAP\n\n");
    
    $files = $list_function($list_path);    
    foreach($files as $file)
    {
	$funcs = $functions_func($file);
	if(empty($funcs)) continue;
	
	fwrite($output, "/[[".$file."][".
			basename($file)." (".
			count($funcs).")]]/\n");
	foreach($funcs as $e)
	{
	    fwrite($output, "- $e\n");
	}
	fwrite($output, "\n");
    }
    fclose($output);
}
?>
