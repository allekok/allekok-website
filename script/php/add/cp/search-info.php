<!DOCTYPE HTML>
<html dir="rtl">
    <head>
        <title>
            گەڕانەکان
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
            
            td {
                border-bottom:1px solid #ddd;
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
            
        </div>
        
        <?php
            
            $db = "search";
            $q = "select Cipi, rtakh, rbook, rname, id from poems where Cipi!=0 order by Cipi DESC";
            
            require("../../condb.php");
            
            $_ths = array(
            array("Cipi",
            "5%"),
            array("شاعیر",
            "15%"),
            array("کتێب",
            "18%"),
            array("شێعر",
            "45%"),
            array("ژمارە",
            "5%"),
            array("کاروبار",
            "12%")
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
                
                echo "<tr>";
                
                foreach($res as $_r) {
                    echo "<td>";
                    echo $_r;
                    echo "</td>";
                }
                
                //operations
                echo "<td>";
                echo "<a style='background:#ccffee;color:#006644;width: 50%;float: right;' href='edit-poet.php?id={$res['id']}'>Edit</a> <a style='background:#f2d9d9;color:#4b1b1b;width: 50%;float: right;' href=''>Delete</a>";
                echo "</td>";
                
                echo "</tr>";
            }
            
            echo "</table>";
            
            mysqli_close($conn);
        
        ?>
        
    </body>
    
</html>