<?php

require_once("../../constants.php");

function make_page($path,$properties=[]) {
    if(empty($path)) return false;
    if(is_dir($path)) return false;
    
    $header = "<?php

include_once(\"../script/php/constants.php\");
    include_once(ABSPATH . \"script/php/colors.php\");
include_once(ABSPATH . \"script/php/functions.php\");

    \$title = \"{$properties["title"]}\";
    \$desc = \$title;
    \$keys = _KEYS;
    \$t_desc = \"\";
    \$color_num = 0;

    include(ABSPATH . \"script/php/header.php\");
?>
    ";

    $footer = "<?php include_once(ABSPATH . \"script/php/footer.php\"); ?>";

    $body = "<div id=\"poets\"></div>";

    $f = fopen($path, "w");
    fwrite($f,"{$header}\n{$body}\n{$footer}");
    fclose($f);

    return $path;
}

$path = filter_var(@$_GET["path"], FILTER_SANITIZE_STRING);
make_page(ABSPATH . $path);

?>
