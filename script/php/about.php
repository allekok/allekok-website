<div id="poets">
    <div>
        <p style="font-size:0.75em;">
            ئاڵەکۆک، هەلێکە بۆ خوێندنەوەی شێعری کوردی.
        </p>
    </div>
    <!---

    If you wanna know who I am, go here: <?php echo _SITE; ?>quest/

    -->
    <div class='fnav'>
        <div class='fnav-stats'>
            <div class='fnav-stats-caption'>
                <?php include("stats.php"); ?>
                <i id='poets-num'><?php echo $aths_num; ?></i>
                شاعیر
                <i class='material-icons'>keyboard_arrow_left</i>
                <i id='poems-num'><?php echo $hons_num; ?></i>
                شێعر
            </div>
        </div>
        <div style="font-size:.5em; margin-top:1em;">
            <span style="color:#666;">
                ئاخیرین نوێ کردنەوەی شێعرەکان: 
            </span>
            <span style="direction:ltr; letter-spacing: .5px; display:inline-block; color:#444;">
            <?php
                echo num_convert(file_get_contents(ABSPATH . "last-update.txt"), "en", "ckb");
                ?>
            </span>
        </div>

    </div>
    <div style="width:95%;max-width:550px;border-top:1px solid #eee; padding:.5em 0 0; margin:auto;">
        
        <p style="font-size:0.75em;padding-bottom:0.5em;">
            ئاڵەکۆک‌تان بەلاوە چۆنە؟
        </p>

        <div id="message"></div>

        <form id="frmComm" action="/script/php/append.php" method="POST">

            <textarea placeholder="بیر و ڕاتان سەبارەت بە ئاڵەکۆک بنووسن..." id="commTxt" style="font-size:.65em;max-width:95%;width:95%;min-height:8.5em"></textarea>

            <div class='loader' id="commloader" style="display:none;margin:.5em auto .2em;width:1.5em;height:1.5em;"></div>

            <button type="submit" style="font-size: .65em;width: 50%;max-width: 150px;margin-top:0.5em;" class='button'>ناردن</button>
        </form>

        <?php
        $uri = "script/php/res/about.comments";
        if(filesize($uri)>0) { $nzuri = 1; } ?>
        
        <div id="Acomms-title" style="margin:1em 0 .5em;font-size: .8em;<?php if(!$nzuri){echo 'display:none';} ?>">
            بیر و ڕاکان سەبارەت بە ئاڵەکۆک
        </div>

        <div id="Acomms" style="font-size:0.8em;<?php if(!$nzuri){echo('display:none;');} ?>">
            <?php
                $rnds = array(
                    mt_rand(1,22),
                    mt_rand(1,22),
                    mt_rand(1,22),
                    mt_rand(1,22),
                );
            ?>
            <div class='loader' style="border-top: 2px dashed <?php echo $colors[$rnds[0]][0]; ?>;border-bottom: 2px dashed <?php echo $colors[$rnds[1]][0]; ?>;border-right: 2px dashed <?php echo $colors[$rnds[2]][0]; ?>;border-left: 2px dashed <?php echo $colors[$rnds[3]][0]; ?>;border-radius:100%;padding:0;animation-duration:0.7s;"></div>
            
            <script>
                var http = new XMLHttpRequest();
                http.onload = function () {
                    var Acomms = document.getElementById("Acomms");
                    Acomms.innerHTML=this.responseText;
                    Acomms.style.animation="tL-top 0.8s cubic-bezier(.18,.89,.32,1.28)";
                }
                http.open("get","/script/php/about-comments.php");
                http.send();
            </script>
        </div>
    </div>
</div>

<script>

function append() {

    var httpd = new XMLHttpRequest();

    var res = document.getElementById('message');
    var comm = document.getElementById('commTxt');
    var loader = document.getElementById('commloader');

    var nullError = "<i style='display:block;background-color:rgba(204,51,0,0.1);color:#444;font-size:0.5em;'>هیچ تان نەنووسیوە.</i>";

    var succMess = "<i style='display:block;background-color:rgba(102,255,204,0.1);color:#444;font-size:0.5em;'>زۆر سپاس بۆ دەربڕینی بیر و ڕاتان سەبارەت بە ئاڵەکۆک.</i>";

    var failMess = "<i style='display:block;background-color:rgba(204,51,0,0.1);color:#444;font-size:0.5em;'>کێشەیەک هەیە. تکایە دووبارە هەوڵ دەنەوە.</i>";

    //out of range error
    var OoRError = "<i style='display:block;background-color:rgba(204,51,0,0.1);color:#444;font-size:0.5em;'>ژمارەی پیتەکان نابێ لە ۲۶۸۵ پیت زیاتر بێ.</i>";

    var request = "comm="+encodeURIComponent(comm.value);

    if(comm.value === "") {
        comm.focus();
        return 0;
    }

    if(comm.value.length > 2685) {
        res.innerHTML = OoRError;
        comm.style.borderTop = "3px solid rgb(204,51,0)";
        comm.focus();
        setTimeout(function() {
            comm.style.borderTop = "3px solid #ddd";
        }, 3000);
        return 0;
    }

    loader.style.display = "block";
    comm.style.backgroundColor = "#eee";
    comm.style.color = "#999";

    httpd.onload = function() {

        var respond = JSON.parse(this.responseText);

        if(respond.message == "ok") {

            res.innerHTML = succMess;
            comm.style.borderTop = "2px solid #06d";

            var Acomms = document.getElementById('Acomms');
            var AcommsTitle = document.getElementById('Acomms-title');

            Acomms.style.display = "block";
            AcommsTitle.style.display = "block";
            Acomms.innerHTML = respond.comm + Acomms.innerHTML;
            window.location = "#Acomms-title";
            comm.value="";

        } else {
            res.innerHTML = failMess;
            comm.style.borderTop = "2px solid rgb(204,51,0)";
            setTimeout(function() {
                comm.style.borderTop = "3px solid #ddd";
            }, 3000);
        }

        loader.style.display = "none";
        comm.style.backgroundColor = "";
        comm.style.color = "";
         
    }

    httpd.open("POST","/script/php/append.php");
    httpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpd.send(request);

}


    document.getElementById("frmComm").addEventListener("submit", function(e) {
        if(XMLHttpRequest) {
            e.preventDefault();
            append();
        }

    });

</script>
