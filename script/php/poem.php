<?php
/* Translate poems IDs to kurdish */
$row[1]['ckbid'] = num_convert(
	$row[1]['id'],"en", "ckb");
if($row[0]) $row[0]['ckbid'] = num_convert(
	$row[0]['id'],"en", "ckb");
if($row[2]) $row[2]['ckbid'] = num_convert(
	$row[2]['id'],"en", "ckb");
?>
<div id="poets">
	<!-- Poet picture -->
	<img src="<?php 
		  echo _R . get_poet_image($info['id'], false); 
		  ?>" class="poet-pic-small"
	     alt="<?php echo $info['profname']; ?>">
	<!-- Address -->
	<div id='adrs'>
		<a href="<?php echo _R . "poet:$ath"; ?>">
			<?php echo $info['takh']; ?>
		</a>
		<i> &rsaquo; </i>
		<a href="<?php echo _R . "poet:$ath/book:$bk"; ?>">
			<?php echo $bknow[$bk-1]; ?>
		</a>
		<i> &rsaquo; </i>
		<div id="current-location">
			<?php echo $row[1]['ckbid'].'. '.$row[1]['name']; ?>
		</div>
	</div>
	<!-- Navigation -->
	<div class="nav"
	     style="<?php 
		    if(!($row[0] or $row[2])) echo "display:none;";
		    elseif(!$row[0]) echo "text-align:left;";
		    elseif(!$row[2]) echo "text-align:right;";
		    else echo "display:flex;";
		    ?>">
		<?php if($row[0]) { ?>
			<!-- Previous -->
			<div class="prev">
				<a style="display:block"
				   href="<?php 
					 echo _R . "poet:".$info['id']."/book:".
					      $bk."/poem:".$row[0]['id'];
					 ?>"
				><i
				 >&lsaquo;</i><div
					      ><?php 
					       echo $row[0]['ckbid'].". ".
						    trim($row[0]['name']);
					       ?>
				 </div>
				</a>
			</div>
		<?php
		}
		if($row[2]) {
		?>
			<!-- Next -->
			<div class="next">
				<a style="display:block"
				   href="<?php
					 echo _R . "poet:".$info['id']."/book:".
					      $bk."/poem:".$row[2]['id'];
					 ?>"
				><div
				 ><?php 
				  echo $row[2]['ckbid'].". ".
				       trim($row[2]['name']);
				  ?>
				</div><i>&rsaquo;</i>
				</a>
			</div>
		<?php } ?>
	</div>
	<!-- Toolbar -->
	<div class='fontsize'>
		<!--
		   - Toolbar
		     Font adjustment buttons
		     Copy button
		     Other tools button
		     Bookmark button
		-->
		<button class='bigger material-icons icon-round icon-round-poem'
			style="padding:.5em"
		>arrow_upward
		</button
		><button class='smaller material-icons icon-round icon-round-poem'
			 style="padding:.5em"
		 >arrow_downward
		</button
		><button id='copy-sec' class='copy material-icons icon-round icon-round-poem'
			 style="padding:.5em"
		 >content_copy
		</button
		><?php
		 if( !($ath == 10 and
			 $bk == 1 and
			 $row[1]['id'] == 1) )
		 {
		 ?><button id='like-icon' class='material-icons icon-round icon-round-poem'
			   style="padding:.5em"
		   >bookmark_border
		 </button
		 ><?php
		  }
		  ?><button id='extlnkico'
			    style='padding:.5em'
			    class='material-icons icon-round icon-round-poem' 
			    title='ئامێرەکانی‌تر'>more_horiz
		  </button>
	</div>
	<!--
	   - Toolbar
	     Other tools window
	-->
	<div style='display:none'
	     id='extlnk'>
		<?php
		if($row[1]['link'])
		{
			$ext_link = explode("[t]", $row[1]['link']);
			echo "<div>";
			echo "<i class='material-icons icon-round icon-round-poem'>link</i>";
			echo "<a href='{$ext_link[1]}' 
title='{$row[1]['name']}' target='_blank' 
rel='noopener noreferrer nofollow' 
style='display:inline-block'
>ئەم دەقە لەسەر &laquo;{$ext_link[0]}&raquo;</a> ";
			$probability = intval($ext_link[2]) / 4 * 100;
			$probability = "<i style='font-size:.7em;letter-spacing:1px'>%</i>" .
				       num_convert($probability, "en", "ckb");
			echo "<span style='font-size:.8em;letter-spacing:.7px'
>($probability)</span>";
			echo "</div>";
		}
		?>
		<div>
			<!--
			     Plain/text link
			-->
			<i class='material-icons icon-round icon-round-poem'
			>insert_drive_file</i>
			<?php
			echo "<a href='"._R."dev/tools/poem-plain.php?poet=$ath&book=$bk&poem=$id' 
