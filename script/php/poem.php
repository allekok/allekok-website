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
		><i style="color:inherit;font-size:inherit;
			   font-style:normal;display:inline-block;
			   width:10%;max-width:.8em;
			   vertical-align:top"
		 >&lsaquo;</i><div style="display:inline-block;
					  overflow:hidden;
					  white-space:nowrap;
					  text-overflow:ellipsis;
					  width:90%;
					  vertical-align:middle;"
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
		<a style="display:block;"
		   href="<?php
			 echo "/poet:".$info['id']."/book:".
			      $bk."/poem:".$row[2]['id'];
			 ?>"
		><div style='display:inline-block;overflow:hidden;
			     white-space:nowrap;text-overflow:ellipsis;
			     width:90%;vertical-align:middle;'
		 ><?php 
		  echo $row[2]['ckbid'].". ".
		       trim($row[2]['name']);
		  ?>
		</div><i style="color:inherit;font-size:inherit;
				font-style:normal;display:inline-block;
				width:10%;max-width:.8em;vertical-align:top"
		      >&rsaquo;</i>
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
        <button class='bigger material-icons icon-round'
		       style="padding:.5em"
	>arrow_upward
	</button
	><button class='smaller material-icons icon-round'
		 style="padding:.5em"
	 >arrow_downward
        </button
	><button id='copy-sec' class='copy material-icons icon-round'
		 style="padding:.5em"
	 >content_copy
        </button
	><?php
	 if( !($ath == 10 and
	     $bk == 1 and
	     $row[1]['id'] == 1) )
	 {
	 ?><button id='like-icon' class='material-icons icon-round'
		   style="padding:.5em"
	   >bookmark_border
	 </button
	 ><?php
	  }
	  ?><button id='extlnkico'
		    style='padding:.5em'
		    class='material-icons icon-round' 
		    title='ئامێرەکانی‌تر'>more_horiz
	  </button>
    </div>
    <!--
       - Toolbar
	 Other tools window
    -->
    <div style='display:none;font-size:.55em;
		max-width:500px;margin:auto auto .5em;
		padding:.5em 1em;text-align:right'
	 id='extlnk'>
	<style>
	 .icon-round {
	     font-size:1.2em;
	     padding:.3em;
	     margin-left:.5em
	 }
	</style>
	<?php
	if($row[1]['link'])
	{
            $ext_link = explode("[t]", $row[1]['link']);
            echo "<div>";
            echo "<i class='material-icons icon-round'>link</i>";
            echo "<a href='{$ext_link[1]}' 
title='{$row[1]['name']}' target='_blank' 
rel='noopener noreferrer nofollow' 
style='display:inline-block'
>ئەم شێعرە لەسەر &laquo;{$ext_link[0]}&raquo;</a> ";
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
	    <i class='material-icons icon-round'
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
	    <i class='material-icons icon-round'
	    >translate</i> 
	    گۆڕینی ئەلفوبێ: 
	    <button class='button link' type="button"
		    id="convertToLatBtn"
		    style="font-size:1em;margin-right:.5em;
			   letter-spacing:.5px"
	    ><i class="color-555" style='font-family:monospace;
		       font-weight:bold;
		       text-transform:uppercase;
		       font-size:.9em'
	     >Elfubêy Latîn</i></button>
	</div>
	<div style='text-align:center'>
	    <!--
		 Dictionary lookup form
	    -->
	    <form id="wordFrm"
		  style="display:flex;margin:auto">
		<i class="icon-round"
		   style="margin:auto 0 auto 1em;
			  font-weight:bold;
			  font-size:.7em">
		    تەوار
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
		<style>
		 #wordResKawa button {
                     cursor:pointer;
                     font-size:inherit;
                     background:none
		 }
		 #wordMore {
                     text-align:left
		 }
		 #wordMore a {
                     text-align:center;
                     padding:.3em .8em
		 }
		 #wordMore a:hover {
                     text-decoration:none;
		 }
		</style>
		<div id="wordResFerheng"></div>
		<div id="wordResKawa"></div>
		<div id="wordMore"></div>
	    </div>
	</div>
    </div>
    <!-- Poem context -->
    <article id='hon'>
	<?php
	echo $row[1]['hon'];
	?>
    </article>
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
            دەتوانن بیر و ڕای خۆتان سەبارەت بەم شێعرە بنووسن.
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
		    style="font-size:.7em;width:50%;
			   padding:1em 0;max-width:150px"
	    >ناردن</button>
	</form>
	<!--
	     Comments contexts
	-->
	<div id='hon-comments-body'
	     style='padding:0 .2em'></div>
    </div>
    <script>
     window.addEventListener('load', function() {
	 const loader = "<div class='loader' \
style='margin-top:.5em'></div>",
	       message = document.getElementById("message"),
	       name = document.getElementById("commNameTxt"),
	       comments = document.getElementById("hon-comments-body");
	 
	 function send_comment() {	     		     
	     const comment = document.getElementById("commTxt");
	     
	     if(comment.value == "") {
		 comment.focus();
		 return;
	     }
	     
	     message.innerHTML = loader;
	     comment.background = "#eee";
	     comment.color = "#888";
	     
	     const xmlhttp = new XMLHttpRequest();
	     xmlhttp.onload = function() {
		 const res = JSON.parse(this.responseText);
		 
		 if(res.status) {
		     var newComm = "";
		     comment.background = "";
		     comment.color = "";
		     name.value = res.name;
		     comment.value = "";
		     message.style.background =
			 "rgba(0,255,0,.1)";
		     message.innerHTML = res.message;
		     newComm = "<div class='comment'><\
div class='comm-name'>"+res.name+":</div><\
div class='comm-body'>"+res.comment+"</div><\
div class='comm-footer'>"+res.date+"</div></div>";
		     comments.innerHTML = newComm +
					  comments.innerHTML;
		     
		     if(res.name != "ناشناس") {
			 localStorage.setItem(
			     "contributor",
			     JSON.stringify(
				 {name: res.name}
			     ));
		     }
		     window.location = "#hon-comments-body";
		 }
	     }
	     
	     const request = "address=" + poem_adrs +
			     "&name=" + name.value +
			     "&comment=" +
			     encodeURIComponent(comment.value);
	     
	     xmlhttp.open("POST",
			  "/script/php/comments-add.php");
	     xmlhttp.setRequestHeader(
		 "Content-type",
		 "application/x-www-form-urlencoded");
	     xmlhttp.send(request);
	 }
	 
	 document.getElementById("frmComm").
		  addEventListener("submit", function(e) {
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
		poem_adrs, function(responseText) {
		    
		    const res = JSON.parse(responseText);
		    if(res.err != 1) {
			var newComm = "";
			for(a in res)
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
	 document.getElementById("commNameTxt").
		  value = function (nameObj) {
		      if(nameObj === null) return "";
		      return JSON.parse(nameObj).name || "";
		  } (localStorage.getItem("contributor"));

	 /* Footnotes */
	 const sups = document.querySelectorAll("sup");
	 sups.forEach(function(e) {
	     e.addEventListener(
		 "click",function() {
		     window.scrollTo(
			 0, document.querySelector(
			     ".m.d.cf:last-child").
				     offsetTop - 10);
		 });
	 });

	 /* Other tools window */
	 document.getElementById("extlnkico").
		  addEventListener("click" , function() {
		      
		      const extlnk = document.getElementById("extlnk");
		      if(extlnk.style.display != "block") {
			  extlnk.style.display = "block";
			  extlnk.style.animation = ".4s \
cubic-bezier(0.18, 0.89, 0.32, 1.28) tL";
		      }
		      else {
			  extlnk.style.display = "none";
		      }
		  });
	 
	 const convertToLatBtn = document.getElementById("convertToLatBtn"),
	       defLabel = convertToLatBtn.innerHTML,
	       newLabel = "ئەلفوبێی عەرەبی",
	       origin_poem = document.getElementById("hon").innerHTML;
	 
	 function poem_kind()
	 {
	     if(origin_poem.indexOf(
		 "<div class=\"n\">")!=-1) {
		 return "new";
	     }
	     return "classic";
	 }
	 
	 function convert_to_latin(toarabi=false) {
	     const tar = document.getElementById("hon");
	     tar.style.animation = "";
	     void tar.offsetWidth;
	     
	     if(!toarabi) {
		 const ltn = arabi_to_latin(tar.innerText)
		     .replace(/\n/g, "<br>\n");
		 tar.innerHTML =
		     poem_kind()=="new" ?
		     "<div class=\"n\"><div class=\"m dltr\">" +
		     ltn + "</div></div>" :
		     "<div class=\"b\">" + ltn + "</div>";
		 tar.style.animation = "tL .5s";
		 convertToLatBtn.innerHTML = newLabel;
		 tar.style.direction = "ltr";
	     }
	     else {
		 tar.innerHTML = origin_poem;
		 tar.style.animation = "tL .5s";
		 convertToLatBtn.innerHTML = defLabel;
		 tar.style.direction = "rtl";
	     }
	 }
	 
	 convertToLatBtn.addEventListener(
	     "click", function() {
		 if(convertToLatBtn.innerHTML == defLabel)
		     convert_to_latin();
		 else
		     convert_to_latin("origin");
	     });
	 
	 const loaderMin = "<div class='loader' \
style='vertical-align:middle;margin:1em auto'></div>";
	 
	 document.getElementById("wordFrm").
		  addEventListener("submit", function(e) {
		      e.preventDefault();
		      const q = document.getElementById("wordTxt");
		      if(q.value == "") {
			  q.focus();
			  return;
		      }
		      document.getElementById("wordMore").
			       innerHTML = "";
		      search_ferheng(
			  q.value,
			  "#wordResFerheng");
		      search_farhangumejuikawa(
			  q.value,
			  "#wordResKawa");
		  });
	 
	 function search_ferheng (q, t) {
	     t = document.querySelector(t);
	     t.innerHTML = loaderMin;
	     let res, fin = "";
	     
	     getUrl(
		 `/tewar/search/ferheng.info.php?q=${q}&n=1` ,
		 function(responseText) {

		     document.getElementById("wordMore").
			      innerHTML =
				  `<a class='link' 
target='_blank' href='https://allekok.com/tewar/?q=${q}'
>گەڕانی زیاتر لە "تەوار"دا</a>`;
		     if (responseText == "null") {
			 t.innerHTML = "";
			 return;
		     }
		     res = JSON.parse(responseText);
		     fin += "<span class='tp back-f3f3f3' \
style='display:block;font-size:.9em;padding:.3em .5em'\
>فەرهەنگی ئەناهیتا: </span>";
		     for( const a in res )
		     {
			 fin += "<div><section><a \
target='_blank' rel='noopener noreferrer nofollow' \
href='"+res[a].link+"' class='link-color'\
>"+res[a].title+"</a></section><section \
style='word-wrap:break-word;font-size:.87em;\
text-indent:1em;'>"+res[a].desc+"</section></div>";
		     }
		     t.innerHTML = fin;
		 });
	 }
     	 
	 function search_farhangumejuikawa (q, t) {
	     t = document.querySelector(t);
	     t.innerHTML = loaderMin;
	     let res, fin = "";
	     
	     getUrl(
		 `/tewar/search/farhangumejuikawa.com.php?q=${q}&n=1`,
		 function(responseText)
		 {
		     if (responseText == "null")
		     {
			 t.innerHTML = "";
			 return;
		     }

		     res = JSON.parse(responseText);	 
		     fin += "<span class='tp back-f3f3f3' \
style='display:block;font-size:.9em;padding:.3em .5em'\
>فەرهەنگی کاوە: </span>";
		     for( const a in res )
		     {
			 fin += "<div><section\
>"+res[a].link+"</section><section style='\
word-wrap:break-word;font-size:.87em;\
text-indent:1em;'>"+res[a].desc+"</section></div>";
		     }
		     
		     t.innerHTML = fin;
		     const frms = t.getElementsByTagName("form");
		     frms[0].setAttribute("target", "_blank");
		     document.querySelectorAll("#wordResKawa button").
			      forEach(function (item)
			      {
				  item.classList.add("link-color");
			      });
		 });
	 }
     });
    </script>
</div>
