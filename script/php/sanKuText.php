<?php
function san_data($in, $last=false) {
    $extras = array("&laquo;","&raquo;","&rsaquo;","&lsaquo;","&bull;","&nbsp;","?", "!", "#", "&", "*", "(", ")", "-", "+", "=", "_","[", "]", "{", "}","<",">", "/", "|", "'", '"', ";", ":", ",", ".", "~", "`", "؟", "،", "»", "«","ـ","؛","›","‹","•","‌");
    $ar_signs =array('ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ');
    
    $from_nums = [
        '۰',
        '۱',
        '۲',
        '۳',
        '۴',
        '۵',
        '۶',
        '۷',
        '۸',
        '۹',
        '٠',
        '١',
        '٢',
        '٣',
        '٤',
        '٥',
        '٦',
        '٧',
        '٨',
        '٩',
        ];
    $to_nums = [
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        ];
    
    $kurdish_letters = [
    	"ه",
    	"ه",
    	"ک",
    	"ی",
    	"ه",
    	"ز",
    	"س",
    	"ت",
    	"ز",
    	"ر",
    	"ه",
    	"خ",
    	"و",
    	"و",
    	"و",
    	"ی",
    	"ر",
    	"ل",
    	"ز",
    	"س",
    	"ه",
    	"ر",
    	"م",
    	"ا",
    	"ا",
    	"ل",
    	"س",
    	"ی",
    	"و",
    	"ئ",
    	"ی",
    	"ه",
    ];
    
    $other_letters = [
    	"ه‌",
    	"ە",
    	"ك",
    	"ي",
    	"ھ",
    	"ض",
    	"ص",
    	"ط",
    	"ظ",
    	"ڕ",
    	"ح",
    	"غ",
    	"وو",
    	"ۆ",
    	"ؤ",
    	"ێ",
    	"ڕ",
    	"ڵ",
    	"ذ",
    	"ث",
    	"ة",
    	"رر",
    	"مم",
    	"أ",
    	"آ",
    	"لل",
    	"سس",
    	"یی",
    	"ڤ",
    	"ع",
    	"ى",
    	"ھ",
    ];
    
    $in = stripslashes($in);
    $in = filter_var($in,FILTER_SANITIZE_STRING);
    $in = preg_replace('/\s+/', '', $in);
    
    $in = str_replace($extras, "", $in);
    $in = str_replace($ar_signs, "", $in);
    $in = str_replace($from_nums, $to_nums, $in);
    $in = str_replace($other_letters,$kurdish_letters,$in);
    
    if($last === true)  $in = str_replace("ه","",$in);
    
    // $in = str_replace(" ", "", $in);
    /* The above line will remove all the spaces in the $in string.
    ** in some cases you maybe want to remove this line. */
    
    return $in;
}
?>
