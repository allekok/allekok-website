<?php
require_once('../script/php/constants.php');
require(ABSPATH.'script/php/functions.php');
require(ABSPATH.'about/color.php');

$input = 'comments.txt';
$output = 'comments.txt';

$comments = file_get_contents($input);
$comments = explode('[comment]',$comments);

foreach($comments as $i=>$comm)
{
    $comm = str_replace("\n","<br>",$comm);
    $comm = preg_replace("/\r+/ui","",$comm);
    $comm = preg_replace_callback(
	"/(<div)( style='.+')(>.+<i class='h'>)(.+)( \++ )(.+)(<\/i>)/ui", 'update_comment', $comm);
    $comm = str_replace(['Saturday',
			 'Sunday',
			 'Monday',
			 'Tuesday',
			 'Wednesday',
			 'Thursday',
			 'Friday'],
			['شەممە',
			 'یەک‌شەممە',
			 'دووشەممە',
			 'سێ‌شەممە',
			 'چوارشەممە',
			 'پێنج‌شەممە',
			 'هەینی'],
			$comm);
    $comments[$i] = $comm;
}

file_put_contents($output, implode('[comment]', $comments));

function update_comment($s)
{
    $color = color_random();
    $back = $color['back'];
    $fore = $color['fore'];
    $s[2] = " style='background:$back;color:$fore'";
    $s[4] = num_convert($s[4],'en','ckb');
    $s[4] = str_replace(['am','pm'],
			[' بەیانی',
			 ' پاش‌نیوەڕۆ'],
			$s[4]);
    return $s[1].$s[2].$s[3].$s[4].$s[7];
}
?>
