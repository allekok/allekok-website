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

function get_poet_image($_pID, $_size, $_slash) {
    /* Return poet's image url */
    
    $_sizes = [
	['pro-120', 'profile', '120x120'],
	['pro-460', 'pro460', '460x460']
    ];

    $_pID = filter_var($_pID, FILTER_SANITIZE_NUMBER_INT);

    if(in_array($_size, $_sizes[0])) {
	/* 120x120 */

	if(file_exists(
	    ABSPATH .
	    "style/img/poets/profile/profile_{$_pID}.jpg"))
	$_img = "style/img/poets/profile/profile_{$_pID}.jpg";
	else
	    $_img = "style/img/poets/profile/profile_0.jpg";
	
    } elseif(in_array($_size, $_sizes[1])) {
	/* 460x460 */

	if(file_exists(
	    ABSPATH .
	    "style/img/poets/pro-460/pro-460_{$_pID}.jpg"))
	$_img = "style/img/poets/pro-460/pro-460_{$_pID}.jpg";
	else
	    $_img = "style/img/poets/pro-460/pro-460_0.jpg";
    }

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

require_once('sanKuText.php');
?>
