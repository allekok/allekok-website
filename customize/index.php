<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; گۆڕانکاری";
$desc = "گۆڕینی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 #set_theme, #user_codes
 {
     text-align:right;
     font-size:.7em;
     padding:.3em 1em;
 }
 #set_theme button
 {
     font-size:inherit;
     margin:0 1em 0 0;
 }
 .button.selected
 {
     color:<?php echo $colors[0][0]; ?>;
     font-weight:bold;
 }
 .icon-round
 {
     font-size:.8em;
 }
</style>
<div id="poets" style="max-width:850px">
    <h1 style="display:inline-block;padding:.1em .8em 0;
	       border-radius:5px;font-size:1.2em">
	<i class="material-icons"
	   style="color:<?php echo $colors[0][0]; ?>">settings</i>
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
    <!-- User codes -->
    <div id="user_codes">
	<span>
	    کۆدەکانی بەکارهێنەر:
	</span>
	<small style="font-family:'kurd',monospace;
		      font-size:.65em;text-indent:1em;
		      display:block" class="color-333">
	    ئەم کۆدانە کە بە زمانی Javascript دەبێ بنووسرێن، لەکاتی هێنانی ئاڵەکۆک‌دا ئیجرا دەکرێن.
	</small>
	<textarea id="user_codes_text"
		  style="direction:ltr;text-align:left;
		      width:95%;max-width:600px;
		      font-family:'kurd',monospace;
		      min-height:20em;font-size:.6em"
		  placeholder="/* Javascript Code */"></textarea>
	<button type="button" class="button"
		style="display:block;margin:auto;
		      padding:1em"
		onclick="save_user_codes('user_codes_text',this)">
	    پاشەکەوت کردن
	</button>
    </div>
</div>
<script>
 const themes = ['light' , 'dark'],
       user_codes_storage_name = 'user-codes',
       user_codes_storage = localStorage.getItem(user_codes_storage_name);
 
 function set_theme(kind)
 {
     if(themes.indexOf(kind) === -1)
	 return false;

     const days = 1000;
     let expires = new Date();
     expires.setTime(expires.getTime() + (days*24*3600*1000));
     expires = expires.toUTCString();
     document.cookie = `theme=${kind};expires=${expires};path=/`;
     button_select(kind);
     window.location.reload();
 }
 function button_select(kind)
 {
     const target = `set_theme_${kind}`;
     
     for(const i in themes)
     {
	 const id = `set_theme_${themes[i]}`,
	       el = document.getElementById(id);
	 
	 if(id == target)
	     el.className = "button selected";
	 else
	     el.className = "button";
     }
 }
 if(document.cookie)
 {
     const cookies = document.cookie.split(';');
     
     for(const i in cookies)
     {
	 const c = cookies[i].split('=');
	 if(c[0].trim() == "theme")
	 {
	     if(themes.indexOf(c[1]) !== -1)
		 button_select(c[1]);
	 }
	 else
	 {
	     button_select("light");
	 }
     }
 }
 else
 {
     button_select("light");
 }
 function save_user_codes(text_id, submit_button)
 {
     const user_codes = document.getElementById(text_id);
     localStorage.setItem(user_codes_storage_name,
			  user_codes.value);
     
     submit_button.style.color = colors[0][0];
     submit_button.innerHTML = 'پاشەکەوت کرا.';
     setTimeout(function ()
     {
	 submit_button.style.color = '';
	 submit_button.innerHTML = 'پاشەکەوت کردن';
     }, 3000);
 }
 if(user_codes_storage)
     document.getElementById('user_codes_text').value = user_codes_storage;
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
