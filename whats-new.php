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
    
    <h1 style="display: inline-block;padding: 0.3em 0.8em 0;border-radius: 5px;margin: 1em 0 0.5em;font-size:0.9em;">
            تازەکانی ئاڵەکۆک
    </h1>
    <div style="border-bottom:1px solid #eee"></div>
    
    <section class='pitewsec'>
        <h3 style="background: rgba(0, 153, 255,0.05);color: rgb(0, 138, 230);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            نووسینی شێعر
        </h3><br>
        <?php
            $db = "index";
            $q = "select * from pitew where status LIKE '{\"status\":0%' order by id DESC";
            
            require("script/php/condb.php");
            
            if(mysqli_num_rows($query)>0) {
                while($res = mysqli_fetch_assoc($query)) {
                    if($res['poem-name'] === "")    $res['poem-name'] = "شێعر";
                        echo "<section class='pmlist'><span style='color:#09f'>&bull; </span>{$res['contributor']}</section><section class='pmlist'>{$res['poet']} &rsaquo; {$res['book']} &rsaquo; {$res['poem-name']}</section>";
                }
            } else {
                echo "<span style='color:#999;font-size:1em'>&bull;</span>";
            }
            
        ?>
    </section>
    
    <section class='pitewsec'>
        <h3 style="background: rgba(128, 0, 128, 0.05);color: rgb(128, 0, 128);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            ناردنی وێنەی شاعیران
        </h3><br>
        <?php
            $_list = make_list(ABSPATH."style/img/poets/new/");
            $a = 0;
            if(! empty($_list)) {
                foreach($_list as $_l) {
                    if($a === 5)    break 1;
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
        <h3 style="background: rgba(154, 205, 50, 0.08);color: rgb(154, 205, 50);display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
           نووسینی زانیاری سەبارەت بە شاعیران
        </h3><br>
        <?php
            $_list = make_list2(ABSPATH."pitew/res/");
            $a = 0;
            if(!empty($_list)) {
                foreach($_list as $_l) {
                    if($a === 5)    break 1;
                        echo "<section class='pmlist'><span style='color:rgb(154, 205, 50)'>&bull; </span>" . $_l['poet'] . "، " .  $_l['name'] . "</section><section class='pmlist'>" . "<a href='/pitew/poetdesc-list.php?name={$_l['poet']}&poet={$_l['name']}'>نووسراو</a></section>";
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
        <h3 style="background: rgba(255, 0, 0,0.05);color: red;display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
            بیر و ڕای شێعرەکان
        </h3><br>
        <?php
            $q = "select * from `comments` where `read`=0 order by `id` DESC";
            
            $query = mysqli_query($conn, $q);
            
            if(mysqli_num_rows($query)>0) {
                while($res = mysqli_fetch_assoc($query)) {
                if($res['name'] === "")    $res['name'] = "ناشناس";
                    echo "<section class='pmlist'><span style='color:red'>&bull; </span>{$res['name']}</section><section class='pmlist'><a href='/{$res['address']}'>بیروڕا</a></section>";
                }
            } else {
                echo "<span style='color:#999;font-size:1em'>&bull;</span>";
            }
            
            mysqli_close($conn);
        ?>
    </section>
    
    <section class='pitewsec'>
        <i class='material-icons' style='color:blue;'><img src='/style/img/poets/profile/profile_0.jpg' style='opacity: 0.75;border: 2px dashed;border-radius: 100%;width: 0.9em;margin-bottom: 0.1em;'></i>
        <div class='fnav'>
            <div class='fnav-stats'>
                <div class='fnav-stats-caption'>
                    <?php include(ABSPATH . "script/php/stats.php"); ?>
                    <div id='poets-num'>
                        شاعیر:
                        <?php echo $aths_num; ?>
                    </div>
                    <div id='poets-num'>
                        کتێب:
                        <?php echo $bks_num; ?>
                    </div>
                    <div id='poems-num'>
                        شێعر:
                        <?php echo $hons_num; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="Acomms" style="font-size:0.8em;">
            <script>
                var http = new XMLHttpRequest();

                http.onload = function() {
                    document.getElementById("Acomms").innerHTML=this.responseText;
                    document.getElementById("Acomms").style.animation="tL-top 0.8s cubic-bezier(.18,.89,.32,1.28)";
                }

                http.open("get","/script/php/about-comments.php?num=3&ch="+Date.now());
                http.send();
            </script>
            
        </small>
    </section>
    
</div>

<?php
require_once("script/php/footer.php");
?>