<?php

require_once("../../constants.php");

function num_convert($_num, $_from, $_to) {
    // convert numbers from (en,ar,ckb) > (en,ar,ckb)
    
    $_en = ["0","1","2","3","4","5","6","7","8","9"];
    $_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $_ckb = ["۰","۱","۲","۳","۴","۵","۶","۷","۸","۹"];

    $_assoc = ["en"=>$_en, "ar"=>$_ar, "ckb"=>$_ckb];

    return str_replace($_assoc[$_from], $_assoc[$_to], $_num);

}

function get_poet_image($_pID, $_size, $_slash) {
    // returns poet's image uri or the default image.
    
    $_sizes = [
	["pro-120", "profile", "120x120"],
	["pro-460", "pro460", "460x460"]
    ];

    $_pID = filter_var($_pID, FILTER_SANITIZE_NUMBER_INT);

    if(in_array($_size, $_sizes[0])) {

	if(file_exists(ABSPATH . "style/img/poets/profile/profile_{$_pID}.jpg")) {
	    $_img = "style/img/poets/profile/profile_{$_pID}.jpg";
	} else {
	    $_img = "style/img/poets/profile/profile_0.jpg";
	}
	
    } elseif(in_array($_size, $_sizes[1])) {

	if(file_exists(ABSPATH . "style/img/poets/pro-460/pro-460_{$_pID}.jpg")) {
	    $_img = "style/img/poets/pro-460/pro-460_{$_pID}.jpg";
	} else {
	    $_img = "style/img/poets/pro-460/pro-460_0.jpg";
	}
    }

    if($_slash)
	$_img = "/" . $_img;

    return $_img;

}

function color_num ($ath) {
    // return color number for given poet's id.
    //return ($ath%22) ? $ath - (22 * floor($ath/22)) : 22;
    return 0;
}

function format_DD($date_diff) {
    if($date_diff->days)
	$ret = $date_diff->days . " ڕۆژ";
    elseif($date_diff->h)
	$ret = $date_diff->h . " کاتژمێر";
    elseif($date_diff->i)
	$ret = $date_diff->i . " خولەک";
    elseif($date_diff->s)
	$ret = $date_diff->s . " چرکە";
    else
	return;
    return num_convert($ret,"en","ckb") . " لەوەپێش";
}


require_once("sanKuText.php");

?>
