<?php
    header("Content-type:text/plain; charset=utf-8");
    /*
    $hafez_allekok = json_decode(file_get_contents("https://allekok.com/dev/tools/book.php?poet=65&book=1") , true);
    echo "\$hafez_allekok downloaded.\n";
    echo "{$hafez_allekok['poems-num']}\n";*/
    
    $ganjoor_uri = "https://ganjoor.net/hafez/ghazal/";
    $html = file_get_contents($ganjoor_uri);
    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    
    $template = "hafez/ghazal/sh";
    
    $f = fopen("65_1_.txt", "a");
    
    foreach($dom->getElementsByTagName("a") as $a) {
        if( strstr($a->getAttribute("href") , $template) ) {
            
            $title = $a->parentNode->nodeValue;
            $title = urlencode(san_data($title));
            
            $uri = "https://allekok.com/dev/tools/search.php?q={$title}&poet=حەقیقی&pm=1&k=2";
            $alle = json_decode(file_get_contents($uri) , true);
            
            $m = $alle["poems"]["firstChance"]["context"][0]["poem_id"] or $alle["poems"]["lastChance"]["context"][0]["poem_id"];
            
            if($m) {
            
                $res = [
                    "m"=> $m,
                    "c"=>[1,1,1,1],
                    "v"=>stripslashes($a->getAttribute("href")),
                    ];
                    
                fwrite($f , json_encode($res) . "\n" );
            }
            
            
        }
    }
    
    fclose($f);
    
    
    
    
function san_data($in, $last=false) {
    $extras = array("&laquo;","&raquo;","&rsaquo;","&lsaquo;","&bull;","&nbsp;","?", "!", "#", "&", "*", "(", ")", "-", "+", "=", "_","[", "]", "{", "}","<",">", "/", "|", "'", '"', ";", ":", ",", ".", "~", "`", "؟", "،", "»", "«","ـ","","؛","›","‹","•","‌","غزل شماره");
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

    
    
    $in = stripslashes($in);
    $in = filter_var($in,FILTER_SANITIZE_STRING);

    $in = str_replace($extras, "", $in);
    $in = str_replace($ar_signs, "", $in);
    $in = str_replace($from_nums, "", $in);

    if($last === true)  $in = str_replace("ه","",$in);
    
    // $in = str_replace(" ", "", $in);
    /* The above line will remove all the spaces in the $in string.
    ** in some cases you maybe want to remove this line. */
    
    return $in;
}

    

?>