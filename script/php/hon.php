
<script>
    var ln = <?php echo $row[1]['likes']; ?>;
    var http_adrs = "poet=<?php echo $info['id']; ?>&book=<?php echo $bk; ?>&poem=<?php echo $row[1]['id']; ?>";
    var poem_adrs = "poet:<?php echo $info['id']; ?>/book:<?php echo $bk; ?>/poem:<?php echo $row[1]['id']; ?>";
    
    var poemV2 = JSON.stringify({
        url: poem_adrs,
        poetID: <?php echo $info['id']; ?>,
        poetName: "<?php echo $info['takh']; ?>",
        book: "<?php echo $bknow[$bk-1]; ?>",
        poem: "<?php echo $row[1]['name']; ?>",
    });
    
</script>

<div id="poets">

<p id='adrs'>
    <?php
        $__allekok_url = ($info['kind'] == "dead" || $info['kind'] == "bayt") ? "/" : "/?new";
    ?>
<a href="<?php echo $__allekok_url; ?>" style='background-image:url(/style/img/allekok.png);background-repeat:no-repeat;background-position: 3.7em 0.1em;padding-right: 1.8em;background-size: 1.6em;'>ئاڵەکۆک</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>

<a href="/poet:<?php echo $ath; ?>">
<?php
echo "<i style='vertical-align:middle;' class='material-icons'>person</i>" . " " . $info['takh'];
?>
</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>
<a href="/poet:<?php echo $ath; ?>/book:<?php echo $bk; ?>">
<?php
$bknow = explode(',',$info['bks']);
    
echo "<i style='vertical-align:middle;' class='material-icons'>book</i>" . " " . $bknow[$bk-1];
?>
</a>
<?php
$rrid_k = num_convert($row[1]['id'], "en", "ckb");
    
//echo("<i style='vertical-align:middle;' class='material-icons'>view_list</i>" . " " . "(".$rrid_k.") ".$row[1]['name']);
?>
</p>
<h3 id="bhon">
<?php
echo($rrid_k . ". " . $row[1]['name']);
?>

</h3>

    <?php if($row[2] != 0) { 
        $row[2]['ckbid'] = num_convert($row[2]['id'], "en", "ckb");
    }
    if($row[0] != 0) { 
        $row[0]['ckbid'] = num_convert($row[0]['id'], "en", "ckb");
    }
    ?>
