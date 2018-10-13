<?php
    
    if(! defined('ABSPATH'))    define('ABSPATH', '/home/allekokc/public_html/');

	require_once("script/php/colors.php");
	require_once("script/php/constants.php");
	require_once("script/php/functions.php");

$title = _TITLE . " - تازەکان";
$desc = "تازەکانی ئاڵەکۆک";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('script/php/header.php');
?>

<div id="poets">
    
    <h1 style="background: rgba(255, 140, 0, 0.05);color: darkorange;display: inline-block;padding: 0.3em 0.8em 0;border-radius: 5px;margin: 1em 0 0.5em;font-size:0.9em;">
            تازەکانی ئاڵەکۆک
    </h1>
    <div style="border-bottom:1px solid #eee"></div>
    
    <section class='pitewsec'>
        <!--<i class='material-icons' style="color: rgb(0, 138, 230);">note_add</i>-->
        <h3 style="background: rgba(0, 153, 255,0.05);color: rgb(0, 138, 230);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            نووسینی شێعر
        </h3><br>
        <?php
            $db = "index";
            $q = "select * from pitew where status LIKE '{\"status\":0%' order by id DESC";
            
            require("script/php/condb.php");
            
            $a = 0;
            if(mysqli_num_rows($query)>0) {
                while($res = mysqli_fetch_assoc($query)) {
                    if($a === 3)    break 1;
                if($res['poem-name'] === "")    $res['poem-name'] = "شێعر";
                    echo "<section class='pmlist'><span style='color:#09f'>&bull; </span>{$res['contributor']}</section><section class='pmlist'>{$res['poet']} &rsaquo; {$res['poem-name']}</section>";
                    $a++;
                }
            } else {
                echo "<span style='color:#999;font-size:1em'>&bull;</span>";
            }
            
        ?>
    </section>
    
    <section class='pitewsec'>
        <!--<i class='material-icons' style='color:purple;'>image</i>-->
        <h3 style="background: rgba(128, 0, 128, 0.05);color: rgb(128, 0, 128);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            ناردنی وێنەی شاعیران
        </h3><br>
        <?php
            $_list = make_list(ABSPATH."style/img/poets/new/");
            $a = 0;
            if(! empty($_list)) {
                foreach($_list as $_l) {
                    if($a === 3)    break 1;
                    echo "<section class='pmlist'><span style='color:rgb(128, 0, 128)'>&bull; </span>" . $_l['name'] . "، " . $_l['poet'] . "</section><section class='pmlist'>" . "<a href='{$_l['uri']}'>وێنە</a></section>";
                    $a++;
                }
            } else {
                echo "<span style='color:#999;font-size:1em'>&bull;</span>";
            }

            function make_list($_dir) {
              if(! is_dir($_dir) )
                return 0;
            
              $d = opendir($_dir);
              $_list = array();
            
              while( false !== ($entry = readdir($d))) {
                if(_unlist($entry)) {
                    $uri = "/style/img/poets/new/".$entry;
                    $entry = str_replace([".jpeg",".jpg",".png"], "", $entry);
                    $entry = explode("_", $entry);
                    $entry["poet"] = $entry[0];
                    $entry["name"] = $entry[1];
                    $entry["uri"] = $uri;
                    array_unshift($entry, filemtime("/home/allekokc/public_html" . $uri));
                    $_list[] = $entry;
                }
              }
            
              if(rsort($_list))  return $_list;
            }
            
            function _unlist($v) {
              $_Vs = array(".", "..");
              if(! in_array($v, $_Vs) ) return $v;
            }
        ?>
    </section>
    
    <section class='pitewsec'>
        <!--<i class='material-icons' style='color:yellowgreen;'>person</i>-->
        <h3 style="background: rgba(154, 205, 50, 0.08);color: rgb(154, 205, 50);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
           نووسینی زانیاری سەبارەت بە شاعیران
        </h3><br>
        <?php
            $_list = make_list2(ABSPATH."pitew/res/");
            $a = 0;
            if(!empty($_list)) {
                foreach($_list as $_l) {
                    if($a === 3)    break 1;
                        echo "<section class='pmlist'><span style='color:rgb(154, 205, 50)'>&bull; </span>" . $_l['poet'] . "، " .  $_l['name'] . "</section><section class='pmlist'>" . "<a href='{$_l['uri']}'>نووسراو</a></section>";
                    $a++;
                }
            } else {
                echo "<span style='color:#999;font-size:1em'>&bull;</span>";
            }

            function make_list2($_dir) {
              if(! is_dir($_dir) )
                return 0;
            
              $d = opendir($_dir);
              $_list = array();
            
              while( false !== ($entry = readdir($d))) {
                if(_unlist($entry)) {
                    $uri = "/pitew/res/".$entry;
                    $entry = str_replace([".txt"], "", $entry);
                    $entry = explode("_", $entry);
                    $entry["poet"] = $entry[0];
                    $entry["name"] = $entry[1];
                    $entry["uri"] = $uri;
                    array_unshift($entry, filemtime("/home/allekokc/public_html" . $uri));
                    $_list[] = $entry;
                }
              }
            
              if(rsort($_list))  return $_list;
            }
        ?>
    </section>
    
    <section class='pitewsec'>
        <!--<i class='material-icons' style='color:red;'>insert_drive_file</i>-->
        <h3 style="background: rgba(255, 0, 0,0.05);color: red;display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            بیر و ڕای شێعرەکان
        </h3><br>
        <?php
            $q = "select * from `comments` where `read`=0 order by `id` DESC";
            
            $query = mysqli_query($conn, $q);
            
            $a = 0;
            if(mysqli_num_rows($query)>0) {
                while($res = mysqli_fetch_assoc($query)) {
                    if($a === 3)    break 1;
                if($res['name'] === "")    $res['name'] = "ناشناس";
                    echo "<section class='pmlist'><span style='color:red'>&bull; </span>{$res['name']}</section><section class='pmlist'><a href='/{$res['address']}'>بیروڕا</a></section>";
                    $a++;
                }
            } else {
                echo "<span style='color:#999;font-size:1em'>&bull;</span>";
            }
            
        ?>
    </section>
    
    <section class='pitewsec'>
        <i class='material-icons' style='color:blue;'><img src='/style/img/poets/profile/profile_0.jpg' style='opacity: 0.75;border: 2px dashed;border-radius: 100%;width: 0.9em;margin-bottom: 0.1em;'></i>
        <!--<h3 style="background: rgba(0, 0, 0,0.05);color: #444;display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            ئاڵەکۆک؟
        </h3><br>-->
        <div class='fnav'>
            <div class='fnav-stats'>
                <div class='fnav-stats-caption'>
                    <i id='poets-num'>---</i>
                    شاعیر
                    <i style='font-style:normal;'> &rsaquo; </i>
                    <i id='poems-num'>---</i>
                    شێعر
                </div>
            </div>
        </div>
        <div id="Acomms" style="font-size:0.8em;">
            <script>
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
                var http = new XMLHttpRequest();

                http.onreadystatechange = function() {
                    if(this.status == 200 && this.readyState == 4) {
                        document.getElementById("Acomms").innerHTML=this.responseText;
                            document.getElementById("Acomms").style.animation="tL-top 0.8s cubic-bezier(.18,.89,.32,1.28)";
                    }
                }

                http.open("POST","/script/php/about-comments.php?num=3",true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send();
            </script>
            
        </small>
    </section>
    
</div>

<?php
mysqli_close($conn);
	require_once("script/php/footer.php");
?>