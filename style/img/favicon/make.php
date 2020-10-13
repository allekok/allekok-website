<?php
require("../../../script/php/constants.php");
$inputs = ["browserconfig-sample.xml",
	   "site-sample.webmanifest"];
foreach($inputs as $f)
{
	file_put_contents(
		str_replace("-sample", "", $f),
		str_replace("/favicon/", _R."style/img/favicon/",
			    file_get_contents($f))
	);
}
?>
