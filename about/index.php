<?php
include_once("../script/php/constants.php");
include_once(ABSPATH."script/php/colors.php");
include_once(ABSPATH."script/php/functions.php");

$title = $_TITLE . "؟";
$desc = $title;
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH."script/php/header.php");
?>
<div id="poets">
    <h1 class="color-blue"
	style="font-size:1em;text-align:right">
	سەبارەت
    </h1>
    <div style="text-align:right;font-size:.6em;padding-right:1em">
	<p>
	    ئاڵەکۆک هەلێکە بۆ خوێندنەوەی شێعری کوردی.
        </p>
	<p>
	    ئاخیرین نوێ‌کردنەوەی شێعرەکان: 
	    <?php
	    $last_update_date = date_create(
		@file_get_contents(ABSPATH."last-update.txt"));
	    $now = date_create(date("Y-m-d H:i:s"));
	    echo format_DD(
		date_diff($now,$last_update_date,true));
	    ?>
	</p>
	<p>
	    ئەژمار: 
            <?php include(ABSPATH."script/php/stats.php"); ?>
            <i class='sub-num'><?php echo $aths_num; ?></i>
            شاعیر
            &rsaquo;
            <i class='sub-num'><?php echo $hons_num; ?></i>
            شێعر
	</p>
    </div>
    <div style="margin:0 auto">
        <div id="message"></div>
        <form id="frmComm"
	      action="/about/append.php"
	      method="POST">
            <textarea id="commTxt"
		      style="font-size:.65em;
			  max-width:100%;
			  width:100%"
		      placeholder="ئاڵەکۆک‌تان بەلاوە چۆنە؟ بۆمان بنووسن..."
	    ></textarea>
            <div class='loader' id="commloader"
		 style="display:none;
			margin:.5em auto .2em"
	    ></div>
            <button type="submit"
		    style="font-size:.7em;
			  padding:.5em 1.5em"
		    class='button'>ناردن</button>
        </form>
        <?php
        $uri = ABSPATH . "about/comments.txt";
	$nzuri = file_exists($uri) ?
		 filesize($uri)>0 :
		 false;
	if($nzuri) {
	?>
            <h1 id="Acomms-title" class="color-blue"
		style="text-align:right;
		    margin:0 0 .5em;
		    font-size:1em">
		بیر و ڕاکان
            </h1>
            <div id="Acomms"
		 style="font-size:.6em;max-width:800px;
		     background:white;border-radius:1em;
		     margin:auto">
		<?php
		$comments = file_get_contents($uri);
		$comments = explode("[comment]",$comments);
		$comments = array_reverse($comments);
		$limit = (false === filter_var(@$_GET['num'],
					       FILTER_VALIDATE_INT)) ?
			-1 :
			 $_GET['num'];
		$_n = 0;
		foreach($comments as $c)
		{
		    if($_n == $limit) break;
		    if(!isset($_GET["plain"]))
			$c = str_replace("\n", "<br>", $c);
		    echo $c;
		    $_n++;
		}
		} // $nzuri
		?>
	    </div>
    </div>
</div>
</div>
<script> 
 function append() {
     const res = document.getElementById('message'),
	   comm = document.getElementById('commTxt'),
	   loader = document.getElementById('commloader'),
	   succMess = "<i style='display:block;background:rgba(102,255,204,.1);\
font-size:.5em'>زۆر سپاس بۆ دەربڕینی بیر و ڕاتان سەبارەت بە ئاڵەکۆک.</i>",
	   failMess = "<i style='display:block;background:rgba(204,51,0,.1);\
font-size:.5em'>کێشەیەک هەیە. تکایە دووبارە هەوڵ دەنەوە.</i>",
	   OoRError = "<i style='display:block;background:rgba(204,51,0,.1);\
font-size:.5em'>ژمارەی پیتەکان نابێ لە ۲۶۸۵ پیت زیاتر بێ.</i>",
	   request = "comm="+encodeURIComponent(comm.value);

     if(comm.value == '')
     {
         comm.focus();
         return;
     }
     if(comm.value.length > 2685)
     {
         res.innerHTML = OoRError;
         comm.style.borderColor = "rgb(204,51,0)";
         comm.focus();
         setTimeout(function() {
	     comm.style.borderColor = "";
         }, 3000);
         return;
     }     
     loader.style.display = "block";
     comm.style.background = "#eee";
     comm.style.color = "#999";

     postUrl("<?php echo _R; ?>about/append.php", request, function(response) {
         const respond = JSON.parse(response);
         if(respond.message == "ok")
	 {
	     res.innerHTML = succMess;
	     comm.style.borderColor = "#06d";
	     const Acomms = document.getElementById('Acomms'),
		   AcommsTitle = document.getElementById('Acomms-title');
	     Acomms.style.display = "block";
	     AcommsTitle.style.display = "block";
	     Acomms.innerHTML = respond.comm + Acomms.innerHTML;
	     window.location = "#Acomms-title";
	     comm.value="";
         }
	 else
	 {
	     res.innerHTML = failMess;
	     comm.style.borderColor = "rgb(204,51,0)";
	     setTimeout(function() {
                 comm.style.borderColor = "";
	     }, 3000);
         }
         loader.style.display = "none";
         comm.style.background = "";
         comm.style.color = "";
     });
 }
 
 document.getElementById("frmComm").
	  addEventListener("submit", function(e)
	      {
		  e.preventDefault();
		  append();
	  });
</script>
<?php
include_once(ABSPATH."script/php/footer.php");
?>
