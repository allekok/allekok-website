<a href="<?php echo _R; ?>donate/"
   class="color-blue"><?php P("donate"); ?></a>
<a id="rdm-pm-a" target="_blank"
   href="<?php echo _R; ?>script/php/random-poem.php?redirect"
   title="<?php P("random-poem-title"); ?>"><?php P("random-poem"); ?></a>
<script>
 document.getElementById("rdm-pm-a").onclick = function (e) {
	 e.preventDefault();
	 const loading = document.getElementById('main-loader');
	 loading.style.display = 'block';
	 getUrl(`${_R}script/php/random-poem.php`, function (url) {
		 const parent='body', target='#MAIN',
		       p = document.querySelector(parent);
		 
		 const href = url;
		 url = concat_url_query(href, 'nohead&nofoot');
		 
		 let content;
		 if(ajax_save_p && (content = ajax_findstate(url)))
			 ajax_load(url, href, content, parent, target, loading);
		 else
			 getUrl(url, function (content) {
				 ajax_load(url, href, content, parent, target, loading);
				 ajax_savestate(url, content);
			 });
	 });
 }
</script>
<a title="<?php P("about allekok"); ?>"
   href="<?php echo _R; ?>about/"><?php P("allekok?"); ?></a>
<a title="<?php P("allekok news"); ?>"
   href="<?php echo _R; ?>pitew/news.php"><?php P("news"); ?></a>
<a title="<?php P("allekok pitew"); ?>"
   href="<?php echo _R; ?>pitew/first.php"><?php P("pitew"); ?></a>
<a title="<?php P("thanks.."); ?>"
   href="<?php echo _R; ?>thanks/"><?php P("thanks"); ?></a>
<a title="<?php P("desktop"); ?>" href="<?php echo _R; ?>desktop/">
	<i class="material-icons">phone_iphone‌laptop</i>
</a>
<a title="<?php P("code"); ?>" href="<?php echo _R; ?>dev/tools/">
	<i class="material-icons">code</i>
</a>
<a title="<?php P("customize"); ?>" href="<?php echo _R; ?>customize/">
	<i class="material-icons">settings</i>
</a>
<a title="<?php P("copyright"); ?>"
   href="<?php echo _R; ?>dev/tools/license.php">
	<i class="material-icons">copyright</i>
</a>
<a title="<?php P("allekok-apps"); ?>" target="_blank"
   href="https://allekok.github.io/">
	<i class="material-icons">dehaze</i>
</a>
