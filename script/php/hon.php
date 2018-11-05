
<script>
    var pID = <?php echo $info['id']; ?>;
    var bID = <?php echo $bk; ?>;
    var mID = <?php echo $row[1]['id']; ?>;
    
    var http_adrs = `poet=${pID}&book=${bID}&poem=${mID}`;
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
    <img src="<?php echo get_poet_image($info['id'], 'profile', true); ?>" style="display: block;margin: auto;border-radius: 100%;max-width:120px;box-shadow: 0 3px 4px -3px #aaa;" alt="<?php echo $info['profname']; ?>">

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
    <?php if($row[0] != 0) { ?><div class="prev"><a style="color:inherit;font-size:inherit;display:inline-block;padding:.85em 0;display:block;" href="/poet:<?php echo $info['id']."/book:{$bk}/poem:{$row[0]['id']}"; ?>"><i style="color:inherit;font-size: inherit;font-style:normal;display:inline-block;width:10%;max-width:.8em;vertical-align:top">&lsaquo;</i><div style="display:inline-block;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:90%;"> <?php 
            echo $row[0]['ckbid'] . ". " . trim($row[0]['name']); ?></div></a></div><?php } ?><?php if($row[2] != 0) { ?><div class="next"><a style="color:inherit;font-size:inherit;display:inline-block;padding:.85em 0;display:block;" href="/poet:<?php echo $info['id']."/book:{$bk}/poem:{$row[2]['id']}"; ?>"><div style='display:inline-block;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:90%;'>
            <?php 
            echo $row[2]['ckbid'] . ". " . trim($row[2]['name']); ?> </div><i style="color:inherit;font-size: inherit;font-style:normal;display:inline-block;width:10%;max-width:.8em;vertical-align:top">&rsaquo;</i></a></div><?php } ?>

</div>

    <div class='fontsize'>
        <i style='vertical-align:middle;font-size:1.4em;height:0.6em;padding-right:5px;color:#666;' class='material-icons'>format_size</i>
        <div class='bigger' style="position:relative;padding:.7em 1em">
            <div style="width: 100%;height: 100%;position: absolute;right: -0.03em;background: none;border: 0;box-shadow: none;"></div><i style='vertical-align:middle;' class='material-icons'>arrow_upward</i>
        </div><div class='smaller' style="position:relative;margin-left:0.4em;padding:.7em 1em">
            <div style="width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;"></div><i style='vertical-align:middle;' class='material-icons'>arrow_downward</i>
        </div>|<div id='copy-sec' class='copy' style="position:relative;margin:0 0.4em;font-size:.83em;padding:.7em .3em;">
            <div style="width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;"></div>
            <i style='vertical-align:middle;' class='material-icons'>content_copy</i> کۆپی کردن 
        </div><?php 
        echo "|<i id='extlnkico' style='cursor:pointer;color: #666;vertical-align: middle;padding:0 .2em;font-size: 1.8em;height: .8em;' class='material-icons' title='سەبارەت بە شێعر'>settings</i>";

        if(! ($ath==10 && $bk==1 && $row[1]['id']==1) ) { ?><div id='fav-sec' class='fav' style="background:none; font-size:1.8em; box-shadow:none; border:0;float:left;height:0.9em;position:relative;padding-left:5px;padding-top:.25em;">
            <div style="width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;"></div>
            <i class='material-icons' id='like-icon' style='color: <?php echo $colors[$ath][0]; ?>;vertical-align: top;font-size: 1.3em;'>bookmark_border</i>
        </div>
        <?php } ?>
    </div>

<div style='display:none;font-size: .55em;background: #f8f8f8;max-width: 500px;margin: auto auto .5em;padding: .5em;border-radius: 2px;box-shadow: 0 4px 20px -20px #000;text-align: right; border: 1px solid #eee;' id='extlnk'>
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
<div style="padding: 1em 0;">
    <i class='material-icons' style="vertical-align: middle;">translate</i>
    <button class='button' type="button" id="convertToLatBtn" style="font-size: .9em;margin-right: .5em;">ئەلفوبێی لاتین</button>
    <div class='loader' id='convertToLat-loading' style='width:1.5em; height:1.5em; display:none;margin-right:1em;vertical-align:middle;'></div>
