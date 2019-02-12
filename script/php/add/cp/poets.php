<!DOCTYPE HTML>
<html dir="rtl">
    <head>
        <title>
            شاعیران
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/style/css/main.css?v6">
        <style>
         button[type=submit] {
             display:block;
             width:100%;
             max-width:100px;
             padding:0.3em 0;
             margin:auto;
         }
         
         .g {
             background-color:rgba(0,255,0,0.2);
             color:green;
             display:block;
         }
         .r {
             background-color:rgba(255,0,0,0.2);
             color:red;
             display:block;
         }
         
         table {
             margin: auto;
             width: 100%;
             max-width: 700px;
         }
         
         th {
             background:#eee;
         }
         
         img {
             width:100%;
         }
         a {
             color: #fff;
             background: #06f;
             text-decoration: none;
             display: block;
             padding: 0.5em 0;
             text-align: center;
             box-shadow: 0 2px 1px #bbb;
         }
         a:hover {
             opacity:0.7;
         }
        </style>
    </head>
    
    <body>
        
        <div id="toolbox">
            <a href="add-poet.php">
                شاعیری نوێ
            </a>
        </div>
	<input style="width:100%" type="text" id="filter-txt" onkeyup="_filter()" placeholder="گەڕان لە کتێبەکان‌دا...">
        
        <?php
        
        // include colors
        
        include("../../colors.php");
	include("../../functions.php");
        
        
        $db = "index";
        $q = "select id, profname from auth";
        
        require("../../condb.php");
        
        $_ths = array(
            array("وێنە",
		  "10%"),
            array("ژمارە",
		  "5%"),
            array("ناسناو",
		  "55%"),
            array("کاروبار",
		  "30%")
        );
        
        echo "<table>";
        echo "<tr>";
        
        foreach($_ths as $_th) {
            
            echo "<th style='width:{$_th[1]};'>";
            echo $_th[0];
            echo "</th>";
        }
        
        echo "</tr>";
        
        while($res = mysqli_fetch_assoc($query)) {
            
            echo "<tr style='background:".$colors[color_num($res['id'])][2]."'>";
            
            //poet img
            echo "<td style='outline:1px solid ".$colors[color_num($res['id'])][2]."'>";
            $_imgsrc = "../../../../style/img/poets/profile/profile_{$res['id']}.jpg";
            if(file_exists($_imgsrc)) {
                
                echo "<img src={$_imgsrc}>";
            } else {
                echo "<img src='../../../../style/img/poets/profile/profile_0.jpg'>";
            }
            echo "</td>";
            
            foreach($res as $_r) {
                echo "<td style='outline:1px solid ".$colors[color_num($res['id'])][2]."'>";
                echo $_r;
                echo "</td>";
            }
            
            //operations
            echo "<td style='outline:1px solid ".$colors[color_num($res['id'])][2]."'>";
            echo "<a style='background:".$colors[color_num($res['id'])][0].";color:".$colors[color_num($res['id'])][1].";float: right;width:100%' href='edit-poet.php?id={$res['id']}'>Edit</a>";
            echo "</td>";
            
            echo "</tr>";
        }
        
        echo "</table>";
        
        mysqli_close($conn);
        
        ?>

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
    </body>
    
</html>
