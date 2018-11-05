<?php
    
    if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک &raquo; بیر و ڕاکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شێعرەکان";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
?>

<div id="poets">
    <?php
        $_rnd = [
            mt_rand(1,22),
            mt_rand(1,22),
            mt_rand(1,22),
            mt_rand(1,22),
            ];
    
    ?>
    <h1 id="current-location" style="display:block;background: linear-gradient(to right, <?php echo $colors[$_rnd[0]][2]; ?>, <?php echo $colors[$_rnd[1]][2]; ?>, <?php echo $colors[$_rnd[2]][2]; ?>, <?php echo $colors[$_rnd[3]][2]; ?>);color:#555;font-size:1.2em">
        بیر و ڕاکان
    </h1>

    
    <div style='font-size:.55em; color:#444;margin:.5em 0;'>
        ژمارەی بیروڕاکان: 
        <?php
            $db = "index";
            $q = "select * from comments where blocked=0";
            require("../script/php/condb.php");
            $nm = num_convert(mysqli_num_rows($query),"en","ckb");
            
            echo $nm;
            mysqli_close($conn);
        ?>
    </div>
    <div style='max-width:800px;margin:auto;padding:.3em;'>
        <div id="hon-comments-body">
            <div class='loader' style="border-top:2px dashed <?php echo $colors[$_rnd[0]][0]; ?>;border-bottom:2px dashed <?php echo $colors[$_rnd[1]][0]; ?>;border-right:2px dashed <?php echo $colors[$_rnd[2]][0]; ?>;border-left:2px dashed <?php echo $colors[$_rnd[3]][0]; ?>;animation-duration:.7s;"></div>
        </div>
        
    </div>
    
    <script>
                    
        var comments = document.querySelector("#hon-comments-body");

        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                var res = JSON.parse(this.responseText);

                if(res.err != 1) {
                    
                    var newComm = "";
                    
                    
                    for(a in res) {
                        
                        
                        newComm += "<div class='comment' style='margin-bottom:16px;'><div class='comm-name'><i style='font-style:normal;padding-left:.2em;font-size:1.4em;color:"+ colors[res[a].pt][0] +"'>&bull;</i>"+res[a].name+"<span style='color:#444;font-size:.7em'> سەبارەت بە شێعری </span><a style='font-size:.75em;border-radius:3px;padding:.1em .3em;background:"+colors[res[a].pt][2]+";' href='/"+res[a].address+"'>"+res[a].pmn+"</a><span style='color:#444;font-size:.7em'> نووسیویەتی:</span></div><div class='comm-body'>"+res[a].comment+"</div><div class='comm-footer'>"+res[a].date+"</div></div>";
                    }
                    
                    comments.innerHTML = newComm;
                    comments.style.animation = ".8s tL ease";
                    
                }
                

            }
        }
        xmlhttp.open("GET", "get-comms.php?n=100", true);
        xmlhttp.send();
    </script>
    
</div>

<?php
	require_once("../script/php/footer.php");
?>