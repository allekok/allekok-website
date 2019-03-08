<?php

include_once("../../../../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; گۆڕینی شاعیر";
$desc = "گۆڕینی شاعیر";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

include(ABSPATH . 'script/php/header.php');
?>
<?php
// a big if

if(! empty($_REQUEST['id'])) {
    
    // get poet info
    
    $_id = $_REQUEST['id'];
    
    $db = "index";
    $q = "select * from auth where id=$_id";
    
    require("../../condb.php");
    if(mysqli_num_rows($query) === 1) {
        
        $_poet = mysqli_fetch_assoc($query);
        
        
    } else {
        $_id = 0;
    }
    
    if($_id>0) {
        
        // load poet data
        
        $_name = $_poet['name'];
        $_takh = $_poet['takh'];
        $_profname = $_poet['profname'];
        $_hdesc = stripslashes($_poet['hdesc']);
        $_bks = $_poet['bks'];
        $_bksdesc = stripslashes($_poet['bksdesc']);
        
        $submitted = "<i class='g'>";
        $submitted .= "دۆزیمە!";
        $submitted .= "</i>"; 
        
        // if form has been submitted already
        
        if( isset($_REQUEST["name"]) && isset($_REQUEST["takh"]) && isset($_REQUEST["profname"]) && isset($_REQUEST["bks"]) ) {
            
            $_name = $_REQUEST['name'];
            $_takh = $_REQUEST['takh'];
            $_profname = $_REQUEST['profname'];
            $_hdesc = addslashes($_REQUEST['hdesc']);
            $_bks = $_REQUEST['bks'];
            $_bksdesc = addslashes($_REQUEST['bksdesc']);
            
            // update poet info. in the index db.
            
            
            $q = "UPDATE auth SET name='$_name', takh='$_takh', profname='$_profname', hdesc='$_hdesc', bks='$_bks', bksdesc='$_bksdesc' WHERE id=$_id";
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
                $submitted .= "ئەو شاعیرە بە ڕۆژ بۆوە";
                $submitted .= "</i>"; 
                
                $_hdesc = stripslashes($_REQUEST['hdesc']);
                $_bksdesc = stripslashes($_REQUEST['bksdesc']);
                
            } else {
                
                $submitted = "<i class='r'>";
                $submitted .= "کێشەیەک هەیە";
                $submitted .= "</i>";
            }
        }
        
        // load poet images
        
        $_imgsrc = array("../../../../style/img/poets/profile/profile_{$_id}.jpg", "../../../../style/img/poets/pro-460/pro-460_{$_id}.jpg");
        
        if( !file_exists($_imgsrc[0]) ) {
            $_imgsrc = array("../../../../style/img/poets/profile/profile_0.jpg", "../../../../style/img/poets/pro-460/pro-460_0.jpg");
        }
        
        $uploaded = "<img id='profilepic' src='{$_imgsrc[0]}'> <img id='pro-460pic' src='{$_imgsrc[1]}'>";
        
        // check for uploads
        
        if(isset($_FILES)) {
            $_profile = array( $_FILES["profile"], "../../../../style/img/poets/profile/profile_{$_id}.jpg" );
            
            $_pro460 = array( $_FILES["pro-460"], "../../../../style/img/poets/pro-460/pro-460_{$_id}.jpg" );
            
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
        
        mysqli_close($conn);
        
    }
    
}
?>
<style>
 input[type=text], textarea {
     font-size:.6em;
     display: block;
     width:100%;
     max-width:100%;
     font-family:'kurd',mono;
 }

 textarea {
     height:10em;
 }
 
 button[type=submit] {
     display:block;
     width:100%;
     max-width:100px;
     padding:0.3em 0;
     margin:auto;
 }
 
 #frmInfo {
     width:100%;
     max-width:800px;
     margin:auto auto 1em;
     padding:1em;
     border-bottom:3px solid #ddd;
 }
 
 #frmUpload {
     text-align:center;
 }

 #frmUpload p {
     direction:ltr;
     font-family:'kurd',mono;
     font-size:.5em;
 }
 #frmUpload input[type=file] {
     display:none;
 }
 
 #frmUpload button .material-icons {
     font-size:2em;
 }
 
 #frmInfoMess, #frmUploadMess {
     width:99%;
     max-width:800px;
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
 #toolbox a {
     color: #fff;
     background: #444;
     text-decoration: none;
     display: block;
     padding: 0.5em 0;
     text-align: center;
     font-size:.7em;
 }
 a:hover {
     opacity:0.7;
 }
</style>

<div id="poets">
    <div id="toolbox">
        <a href="poets.php">
            شاعیران
        </a>
        <a onclick="event.preventDefault();window.open('http://allekok.com/script/php/add/cp/make_search.php', '_blank','width=300,height=200','')" style="background:rgb(102, 0, 51);" href="make_search.php" target='_blank'>
            make_search.php
        </a>
    </div>
    
    <!-- info sec -->
    
    <div id="frmInfoMess">
        <?php echo $submitted; ?>
    </div>
    
    <form id="frmInfo" method="POST" action="">
        <input type="text" name="id" placeholder="ژمارەی شاعیر" value="<?php echo $_id; ?>" disabled>
        
        <input type="text" name="name" placeholder="ناوی شاعیر" value="<?php echo $_name; ?>">
        
        <input type="text" name="takh" placeholder="تەخەللوس" value="<?php echo $_takh; ?>">
        
        <input type="text" name="profname" placeholder="ناوی پرۆفایل" value="<?php echo $_profname; ?>">
        
        <textarea name="hdesc" placeholder="لەبارەی ئەم شاعیرەدا"><?php echo $_hdesc; ?></textarea>
        
        <textarea name="bks" placeholder="بەرهەمەکان"><?php echo $_bks; ?></textarea>
        
        <textarea name="bksdesc" placeholder="لەبارەی بەرهەمەکان"><?php echo $_bksdesc; ?></textarea>
        
        <button type="submit">بەڕۆژ کردن</button>
    </form>
    
    <!-- file upload sec -->
    <form id="frmUpload" method="POST" enctype="multipart/form-data">
        <p>
	    120 x 120: <button class="button" onclick="document.getElementById('profile').click();">
	    <i class="material-icons">add_a_photo</i>
	    </button>
	    <input type="file" name="profile" id="profile">
        </p><p>
	    460 x 460: <button class="button" onclick="document.getElementById('pro-460').click();">
	    <i class="material-icons">add_a_photo</i>
	    </button>
	    <input type="file" name="pro-460" id="pro-460">
	</p>
	
        <button type="submit">ناردن</button>
    </form>
    
    <div id="frmUploadMess">
        <?php echo $uploaded; ?>
    </div>    
</div>

<?php
include_once(ABSPATH . "script/php/footer.php");
?>
