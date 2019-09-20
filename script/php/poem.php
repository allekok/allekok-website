<?php
/* Translate poems IDs to kurdish */
$row[1]['ckbid'] = num_convert(
    $row[1]['id'],"en", "ckb");
if($row[0]) $row[0]['ckbid'] = num_convert(
    $row[0]['id'],"en", "ckb");
if($row[2]) $row[2]['ckbid'] = num_convert(
    $row[2]['id'],"en", "ckb");
?>
<script>
 const pID = <?php echo $info['id']; ?>,
       bID = <?php echo $bk; ?>,
       mID = <?php echo $row[1]['id']; ?>,
       poem_adrs = `poet:${pID}/book:${bID}/poem:${mID}`,
       poemObject = {
	   url: poem_adrs,
	   poetID: pID,
	   poetName: "<?php echo $info['takh']; ?>",
	   book: "<?php echo $bknow[$bk-1]; ?>",
	   poem: "<?php echo $row[1]['name']; ?>",
       };
</script>

<div id="poets">
    <!-- Poet picture -->
    <img src="<?php 
	      echo get_poet_image($info['id'], true); 
	      ?>" class="poet-pic-small"
	 alt="<?php echo $info['profname']; ?>">
    <!-- Address -->
    <div id='adrs'>
	<a href="<?php echo "/poet:$ath"; ?>">
	    <?php echo $info['takh']; ?>
	</a>
	<i> &rsaquo; </i>
	<a href="<?php echo "/poet:$ath/book:$bk"; ?>">
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
			 echo "/poet:".$info['id']."/book:".
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
			 echo "/poet:".$info['id']."/book:".
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
            echo "<a href='/dev/tools/poem-plain.php?poet=$ath&book=$bk&poem=$id' 
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
	    گۆڕینی ئەلفوبێ: 
	    <button class='button link' type="button"
		    id="convertToLatBtn"
		    style="font-size:1em;margin-right:.5em;
			   letter-spacing:.5px"
	    ><i style='font-family:monospace;
		       font-weight:bold;
		       text-transform:uppercase;
		       font-size:.9em'
	     >Elfubêy Latîn</i></button>
	</div>
	<div>
	    <i class="material-icons icon-round icon-round-poem">dehaze</i>
	    <button type="button"
		    id="make_poem_dict"
		    style="font-size:1em">
		دروست کردنی فەرهەنگ بۆ ئەم دەقە
	    </button>
	</div>
	<div style='text-align:center'>
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
			    class='button material-icons'
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
	<div id="poem_dict" style="font-size:.55em;
		 text-align:right;border-left:2px solid;
		 padding-left:1em;margin-left:1em;
		 word-break:break-word;display:none">
	    <div id="poem_dict_close"
		 style="text-align:left;font-size:1.5em;
		     cursor:pointer"
	    ><i class="material-icons"
	     >arrow_forward</i></div>
	    <div id="poem_dict_context"></div>
	</div>
	<!-- Poem context -->
	<article id='hon'>
	    <?php
	    echo $row[1]['hon'];
	    ?>
	</article>
    </div>
    <script>
     /* Set poem font size */
     document.getElementById("hon").
	      style.fontSize = function(s)
	      {
		  if(s !== null && !isNaN(s))
		      return `${s}px`;
	      }
     (localStorage.getItem('fontsize'));
    </script>
    <!-- Poem description -->
    <?php if($row[1]['hdesc']) { ?>
	<span id='bhondesc' style='display:block'>
	    <?php echo $row[1]['hdesc']; ?>
	</span>
    <?php } ?>
    <!-- Comments -->
    <h1 class="color-blue"
	style="font-size:1em;text-align:right;padding-top:.5em">
	بیر و ڕاکان
    </h1>
    <div id="hon-comments">
	<div style="padding:.5em 0;font-size:.6em;text-align:right">
            دەتوانن بیر و ڕای خۆتان سەبارەت بەم شێعرە لێرە بنووسن.
	    <br>
	    تکایە ئەگەر ئەم دەقە هەڵەی تێدایە پێمانی ڕا بگەیێنن.
	</div>
	<form id="frmComm"
	      style="max-width:700px;margin:auto"
	      action="/script/php/comments-add.php"
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
		    style="font-size:.7em;padding:1em 1.5em"
	    >ناردن</button>
	</form>
	<!--
	     Comments
	-->
	<div id='hon-comments-body'
	     style='padding:0 .2em'></div>
    </div>
    <script>
     window.addEventListener('load', function()
     {
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

	     postUrl("/script/php/comments-add.php", request, function (responseText) {
		 const res = isJson(responseText);
		 
		 if(res && res.status)
		 {
		     name.value = res.name;
		     comment.value = "";
		     message.style.background = "rgba(0,255,0,.1)";
		     message.innerHTML = res.message;
		     const newComm = "<div class='comment'><\
div class='comm-name'>"+res.name+":</div><\
div class='comm-body'>"+res.comment+"</div><\
div class='comm-footer'>"+res.date+"</div></div>";
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
	 
	 <?php
	 /* Check for comments */
	 $db = 'index';
	 $address = 'poet:'.$info['id'].
		    '/book:'.$bk.
		    '/poem:'.$row[1]['id'];
	 $q = "select * from comments where 
address='$address' and blocked=0";
	 require("condb.php");
	 
	 if($query and
	     @mysqli_num_rows($query)>0) {                 
	 ?>
	 getUrl('/script/php/comments-get.php?address='+
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
	 
	 /* Load user name into `commNameTxt' */
	 try
	 {
	     document.getElementById("commNameTxt").value =
		 isJson(localStorage.getItem("contributor")).name;
	 }
	 catch (e) {}

	 /* Footnotes */
	 const sups = document.querySelectorAll("sup");
	 sups.forEach(function(o)
	 {
	     o.addEventListener(
		 "click", function()
		 {
		     window.scrollTo(
			 0, document.querySelector(
			     ".m.d.cf:last-child").
				     offsetTop - 10);
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
	 const convertToLatBtn = document.getElementById("convertToLatBtn"),
	       defLabel = convertToLatBtn.innerHTML,
	       newLabel = "ئەلفوبێی عەرەبی",
	       origin_poem = document.getElementById("hon").innerHTML;
	 
	 function convert_to_latin(toarabi=false)
	 {
	     const tar = document.getElementById("hon");
	     tar.style.animation = "";
	     void tar.offsetWidth;
	     
	     if(!toarabi)
	     {
		 const ltn = arabi_to_latin(tar.innerText)
		     .replace(/\n/g, "<br>\n");
		 tar.innerHTML =
		     poem_kind(origin_poem)=="new" ?
		     "<div class=\"n\"><div class=\"m dltr\">" +
		     ltn + "</div></div>" :
		     "<div class=\"b\">" + ltn + "</div>";
		 convertToLatBtn.innerHTML = newLabel;
		 tar.style.direction = "ltr";
	     }
	     else
	     {
		 tar.innerHTML = origin_poem;
		 convertToLatBtn.innerHTML = defLabel;
		 tar.style.direction = "rtl";
	     }
	     tar.style.animation = "tL .5s";
	 }
	 
	 convertToLatBtn.addEventListener(
	     "click", function()
	     {
		 if(convertToLatBtn.innerHTML == defLabel)
		     convert_to_latin();
		 else
		     convert_to_latin("origin");
	     });
	 
	 const loaderMin = "<div class='loader' \
style='vertical-align:middle;margin:1em auto'></div>";
	 
	 document.getElementById("wordFrm").
		  addEventListener("submit", function(e)
		  {
		      e.preventDefault();
		      const q_el = document.getElementById('wordTxt');
		      lookup(q_el, 'wordResult');
		  });
	 
	 function lookup (q_el, result_el_id)
	 {
	     const dicts = ['xal', 'henbane-borine',
			    'bashur', 'kameran'],
		   dicts_req = dicts.join(','),
		   result_el = document.getElementById(result_el_id),
		   q = encodeURIComponent(q_el.value.trim()),
		   url = '/tewar/src/backend/lookup.php',
		   request = `q=${q}&dicts=${dicts_req}&output=json`,
		   loading = '<div class="loader"></div>',
		   wordMore = document.getElementById('wordMore');
	     
	     if(!q)
	     {
		 q_el.focus();
		 return;
	     }

	     // Loading animation
	     result_el.innerHTML = loading;

	     postUrl(url, request, function(response) {
		 response = isJson(response);
		 if(! response) return;
		 
		 let toprint = '';
		 for(const i in response)
		 {
		     if(i == 'time') continue;
		     
		     const res = response[i];
		     for(const w in res)
		     {
			 const m = res[w];
			 if(! m) continue;
			 toprint += `- <i class='color-blue'>${w}</i>: <p>${m}</p>`;
		     }
		 }
		 result_el.innerHTML = toprint;
	     });
	     wordMore.innerHTML = `<a target='_blank' href='/tewar/?q=${q}'>گەڕانی زیاتر لە "تەوار"دا</a>`;
	 }

	 document.getElementById('make_poem_dict').
		  addEventListener('click', function() {
		      const poem = document.getElementById('hon').innerText;
		      const q_el = document.createElement('textarea');
		      
		      q_el.value = poem;
		      lookup(q_el, 'poem_dict_context');

		      const poem_wrapper_el = document.getElementById('poem-wrapper');
		      const poem_dict_el = document.getElementById('poem_dict');
		      const hon_el = document.getElementById('hon');
		      
		      poem_wrapper_el.style.display = 'flex';
		      poem_dict_el.style.display = 'block';
		      poem_dict_el.style.width = '35%';
		      hon_el.style.width = '65%';
		  });
	 
	 document.getElementById('poem_dict_close').
		  addEventListener('click', function() {
		      const poem_wrapper_el = document.getElementById('poem-wrapper');
		      const poem_dict_el = document.getElementById('poem_dict');
		      const hon_el = document.getElementById('hon');
		      
		      poem_wrapper_el.style.display = '';
		      poem_dict_el.style.width = '';
		      poem_dict_el.style.display = 'none';
		      hon_el.style.width = '';
		  });
     });
    </script>
</div>
