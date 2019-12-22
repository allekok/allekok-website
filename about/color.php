<?php
function color_random ()
{
    $R = mt_rand(0,255);
    $G = mt_rand(0,255);
    $B = mt_rand(0,255);
    $color = [
	'back' => "rgba($R,$G,$B,.125)",
	'fore' => '#000',
    ];
    return $color;
}
?>
