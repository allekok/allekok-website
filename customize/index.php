<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; گۆڕانکاری";
$desc = "گۆڕینی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>
<style>
 #set_theme, #set_lang
 {
     text-align:right;
     font-size:.7em;
     padding:1em;
 }
 #set_theme button, #set_lang button
 {
     font-size:inherit;
     margin:0 1em 0 0;
 }
 .button.selected
 {
     color:#15c314;
 }
 .icon-round
 {
     font-size:.8em;
 }
</style>
<div id="poets" style="max-width:850px">
    <h1 style="display:inline-block;padding:.1em .8em 0;
	       border-radius:5px;font-size:1.2em">
        گۆڕینی شێوەی ئاڵەکۆک
    </h1>
    <!-- Theme -->
    <div id="set_theme">
        <span>
            گۆڕینی ڕەنگ: 
	</span>
	<button type="button" class="button"
		id="set_theme_light" onclick="set_theme('light')">
	    <i class="material-icons">brightness_5</i>
	    ڕووناک
	</button>
	<button type="button" class="button"
		id="set_theme_dark" onclick="set_theme('dark')">
	    <i class="material-icons">brightness_2</i>
	    تاریک
	</button>
    </div>
    <!-- Language
    <div id="set_lang">
	<span>
	    گۆڕینی ئەلفووبێ: 
	</span>
	<button type="button" class="button"
		      id="set_lang_ckb" onclick="set_lang('ckb')">
	    عەرەبی
	</button>
	<button type="button" class="button"
		id="set_lang_ku" onclick="set_lang('ku')"
		style="font-family:monospace;">
	    Latîn
	</button>
    </div>
    -->
</div>
<script>
 const themes = ["light" , "dark"],
       langs = ["ckb" , "ku"];
 function set_theme(kind)
 {
     if(themes.indexOf(kind) === -1)
	 return false;
     let expires = new Date(),
	 days = 1000,
	 id = "";
     expires.setTime(expires.getTime() + (days*24*3600*1000));
     expires = expires.toUTCString();
     document.cookie = `theme=${kind};expires=${expires};path=/`;
     button_select(kind);
     window.location.reload();
 }
 function button_select(kind)
 {
     let id = "",
	 target = `set_theme_${kind}`;
     for(let i in themes)
     {
	 id = `set_theme_${themes[i]}`;
	 if(id == target)
	 {
	     document.getElementById(id).className = "button selected";
	 }
	 else
	 {
	     document.getElementById(id).className = "button";
	 }
     }
 }
 if(document.cookie)
 {
     let cookies = document.cookie.split(';'),
	 c = [], id = "";
     for(let i in cookies)
     {
	 c = cookies[i].split('=');
	 if(c[0] == "theme")
	 {
	     if(themes.indexOf(c[1]) !== -1)
	     {
		 button_select(c[1]);
	     }
	 }
     }
 }
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
