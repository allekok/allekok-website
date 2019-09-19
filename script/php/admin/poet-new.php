<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; شاعیری تازە";
$desc = "شاعیرێکی تازە";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<?php
// get the last id+1

$db = "index";
$q = "select id from auth order by id DESC";
require(ABSPATH."script/php/condb.php");

if( $query ) {
    $_id = ++mysqli_fetch_assoc($query)['id'];
}

// check for uploads

if(isset($_FILES)) {
    $_profile = array( $_FILES["profile"], "../../../style/img/poets/profile/profile_{$_id}.jpg" );
    
    $_pro460 = array( $_FILES["pro-460"], "../../../style/img/poets/pro-460/pro-460_{$_id}.jpg" );
    
    if(! ( file_exists($_profile[1]) && file_exists($_pro460[1]) ) ) {
        
        if( move_uploaded_file($_profile[0]['tmp_name'], $_profile[1]) && move_uploaded_file($_pro460[0]['tmp_name'], $_pro460[1]) ) {
            
            $uploaded = "<i class='g'>OK!</i> <br> <img src='{$_profile[1]}' id='profilepic'> <img src='{$_pro460[1]}' id='pro-460pic'>";
            
            $f = fopen("../../../desktop/update/imgs/update-version.txt","r+");
    	    $old_ver = fread($f, filesize("../../../desktop/update/imgs/update-version.txt"));
    	    fseek($f, 0);
    	    $new_ver = 1+intval($old_ver);
    	    fwrite($f, $new_ver);
    	    fclose($f);
    	    
    	    $f = fopen("../../../desktop/update/imgs/update-log.txt","a");
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
        
        $f = fopen("../../../desktop/update/index/update-version.txt","r+");
	$old_ver = fread($f, filesize("../../../desktop/update/index/update-version.txt"));
	fseek($f, 0);
	$new_ver = 1+intval($old_ver);
	fwrite($f, $new_ver);
	fclose($f);
	
	$f = fopen("../../../desktop/update/index/update-log.txt","a");
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
        <a onclick="event.preventDefault();window.open('http://allekok.com/script/php/add/cp/smgen.php', '_blank','width=300,height=200','')" style="background:rgb(102, 0, 51);" href="smgen.php">
            سازکردنی سایت‌مەپ
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
        
        <textarea name="hdesc" placeholder="لەبارەی ئەم شاعیرەدا"></textarea>
        
        <textarea name="bks" placeholder="بەرهەمەکان"></textarea>
        
        <textarea name="bksdesc" placeholder="لەبارەی بەرهەمەکان"></textarea>
        
        <input type="text" name="kind" placeholder="نەوع: dead,alive,pending">
        
        <button class="button" type="submit">زیاد کردن</button>
    </form>
    
    <!-- file upload sec -->
    <form id="frmUpload" method="POST" enctype="multipart/form-data" style="">
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
        
        <button class="button" type="submit">ناردن</button>
    </form>
    
    <div id="frmUploadMess">
        <?php echo $uploaded; ?>
    </div>    
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
