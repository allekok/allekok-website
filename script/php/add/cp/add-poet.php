<?php
 // get the last id+1
    
    $db = "index";
    $q = "select id from auth order by id DESC";
    require("../../condb.php");
    
    if( $query ) {
        $_id = ++mysqli_fetch_assoc($query)['id'];
    }
    
    // check for uploads
    
    if(isset($_FILES)) {
        $_profile = array( $_FILES["profile"], "../../../../style/img/poets/profile/profile_{$_id}.jpg" );
        
        $_pro460 = array( $_FILES["pro-460"], "../../../../style/img/poets/pro-460/pro-460_{$_id}.jpg" );
        
        if(! ( file_exists($_profile[1]) && file_exists($_pro460[1]) ) ) {
            
            if( move_uploaded_file($_profile[0]['tmp_name'], $_profile[1]) && move_uploaded_file($_pro460[0]['tmp_name'], $_pro460[1]) ) {
                
                $uploaded = "<i class='g'>OK!</i> <br> <img src='{$_profile[1]}' id='profilepic'> <img src='{$_pro460[1]}' id='pro-460pic'>";
                
                $f = fopen("../../../../desktop/update/imgs/update-version.txt","r+");
    			$old_ver = fread($f, filesize("../../../../desktop/update/imgs/update-version.txt"));
    			fseek($f, 0);
    			$new_ver = 1+intval($old_ver);
    			fwrite($f, $new_ver);
    			fclose($f);
    			
    			$f = fopen("../../../../desktop/update/imgs/update-log.txt","a");
    			$log = [
    			    "ver" => $new_ver,
    			    "poetID" => intval($_id),
    			    ];
    			 $log = json_encode($log) . "\n";
    			fwrite($f, $log);
    			fclose($f);
            }
        }
    }
    
    // submit poet info. in the index db.
    
    if( isset($_REQUEST["name"]) && isset($_REQUEST["takh"]) && isset($_REQUEST["profname"]) && isset($_REQUEST["bks"]) && isset($_REQUEST["kind"]) ) {
        
        $_name = $_REQUEST['name'];
        $_takh = $_REQUEST['takh'];
        $_profname = $_REQUEST['profname'];
        $_hdesc = $_REQUEST['hdesc'];
        $_bks = $_REQUEST['bks'];
        $_bksdesc = $_REQUEST['bksdesc'];
        $_kind = $_REQUEST['kind'];
        // $_date = date("l Y-m-d h:i:sa");
        
        $q = "INSERT INTO auth (id,name,takh,profname,hdesc,bks,bksdesc,kind) VALUES($_id, '$_name', '$_takh', '$_profname', '$_hdesc', '$_bks', '$_bksdesc', '$_kind')";
        $query = mysqli_query($conn, $q);
        
        if( $query ) {
            
            $f = fopen("../../../../desktop/update/index/update-version.txt","r+");
			$old_ver = fread($f, filesize("../../../../desktop/update/index/update-version.txt"));
			fseek($f, 0);
			$new_ver = 1+intval($old_ver);
			fwrite($f, $new_ver);
			fclose($f);
			
			$f = fopen("../../../../desktop/update/index/update-log.txt","a");
			$log = [
			    "ver" => $new_ver,
			    "poetID" => intval($_id),
			    ];
			 $log = json_encode($log) . "\n";
			fwrite($f, $log);
			fclose($f);
            
            $submitted = "<i class='g'>";
            $submitted .= "ئەو شاعیرە بە ئاڵەکۆکەوە زیاد کرا";
            $submitted .= "</i>"; 
            
            $_id++;
        } else {
            
            $submitted = "<i class='r'>";
            $submitted .= "کێشەیەک هەیە";
            $submitted .= "</i>";
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE HTML>
<html dir="rtl">
    <head>
        <title>
            شاعیر - نوێ
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
            
            #frmInfo {
                width:99%;
                max-width:600px;
                margin:auto auto 1em;
                border-bottom:3px solid #ddd;
            }
            
            #frmUpload {
                text-align:center;
            }
            
            #frmInfoMess, #frmUploadMess {
                width:99%;
                max-width:600px;
                margin:auto;
                text-align:center;
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
            <a href="poets.php">
                شاعیران
            </a>
            <a onclick="event.preventDefault();window.open('http://allekok.com/script/php/add/cp/smgen.php', '_blank','width=300,height=200','')" style="background:rgb(102, 0, 51);" href="smgen.php">
                smgen.php
            </a>
        </div>
        
        <!-- info sec -->
        
        <div id="frmInfoMess">
            <?php echo $submitted; ?>
        </div>
        
        <form id="frmInfo" method="POST" action="">
            <input type="text" name="id" placeholder="ژمارەی شاعیر" value="<?php echo $_id; ?>" disabled>
            
            <input type="text" name="name" placeholder="ناوی شاعیر" >
            
            <input type="text" name="takh" placeholder="تەخەللوس">
            
            <input type="text" name="profname" placeholder="ناوی پرۆفایل">
            
            <input type="text" name="hdesc" placeholder="لەبارەی ئەم شاعیرەدا" disabled>
            
            <input type="text" name="bks" placeholder="بەرهەمەکان">
            
            <input type="text" name="bksdesc" placeholder="لەبارەی بەرهەمەکان">
            
            <input type="text" name="kind" placeholder="نەوع">
            
            <button type="submit">زیاد کردن</button>
        </form>
        
        <!-- file upload sec -->
        <form id="frmUpload" method="POST" enctype="multipart/form-data" style="direction:ltr">
            
            profile: <input type="file" name="profile">
            
            pro-460: <input type="file" name="pro-460">
            
            <button type="submit">ناردن</button>
        </form>
        
        <div id="frmUploadMess">
            <?php echo $uploaded; ?>
        </div>    
        
    </body>
    
</html>