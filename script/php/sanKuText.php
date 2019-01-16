<?php
function san_data($in, $last=false) {
    $extras = array("&#34;","&#39;","&laquo;","&raquo;","&rsaquo;","&lsaquo;","&bull;","&nbsp;","?", "!", "#", "&", "*", "(", ")", "-", "+", "=", "_","[", "]", "{", "}","<",">","\\","/", "|", "'", "\"", ";", ":", ",", ".", "~", "`", "؟", "،", "»", "«","ـ","؛","›","‹","•","‌");
    $ar_signs =array("ِ", "ُ", "ٓ", "ٰ", "ْ", "ٌ", "ٍ", "ً", "ّ", "َ");
    
    $from_nums = [
        "۰",
        "۱",
        "۲",
        "۳",
        "۴",
        "۵",
        "۶",
        "۷",
        "۸",
        "۹",
        "٠",
        "١",
        "٢",
        "٣",
        "٤",
        "٥",
        "٦",
        "٧",
        "٨",
        "٩",
    ];
    $to_nums = [
        "0",
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "0",
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
    ];
    
    $kurdish_letters = [
        "b","c","ç","d","f","g","h","j","k","l","m","n","p","q","r","s","ş","t","v","w","x","y","z","e","a","h","h","k","y","h","z","s","t","z","r","h","x","w","w","w","y","r","l","z","s","h","r","m","a","a","l","s","y","w","e","y","h",];
    
    $other_letters = [
        "ب",
        "ج",
        "چ",
        "د",
        "ف",
        "گ",
        "ه",
        "ژ",
        "ک",
        "ل",
        "م",
        "ن",
        "پ",
        "ق",
        "ر",
        "س",
        "ش",
        "ت",
        "ڤ",
        "و",
        "خ",
        "ی",
        "ز",
        "ئ",
        "ا",
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
        "ۆ",
    	"ؤ",
    	"ww",
    	"ێ",
    	"ڕ",
    	"ڵ",
    	"ذ",
    	"ث",
    	"ة",
    	"rr",
    	"mm",
    	"أ",
    	"آ",
    	"ll",
    	"ss",
    	"yy",
    	"ڤ",
    	"ع",
    	"ى",
    	"ھ",
    ];
    
    $in = stripslashes($in);
    $in = filter_var($in,FILTER_SANITIZE_STRING);
    $in = preg_replace("/\s+/", "", $in);
    
    $in = str_replace($extras, "", $in);
    $in = str_replace($ar_signs, "", $in);
    $in = str_replace($from_nums, $to_nums, $in);
    $in = str_replace($other_letters,$kurdish_letters,$in);
    
    if($last === true) {
        $in = str_replace("h","",$in);
        $in = str_replace($to_nums, "", $in);
    }

    return $in;
}

/* TESTING
echo san_data("چاوەکەم چاوی ڕەشیی تۆۆ عەبدووووڕڕلل سسصص");
(start-process-shell-command "php" "sanKuText.php" "php sanKuText.php")
*/
?>