</div>
<form id="wordFrm" style='text-align: center;border-top: 1px solid #ddd;padding: 1em 0;background: linear-gradient(#f2f2f2, #f8f8f8, #f8f8f8, #f8f8f8);'>
    <section style="display: inline-block;width: 35%;font-size: .9em;text-align: right;">
        گەڕان بۆ واتای وشە : 
    </section><section style="display: inline-block;width: 40%;">
        <input type="text" id="wordTxt" style="width: 100%;padding: .63em 1em;" placeholder="وشە...">
    </section><section style="display: inline-block;width: 12%;">
        <button id="wordBtn" class='button' type="submit" style="font-size: 1.3em;padding: .5em 0;width: 100%;text-align: center;background:none; box-shadow:none;"><i class='material-icons'>search</i></button>
    </section>
    <div id="wordRes" style="text-align:right">
        <div id="wordResFerheng">
            
        </div>
        <style>
            #wordResKawa button {
                color:#00e;
            }
        </style>
        <div id="wordResKawa">
            
        </div>
    </div>
</form>
</div>

<div id='hon' style="max-width:950px;margin:auto">
<?php
$hon = $row[1]['hon'];

echo  $hon;

?>
</div>
<script>
    var lsfs = localStorage.getItem('fontsize');
    var hhon = document.getElementById('hon');
    if (lsfs != null && !isNaN(lsfs) && hhon !=null) {      
        
        hhon.style.fontSize=lsfs+"px";
    }
</script>

<?php if($row[1]['hdesc']=='') {

} else {
?>
<span id='bhondesc' style="display:block">
<?php echo $row[1]['hdesc']; ?>
</span>
<?php } ?>

<div id="hon-comments">
    
<div style="padding: 1em .3em;font-size: 0.65em;">
    بیر و ڕای خۆتان سەبارەت بەو شێعرە بنووسن.
</div>
        <form id="frmComm" style="max-width: 700px;margin: auto;" action="/script/php/comments-add.php" method="POST">
            
            <input type="text" name='name' id='commNameTxt' placeholder="نێوی خۆتان لێرە بنووسن.">

            <textarea placeholder="بیر و ڕای خۆتان سەبارەت بەو شێعرە لێرە بنووسن... *" id="commTxt" name='comment'></textarea>

            <div class='loader' id="commloader" style="display:none;border-top:1px solid <?php echo $colors[$ath][0]; ?>"></div>
            
            <div id="message"></div>

            <button class='button bth' type="submit" style="font-size: .7em;width: 50%;padding: 1em 0;max-width: 150px;background-color: <?php echo $colors[$ath][0]; ?>;color: <?php echo $colors[$ath][1]; ?>;cursor:pointer;margin:0.5em 0;">ناردن</button>
        </form>
        
