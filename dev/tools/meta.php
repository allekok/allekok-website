<?php

require("../../script/php/constants.php");

$meta = [
    "SITE" => _SITE,
    "TITLE" => _TITLE,
    "DESC" => _DESC,
    "KEYS" => _KEYS,
    ];

if(isset($_GET['colors'])) {
    require("../../script/php/colors.php");
    $meta["colors"] = $colors;
}
    
header("Content-type:application/json; charset=UTF-8");
echo json_encode($meta);

?>