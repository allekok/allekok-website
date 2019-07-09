<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; بەرنامەی مۆبایلی ئاڵەکۆک";
$desc = "داگرتنی بەرنامەی مۆبایلی ئاڵەکۆک بۆ ئەندرۆید";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>
<div id="poets" style="max-width:850px">
    <h1 style="display:inline-block;padding:.1em .8em 0;
	       border-radius: 5px;font-size:1.2em">
	<i class="material-icons"
	   style="color:<?php echo $colors[0][0]; ?>">phone_iphone</i>
        بەرنامەی مۆبایلی ئاڵەکۆک
    </h1>
    <small class="color-555" style='font-size:.6em;
		  margin-top:-.6em;display:block'>
        وەشانی ۱.۲.۲
    </small>
    <style>
     .pitewsec a {
         font-size:1.2em;
     }
     #QAtxt {
         font-size: 0.65em;
         text-align: right;
         max-width: 90%;
         width: 90%;
         min-height: 8em;
         display: block;
         margin: 1em auto 0;
         height: 155px;
     }
     .btn {
         font-size:.7em;
         width:50%;
         padding:.8em 0;
         max-width:150px;
     }
    </style>
    <section class='pitewsec' style="display:block;
		    font-size:1.2em;border-bottom:0;
		    width:100%">
	<!-- Android logo -->
        <svg style="width:20%;min-width:100px;fill:#15c314" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M89.6 204.5v115.8c0 15.4-12.1 27.7-27.5 27.7-15.3 0-30.1-12.4-30.1-27.7V204.5c0-15.1 14.8-27.5 30.1-27.5 15.1 0 27.5 12.4 27.5 27.5zm10.8 157c0 16.4 13.2 29.6 29.6 29.6h19.9l.3 61.1c0 36.9 55.2 36.6 55.2 0v-61.1h37.2v61.1c0 36.7 55.5 36.8 55.5 0v-61.1h20.2c16.2 0 29.4-13.2 29.4-29.6V182.1H100.4v179.4zm248-189.1H99.3c0-42.8 25.6-80 63.6-99.4l-19.1-35.3c-2.8-4.9 4.3-8 6.7-3.8l19.4 35.6c34.9-15.5 75-14.7 108.3 0L297.5 34c2.5-4.3 9.5-1.1 6.7 3.8L285.1 73c37.7 19.4 63.3 56.6 63.3 99.4zm-170.7-55.5c0-5.7-4.6-10.5-10.5-10.5-5.7 0-10.2 4.8-10.2 10.5s4.6 10.5 10.2 10.5c5.9 0 10.5-4.8 10.5-10.5zm113.4 0c0-5.7-4.6-10.5-10.2-10.5-5.9 0-10.5 4.8-10.5 10.5s4.6 10.5 10.5 10.5c5.6 0 10.2-4.8 10.2-10.5zm94.8 60.1c-15.1 0-27.5 12.1-27.5 27.5v115.8c0 15.4 12.4 27.7 27.5 27.7 15.4 0 30.1-12.4 30.1-27.7V204.5c0-15.4-14.8-27.5-30.1-27.5z"/></svg>
        <h3>
            <small>
                <a class="border-bottom-eee" style="display:block"
		   href="https://allekok.github.io/allekok-downloads/downloads/allekok-android/allekok-latest.apk"
		><i style="font-size:1.15em;
			   display:inline" class="material-icons">cloud_download</i> دابەزاندن بۆ ئەندرۆید
                </a>
                <small style="display:block">
                    ئەندرۆیدی ۴.۱ بۆ سەرێ
                </small>
		<a target="_blank"
		   rel="noopener noreferrer nofollow"
		   href="https://github.com/allekok/allekok-android"
		   style="display:inline-block;font-size:1.8em" 
		   class="material-icons color-555" title="کۆدەکانی بەرنامەی ئەندرۆیدی ئاڵەکۆک"
		>code</a>
            </small>
        </h3>
    </section>
    <div class="border-eee"
	 style="max-width:800px;
		margin:1em auto 0;
		padding:.8em .2em 0">
        <h3 style="font-size:.7em">
            بیروڕای خۆتان سەبارەت بە بەرنامەی مۆبایلی ئاڵەکۆک لێرە بنووسن.
        </h3>
        <form id="frmQA" action="save.php" method="POST">
            <textarea id="QAtxt"></textarea>
            <div id="QAres"></div>
            <button type="submit"
		    class='button btn'>ناردن</button>
        </form>
        <div>
            <?php
            if(@filesize("QA.txt") > 0) {
                
                $f = fopen("QA.txt", "r");
                $cc = fread($f, filesize("QA.txt"));
                $cc = explode("\nend\n", $cc);
                
                echo "<h3 class='border-eee' style='margin-top:2em;
font-size:.7em;padding:1em'>بیر و بۆچوونەکان</h3>";
		
                $cc = array_reverse($cc);
                foreach($cc as $c) {
                    if(!empty($c)) {
			$c = preg_replace(
			    ["/\[code\]\n*/","/\n*\[\/code\]/"],
			    ["<code>","</code>"], $c);
                        $c = str_replace(["\n"], ["<br>"], $c);
                        echo "<div class='comment'
><div class='comm-body'>$c</div></div>";
                    }
                }
                fclose($f);
            }
            ?>
        </div>
        <script>
         document.querySelector("#frmQA").
		  addEventListener("submit", function(e) {
		      e.preventDefault();
		      
		      var txt = document.querySelector("#QAtxt"),
			  t = document.querySelector("#QAres"),
			  loader = "<div class='loader'></div>";
		      
		      if(txt.value == "") {
			  txt.focus();
			  return;
		      }
		      
		      t.innerHTML = loader;
		      var x = new XMLHttpRequest();
		      x.onload = function() {
			  if(this.responseText == "1") {
			      t.innerHTML = "<span \
style='background:rgba(0,255,0,.08);color:green;\
display:block;padding:1em;font-size:.6em;'\
>زۆرسپاس بۆ دەربڕینی بیروڕاتان.</span>";
			      txt.value = "";
			  }
		      }
		      x.open("POST", "save.php");
		      x.setRequestHeader(
			  "Content-type",
			  "application/x-www-form-urlencoded");
		      x.send(`txt=${encodeURIComponent(txt.value)}`);
		  });
        </script>
    </div>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
