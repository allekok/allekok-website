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
<div id="poets" style="text-align:right">
    <h1 class="color-blue" style="font-size:1em">
        گۆڕینی شێوەی ئاڵەکۆک
    </h1>
    <!-- Theme -->
    <div id="set_theme">
        <span>
            گۆڕینی ڕەنگ: 
	</span>
	<button type="button" id="set_theme_light">
	    <i class="material-icons">brightness_5</i>
	    ڕووناک
	</button>
	<button type="button" id="set_theme_dark">
	    <i class="material-icons">brightness_2</i>
	    تاریک
	</button>
    </div>
    <!-- User codes -->
    <div id="user_codes">
	<span>
	    کۆدەکانی بەکارهێنەر:
	</span>
	<small>
	    ئەم کۆدانە کە بە زمانی Javascript دەبێ بنووسرێن، لەکاتی هێنانی ئاڵەکۆک‌دا ئیجرا دەکرێن.
	</small>
	<textarea id="user_codes_text"
		  placeholder="/* Javascript Code */"></textarea>
	<button type="button" class="button" id="user_codes_button">
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
	     break;
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
     
     submit_button.className = 'selected';
     submit_button.innerHTML = 'پاشەکەوت کرا.';
     setTimeout(function ()
     {
	 submit_button.className = '';
	 submit_button.innerHTML = 'پاشەکەوت کردن';
     }, 3000);
 }
 if(user_codes_storage)
     document.getElementById('user_codes_text').value = user_codes_storage;
 document.getElementById('set_theme_light').onclick = function(){set_theme('light')}
 document.getElementById('set_theme_dark').onclick = function(){set_theme('dark')}
 const user_codes_button = document.getElementById('user_codes_button');
 user_codes_button.onclick = function(){save_user_codes('user_codes_text',user_codes_button)}
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
