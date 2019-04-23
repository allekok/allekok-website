<?php
require('session.php');
require_once("../constants.php");

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
?>";
    $body = "<div id=\"poets\"></div>";
    $footer = "<?php include_once(ABSPATH . \"script/php/footer.php\"); ?>";
    
    file_put_contents($path,"$header\n$body\n$footer");
}

$path = filter_var(@$argv[1], FILTER_SANITIZE_STRING);
make_page(ABSPATH . $path);
?>
