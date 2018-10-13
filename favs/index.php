<?php
    
    if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; خۆشەویست‌ترین شێعرەکانی ئاڵەکۆک";
$desc = "خۆشەویست‌ترین شێعرەکانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
?>

<script>
    function load_favs(where) {
        var r = document.querySelector(where);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if(this.readyState === 4 && this.status === 200) {
                var response = JSON.parse(this.responseText);
                var pr = "", adrs = "";

                for(res in response) {
                    
                    adrs = `/poet:${response[res].poet.id}/book:${response[res].book.id}/poem:${response[res].id}`;
                    
                    pr += "<a class='load-favs-a' href='"+adrs+"'>";
                    pr += "<i class='hp'>"+response[res].poet.takh+"</i> &rsaquo; <i class='hp'>"+response[res].book.name+"</i> &rsaquo; "+response[res].name;
                    pr += " <i class='hn' > ( <i class='material-icons' style='font-size: inherit;height: 0.9em;vertical-align: middle;color:"+colors[response[res].poet.id][0]+";'>bookmark</i> "+response[res].kulikes+" ) </i>";
                    pr += "</a>";
                }
                
                r.style.animation = ".8s tL ease";
                r.innerHTML = pr;
            }
        }
        
        xmlhttp.open("get", "/script/php/showFavList.php?lmt=50", true);
        xmlhttp.send();
    }
</script>
<div id="poets">
    
    <h1 style="background: rgba(240,51,0,0.05);color: rgb(240,51,0);display: inline-block;padding: 0.3em 0.8em 0;border-radius: 5px;margin: 1em 0 0.5em;font-size:0.9em">
            خۆشەویست‌ترین شێعرەکانی ئاڵەکۆک
    </h1>
    
    <div>
        <div id="load-favs" style="font-size:0.55em; max-width:800px;margin:auto;">
            <div class='loader' style="border-top:1px solid red"></div>
            <script>
                load_favs("#load-favs");
            </script>
        </div>
        
    </div>
    
</div>

<?php
	require_once("../script/php/footer.php");
?>