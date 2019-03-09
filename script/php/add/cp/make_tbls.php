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
    $res['bks'] = explode(",",$res['bks']);
    $res['rbooks'] = $res['bks'];
    for($b=0;$b<count($res['bks']);$b++) {
        $res['bks'][$b] = san_data($res['bks'][$b]);
    }
    $res['bksdesc'] = explode(",",$res['bksdesc']);
    for($b=0;$b<count($res['bksdesc']);$b++) {
        $res['bksdesc'][$b] = san_data($res['bksdesc'][$b]);
    }
    $res['rtakh'] = $res['takh'];
    $res['takh'] = san_data($res['takh']);
    

    //replaces-trims
    $res['address'] = "poet:".$res['id'];
    
    $aths[$res['id']] = $res;
}
//truncate table poems
mysqli_select_db($con,"allekokc_search");
mysqli_query($con,"TRUNCATE TABLE books");
echo "<pre>";

$j=0;
foreach($aths as $ath) {
    //mysqli_select_db($con,"allekokc_search");
    
    $poet_takh = $ath['takh'];
    $poet_address = $ath['address'];
    $rtakh = $ath['rtakh'];
    
    for($i=0;$i<count($ath['bks']);$i++) {
        $j++;
        $id = $j;
        $book = $ath['bks'][$i];
        $rbook = $ath['rbooks'][$i];
        $book_desc = $ath['bksdesc'][$i];
        
        $len = ( strlen($book) > strlen($book_desc) ) ? strlen($book) : strlen($book_desc);

        $book_address = "book:" . ($i+1);
        $q = mysqli_query($con, "INSERT INTO `books`(`id`,`book`,`book_desc`,`poet_address`,`book_address`,`rtakh`,`rbook`,`len`) VALUES ($id,'$book','$book_desc','$poet_address','$book_address','$rtakh','$rbook','$len')");
        if($q) {
            echo "true";
        } else {
            echo "bam";
        }
    }
    
    
}

mysqli_close($con);
?>
<br><br>
<button onclick="window.open('http://allekok.com/script/php/add/cp/make_poems.php', '_blank','width=300,height=200','')" type="button">make_poems.php</button>
