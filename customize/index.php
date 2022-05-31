<?php
require_once("../script/php/constants.php");
require_once("../script/php/colors.php");
require_once("../script/php/functions.php");

$title = $_TITLE . " › گۆڕانکاری";
$desc = "گۆڕینی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

require_once("../script/php/header.php");
?>
<style>
 @font-face {
	 font-family:"orig";
	 font-display:swap;
	 src:url("<?php echo _R ?>style/font/DroidNaskh-Regular.woff2")
	 format("woff2");
 }
 #set_theme, #set_lang, #toggle_ajaxsave, #set_font {
	 border-bottom:1px solid;
 }
 #set_theme, #user_codes, #set_lang, #toggle_ajaxsave, #set_font {
	 text-align:right;
	 font-size:.62em;
	 padding:.7em 1em;
 }
 #set_theme button {
	 font-size:inherit;
	 margin:0 .5em 0 0;
 }
 #set_theme_custom_colors {
	 font-size:.9em;
	 padding-top:1em;
	 <?php
	 if(!$_theme_custom)
		 echo "display:none";
	 ?>
 }
 #set_theme_custom_colors ._colors_c {
	 display:inline-block;
	 padding:0;
	 margin-right:1em;
	 box-sizing:initial;
	 border:0;
	 height:2em;
	 width:3em;
	 vertical-align:text-bottom;
 }
 #set_theme_custom_colors ._colors,
 #set_theme_custom_colors ._back_img,
 #set_theme_custom_colors ._back_img_op {
	 display:inline-block;
	 padding:.1em .5em;
	 max-width:100px;
	 direction:ltr;
	 text-align:center;
	 margin-right:.5em;
	 font-size:.9em;
 }
 #set_theme_custom_colors ._back_img {
	 width:60%;
	 max-width:500px;
 }
 #set_theme_custom_colors ._back_img_op {
	 width:60%;
	 max-width:200px;
 }
 #set_theme_custom_colors_submit {
	 padding:.5em 1em;
 }
 #user_codes small {
	 font-size:.85em;
	 text-indent:1em;
	 display:block;
 }
 #user_codes_text {
	 direction:ltr;
	 text-align:left;
	 width:100%;
	 font-family:"kurd", monospace;
	 font-size:.8em;
	 height:15em;
 }
 #user_codes button {
	 display:block;
	 margin:1em auto 0;
	 padding:1em 2em;
	 font-size:.8em;
 }
 .dropdown {
	 position:relative;
 }
 .dd-label {
	 cursor:pointer;
	 display:inline-block;
 }
 .dd-label:hover {
	 color:<?php echo $_colors[2] ?>;
 }
 .dd-frame {
	 display:none;
	 border:1px solid;
	 border-radius:1em;
	 z-index:999;
	 position:absolute;
 }
 .dd-frame ul {
	 margin:0;
	 padding:.5em;
 }
 .dd-frame ul li {
	 display:block;
	 padding:0 .5em;
	 font-size:.9em;
 }
 .dd-frame button {
	 font-size:inherit;
	 display:block;
	 width:100%;
 }
 #dd-lang .dd-frame {
	 min-width:90px;
 }
 .dd-frame img {
	 max-width:40%;
	 display:block;
	 margin:auto;
 }
 .dd-frame .fontOpt:hover {
	 opacity:.7;
	 color:initial;
 }
 #dd-font .dd-frame {
	 max-width:250px;
 }
 .fontOpt p {
	 text-align:center;
	 font-size:.9em;
 }
 .fontOpt {
	 border-bottom:1px solid;
	 padding:.5em 0;
 }
 #toggle_ajaxsave button {
	 font-size:1em;
	 padding:.5em;
 }
