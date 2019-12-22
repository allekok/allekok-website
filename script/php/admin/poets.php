<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; شاعیران";
$desc = "شاعیران";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>

<style>
 input {
     font-size:.6em;
 }
 table {
     margin:auto;
     width:100%;
     max-width:800px;
     font-size:.6em;
     text-align:right
 }
 
 img {
     width:100%;
     max-width:100px
 }
 #toolbox a {
     color:#fff;
     background:#444;
     text-decoration:none;
     display:block;
     padding:.5em 0;
     text-align:center;
     font-size:.7em;
 }
 a:hover {
     opacity:.7;
 }
 td {
     border:0;
     padding:.5em;
 }
 .profile {
     padding:.1em;
 }
 .profile img {
     vertical-align:middle;
     border-radius:50%
 }
</style>
<div id="poets">
    
    <div id="toolbox">
        <a href="poet-new.php">
            شاعیری نوێ
        </a>
    </div>
    <input style="width:100%" type="text" id="filter-txt" onkeyup="_filter()" placeholder="گەڕان لە شاعیران‌دا...">
    
    <?php
    
    // include colors
    
    include(ABSPATH."script/php/colors.php");
    
    
    $q = "select id, profname from auth order by takh";
    
    require(ABSPATH."script/php/condb.php");
    
    $_ths = array(
        array("وێنە",
	      "7%"),
        array("ژمارە",
	      "5%"),
        array("ناسناو",
	      "55%"),
        array("کاروبار",
	      "10%")
    );
    
    echo "<table>";
    echo "<tr>";
    
    foreach($_ths as $_th) {
        
        echo "<th style='width:{$_th[1]}'>";
        echo $_th[0];
        echo "</th>";
    }
    
    echo "</tr>";
    
    while($res = mysqli_fetch_assoc($query)) {
        
        echo "<tr>";
        
        //poet img
        echo "<td class='profile border-bottom-eee'>";
        $_imgsrc = get_poet_image($res['id'],true);
        echo "<img src='$_imgsrc'>";
        echo "</td>";
        
        foreach($res as $_r) {
            echo "<td class='border-bottom-eee'>";
            echo num_convert($_r,"en","ckb");
            echo "</td>";
        }
        
        //operations
        echo "<td class='border-bottom-eee'>";
        echo "<a class='link material-icons' href='poet-edit.php?id={$res['id']}'>edit</a>";
        echo "</td>";
        
        echo "</tr>";
    }
    
    echo "</table>";
    
    mysqli_close($conn);
    
    ?>
</div>

<script>
 function _filter(lastChance=false) {
     var input = document.getElementById("filter-txt").value;
     var filter, ul, li, a, i, res, tmp;
     res = 0;
     filter = lastChance ? san_data(input.toUpperCase(), true) : san_data(input.toUpperCase());
     div = document.querySelector("table");
     a = div.querySelectorAll("tr");
     for (i = 0; i < a.length; i++) {
	 tmp = lastChance ? san_data(a[i].innerHTML.toUpperCase(), true) : san_data(a[i].innerHTML.toUpperCase());
	 if (tmp.indexOf(filter) > -1) {
	     a[i].style.display = "";
	     res++;
	 } else {
	     a[i].style.display = "none";
	 }
     }
     if(res == 0 && !lastChance) {
	 _filter(true);
     }
 }

 function num_convert(inp) {

     var en_num = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g];
     var ku_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
     var ar_num = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];

     for (var i in en_num) {
	 inp = inp.replace(en_num[i], ku_num[i]);
	 inp = inp.replace(ar_num[i], ku_num[i]);
     }

     return inp;
 }

 function san_data(inp, lastChance = false) {
     if (inp == "") return "";

     var extras = [/&laquo;/g, /&raquo;/g, /&rsaquo;/g, /&lsaquo;/g, /&bull;/g, /&nbsp;/g, /\?/g, /!/g, /#/g, /&/g, /\*/g, /\(/g, /\)/g, /-/g, /\+/g, /=/g, /_/g, /\[/g, /\]/g, /{/g, /}/g, /</g, />/g, /\//g, /\|/, /\'/g, /\"/g, /;/g, /:/g, /,/g, /\./g, /~/g, /`/g, /؟/g, /،/g, /»/g, /«/g, /ـ/g, /›/g, /‹/g, /•/g, /‌/g, /\s+/g,
		   /؛/g,
     ];
     var ar_signs = ['ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ'];

     var kurdish_letters = [
	 "ه",
	 "ه",
	 "ک",
	 "ی",
	 "ه",
	 "ز",
	 "س",
	 "ت",
	 "ز",
	 "ر",
	 "ه",
	 "خ",
	 "و",
	 "و",
	 "و",
	 "ی",
	 "ر",
	 "ل",
	 "ز",
	 "س",
	 "ه",
	 "ر",
	 "م",
	 "ا",
	 "ا",
	 "ل",
	 "س",
	 "ی",
	 "و",
	 "ئ",
	 "ی",
     ];

     var other_letters = [
	 /ه‌/g,
	 /ە/g,
	 /ك/g,
	 /ي/g,
	 /ھ/g,
	 /ض/g,
	 /ص/g,
	 /ط/g,
	 /ظ/g,
	 /ڕ/g,
	 /ح/g,
	 /غ/g,
	 /وو/g,
	 /ۆ/g,
	 /ؤ/g,
	 /ێ/g,
	 /ڕ/g,
	 /ڵ/g,
	 /ذ/g,
	 /ث/g,
	 /ة/g,
	 /رر/g,
	 /مم/g,
	 /أ/g,
	 /آ/g,
	 /لل/g,
	 /سس/g,
	 /یی/g,
	 /ڤ/g,
	 /ع/g,
	 /ى/g,
     ];

     for (var i in extras) {
	 inp = inp.replace(extras[i], "");
     }

     for (i in ar_signs) {
	 inp = inp.replace(ar_signs[i], "");
     }

     for (i in kurdish_letters) {
	 inp = inp.replace(other_letters[i], kurdish_letters[i]);
     }

     inp = num_convert(inp);

     if (lastChance == true) inp = inp.replace(/ه/g, "");

     return inp;
 }
</script>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
