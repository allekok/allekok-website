<?php
function poem_writers () {
    $q = 'SELECT contributor FROM pitew WHERE status LIKE \'{\"status\":1%\'';
    require('../../script/php/condb.php');
    $writers = [];
    while($res = mysqli_fetch_assoc($query)) {
	$name = $res['contributor'] ? $res['contributor'] : 'ناشناس';
	if(isset($writers[$name]))
	    $writers[$name][0] += 1;
	else
	    $writers[$name] = [1, $name];
    }
    mysqli_close($conn);
    rsort($writers);
    return $writers;
}

function image_contributors () {
    $dir = opendir('../../style/img/poets/new/');
    $ignore = ['.','..'];
    $contributors = [];
    while(false !== ($e=readdir($dir))) {
	if(in_array($e, $ignore))
	    continue;

	$name = explode('_', str_replace(['.jpeg', '.png'], '', $e))[1];
	if(isset($contributors[$name]))
	    $contributors[$name][0] += 1;
	else
	    $contributors[$name] = [1, $name];
    }
    closedir($dir);
    rsort($contributors);
    return $contributors;
}

function poet_description_writers () {
    $dir = opendir('../res/');
    $ignore = ['.','..'];
    $writers = [];
    while(false !== ($e=readdir($dir))) {
	if(in_array($e, $ignore))
	    continue;

	$name = explode('_',$e)[0];
	if(isset($writers[$name]))
	    $writers[$name][0] += 1;
	else
	    $writers[$name] = [1, $name];
    }
    closedir($dir);
    rsort($writers);
    return $writers;
}

function comment_contributors () {
    $q = 'SELECT name FROM comments WHERE blocked=0 AND `read`=1';
    require('../../script/php/condb.php');
    $contributors = [];
    while($res = mysqli_fetch_assoc($query)) {
	$name = $res['name'] ? $res['name'] : 'ناشناس';
	if(isset($contributors[$name]))
	    $contributors[$name][0] += 1;
	else
	    $contributors[$name] = [1, $name];
    }
    mysqli_close($conn);
    rsort($contributors);
    return $contributors;
}

function pdf_contributors () {
    $pdfs = explode("\n\n",
		    trim(file_get_contents('../pdfs.txt')));
    $needle = 'ناردن: ';
    $contributors = [];
    
    foreach($pdfs as $pdf) {
	$pdf = explode("\t\t",$pdf);
	$last_line = @array_pop(
	    explode("\n",$pdf[2]));
	
	if(strpos($last_line,$needle) !== 0)
	    continue;

	$name = substr($last_line,strlen($needle));
	if(@isset($contributors[$name])) 
	    $contributors[$name][0] += 1;
	else
	    $contributors[$name] = [1, $name];
    }
    
    rsort($contributors);
    return $contributors;
}

function number_of_words($string) {
    preg_match_all("/\w+/", $string, $string);
    return count($string[0]);
}

function sum ($array) {
    $sum = 0;
    foreach($array as $e) {
	$sum += $e[0];
    }
    return $sum;
}

function save ($uri, $array) {
    $f = fopen($uri, 'w');
    fwrite($f, sum($array) . "\t*\n");
    foreach($array as $e) {
	fwrite($f, implode("\t", $e) . "\n");
    }
    fclose($f);
}

function save_all () {
    save('poems.txt', poem_writers());
    save('images.txt', image_contributors());
    save('poet-descs.txt', poet_description_writers());
    save('comments.txt', comment_contributors());
    save('pdfs.txt', pdf_contributors());
}

save_all();

?>