</style>
<div id="poets" style="text-align:right">
	<h1 class="color-blue" style="font-size:1em">
		گۆڕینی ئاڵەکۆک
	</h1>
	<!-- Theme -->
	<div id="set_theme">
		<span>
			گۆڕینی ڕەنگ: 
		</span>
		<button type="button" id="set_theme_system">
			<i class="material-icons">brightness_4</i>
			خۆکار
		</button>
		<button type="button" id="set_theme_light">
			<i class="material-icons">brightness_5</i>
			ڕووناک
		</button>
		<button type="button" id="set_theme_dark">
			<i class="material-icons">brightness_2</i>
			تاریک
		</button>
		<button type="button" id="set_theme_custom">
			<i class="material-icons">settings</i>
			ڕەنگی‌تر
		</button>
		<div id="set_theme_custom_colors">
			<?php
			function print_select($A, $def, $class) {
				echo "<select class='$class'>";
				foreach($A as $b) {
					echo "<option value='$b[0]'";
					if($b[0] == $def)
						echo " selected";
					echo ">$b[1]</option>";
				}
				echo "</select>";
			}
			?>
			<p>
				ڕەنگی پەڕە:
				<input type="text"
				       class="_colors"
				       value="<?php echo $_colors[0] ?>">
				<input type="color"
				       class="_colors_c"
				       value="<?php echo $_colors[0] ?>">
			</p>
			<p>
				ڕەنگی نووسراوە:
				<input type="text"
				       class="_colors"
				       value="<?php echo $_colors[1] ?>">
				<input type="color"
				       class="_colors_c"
				       value="<?php echo $_colors[1] ?>">
			</p>
			<p>
				ڕەنگی تایبەت:
				<input type="text"
				       class="_colors"
				       value="<?php echo $_colors[2] ?>">
				<input type="color"
				       class="_colors_c"
				       value="<?php echo $_colors[2] ?>">
			</p>
			<p>
				ڕەنگی هەڵە:
				<input type="text"
				       class="_colors"
				       value="<?php echo $_colors[3] ?>">
				<input type="color"
				       class="_colors_c"
				       value="<?php echo $_colors[3] ?>">
			</p>
			<p>
				وێنەی پەڕە:
				<input type="text"
				       class="_back_img"
				       placeholder="نیشانی ئینتێرنێتی وێنە"
				       value="<?php echo @$_back_img ?>">
			</p>
			<p>
				گەورەیی وێنە:
				<?php
				$back_sizes = [
					["cover", "پڕ بە لاپەڕە"],
					["auto", "وەکوو خۆی"],
					["contain", "لە نێوان لاپەڕە"]
				];
				print_select($back_sizes,
					     @$_back_img_size,
					     "_back_img_size");
				?>
			</p>
			<p>
				دووپات بوونەوەی وێنە:
				<?php
				$repeats = [
					["no-repeat", "دووپات نەبێتەوە"],
					["repeat", "دووپات ببێتەوە"],
					["repeat-x", "تەنیا لە درێژایی‌دا"],
					["repeat-y", "تەنیا لە بڵندایی‌دا"],
					["space", "دووپات ببێتەوە پڕ بە لاپەڕە"]
				];
				print_select($repeats,
					     @$_back_img_repeat,
					     "_back_img_repeat");
				?>
			</p>
			<p>
				پێوەست بوونی وێنە:
				<?php
				$attachments = [
					["fixed", "ڕاوەستاو"],
					["scroll", "کێشان"],
					["local", "ناوچە"]
				];
				print_select($attachments,
					     @$_back_img_attach,
					     "_back_img_attach");
				?>
			</p>
			<p>
				شوێنی وێنە:
				<?php
				$positions = [
					["center center", "ناوەڕاست ناوەڕاست"],
					["center left", "ناوەڕاست چەپ"],
					["center right", "ناوەڕاست ڕاست"],
					["bottom center", "خوارەوە ناوەڕاست"],
					["bottom left", "خوارەوە چەپ"],
					["bottom right", "خوارەوە ڕاست"],
					["top center", "سەرەوە ناوەڕاست"],
					["top left", "سەرەوە چەپ"],
					["top right", "سەرەوە ڕاست"]
				];
				print_select($positions,
					     @$_back_img_pos,
					     "_back_img_pos");
				?>
			</p>
			<p>
				کاڵ بوونەوەی وێنە:
				<input type="text"
				       class="_back_img_op"
				       placeholder="ژمارەیەک بەینی ٠.٠ تا ١.٠"
				       value="<?php
					      echo num_convert($_back_img_op,
							       "en",
							       "ckb");
					      ?>">
			</p>
			<p style="text-align:center;padding-top:.7em">
				<button type="button"
					      class="button"
					      id="set_theme_custom_colors_submit"
					      style="font-size:.9em">
					پاشەکەوت کردن
				</button>
			</p>
		</div>
	</div>
	<!-- Language -->
	<div id="set_lang">
		<div class="dropdown" id="dd-lang">
			<span style="padding-left:1em">
				<?php P("language") ?>:
			</span>
			<div class="dd-label">
				<?php echo SITE_LANGS[$site_lang]["lit"] ?>
				<span class="material-icons">
					keyboard_arrow_down
				</span>
			</div>
			<div class="dd-frame">
				<?php
				echo "<ul>";
				foreach(SITE_LANGS as $k => $v) {
					if($site_lang != $k) {
						echo "<li>" .
						     "<button type='button'" .
						     " class='langOpt' " .
						     "L='$k'>" .
						     $v["lit"] .
						     "</button></li>";
					}
					else {
						echo "<li " .
						     "style='opacity:.75'>" .
						     $v["lit"] .
						     "</li>";
					}
				}
				echo "</ul>";
				?>
			</div>
		</div>
	</div>
	<!-- Toggle Save -->
	<div id="toggle_ajaxsave">
		<span style="padding-left:1em">
			پاشەکەوت‌کردنی لاپەڕەکان:
		</span>
		<button type="button"
			id="toggle_ajaxsave_btn"
			class="button material-icons back-blue color-white">
			check
		</button>
	</div>
	<!-- Font -->
	<?php
	$fonts = json_decode(file_get_contents("fonts/list.txt"), true);
	?>
	<div id="set_font">
		<div class="dropdown" id="dd-font">
			<span style="padding-left:1em">
				قەڵەم:
			</span>
			<div class="dd-label">
				<?php
				$is_font = (isset($_COOKIE["font"]) and
					!empty($_COOKIE["font"]) and
					$_COOKIE["font"] != "null");
				if($is_font) {
					$font = filter_var(
						$_COOKIE["font"],
						FILTER_SANITIZE_STRING);
					$font_name = substr(
						$font,
						0,
						strrpos($font, "."));
					echo isset($fonts[$font_name]) ?
					     $fonts[$font_name][0] :
					     $font_name;
				}
				else {
					echo "نەسخ";
				}
				?>
				<span class="material-icons">
					keyboard_arrow_down
				</span>
			</div>
			<div class="dd-frame">
				<?php echo "<ul>" ?>
				<li>
					<button L=""
						   type="button"
						   class="fontOpt"
						   style="text-align:center;
						   padding:.5em 0;
						   font-family:'orig'">
						نەسخ
					</button>
				</li>
				<?php
				foreach($fonts as $f) {
					echo "<li><button type='button'" .
					     " class='fontOpt' " .
					     "F='{$f[1]}.{$f[3]}'><img " .
					     "lsrc='fonts/font-imgs/" .
					     "{$f[1]}.{$f[2]}'></button></li>";
				}
				?>
				<li style="margin:0 .5em;padding:1em 0">
					<input type="text"
					       id="internet-font-txt"
					       placeholder="نیشانی ئینتێرنێتی قەڵەم"
					       style="direction:ltr;
						     text-align:center;
						     width:100%;
						     border-radius:1em 1em 0 0;
						     border-bottom:0"
					       <?php
					       echo "value='" .
						    @$_COOKIE["interfont"] .
						    "'";
					       ?>>
					<button type="button"
						      id="internet-font-btn"
						      class="button"
						      style="text-align:center;
						      font-size:.8em;
						      padding:.5em 0;
						      border-radius:
						      0 0 1em 1em">
						ناردن
					</button>
				</li>
				<?php echo "</ul>" ?>
			</div>
		</div>
	</div>
	<!-- User codes -->
	<div id="user_codes">
		<span>
			کۆدەکانی بەکارهێنەر:
		</span>
		<small>
			ئەم کۆدانە کە بە زمانی
			Javascript
			دەبێ بنووسرێن، لەکاتی هێنانی ئاڵەکۆک‌دا ئیجرا دەکرێن.
		</small>
		<textarea id="user_codes_text"
			  placeholder="/* Javascript Code */"></textarea>
		<button type="button" class="button" id="user_codes_button">
			پاشەکەوت کردن
		</button>
	</div>
