<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; بیر و ڕاکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شێعرەکان";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<div id="poets">
    <h1 style="font-size:1.2em">
        بیر و ڕاکان
    </h1>
    <div class="color-444" style='font-size:.55em;margin:.5em 0'>
        ژمارەی بیروڕاکان: 
        <?php
        $db = "index";
        $q = "select id from comments where blocked=0";
        include(ABSPATH . "script/php/condb.php");
        $nm = $query ?
	      mysqli_num_rows($query) : 0;
	$nm = num_convert($nm,"en","ckb");
        mysqli_close($conn);
        echo $nm;
        ?>
    </div>
    <div style='max-width:800px;margin:auto;padding:.3em'>
        <div id="hon-comments-body">
            <div class='loader'></div>
        </div>
    </div>
    <script>
     window.onload = function ()
     {
	 const comments = document.querySelector("#hon-comments-body"),
	       xmlhttp = new XMLHttpRequest();
	 getUrl("get-comments.php?n=20",function(responseText) {
	     const res = JSON.parse(responseText);
             if(res.err != 1) {
		 let newComm = "";
		 for(a in res)
		 {
                     newComm += "<div class='comment'><div class='comm-name'\
><i style='font-style:normal;padding-left:.2em;color:<?php echo $colors[0][0]; ?>;\
font-size:1.4em;'>&bull;</i>"+res[a].name+"<span class='color-444' \
style='font-size:.7em'> سەبارەت بە شێعری </span><a class='border-bottom-eee' \
style='font-size:.75em;border-radius:3px;padding:.1em .3em' \
href='/"+res[a].address+"'>"+res[a].ptn+" &rsaquo; "+res[a].pmn+"</a\
><span class='color-444' style='font-size:.7em'> نووسیویەتی:</span></div\
><div class='comm-body'>"+res[a].comment+"</div><div class='comm-footer'\
>"+res[a].date+"</div></div>";
		 }
		 comments.innerHTML = newComm;
		 comments.style.animation = ".8s tL ease";
             }
	 });
     }
    </script>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
