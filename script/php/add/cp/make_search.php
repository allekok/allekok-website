<meta charset="utf-8">
<?php
require_once("../../constants.php");
require_once("../../sanKuText.php");

$con = mysqli_connect(_HOST,_USER,_PASS);

mysqli_set_charset($con,"utf8");
mysqli_select_db($con,"allekokc_index");

$q = mysqli_query($con, "SELECT * from auth");

$aths_num = mysqli_num_rows($q);
echo "aths: " . $aths_num;

while($res=mysqli_fetch_assoc($q)) {
    $res['rtakh'] = $res['takh'];
    $res['name'] = san_data($res['name']);
    $res['takh'] = san_data($res['takh']);
    $res['profname'] = san_data($res['profname']);
    $res['hdesc'] = san_data($res['hdesc']);
    //replaces-trims
    $res['address'] = "poet:".$res['id'];
    
    $res['len'] = ( strlen($res['name']) > strlen($res['hdesc']) ) ? strlen($res['name']) : strlen($res['hdesc']);
    
    $aths[$res['id']] = $res;
}

//truncate table poems
mysqli_select_db($con,"allekokc_search");
mysqli_query($con,"TRUNCATE TABLE poets");
echo "<pre>";

foreach($aths as $ath) {
    //mysqli_select_db($con,"allekokc_search");
    
    $id = $ath['id'];
    $name = $ath['name'];
    $takh = $ath['takh'];
    $profname = $ath['profname'];
    $hdesc = filter_var($ath['hdesc'],FILTER_SANITIZE_STRING);;
    $address = $ath['address'];
    $rtakh = $ath['rtakh'];
    $len = $ath['len'];
    
    $q = mysqli_query($con, "INSERT INTO `poets`(`id`,`name`,`takh`,`profname`,`hdesc`,`uri`,`rtakh`,`len`) VALUES ($id,'$name','$takh','$profname','$hdesc','$address','$rtakh','$len')");
    if($q) {
        echo "true";
    } else {
        echo "bam";
    }
    
}

mysqli_close($con);
?>
<br><br>
<button onclick="window.open('http://allekok.com/script/php/add/cp/make_tbls.php', '_blank','width=300,height=200','')" type="button">make_tbls.php</button>