</div>
<script>
 /* Constants */
 const themes = ['system', 'light', 'dark', 'custom'],
       dd_lang = document.getElementById('dd-lang'),
       dd_lang_label = dd_lang.querySelector('.dd-label'),
       dd_lang_frame = dd_lang.querySelector('.dd-frame'),
       toggle_ajaxsave_btn = document.getElementById('toggle_ajaxsave_btn'),
       dd_font = document.getElementById('dd-font'),
       dd_font_label = dd_font.querySelector('.dd-label'),
       dd_font_frame = dd_font.querySelector('.dd-frame'),
       user_codes_storage_name = 'user-codes',
       user_codes_storage = localStorage.getItem(user_codes_storage_name)
 
 /* Event Listeners */
 document.getElementById('set_theme_system').onclick = () => set_theme('system')
 document.getElementById('set_theme_light').onclick = () => set_theme('light')
 document.getElementById('set_theme_dark').onclick = () => set_theme('dark')
 document.getElementById('set_theme_custom').onclick = () => set_theme('custom')
 document.getElementById('set_theme_custom_colors_submit').onclick = () => {
	 set_colors()
	 set_back_img()
 }
 document.getElementById('set_theme_custom_colors').
	  querySelectorAll('._colors_c').forEach(o =>
		  o.addEventListener('input', () => 
			  o.parentNode.querySelector('._colors').value =
				  o.value))
 dd_lang_label.addEventListener('click', () =>
	 toggle(dd_lang_label, dd_lang_frame))
 document.querySelectorAll('.langOpt').forEach(o =>
	 o.addEventListener('click', () => set_lang(o.getAttribute('L'))))
 toggle_ajaxsave_btn.addEventListener('click', toggle_ajaxsave)
 dd_font_label.addEventListener('click', () => {
	 dd_font_frame.querySelectorAll('.fontOpt img').forEach(img =>
		 img.src = img.getAttribute('lsrc'))
	 toggle(dd_font_label, dd_font_frame)
 })
 document.querySelectorAll('.fontOpt').forEach(o => 
	 o.addEventListener('click', () => set_font(o.getAttribute('F'))))
 document.querySelector('#internet-font-btn').addEventListener('click', () =>
	 set_interfont(document.querySelector('#internet-font-txt').
				value.trim()))
 document.getElementById('user_codes_button').onclick = () =>
	 save_user_codes('user_codes_text', user_codes_button)
 
 /* Run */
 if(document.cookie) {
	 const cookies = document.cookie.split(';')
	 for(const cookie of cookies) {
		 const c = cookie.split('=')
		 if(c[0].trim() == 'theme') {
			 if(themes.indexOf(c[1]) !== -1)
				 button_select(c[1])
			 break
		 }
		 else {
			 button_select('system')
		 }
	 }
 }
 else {
	 button_select('system')
 }

 if(get_cookie('ajax_save_p') === '0') {
	 toggle_ajaxsave_btn.innerText = 'close'
	 toggle_ajaxsave_btn.classList.remove('back-blue')
	 toggle_ajaxsave_btn.classList.remove('color-white')
 }
 
 if(user_codes_storage) {
	 document.getElementById('user_codes_text').value = user_codes_storage
 }

 /* Functions */
 function set_theme(kind) {
	 if(themes.indexOf(kind) === -1)
		 return false
	 
	 const days = 1000
	 const expires = new Date((new Date).getTime() +
				  days * 24 * 3600 * 1000).toUTCString()
	 document.cookie = `theme=${kind};expires=${expires};path=/`
	 document.getElementById(`set_theme_${kind}`).
		  querySelector('.material-icons').innerText = 'sync'
	 button_select(kind)
	 window.location.reload()
 }
 
 function button_select(kind) {
	 const target = `set_theme_${kind}`
	 for(const theme of themes) {
		 const id = `set_theme_${theme}`,
		       el = document.getElementById(id)
		 el.className = id == target ? 'selected' : ''
	 }
 }
 
 function save_user_codes(text_id, submit_button) {
	 const user_codes = document.getElementById(text_id)
	 localStorage.setItem(user_codes_storage_name, user_codes.value)
	 
	 submit_button.className = 'button btn-selected color-white'
	 submit_button.innerHTML = 'پاشەکەوت کرا.'
	 setTimeout(() => {
		 submit_button.className = 'button'
		 submit_button.innerHTML = 'پاشەکەوت کردن'
	 }, 3000)
 }
 
 function set_colors() {
	 const colors = []
	 document.getElementById('set_theme_custom_colors').
		  querySelectorAll('._colors').forEach(o =>
			  colors.push(o.value))
	 set_cookie('colors', colors.join(','))
	 window.location.reload()
 }
 
 function set_back_img() {
	 const parent = document.getElementById('set_theme_custom_colors')
	 const img = parent.querySelector('._back_img').value.trim(),
	       size = parent.querySelector('._back_img_size').value.trim(),
	       repeat = parent.querySelector('._back_img_repeat').value.trim(),
	       attach = parent.querySelector('._back_img_attach').value.trim(),
	       pos = parent.querySelector('._back_img_pos').value.trim(),
	       op = parent.querySelector('._back_img_op').value.trim()
	 
	 set_cookie('backimg', encodeURIComponent(img))
	 set_cookie('backimgsize', size)
	 set_cookie('backimgrepeat', repeat)
	 set_cookie('backimgattach', attach)
	 set_cookie('backimgpos', pos)
	 set_cookie('backimgop', op)
	 
	 window.location.reload()
 }
 
 function set_cookie(cookie_name, value, days=1000, path='/') {
	 const expires = new Date((new Date).getTime() +
				  days * 24 * 3600 * 1000).toUTCString()
	 const cookie = `${cookie_name}=${value};` +
			`expires=${expires};path=${path}`;
	 document.cookie = cookie
	 return cookie
 }
 
 function toggle(label, target) {
	 const icon = label.querySelector('.material-icons')
	 if(target.style.display != 'block') {
		 target.style.display = 'block'
		 icon.innerText = 'keyboard_arrow_up'
	 }
	 else {
		 target.style.display = 'none'
		 icon.innerText = 'keyboard_arrow_down'
	 }
 }
 
 function set_interfont(font) {
	 set_cookie('interfont', encodeURIComponent(font))
	 window.location.reload()
	 toggle(dd_font_label, dd_font_frame)
	 dd_font_label.querySelector('.material-icons').innerText = 'sync'
 }
 
 function set_font(font) {
	 set_cookie('interfont', '')
	 set_cookie('font', font)
	 window.location.reload()
	 toggle(dd_font_label, dd_font_frame)
	 dd_font_label.querySelector('.material-icons').innerText = 'sync'
 }
 
 function set_lang(lang) {
	 set_cookie('lang', lang)
	 window.location.reload()
	 toggle(dd_lang_label, dd_lang_frame)
	 dd_lang_label.querySelector('.material-icons').innerText = 'sync'
 }
 
 function get_cookie(key) {
	 if(document.cookie) {
		 const cookies = document.cookie.split(';')
		 for(const cookie of cookies) {
			 const c = cookie.split('=')
			 if(c[0].trim() == key) {
				 return c[1]
				 break
			 }
		 }
	 }
	 return false
 }
 
 function toggle_ajaxsave() {
	 const state = get_cookie('ajax_save_p')
	 if(state === '0') {
		 set_cookie('ajax_save_p', '1')
		 toggle_ajaxsave_btn.innerText = 'check'
	 }
	 else {
		 set_cookie('ajax_save_p', '0')
		 toggle_ajaxsave_btn.innerText = 'close'
	 }
	 toggle_ajaxsave_btn.innerText = 'sync'
	 window.location.reload()
 }
</script>
<?php
require_once("../script/php/footer.php");
?>
