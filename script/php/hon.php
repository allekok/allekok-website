<script>
 var pID = <?php echo $info['id']; ?>;
 var bID = <?php echo $bk; ?>;
 var mID = <?php echo $row[1]['id']; ?>;
 
 var poem_adrs = `poet:${pID}/book:${bID}/poem:${mID}`;
 
 var poemV2 = JSON.stringify({
     url: poem_adrs,
     poetID: pID,
     poetName: "<?php echo $info['takh']; ?>",
     book: "<?php echo $bknow[$bk-1]; ?>",
     poem: "<?php echo $row[1]['name']; ?>",
 });
</script>

<div id="poets">
    <img src="<?php echo get_poet_image($info['id'], 'profile', true); ?>" class="poet-pic-small" alt="<?php echo $info['profname']; ?>">

    <div id='adrs'>
	<a href="/poet:<?php echo $ath; ?>">
	    <?php
	    echo $info['takh'];
	    ?>
	</a>
	<i style='font-style:normal'> &rsaquo; </i>
	<a href="/poet:<?php echo $ath; ?>/book:<?php echo $bk; ?>">
	    <?php
	    $bknow = explode(',',$info['bks']);
	    
	    echo $bknow[$bk-1];
	    ?>
	</a>
	<i style='font-style:normal'> &rsaquo; </i>
	<div id="current-location">
	    <?php
	    $rrid_k = num_convert($row[1]['id'], "en", "ckb");
	    echo($rrid_k . ". " . $row[1]['name']);
	    ?>
	</div>
    </div>
    <?php if($row[2] != 0) { 
        $row[2]['ckbid'] = num_convert($row[2]['id'], "en", "ckb");
    }
    if($row[0] != 0) { 
        $row[0]['ckbid'] = num_convert($row[0]['id'], "en", "ckb");
    }
    ?>
    <div class="nav" style="font-size: .65em;color:#555;width:100%;<?php if(!($row[0]||$row[2])){echo('display:none;');} ?><?php if($row[0] === 0) { echo "text-align:left;"; } ?><?php if($row[2] === 0) { echo "text-align:right;"; } ?>">
	<?php if($row[0] != 0) { ?><div class="prev"><a style="color:inherit;font-size:inherit;display:inline-block;padding:.85em 0;display:block;" href="/poet:<?php echo $info['id']."/book:{$bk}/poem:{$row[0]['id']}"; ?>"><i style="color:inherit;font-size: inherit;font-style:normal;display:inline-block;width:10%;max-width:.8em;vertical-align:top">&lsaquo;</i><div style="display:inline-block;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:90%;vertical-align:middle;"> <?php 
																																																													echo $row[0]['ckbid'] . ". " . trim($row[0]['name']); ?></div></a></div><?php } ?><?php if($row[2] != 0) { ?><div class="next"><a style="color:inherit;font-size:inherit;display:inline-block;padding:.85em 0;display:block;" href="/poet:<?php echo $info['id']."/book:{$bk}/poem:{$row[2]['id']}"; ?>"><div style='display:inline-block;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:90%;vertical-align:middle;'>
            <?php 
            echo $row[2]['ckbid'] . ". " . trim($row[2]['name']); ?> </div><i style="color:inherit;font-size: inherit;font-style:normal;display:inline-block;width:10%;max-width:.8em;vertical-align:top">&rsaquo;</i></a></div><?php } ?>

    </div>

    <div class='fontsize'>
        <i style='vertical-align:middle;font-size:1.4em;height:0.6em;color:#555;' class='material-icons'>format_size</i>
        <button class='bigger' style="padding:.85em 1.1em">
            <i style='vertical-align:middle;' class='material-icons'>arrow_upward</i>
        </button><button class='smaller' style="margin-left:0.4em;padding:.85em 1.1em">
            <i style='vertical-align:middle;' class='material-icons'>arrow_downward</i>
        </button>|<button id='copy-sec' class='copy' style="margin:0 0.4em;font-size:.83em;padding:.85em .3em;">
            <i style='vertical-align:middle;' class='material-icons'>content_copy</i> کۆپی کردن 
        </button><?php 
		 echo "|<i id='extlnkico' style='cursor:pointer;color: #444;vertical-align: middle;padding:0 .2em;font-size: 1.8em;height: .8em;' class='material-icons' title='سەبارەت بە شێعر'>more_horiz</i>";

		 if(! ($ath==10 && $bk==1 && $row[1]['id']==1) ) { ?><button id='fav-sec' class='fav' style="background:none; font-size:1.8em; box-shadow:none; border:0;float:left;padding-left:5px;padding-top:.25em;">
            <i class='material-icons' id='like-icon' style='color: <?php echo $colors[$color_num][0]; ?>;vertical-align: top;font-size: 1.25em'>bookmark_border</i>
		 </button>
        <?php } ?>
    </div>

    <div style='display:none;font-size: .55em;background: #fafafa;max-width: 500px;margin: auto auto .5em;padding: .5em 1em;border-radius: 0 0 2px 2px;box-shadow: 0 4px 20px -20px #000;text-align: right; border: 1px solid #eee;border-top:0;' id='extlnk'>
	<?php
	if($row[1]['link'] != "") {
            $ext_lnk = explode("[t]", $row[1]['link']);
            echo "<div>";
            echo "<i class='material-icons' style='vertical-align:middle'>link</i>";
            echo "<a class='link' href='{$ext_lnk[1]}' title='{$row[1]['name']}' target='_blank' rel='noopener noreferrer nofollow' style='display: inline-block;'>ئەم شێعرە لەسەر &laquo;{$ext_lnk[0]}&raquo;</a>";
            $probEL = intval($ext_lnk[2]) / 4 * 100;
            $probEL = num_convert($probEL , "en" , "ckb") . "%";
            echo "<span style='color:#666;font-size:.7em'>({$probEL})</span>";
            echo "</div>";
	}
	?>
	<div style="padding: 1.1em 0;">
	    <i class='material-icons' style="vertical-align: middle;">translate</i>
	    <button class='button' type="button" id="convertToLatBtn" style="font-size: .9em;margin-right: .5em;">Elfubêy Latîn</button>
	</div>
	<div style='text-align: center;border-top:1px solid #eee;padding: .5em 0;'>
	    <form id="wordFrm">
		<section style="display: inline-block;width: 35%;font-size: .9em;text-align: right;">
		    گەڕان بۆ واتای وشە : 
		</section><section style="display: inline-block;width: 40%;">
		    <input type="text" id="wordTxt" style="width: 100%;padding: .63em 1em;border-top:1px solid #eee;" placeholder="وشە...">
		</section><section style="display: inline-block;width: 12%;">
		    <button id="wordBtn" class='button' type="submit" style="font-size: 1.3em;padding: .5em 0;width: 100%;text-align: center;background:none; box-shadow:none;"><i class='material-icons'>search</i></button>
		</section>
	    </form>
	    <div id="wordRes" style="text-align:right; margin-top:.5em">
		<div id="wordResFerheng">
		    
		</div>
		<style>
		 #wordResKawa button {
                     color:#00e;
                     cursor:pointer;
                     font-size:inherit;
                     background:none;
		 }
		 #wordMore {
                     text-align:left;
		 }
		 #wordMore a {
                     text-align: center;
                     background: <?php echo $colors[$color_num][0]; ?>;
                     color: <?php echo $colors[$color_num][1]; ?>;
                     padding: .3em .8em;
		 }
		 #wordMore a:hover {
                     text-decoration:none;
                     box-shadow:0 3px 5px -2px #aaa;
		 }
		</style>
		<div id="wordResKawa">
		    
		</div>
		<div id="wordMore">
		    
		</div>
	    </div>
	</div>
    </div>

    <div id='hon' style="max-width:950px;margin:auto">
	<?php

	echo  $row[1]['hon'];

	?>
    </div>
    <script>
     document.getElementById("hon").style.fontSize = function(s) {
	 if(s !== null && !isNaN(s))
	     return `${s}px`;
     } (localStorage.getItem('fontsize'));
    </script>

    <?php if($row[1]['hdesc']=='') {

    } else {
    ?>
	<span id='bhondesc' style="display:block">
	    <?php echo $row[1]['hdesc']; ?>
	</span>
    <?php } ?>

    <div id="hon-comments">
	
	<div style="padding:1em .3em;font-size:.65em;color:#444;">
            بیر و ڕای خۆتان سەبارەت بەو شێعرە بنووسن.
	</div>
	<form id="frmComm" style="max-width: 700px;margin: auto;" action="/script/php/comments-add.php" method="POST">
            
            <input type="text" name='name' id='commNameTxt' placeholder="نێوی خۆتان لێرە بنووسن.">
	    
            <textarea placeholder="بیر و ڕای خۆتان سەبارەت بەو شێعرە لێرە بنووسن... *" id="commTxt" name='comment'></textarea>
	    
            <div class='loader' id="commloader" style="display:none;border-top:1px solid <?php echo $colors[$color_num][0]; ?>"></div>
            
            <div id="message"></div>
	    
            <button class='button bth' type="submit" style="font-size: .7em;width: 50%;padding: 1em 0;max-width: 150px;background-color: <?php echo $colors[$color_num][0]; ?>;color: <?php echo $colors[$color_num][1]; ?>;cursor:pointer;margin:0.5em 0;">ناردن</button>
	</form>
        
	<script>
	 function getUrl(url, callback) {
	     var client = new XMLHttpRequest();
	     client.open("get", url);
	     client.onload = function (e) {
		 callback(client.responseText, e);
	     }
	     client.send();
	 }
	 
	 function send_comment() {
             
             var name = document.getElementById("commNameTxt"),
		 comment = document.getElementById("commTxt"),
		 loader = document.getElementById("commloader"),
		 message = document.getElementById("message");
             
             if(comment.value == "") {
		 comment.focus();
		 return;
             }
             
             loader.style.display = "block";
             comment.background = "#ddd";
             comment.color = "#888";
             
             var xmlhttp = new XMLHttpRequest();             
             xmlhttp.onload = function() {
		 
                 var res = JSON.parse(this.responseText);
                 
                 if(res.status) {
		     loader.style.display = "none";
		     comment.background = "";
		     comment.color = "";
		     name.value = res.name;
		     comment.value = "";
		     message.style.background = "rgba(0,255,0,0.1)";
		     message.innerHTML = res.message;
		     
		     var comments = document.getElementById("hon-comments-body"),
			 newComm = "<div class='comment'><div class='comm-name'>"+res.name+":</div><div class='comm-body'>"+res.comment+"</div><div class='comm-footer'>"+res.date+"</div></div>";
		     
		     document.getElementById("Acomms-title").style.display = "block";
		     comments.innerHTML = newComm + comments.innerHTML;
		     
		     // localStorage
		     if(res.name != "ناشناس") {
                         localStorage.setItem("contributor", JSON.stringify({name: res.name}));
		     }
		     
		     window.location = "#hon-comments-body";
                 }
             }
             
             var request = "address=" + poem_adrs +"&name=" + name.value + "&comment=" + encodeURIComponent(comment.value);
             
             xmlhttp.open("POST","/script/php/comments-add.php");
             xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             xmlhttp.send(request);
             
	 }
	 
	 document.getElementById("frmComm").addEventListener("submit", function(e) {
	     e.preventDefault();
	     send_comment();
	 });
	</script>

	<div id="Acomms-title" style="margin:1em 0;display:none;border-top: 1px solid #ccc;padding: 1em .3em;font-size: 0.75em;">
	    بیر و ڕاکان سەبارەت بەو شێعرە
	</div>
	<div id='hon-comments-body' style='padding:0 .2em'></div>
	<div class='loader' id="commmloader" style="display:none;border-top:1px solid <?php echo $colors[$color_num][0]; ?>"></div>
    </div>

    <script>
     window.addEventListener("load", function() {
         
         <?php
         $db = 'index';
         $address = "poet:{$info['id']}/book:{$bk}/poem:{$row[1]['id']}";
         $q = "select * from comments where address='$address' and blocked=0";
         require("condb.php");
         
         if($query) {
             if(mysqli_num_rows($query)>0) {                 
         ?>
         
         var comments = document.getElementById("hon-comments-body"),
	     loader = document.getElementById("commmloader"),
	     commTitle = document.getElementById("Acomms-title");
         
         loader.style.display = "block";

         xmlhttp = new XMLHttpRequest();
	 getUrl(`/script/php/comments-get.php?address=${poem_adrs}`,
		function(responseText, e) {
		    
		    var res = JSON.parse(responseText);
		    loader.style.display = "none";
		    
		    if(res.err != 1) {
			
			var newComm = "";
			
			for(a in res) {
			    
			    newComm += "<div class='comment'><div class='comm-name'><i style='font-style:normal;font-size:1.4em;padding-left:.3em;color:<?php echo $colors[$color_num][0]; ?>'>&bull;</i>"+res[a].name+":</div><div class='comm-body'>"+res[a].comment+"</div><div class='comm-footer'>"+res[a].date+"</div></div>";
			}
			
			comments.innerHTML = newComm;
			
			commTitle.style.display="block";
			
		    }
		});
         
         <?php
         }
         }
         ?>
         
	 /* load visitor's name into `commNameTxt` */
	 document.getElementById("commNameTxt").value = (function (nameObj) {
	     if(nameObj === null) return "";
	     return JSON.parse(nameObj).name || "";
	 } (localStorage.getItem("contributor")));
	 
         
	 
	 var sups = document.querySelectorAll("sup"),
	     fs = document.querySelector(".fontsize"),
	     nav = document.querySelector(".nav");
	 
	 sups.forEach(function(e) {
	     e.addEventListener("click",function() {
		 window.scrollTo(0, document.querySelector(".m.d.cf:last-child").offsetTop - 10);
	     });
	 });	     
	 
	 document.getElementById("extlnkico").addEventListener("click" , function() {
	     
	     var extlnk = document.getElementById("extlnk");
	     
	     if(extlnk.style.display != "block") {
		 extlnk.style.display = "block";
		 extlnk.style.animation = ".8s cubic-bezier(0.18, 0.89, 0.32, 1.28) tL";
	     } else {
		 extlnk.style.display = "none";
	     }
	 });
	 
	 var convertToLatBtn = document.getElementById("convertToLatBtn"),
	     defLabel = convertToLatBtn.innerHTML,
	     newLabel = "ئەلفوبێی عەرەبی",
	     origin_poem = document.getElementById("hon").innerHTML;

	 function poem_kind() {
	     if(origin_poem.indexOf("<div class=\"n\">") !=-1) {
		 return "new";
	     }
	     return "classic";
	 }
	 
	 function convert_to_latin(toarabi="") {
	     var tar = document.getElementById("hon"),
		 client = new XMLHttpRequest();
	     tar.style.animation = "";
	     void tar.offsetWidth;
	     
	     if(toarabi == "") {
		 var ltn = arabi_to_latin(tar.innerText).replace(/\n/g, "<br>");
		 tar.innerHTML = poem_kind()=="new" ? "<div class=\"n\"><div class=\"m dltr\">" + ltn + "</div></div>" : "<div class=\"b\">" + ltn + "</div>";
		 tar.style.animation = "tL .5s";
		 convertToLatBtn.innerHTML = newLabel;
		 tar.style.direction = "ltr";
	     } else {
		 tar.innerHTML = origin_poem;
		 tar.style.animation = "tL .5s";
		 convertToLatBtn.innerHTML = defLabel;
		 tar.style.direction = "rtl";
	     }
	     
	 }
	 
	 convertToLatBtn.addEventListener("click", function() {
	     if(convertToLatBtn.innerHTML == defLabel) {
		 convert_to_latin();
	     }
	     else {
		 convert_to_latin("origin");
	     }
	 });
	 
	 
	 const loaderMin = "<div class='loader' style='width:1.8em; height:1.8em; vertical-align:middle; margin:1em auto;'></div>";
	 
	 document.getElementById("wordFrm").addEventListener("submit", function(e) {
	     e.preventDefault();
	     var q = document.getElementById("wordTxt");
	     if(q.value == "") {
		 q.focus();
		 return;
	     }
	     document.getElementById("wordMore").innerHTML = "";
	     search_ferheng(q.value, "#wordResFerheng");
	     search_farhangumejuikawa(q.value, "#wordResKawa");
	 });
	 
	 function search_ferheng (q, t) {
	     t = document.querySelector(t);
	     t.innerHTML = loaderMin;
	     var res, fin = "";
	     
	     getUrl(`/tewar/ferheng.info.php?q=${q}&n=1` , function(responseText, e) {
		 
		 document.getElementById("wordMore").innerHTML = `<a target='_blank' href='https://allekok.com/tewar/?q=${q}'>گەڕانی زیاتر لە "تەوار"دا</a>`;
		 
		 if (responseText == "null") {
		     t.innerHTML = "";
		     return;
		 }
		 
		 var res = JSON.parse(responseText);
		 
		 fin += "<span class='tp' style='background: #f3f3f3;display: block;font-size: .9em;padding: .3em .5em;'>فەرهەنگی ئەناهیتا: </span>";
		 
		 for( var a in res ) {
		     
		     fin += "<div><section><a target='_blank' rel='noopener noreferrer nofollow' href='"+res[a].link+"' style='color:#00e'>"+res[a].title+"</a></section>";
		     fin += "<section style='font-size: .87em;text-indent: 1em;'>"+res[a].desc+"</section></div>";
		 }
		 
		 t.innerHTML = fin;
		 
	     });
	     
	 }
     	 
	 function search_farhangumejuikawa (q, t) {
	     t = document.querySelector(t);
	     t.innerHTML = loaderMin;
	     var res, fin = "";
	     getUrl(`/tewar/farhangumejuikawa.com.php?q=${q}&n=1` , function(responseText, e) {
		 
		 if (responseText == "null") {
		     t.innerHTML = "";
		     return;
		 }
		 
		 var res = JSON.parse(responseText);
		 
		 fin += "<span class='tp' style='background: #f3f3f3;display: block;font-size: .9em;padding: .3em .5em;'>فەرهەنگی کاوە: </span>";
		 
		 for( var a in res ) {
		     
		     fin += "<div><section>"+res[a].link+"</section>";
		     fin += "<section style='font-size: .87em;text-indent: 1em;'>"+res[a].desc+"</section></div>";
		 }
		 
		 t.innerHTML = fin;
		 var frms = t.getElementsByTagName("form");
		 frms[0].setAttribute("target", "_blank");
	     });
	 }
	 
     });
    </script>

</div>
