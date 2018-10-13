<?php
function num_convert($_num, $_from, $_to) {
    
	$_en = array('0','1','2','3','4','5','6','7','8','9');
	$_ckb = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');

	if($_from === "en" && $_to === "ckb" ) {

		return str_replace($_en, $_ckb, $_num);
	
	} elseif($_from === "ckb" && $_to === "en") {

		return str_replace($_ckb, $_en, $_num);
	}
}

function get_poet_image($_pID, $_size, $_slash) {
	$_sizes = array(
		array("profile", "120x120"),
		array("pro-460", "pro460", "460x460")
	);

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

require_once("sanKuText.php");


?>