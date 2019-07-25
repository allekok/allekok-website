<?php
$desktop = 'QA.txt';
$mobile = '../mobile/QA.txt';
$new_desktop = file_get_contents($mobile).
	       file_get_contents($desktop);
file_put_contents($desktop, $new_desktop);
?>
