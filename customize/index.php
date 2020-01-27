<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; گۆڕانکاری";
$desc = "گۆڕینی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<style>
 #set_theme, #set_lang, #toggle_ajaxsave
 {
     border-bottom:1px solid;
 }
 #set_theme, #user_codes, #set_lang, #toggle_ajaxsave
 {
     text-align:right;
     font-size:.7em;
     padding:.7em 1em;
 }
 #set_theme button
 {
     font-size:inherit;
     margin:0 1em 0 0;
 }
 #user_codes small
 {
     font-family:'kurd',monospace;
     font-size:.75em;
     text-indent:1em;
     display:block;
 }
 #user_codes_text
 {
     direction:ltr;
     text-align:left;
     width:100%;
     font-family:'kurd',monospace;
     font-size:.6em;
     height:20em;
 }
 #user_codes button
 {
     display:block;
     margin:1em auto 0;
     padding:1em 2em;
     font-size:.8em;
 }
 .dropdown
 {
     position:relative;
 }
 .dd-label
 {
     cursor:pointer;
     display:inline-block;
 }
 .dd-label:hover
 {
     color:<?php echo $_color; ?>;
 }
 .dd-frame
 {
     display:none;
     border:1px solid;
     border-radius:1em;
     z-index:999;
     position:absolute;
 }
 .dd-frame ul
 {
     margin:0;
     padding:0;
 }
 .dd-frame ul li
 {
     display:block;
     padding:0 .5em;
     font-size:.9em;
 }
 .dd-frame button
 {
     font-size:inherit;
     display:block;
 }
 #dd-lang .dd-frame
 {
     min-width:90px;
 }
 #toggle_ajaxsave button
 {
     font-size:1.4em;
     padding:.3em;
 }
</style>
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
    <!-- Language -->
    <div id="set_lang">
	<div class="dropdown" id="dd-lang">
	    <span style="padding-left:1em">
		<?php P("language"); ?>:
	    </span>
	    <div class="dd-label"
	    ><?php echo SITE_LANGS[$site_lang]["lit"]; ?>
		<span class='material-icons'
		>keyboard_arrow_down</span></div>
	    <div class="dd-frame">
		<ul>
		    <?php
		    foreach(SITE_LANGS as $k => $v)
		    {
			echo "<li>";
			if($site_lang != $k)
			    echo "<button type='button' onclick='set_lang(\"{$k}\")'>" .
				 $v["lit"] . "</button></li>";
			else
			    echo $v["lit"] . "</li>";
		    }
		    ?>
		</ul>
	    </div>
	</div>
    </div>
    <!-- Toggle Ajax -->
    <div id="toggle_ajaxsave">
        <span style="padding-left:1em">
            پاشەکەوت‌کردنی لاپەڕەکان:
	</span>
	<button type="button" class="button material-icons back-blue color-white"
		      id="toggle_ajaxsave_btn">
	    check
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
     document.getElementById(`set_theme_${kind}`).
	      querySelector(".material-icons").innerText = "sync";
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
	     el.className = "selected";
	 else
	     el.className = "";
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
     
     submit_button.className = 'button btn-selected color-white';
     submit_button.innerHTML = 'پاشەکەوت کرا.';
     setTimeout(function ()
	 {
	     submit_button.className = 'button';
	     submit_button.innerHTML = 'پاشەکەوت کردن';
	 }, 3000);
 }
 if(user_codes_storage)
     document.getElementById('user_codes_text').value = user_codes_storage;
 document.getElementById('set_theme_light').onclick = function(){set_theme('light')}
 document.getElementById('set_theme_dark').onclick = function(){set_theme('dark')}
 const user_codes_button = document.getElementById('user_codes_button');
 user_codes_button.onclick = function(){save_user_codes('user_codes_text',user_codes_button)}

 function set_cookie (cookie_name, value, days=1000, path="/")
 {
     let expires = new Date();
     expires.setTime(expires.getTime() + (days*24*3600*1000));
     expires = expires.toUTCString();
     const cookie = `${cookie_name}=${value};expires=${expires};path=${path}`;
     document.cookie = cookie;
     return cookie;
 }
 function toggle (label, target)
 {
     const icon = label.querySelector(".material-icons");
     if(target.style.display != "block")
     {
	 target.style.display = "block";
	 icon.innerText = "keyboard_arrow_up";
     }
     else
     {
	 target.style.display = "none";
	 icon.innerText = "keyboard_arrow_down";
     }
 }
 const dd_lang = document.getElementById("dd-lang");
 const dd_lang_label = dd_lang.querySelector(".dd-label");
 const dd_lang_frame = dd_lang.querySelector(".dd-frame");
 dd_lang_label.addEventListener("click", function () {
     toggle(dd_lang_label, dd_lang_frame);
 });
 function set_lang (lang)
 {
     set_cookie("lang", lang);
     dd_lang_label.querySelector(".material-icons").innerText = "sync";
     window.location.reload();
 }
 function get_cookie (key)
 {
     if(document.cookie)
     {
	 const cookies = document.cookie.split(';');
	 
	 for(const i in cookies)
	 {
	     const c = cookies[i].split('=');
	     if(c[0].trim() == key)
	     {
		 return c[1];
		 break;
	     }
	 }
     }
     return false;
 }
 const toggle_ajaxsave_btn = document.getElementById("toggle_ajaxsave_btn");
 toggle_ajaxsave_btn.addEventListener("click", toggle_ajaxsave);
 const _temp = (get_cookie("ajax_save_p") === "0");
 if(_temp)
 {
     toggle_ajaxsave_btn.innerText = "close";
     toggle_ajaxsave_btn.classList.remove("back-blue");
     toggle_ajaxsave_btn.classList.remove("color-white");
 }
 function toggle_ajaxsave ()
 {
     const state = get_cookie("ajax_save_p");
     if(state === "0")
     {
	 set_cookie("ajax_save_p", "1");
	 toggle_ajaxsave_btn.innerText = "check";
     }
     else
     {
	 set_cookie("ajax_save_p", "0");
	 toggle_ajaxsave_btn.innerText = "close";
     }
     toggle_ajaxsave_btn.innerText = "sync";
     window.location.reload();
 }
</script>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
