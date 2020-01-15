<?php
if(!isset($site_lang))
{
    include_once('Ps.php');

    $site_lang = @$_GET["lang"] ? $_GET["lang"] : @$_COOKIE["lang"];
    if(! @SITE_LANGS[$site_lang])
	$site_lang = DEFAULT_SITE_LANG;

    $site_lang_obj = SITE_LANGS[$site_lang];
    $site_lang_cc = $site_lang_obj["cc"];
    $site_dir = $site_lang_obj["dir"];
    $site_align = $site_lang_obj["align"];
    $site_anti_align = $site_align == "right" ? "left" : "right";
}
?>