<div class="nav" style="font-size: 0.6em;background:#fafafa;color:#555;width:100%;border-bottom: 1px solid #f6f6f6;<?php if(!($row[0]||$row[2])){echo('display:none;');} ?><?php if($row[0] === 0) { echo "text-align:left;"; } ?><?php if($row[2] === 0) { echo "text-align:right;"; } ?>">
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
        </div>|<div id='copy-sec' class='copy' style="position:relative;margin-right:0.4em;font-size:.83em;padding:.7em .3em;">
            <div style="width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;"></div>
            <i style='vertical-align:middle;' class='material-icons'>content_copy</i> کۆپی کردن 
        </div> | <div role="button" id="night-mode" style="padding: .7em .5em;font-size: .83em;background: #666;color: #fff;">تاریک</div><?php if(! ($ath==10 && $bk==1 && $row[1]['id']==1) ) { ?><div id='fav-sec' class='fav' style="background:none; font-size:1.8em; box-shadow:none; border:0;float:left;height:0.9em;position:relative;padding-left:5px;padding-top:.25em;">
            <div style="width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;"></div>
            <?php /*
            echo "<span id='likes-num' style='float:right;font-size:0.6em;color:#999;'>";
            if($row[1]['likes']>0) {
                $_likes = num_convert($row[1]['likes'], "en", "ckb");
                echo $_likes;
            }
            echo "</span>"; */
            ?>
            <i class='material-icons' id='like-icon' style='vertical-align:top;color:<?php echo $colors[$ath][0]; ?>;'>bookmark_border</i>
        </div>
        <?php } ?>
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
        <form id="frmComm" action="/script/php/comments-add.php" method="POST">
            
            <input style="box-shadow: 0 5px 10px -5px #ddd;border-top: 3px solid #ddd;" type="text" name='name' id='commNameTxt' placeholder="نێوی خۆتان لێرە بنووسن.">

            <textarea placeholder="بیر و ڕای خۆتان سەبارەت بەو شێعرە لێرە بنووسن... *" id="commTxt" style="font-size:0.6em;padding:0.6em 3% 0.6em 2%;text-align:right;max-width:95%;min-width:95%;min-height:6em;display:block;box-shadow: 0 5px 10px -5px #ddd;border-top: 3px solid #ddd;" name='comment'></textarea>

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
    
    function night_mode_switch() {
        var nm = document.querySelector("#night-mode");
        
        if(nm.innerHTML == "تاریک") {
            nm.innerHTML = "ڕووناک";
            localStorage.setItem("night", true);
            document.body.style.backgroundColor = "#22325e";
            document.body.style.color = "#fff";
            document.querySelector("#bhon").style.color = "#fff";
            document.querySelector("#adrs").style.color = "rgba(255,255,255,.85)";
            document.querySelector(".nav").style.background = document.body.style.backgroundColor;
            document.querySelector('.nav').style.color = "rgba(255,255,255,.85)";
            document.querySelector('.fontsize').style.background = "#293c70";
            document.querySelector('.fontsize').style.color = "rgba(255,255,255,.85)";
            document.querySelector('.fontsize i').style.color = "rgba(255,255,255,.85)";
            document.querySelectorAll('.bigger, .smaller, #copy-sec').forEach(function(d) {
                d.style.color = "#eee";
                d.style.background = "rgba(255,255,255,.2)";
            });
            document.querySelector('#night-mode').style.background = "#eee";
            document.querySelector('#night-mode').style.color = "#444";
            document.querySelectorAll('#adrs a').forEach(function(d) {
                d.style.color = "#fff";
            });
            document.querySelector('.nav').style.borderBottomColor = "rgba(255,255,255,.2)";
            try{document.querySelectorAll('.ptr').forEach(function(d){
                d.style.background = "rgba(255,255,255,.1)";
            });} catch(e) {}
            try{document.querySelectorAll('.d.cf').forEach(function(d) {
                d.style.color = "#fff";
                d.style.background = "rgba(255,255,255,.11)";
            });} catch(e) {}
            
            try {document.querySelector('#bhondesc').style.color = "#fff";
            document.querySelector('#bhondesc').style.background = "rgba(255,255,255,.11)";}catch(e) {}
            try{document.querySelectorAll('.comment').forEach(function(d) {
                d.style.background = "rgba(255,255,255,.11)";
            });}catch(e) {}
            try{
            document.querySelectorAll('.comm-footer').forEach(function(d) {
                d.style.color = "#ddd";
            });}catch(e) {}
            try{document.querySelectorAll('footer a').forEach(function(d) {
                d.style.color = "#ddd";
                d.style.borderBottomColor = "#999";
            });}catch(e){}
            document.querySelectorAll('form input, form textarea').forEach(function(d) {
                d.style.color = "#fff";
                d.style.background = "rgba(255,255,255,.11)";
            });
        } else {
            nm.innerHTML = "تاریک";
            localStorage.setItem("night", false);
            document.body.style.backgroundColor = "";
            document.body.style.color = "";
            document.querySelector("#bhon").style.color = "";
            document.querySelector("#adrs").style.color = "";
            document.querySelector(".nav").style.background = "#fafafa";
            document.querySelector('.nav').style.color = "";
            document.querySelector('.fontsize').style.background = "";
            document.querySelector('.fontsize').style.color = "";
            document.querySelector('.fontsize i').style.color = "#666";
            document.querySelectorAll('.bigger, .smaller, #copy-sec').forEach(function(d) {
                d.style.color = "";
                d.style.background = "";
            });
            document.querySelector('#night-mode').style.background = "#666";
            document.querySelector('#night-mode').style.color = "#fff";
            document.querySelectorAll('#adrs a').forEach(function(d) {
                d.style.color = "";
            });
            document.querySelector('.nav').style.borderBottomColor = "#f6f6f6";
            try{document.querySelector('.ptr').style.background = "";} catch(e) {}
            try{document.querySelectorAll('.d.cf').forEach(function(d) {
                d.style.color = "";
                d.style.background = "";
            });} catch(e) {}
            
            try{document.querySelector('#bhondesc').style.color = "";
            document.querySelector('#bhondesc').style.background = "";}catch(e) {}
            try{document.querySelectorAll('.comment').forEach(function(d) {
                d.style.background = "";
            });}catch(e) {}
            try{document.querySelectorAll('.comm-footer').forEach(function(d) {
                d.style.color = "";
            });}catch(e) {}
            try{document.querySelectorAll('footer a').forEach(function(d) {
                d.style.color = "";
                d.style.borderBottomColor = "";
            });}catch(e){}
            document.querySelectorAll('form input, form textarea').forEach(function(d) {
                d.style.color = "";
                d.style.background = "";
            });
            
        }
    }
    if(localStorage.getItem("night") == "true") {
        night_mode_switch();
    }
    document.querySelector("#night-mode").onclick = function() {
        night_mode_switch();
    }
    
</script>

</div>