<script>
    
    
    function send_comment() {
        
        var name = document.querySelector("#commNameTxt");
        var comment = document.querySelector("#commTxt");
        var loader = document.querySelector("#commloader");
        var message = document.querySelector("#message");
        
        if(comment.value == "") {
            comment.style.background = "rgba(204,51,0,0.1)";
            comment.style.borderTopColor = "rgb(204,51,0)";
            comment.focus();
            setTimeout(function() {
                comment.style.background = "";
                comment.style.borderTopColor = "#ddd";
            }, 2000);
            return;
        }
        
        loader.style.display = "block";
        comment.background = "#ddd";
        comment.color = "#888";
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            
            if(this.status == 200 && this.readyState == 4) {
                
                var res = JSON.parse(this.responseText);
                
                if(res.status) {
                    loader.style.display = "none";
                    comment.background = "";
                    comment.color = "";
                    name.value = res.name;
                    comment.value = "";
                    message.style.background = "rgba(0,255,0,0.1)";
                    message.innerHTML = res.message;
                    
                    var comments = document.querySelector("#hon-comments-body");
                    var newComm = "<div class='comment'><div class='comm-name'>"+res.name+":</div><div class='comm-body'>"+res.comment+"</div><div class='comm-footer'>"+res.date+"</div></div>";
                    
                    document.querySelector("#Acomms-title").style.display = "block";
                    comments.innerHTML = newComm + comments.innerHTML;
                    
                    //localStorage
                    if(res.name != "ناشناس") {
                        var email = "";
                        if(localStorage.getItem("contributor") !== null) {
                            var email = JSON.parse(localStorage.getItem("contributor")).ID || "";
                        }
                        localStorage.setItem("contributor", JSON.stringify({name: res.name, ID: email}));
                    }
                    ///
                    
                    window.location = "#hon-comments-body";
                }
            }
        }
        
        var request = "address=" + poem_adrs +"&name=" + name.value + "&comment=" + encodeURIComponent(comment.value);
        
        xmlhttp.open("POST","/script/php/comments-add.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(request);
        
    }
    
    document.getElementById("frmComm").addEventListener("submit", function(e) {
        if(XMLHttpRequest) {
            e.preventDefault();
            send_comment();
        }

    });
</script>

<div id="Acomms-title" style="margin:1em 0;display:none;border-top: 1px solid #ccc;padding: 1em .3em;font-size: 0.75em;">
    بیر و ڕاکان سەبارەت بەو شێعرە
</div>
<div id='hon-comments-body' style='padding:0 .2em'></div>
    <div class='loader' id="commmloader" style="display:none;border-top:1px solid <?php echo $colors[$ath][0]; ?>"></div>
</div>

