<?php

include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; بیر و ڕاکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شێعرەکان";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . "script/php/header.php");
?>

<!-- the main element -->
<div id="poets">
    <h1 id="current-location" style="display:block;background: linear-gradient(to right, <?php echo "#fdfdfd,{$colors[0][0]},#fdfdfd"; ?>);color:#fff;font-size:1.2em">
        بیر و ڕاکان
    </h1>
    
    <div style='font-size:.55em; color:#444;margin:.5em 0;'>
        ژمارەی بیروڕاکان: 
        <?php
        $db = "index";
        $q = "select * from comments where blocked=0";
        include(ABSPATH . "script/php/condb.php");
        $nm = num_convert(mysqli_num_rows($query),"en","ckb");
        mysqli_close($conn);
        
        echo $nm;
        ?>
    </div>
    <div style='max-width:800px;margin:auto;padding:.3em;'>
        <div id="hon-comments-body">
            <div class='loader' style="border-top:3px dashed <?php echo $colors[0][0]; ?>;animation-duration:.7s;"></div>
        </div>
        
    </div>
    
    <script>
     
     var comments = document.querySelector("#hon-comments-body");

     var xmlhttp = new XMLHttpRequest();
     xmlhttp.open("GET", "get-comms.php?n=30");
     xmlhttp.onload=function() {
         var res = JSON.parse(this.responseText);

         if(res.err != 1) {
             
             var newComm = "";
             
             for(a in res) {
                 
                 newComm += "<div class='comment' style='margin-bottom:16px;background:"+colors[color_num(res[a].pt)][2]+"'><div class='comm-name'><i style='font-style:normal;padding-left:.2em;font-size:1.4em;color:"+ colors[color_num(res[a].pt)][0] +"'>&bull;</i>"+res[a].name+"<span style='color:#444;font-size:.7em'> سەبارەت بە شێعری </span><a style='font-size:.75em;border-radius:3px;padding:.1em .3em;border-bottom:1px solid #ccc;' href='/"+res[a].address+"'>"+res[a].ptn+" &rsaquo; "+res[a].pmn+"</a><span style='color:#444;font-size:.7em'> نووسیویەتی:</span></div><div class='comm-body'>"+res[a].comment+"</div><div class='comm-footer'>"+res[a].date+"</div></div>";
             }
             
             comments.innerHTML = newComm;
             comments.style.animation = ".8s tL ease";
             
         }

     }
     xmlhttp.send();
    </script>
    
</div>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
