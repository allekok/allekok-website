<!DOCTYPE HTML>
<html dir="rtl">
    <head>
        <title>
            شاعیران
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../../style/css/fonts.css">
        <style>
            * {
                padding:0;
                margin:0;
                border:0;
                outline:0;
                font-family:'kurd';
                font-size:inherit;
                transition:all 0.2s ease;
                -webkit-transition:all 0.2s ease;
            }
            
            input[type=text] {
                display: block;
                width:96%;
                padding:0.2em 2%;
                border-bottom:2px solid #ccc;
                margin:0 0 1em;
            }
            
            input[type=text]:focus {
                border-bottom:2px solid #06d;
                box-shadow:0 2px 1px #ddd;
            }
            
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
        
        <?php
            
            // include colors
            
            include("../../colors.php");
            
            
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
                
                echo "<tr style='background:".$colors[$res['id']][2]."'>";
                
                 //poet img
                echo "<td style='outline:1px solid ".$colors[$res['id']][2]."'>";
                $_imgsrc = "../../../../style/img/poets/profile/profile_{$res['id']}.jpg";
                if(file_exists($_imgsrc)) {
                    
                    echo "<img src={$_imgsrc}>";
                } else {
                    echo "<img src='../../../../style/img/poets/profile/profile_0.jpg'>";
                }
                echo "</td>";
                
                foreach($res as $_r) {
                    echo "<td style='outline:1px solid ".$colors[$res['id']][2]."'>";
                    echo $_r;
                    echo "</td>";
                }
                
                //operations
                echo "<td style='outline:1px solid ".$colors[$res['id']][2]."'>";
                echo "<a style='background:".$colors[$res['id']][0].";color:".$colors[$res['id']][1].";float: right;width:100%' href='edit-poet.php?id={$res['id']}'>Edit</a>";
                echo "</td>";
                
                echo "</tr>";
            }
            
            echo "</table>";
            
            mysqli_close($conn);
        
        ?>
        
    </body>
    
</html>