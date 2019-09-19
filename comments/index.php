<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; بیر و ڕاکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شێعرەکان";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>
<div id="poets">
    <h1 class="color-blue"
	style="font-size:1em;text-align:right">
        بیر و ڕاکان
    </h1>
    <div style='font-size:.55em;margin:.5em 0'>
        ئەژماری بیروڕاکان: 
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
    <div style='padding-right:1em'>
        <div id="hon-comments-body">
            <div class='loader'></div>
        </div>
    </div>
    <script>
     window.onload = function ()
     {
	 const comments = document.querySelector("#hon-comments-body");
	 getUrl("get-comments.php?n=20",function(responseText) {
	     const res = JSON.parse(responseText);
             if(res.err != 1) {
		 let newComm = "";
		 for(const a in res)
		 {
                     newComm += "<div class='comment'><div class='comm-name'\
>"+res[a].name+"<span \
style='font-size:.7em'> سەبارەت بە شێعری </span><a class='link-color' \
style='font-size:.75em;padding:0 .3em' \
href='/"+res[a].address+"'>"+res[a].ptn+" &rsaquo; "+res[a].pmn+"</a\
><span style='font-size:.7em'> نووسیویەتی:</span></div\
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
