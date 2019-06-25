<?php
/*
 * Functions:
 * num_convert , get_poet_image
 * color_num , format_DD
 */

require_once('constants.php');

function num_convert($_string, $_from, $_to) {
    /* Convert a string of numbers from 
       (en,ar,ckb) > (en,ar,ckb) */

    $_assoc = [
	
	'en'=>['0','1','2','3','4','5','6','7','8','9'],
	'ar'=>['٠', '١', '٢', '٣', '٤','٥', '٦', '٧', '٨', '٩'],
	'ckb'=>['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
	
    ];

    return str_replace($_assoc[$_from],
		       $_assoc[$_to],
		       $_string);
}

function get_poet_image($_pID, $_slash) {
    /* Return poet's image url */    
    if(file_exists(
	ABSPATH .
	"style/img/poets/profile/profile_{$_pID}.jpg"))
    $_img = "style/img/poets/profile/profile_{$_pID}.jpg";
    else
	$_img = "style/img/poets/profile/profile_0.jpg";

    if($_slash)
	$_img = "/$_img";

    return $_img;
}

function color_num ($ath) {
    /* It is gonna be used for '$colors' 
       index inside 'colors.php' */
    return 0;
}

function format_DD($date_diff) {
    if($date_diff->days)
	$ret = $date_diff->days . ' ڕۆژ';
    elseif($date_diff->h)
	$ret = $date_diff->h . ' کاتژمێر';
    elseif($date_diff->i)
	$ret = $date_diff->i . ' خولەک';
    elseif($date_diff->s)
	$ret = $date_diff->s . ' چرکە';
    else
	return;
    return num_convert($ret,'en','ckb') . ' لەوەپێش';
}

/* * * 
 * Sanitize Kurdish text for search.
 * * */
function san_data($in, $lastChance=false) {
    /* Extras */
    $extras = ["&#34;","&#39;","&laquo;","&raquo;","&rsaquo;",
	       "&lsaquo;","&bull;","&nbsp;","?", "!", "#", "&",
	       "*", "(", ")", "-","+", "=", "_","[", "]", "{",
	       "}","<",">","\\","/", "|", "'","\"", ";", ":", ",",
	       ".", "~", "`", "؟", "،", "»", "«","ـ","؛","›","‹","•","‌"];
    $ar_signs =["ِ", "ُ", "ٓ", "ٰ", "ْ", "ٌ", "ٍ", "ً", "ّ", "َ"];

    /* Numbers */
    $from_nums = [
        "۰","۱","۲","۳","۴","۵","۶","۷","۸","۹",
        "٠","١","٢","٣","٤","٥","٦","٧","٨","٩",
    ];
    $to_nums = [
        "0","1","2","3","4","5","6","7","8","9",
        "0","1","2","3","4","5","6","7","8","9",
    ];

    /* Letters */
    $to_letters = [
        "b","c","ç","d","f","g","h","j","k","l",
	"m","n","p","q","r","s","ş","t","v","w",
	"x","y","z","e","a","h","h","k","y","h",
	"z","s","t","z","r","h","x","w","w","w",
	"y","r","l","z","s","h","r","m","a","a",
	"l","s","y","w","e","y","h",];
    
    $from_letters = [
        "ب","ج","چ","د","ف","گ","ه","ژ","ک","ل",
        "م","ن","پ","ق","ر","س","ش","ت","ڤ","و",
        "خ","ی","ز","ئ","ا","ه‌","ە","ك","ي","ھ",
    	"ض","ص","ط","ظ","ڕ","ح","غ","ۆ","ؤ","ww",
    	"ێ","ڕ","ڵ","ذ","ث","ة","rr","mm","أ","آ",
    	"ll","ss","yy","ڤ","ع","ى","ھ",
    ];
    
    $in = filter_var($in,FILTER_SANITIZE_STRING);
    
    $in = str_replace($extras, "", $in);
    $in = str_replace($ar_signs, "", $in);
    $in = str_replace($from_nums, $to_nums, $in);
    $in = str_replace($from_letters,$to_letters,$in);
    $in = preg_replace("/\s+/", "", $in);
    
    if($lastChance) {
	/* Remove 'h' and Numbers */
        $in = str_replace("h","",$in);
        $in = str_replace($to_nums, "", $in);
    }

    return $in;
}

function san_data_more($in) {
    /* Remove 'h' and Numbers */
    $to_nums = [
        "0","1","2","3","4","5","6","7","8","9",
    ];
    $in = str_replace("h","",$in);
    $in = str_replace($to_nums, "", $in);
    return $in;
}

function list_dir($path,
		  $ignore = ['.','..','README.md','list.txt'],
		  $output = 'list.txt') {
    $output = "$path/$output";
    $f = fopen($output,'w');
    $dir = opendir($path);
    while(false !== ($e=readdir($dir))) {
	if(in_array($e,$ignore))
	    continue;
	fwrite($f,"$e\n");
    }
    closedir($dir);
    fclose($f);
}

function save_QA($input) {
    $input = trim(stripslashes(
	htmlspecialchars($input)));
    if(empty($input)) die();
    $f = fopen("QA.txt", "a");
    fwrite($f, $input."\nend\n");
    fclose($f);
    echo "1";
}
?>
