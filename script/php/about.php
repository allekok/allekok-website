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
                <i id='poets-num'>---</i>
                شاعیر
                <i class='material-icons'>keyboard_arrow_left</i>
                <i id='poems-num'>---</i>
                شێعر
            </div>
        </div>

    </div>
    <div style="width:95%;max-width:550px;border-top:1px solid #ddd; padding:0.5em 0 0; margin:auto;">
        
        <p style="font-size:0.75em;padding-bottom:0.5em;">
            ئاڵەکۆک‌تان بەلاوە چۆنە؟
        </p>

        <div id="message"></div>

        <form id="frmComm" action="/script/php/append.php" method="POST">

            <textarea placeholder="بیر و ڕاتان سەبارەت بە ئاڵەکۆک بنووسن..." id="commTxt" style="font-size:0.65em;max-width:95%;width:95%;min-height:8.5em"></textarea>

            <div class='loader' id="commloader" style="display:none;"></div>

            <button type="submit" style="font-size: 0.65em;width: 50%;padding: 0.8em 0;max-width: 150px;cursor:pointer;margin-top:0.5em;" class='button'>ناردن</button>
        </form>

        <?php
        $uri = "script/php/res/about.comments";
        if(filesize($uri)>0) { $nzuri = 1; } ?>

        <div id="Acomms-title" style="border-top: 1px solid #ccc;margin: 0.4em 0 0.2em;padding: 0.4em 0 0.2em;font-size: 0.8em;<?php if(!$nzuri){echo 'display:none';} ?>">
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

                http.onreadystatechange = function() {
                    if(this.status == 200 && this.readyState == 4) {
                        document.getElementById("Acomms").innerHTML=this.responseText;
                            document.getElementById("Acomms").style.animation="tL-top 0.8s cubic-bezier(.18,.89,.32,1.28)";
                    }
                }

                http.open("POST","/script/php/about-comments.php",true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
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
        //res.innerHTML = nullError;
        comm.style.borderTop = "3px solid rgb(204,51,0)";
        comm.style.background = "rgba(204,51,0,0.1)";
        comm.focus();
        setTimeout(function() {
            comm.style.borderTop = "3px solid #ddd";
            comm.style.background = "";
        }, 2000);
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

    httpd.onreadystatechange = function() {

        if(this.status == 200 && this.readyState == 4) {

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
             
             setTimeout(function() {
                 res.innerHTML = "";
                comm.style.borderTop = "3px solid #ddd";
             }, 3500);

        }
    }

    httpd.open("POST","/script/php/append.php",true);
    httpd.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    httpd.send(request);

}


    document.getElementById("frmComm").addEventListener("submit", function(e) {
        if(XMLHttpRequest) {
            e.preventDefault();
            append();
        }

    });

    window.addEventListener("load", function() {
        var nums = document.querySelector(".fnav-stats-caption");
        var poets_num = document.getElementById("poets-num");
        var poems_num = document.getElementById("poems-num");

        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                var respond = JSON.parse(this.responseText);
                poets_num.innerHTML = respond["poets-num"];
                poems_num.innerHTML = respond["poems-num"];

                nums.style.animation="tL 2s ease-in forwards";

            }
        }
        xmlhttp.open("GET","/script/php/stats.php",true);
        xmlhttp.send();
        
        ///////////////////////
    });

</script>