<script>
    //window.addEventListener("load", function() {
        
        <?php
            $db = 'index';
            $address = "poet:{$info['id']}/book:{$bk}/poem:{$row[1]['id']}";
            $q = "select * from comments where address='$address' and blocked=0";
            
            require("condb.php");
            
            if($query) {
        
                if(mysqli_num_rows($query)>0) {
                    
            ?>
            
        var comments = document.querySelector("#hon-comments-body");
        var loader = document.querySelector("#commmloader");
        var commTitle = document.querySelector("#Acomms-title");
        
        loader.style.display = "block";

        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                var res = JSON.parse(this.responseText);
                loader.style.display = "none";
                
                if(res.err != 1) {
                    
                    var newComm = "";
                    
                    
                    for(a in res) {
                        
                        newComm += "<div class='comment'><div class='comm-name'><i style='font-style:normal;font-size:1.4em;padding-left:.3em;color:<?php echo $colors[$ath][0]; ?>'>&bull;</i>"+res[a].name+":</div><div class='comm-body'>"+res[a].comment+"</div><div class='comm-footer'>"+res[a].date+"</div></div>";
                    }
                    
                    comments.innerHTML = newComm;
                    
                    commTitle.style.display="block";
                }
                

            }
        }
        xmlhttp.open("GET","/script/php/comments-get.php?address="+poem_adrs ,true);
        xmlhttp.send();
        
         <?php
                }
            }
        ?>
        
        // localStorage
            
        if(localStorage.getItem("contributor") !== null) {
            document.querySelector("#commNameTxt").value = JSON.parse(localStorage.getItem("contributor")).name || "";
        }
        
        ///
        
    //});
    
    var sups = document.querySelectorAll("sup");
    var fs = document.querySelector(".fontsize");
    var nav = document.querySelector(".nav");
    
    if(sups.length > 0) {
        sups.forEach(function(e) {
            e.addEventListener("click",function() {
                window.scrollTo(0, document.querySelector(".m.d.cf:last-child").offsetTop - (fs.offsetHeight+nav.offsetHeight+10));
            });
        });
    }
    
    document.querySelector("#extlnkico").addEventListener("click" , function() {
        
        var extlnk = document.querySelector("#extlnk");
        
        if(extlnk.style.display != "block") {
            extlnk.style.display = "block";
            extlnk.style.animation = ".8s cubic-bezier(0.18, 0.89, 0.32, 1.28) tL";
        } else {
            extlnk.style.display = "none";
        }
    });
    
    var convertToLatBtn = document.querySelector("#convertToLatBtn");
    var defLabel = convertToLatBtn.innerHTML;
    var newLabel = "ئەلفوبێی ئارامی";
    
    function convert_to_latin(toarami="") {
        var tar = document.querySelector("#hon");
        var client = new XMLHttpRequest();
        var loading = document.getElementById("convertToLat-loading");
        loading.style.display="inline-block";
        tar.style.animation = "";
        void tar.offsetWidth;
        
        client.open("get", `/script/php/arami-to-latin.php?p=${pID}&b=${bID}&m=${mID}&${toarami}`);
        client.onload = function() {
            tar.innerHTML = this.responseText;
            tar.style.animation = "tL .5s";
            
            if(toarami == "") {
                convertToLatBtn.innerHTML = newLabel;
                tar.style.direction = "ltr";
            } else {
                convertToLatBtn.innerHTML = defLabel;
                tar.style.direction = "rtl";
            }
            loading.style.display="none";
        }
        
        client.send();
    }
    
    convertToLatBtn.addEventListener("click", function() {
        if(convertToLatBtn.innerHTML == defLabel) {
            convert_to_latin();
        }
        else {
            convert_to_latin("origin");
        }
    });
    
    
    const loader = "<div class='loader' style='width:1.5em; height:1.5em; vertical-align:middle;'></div>";
    
    
    document.querySelector("#wordFrm").addEventListener("submit", function(e) {
        e.preventDefault();
        var q = document.querySelector("#wordTxt");
        if(q.value == "") {
            q.focus();
            return;
        }
        search_ferheng(q.value, "#wordResFerheng");
        search_farhangumejuikawa(q.value, "#wordResKawa");
    });
    
    function search_ferheng (q, t) {
        t = document.querySelector(t);
        t.innerHTML = loader;
        var res, fin = "";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            
            if (this.responseText == "null") {
                t.innerHTML = "";
                return;
            }
            
            var res = JSON.parse(this.responseText);
            
            fin += "<span class='tp' style='background: #e9e9e9;display: block;font-size: .9em;padding: .3em .5em;'>فەرهەنگی ئەناهیتا: </span>";
            
            for( var a in res ) {
                
                fin += "<div><section><a rel='noopener noreferrer nofollow' href='"+res[a].link+"' style='color:#00e'>"+res[a].title+"</a></section>";
                fin += "<section style='font-size: .87em;text-indent: 1em;'>"+res[a].desc+"</section></div>";
            }
            
            t.style.animation="loaded 1s ease forwards";
            t.innerHTML = fin;
        }
        xmlhttp.open("get", `/tewar/ferheng.info.php?q=${q}&n=1`, true);
        xmlhttp.send();
    }
    
    function search_farhangumejuikawa (q, t) {
        t = document.querySelector(t);
        t.innerHTML = loader;
        var res, fin = "";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            
            if (this.responseText == "null") {
                t.innerHTML = "";
                return;
            }
            
            var res = JSON.parse(this.responseText);
            
            fin += "<span class='tp' style='background: #e9e9e9;display: block;font-size: .9em;padding: .3em .5em;'>فەرهەنگی کاوە: </span>";
            
            for( var a in res ) {
                
                fin += "<div><section>"+res[a].link+"</section>";
                fin += "<section style='font-size: .87em;text-indent: 1em;'>"+res[a].desc+"</section></div>";
            }
            
            t.style.animation="loaded 1s ease forwards";
            t.innerHTML = fin;
        }
        xmlhttp.open("get", `/tewar/farhangumejuikawa.com.php?q=${q}&n=1`, true);
        xmlhttp.send();
    }
</script>

</div>