title='{$row[1]['name']}' target='_blank' 
rel='noopener noreferrer nofollow' 
style='display:inline-block'
>وەشانی تێکست</a>";
			?>
		</div>
		<div>
			<!--
			     Latin <-> Arabic
			-->
			<i class='material-icons icon-round icon-round-poem'
			>compare_arrows</i>
			ئەلفوبێ: 
			<button class='link convertToEtcBtn' type="button"
				style="font-size:1em;margin-right:.5em;
				       font-weight:bold"
			>کوردی</button>
			<button class='link convertToEtcBtn' type="button"
				style="font-size:1em;margin-right:.5em;
				       font-family:monospace;font-weight:bold"
			>Kurdî</button>
			<button class='link convertToEtcBtn' type="button"
				style="font-size:1em;margin-right:.5em;
				       font-weight:bold"
			>فارسی</button>
		</div>
		<div style='text-align:center;
			    border-top:1px solid;
			    padding-top:1em;margin-top:1em'>
			<!--
			     Dictionary lookup form
			-->
			<form id="wordFrm"
			      style="display:flex;margin:auto">
				<i class="material-icons icon-round icon-round-poem"
				   style="height:100%;margin:auto 0 auto .5em">
					translate
				</i>
				<section style="width:100%;margin:auto">
					<input type="text" id="wordTxt"
					       style="width:100%"
					       placeholder="گەڕان بۆ واتای وشە...">
				</section
				><section style="margin:auto">
					<button type="submit" id="wordBtn"
						class='material-icons'
						style="font-size:2em;
						      padding:0 .5em"
					>search</button>
				</section>
			</form>
			<div id="wordRes"
			     style="text-align:right;margin-top:.5em">
				<!--
				     Dictionary results
				-->
				<div id="wordResult"></div>
				<div id="wordMore"></div>
			</div>
		</div>
	</div>
	<div id="poem-wrapper">
		<!-- Poem context -->
		<article id='hon'>
			<?php
			echo $row[1]['hon'];
			?>
		</article>
	</div>
	<!-- Poem description -->
	<span id='bhondesc'<?php if(!$row[1]['hdesc']) echo "style='display:none'"; ?>>
		<?php echo @$row[1]['hdesc']; ?>
	</span>
	<!-- Navigation -->
	<div class="nav" id="bottom-nav"
	     style="<?php 
		    if(!($row[0] or $row[2])) echo "display:none;";
		    elseif(!$row[0]) echo "text-align:left;";
		    elseif(!$row[2]) echo "text-align:right;";
		    else echo "display:flex;";
		    ?>">
		<?php if($row[0]) { ?>
			<!-- Previous -->
			<div class="prev">
				<a style="display:block"
				   href="<?php 
					 echo _R . "poet:".$info['id']."/book:".
					      $bk."/poem:".$row[0]['id'];
					 ?>"
				><i
				 >&lsaquo;</i><div
					      ><?php 
					       echo $row[0]['ckbid'].". ".
						    trim($row[0]['name']);
					       ?>
				 </div>
				</a>
			</div>
		<?php
		}
		if($row[2]) {
		?>
			<!-- Next -->
			<div class="next">
				<a style="display:block"
				   href="<?php
					 echo _R . "poet:".$info['id']."/book:".
					      $bk."/poem:".$row[2]['id'];
					 ?>"
				><div
				 ><?php 
				  echo $row[2]['ckbid'].". ".
				       trim($row[2]['name']);
				  ?>
				</div><i>&rsaquo;</i>
				</a>
			</div>
		<?php } ?>
	</div>
	<!-- Comments -->
	<h1 class="color-blue" id="hon-comments-title"
		   style="font-size:1em;
		   padding-top:.5em;
		   cursor:pointer;
		   text-align:right">
		<i class="material-icons">question_answer</i>
		پەراوێز نووسین
	</h1>
	<div id="hon-comments" style="display:none">
		<div style="padding:.5em 0;font-size:.6em;text-align:right">
			دەتوانن بیر و ڕای خۆتان سەبارەت بەم شێعرە لێرە بنووسن.
			<br>
			تکایە ئەگەر ئەم دەقە هەڵەی تێدایە پێمانی ڕا بگەیێنن.
		</div>
		<form id="frmComm"
		      style="margin:auto"
		      action="<?php echo _R; ?>script/php/comments-add.php"
		      method="POST">
			<!--
			     Comment submition form
			-->
			<input type='text' name='name'
			       id='commNameTxt'
			       placeholder="نێوی خۆتان لێرە بنووسن.">
			<textarea
				placeholder="بیر و ڕای خۆتان سەبارەت بەو شێعرە لێرە بنووسن... *" 
					     id="commTxt" name='comment'></textarea>
			<div id="message"></div>
			<button class='button bth' type="submit"
				style="font-size:.7em;padding:.5em 1.5em"
			>ناردن</button>
		</form>
		<!--
		     Comments
		-->
		<div id='hon-comments-body'></div>
	</div>
	<script>
	 /* Set poem font size */
	 document.getElementById('hon').
		  style.fontSize = function(s)
	 {
		 if(s !== null && !isNaN(s))
			 return `${s}px`;
	 }
	 (localStorage.getItem('fontsize'));
	 const pID = <?php echo $info['id']; ?>,
	       bID = <?php echo $bk; ?>,
	       mID = <?php echo $row[1]['id']; ?>;
	 window.poem_adrs = `poet:${pID}/book:${bID}/poem:${mID}`;
	 window.poemObject = {
		 url: poem_adrs,
		 poetID: pID,
		 poetName: "<?php echo $info['takh']; ?>",
		 book: "<?php echo $bknow[$bk-1]; ?>",
		 poem: "<?php echo $row[1]['name']; ?>",
	 };
	 const loader = "<div class='loader' \
			     style='margin-top:.5em'></div>",
	       message = document.getElementById("message"),
	       name = document.getElementById("commNameTxt"),
	       comments = document.getElementById("hon-comments-body");
	 
	 function send_comment()
	 {
		 const comment = document.getElementById("commTxt"),
		       request = "address=" + poem_adrs +
				 "&name=" + encodeURIComponent(name.value) +
				 "&comment=" + encodeURIComponent(comment.value);
		 
		 if(comment.value == "")
		 {
			 comment.focus();
			 return;
		 }
		 
		 message.innerHTML = loader;

		 postUrl("<?php echo _R; ?>script/php/comments-add.php", request, function (responseText) {
			 const res = isJson(responseText);
			 
			 if(res && res.status)
			 {
				 name.value = res.name;
				 comment.value = "";
				 message.style.background = "rgba(0,255,0,.1)";
				 message.innerHTML = res.message;
				 const newComm = "<div class='comment'><div class='comm-name'>"+res.name+":</div><div class='comm-body'>"+res.comment+"</div><div class='comm-footer'>"+res.date+"</div></div>";
				 comments.innerHTML = newComm +
						      comments.innerHTML;
				 
				 if(res.name != "ناشناس")
				 {
					 localStorage.setItem(
						 "contributor",
						 JSON.stringify(
							 {name: res.name}
					 ));
				 }
				 window.location = "#hon-comments-body";
			 }
		 });
	 }
	 
	 document.getElementById("frmComm").
		  addEventListener("submit", function(e)
			  {
				  e.preventDefault();
				  send_comment();
		  });
	 
	 /* Load user name into `commNameTxt' */
	 try
	 {
		 document.getElementById("commNameTxt").value =
			 JSON.parse(localStorage.getItem("contributor")).name;
	 }
	 catch (e) {}

	 /* Footnotes */
	 const sups = document.querySelectorAll("sup");
	 sups.forEach(function(o) {
		 o.addEventListener("click", function () {
			 window.scrollTo(0, document.querySelector(
				 ".m.d.cf:last-child").offsetTop - 10);
		 });
	 });
	 
	 /* Other tools window */
	 document.getElementById("extlnkico").
		  addEventListener("click" , function()
			  {
				  const extlnk = document.getElementById("extlnk");
				  if(extlnk.style.display != "block")
				  {
					  extlnk.style.display = "block";
					  extlnk.style.animation = ".25s tL";
				  }
				  else
				  {
					  extlnk.style.display = "none";
				  }
		  });

	 /* Tewar */
	 const convertToEtcBtns = document.querySelectorAll(".convertToEtcBtn"),
	       origin_poem_title = document.getElementById("current-location").innerHTML,
	       origin_poem = document.getElementById("hon").innerHTML,
	       origin_poem_desc = document.getElementById("bhondesc").innerHTML;
	 
	 function convert_to_etc (to="کوردی")
	 {
		 const tar = document.getElementById("hon"),
		       title = document.getElementById("current-location"),
		       desc = document.getElementById("bhondesc");
		 
		 tar.style.animation = "";
		 void tar.offsetWidth;
		 let props;
		 
		 if(to == "Kurdî") props = [transliterate_ar2lat, "ltr"];
		 else if(to == "فارسی") props = [transliterate_ar2per, "rtl"];
		 if(to == "کوردی")
		 {
			 title.innerHTML = origin_poem_title;
			 tar.innerHTML = origin_poem;
			 desc.innerHTML = origin_poem_desc;
			 title.style.direction = "rtl";
			 tar.style.direction = "rtl";
			 desc.style.direction = "rtl";
		 }
		 else
		 {
			 title.innerHTML = origin_poem_title;
			 tar.innerHTML = origin_poem;
			 desc.innerHTML = origin_poem_desc;
			 apply_to_text(tar, props[0]);
			 apply_to_text(title, props[0]);
			 apply_to_text(desc, props[0]);
			 if(props[1] == "ltr") {
				 tar.querySelectorAll(".m").forEach(function (o) {
					 o.classList.add("dltr");
				 });
			 }
			 title.style.direction = props[1];
			 tar.style.direction = props[1];
			 desc.style.direction = props[1];
		 }
	 }
	 
	 convertToEtcBtns.forEach(function (o) {
		 o.addEventListener("click", function () {
			 convert_to_etc(o.innerText);
		 });
	 });
	 
	 const loaderMin = "<div class='loader' \
				    style='vertical-align:middle;margin:1em auto'></div>";
	 
	 document.getElementById("wordFrm").
		  addEventListener("submit", function(e) {
			  e.preventDefault();
			  const q_el = document.getElementById('wordTxt');
			  lookup(q_el, 'wordResult');
		  });
	 
	 function lookup (q_el, result_el_id)
	 {
		 const result_el = document.getElementById(result_el_id),
		       q = encodeURIComponent(q_el.value.trim()),
		       url = '<?php echo _R; ?>tewar/src/backend/lookup.php',
		       dicts_str = 'xal,kameran,henbane-borine,bashur,kawe,e2k,zkurd',
		       request = `q=${q}&dicts=${dicts_str}&output=json&n=1`,
		       loading = '<div class="loader"></div>',
		       wordMore = document.getElementById('wordMore');
		 
		 if(!q)
		 {
			 q_el.focus();
			 return;
		 }

		 // Loading animation
		 result_el.innerHTML = loading;

		 getUrl(`${url}?${request}`, function(response) {
			 response = isJson(response);
			 if(! response) return;
			 
			 let toprint = '';
			 for(const i in response)
			 {
				 if(i == 'time') continue;
				 
				 const w = response[i][1],
				       m = response[i][2];
				 toprint += m ? `<i class='color-blue'>${w}</i>: ${m}<br>` : '';
			 }
			 result_el.innerHTML = toprint;
		 });
		 wordMore.innerHTML = `<a target='_blank' href='<?php echo _R; ?>tewar/?q=${q}'>گەڕانی زیاتر لە تەواردا &rsaquo;</a>` +
				      `<a target='_blank' href='<?php echo _R; ?>tewar-legacy/?q=${q}'>گەڕانی زیاتر لە فەرهەنگە ئانلاینەکان‌دا &rsaquo;</a>`;
	 }
	 
	 <?php
	 if(!$no_foot)
		 echo "window.addEventListener('load', function () { ";
	 ?>
	 document.querySelector(".smaller").onclick = function () {
		 save_fs("smaller");
	 }
	 document.querySelector(".bigger").onclick = function () {
		 save_fs("bigger");
	 }
	 try {
		 document.getElementById("like-icon").onclick = Liked;
	 } catch (e) {};
	 document.getElementById("copy-sec").onclick = copyPoem;
	 
	 const likeico = document.getElementById('like-icon');
	 const favs = get_bookmarks();
	 if(favs)
	 {
		 for(const i in favs)
		 {
			 if(favs[i].url == poemObject.url)
			 {
				 likeico.innerHTML = 'bookmark';
				 likeico.classList.add('back-blue');
				 likeico.style.animation = 'll .4s ease-out forwards';
				 break;
			 }
		 }
	 }
	 if(document.getElementById("hon").offsetHeight < 300)
		 document.getElementById("bottom-nav").style.display = "none";
	 <?php if(!$no_foot) echo ' });' ?>
	 
	 document.getElementById("hon-comments-title").onclick = function () {
		 const commentsSec = document.getElementById("hon-comments");
		 if(commentsSec.style.display != "none")
			 commentsSec.style.display = "none";
		 else {
			 commentsSec.style.display = "";
			 <?php
			 /* Check for comments */
			 $address = 'poet:'.$info['id'].
				    '/book:'.$bk.
				    '/poem:'.$row[1]['id'];
			 $q = "select id from comments where 
address='$address' and blocked=0"; // Add limit 0,1
			 require('condb.php');
			 
			 if($query and
				 mysqli_num_rows($query)>0)
			 {
			 ?>
			 document.getElementById("hon-comments-body").style.padding = "1em .2em";
			 getUrl('<?php echo _R; ?>script/php/comments-get.php?address='+
				poem_adrs, function(responseText)
				 {
					 const res = isJson(responseText);
					 if(res && res.err != 1)
					 {
						 let newComm = "";
						 for(const a in res)
						 {
							 newComm += "<div class='comment'\
			><div class='comm-name'>"+res[a].name+":</div><div \
									   class='comm-body'>"+res[a].comment+"</div><div \
															  class='comm-footer'>"+res[a].date+"</div></div>";
						 }
						 comments.innerHTML = newComm;
					 }
			 });
			 <?php
			 }
			 ?>
			 
		 }
	 }
	</script>
</div>
