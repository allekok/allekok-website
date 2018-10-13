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
    $res['rbks'] = $res['bks'];
    for($b=0;$b<count($res['bks']);$b++) {
        $res['bks'][$b] = san_data($res['bks'][$b]);
    }
    
    $res['rtakh'] = $res['takh'];
    $res['takh'] = san_data($res['takh']);
    
    //replaces-trims
    $res['address'] = "poet:".$res['id'];
    
    $aths[$res['id']] = $res;
}


//truncate table poems
mysqli_select_db($con,"allekokc_search");

//but first save imp, C, Cipi cloumns.

$C_query = mysqli_query($con, "select * From poems");

$Cs = array();
//$Cs_address = array();

$Cs_num = 0;

while($C_res = mysqli_fetch_assoc($C_query)) {
    $Cs[$Cs_num] = array('rname'=>$C_res['rname'], 'imp'=>$C_res['imp'], 'C'=>$C_res['C'], 'Cipi'=>$C_res['Cipi']);
    
    //$Cs_address[$Cs_num] = $C_res['poet_address'].$C_res['book_address'].$C_res['poem_address'];
    
    $Cs_num++;
}

mysqli_query($con,"TRUNCATE TABLE poems");
echo "<pre>";

//$j=0;
//$p=0;
//$Cs_num=0;
$kurdish_nums = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹','۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
$other_nums = array('0','1','2','3','4','5','6','7','8','9','٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
$Cs_key = 0;
foreach($aths as $ath) {
    //mysqli_select_db($con,"allekokc_search");
    
    $rtakh = $ath['rtakh'];
    $poet_takh = $ath['takh'];
    $poet_address = $ath['address'];
    
    for($i=0;$i<count($ath['bks']);$i++) {
        //$j++;
        //$id = $j;
        $book = $ath['bks'][$i];
        $rbook = $ath['rbks'][$i];
        $book_address = "book:" . ($i+1);
        mysqli_select_db($con,"allekokc_index");
        $_tbl = "tbl" . $ath['id'] . "_" . ($i+1);
        $q = mysqli_query($con,"select * from " . $_tbl);
        
        while($res=mysqli_fetch_assoc($q)) {
            //$p++;
            //$res['pid'] = $p;
            $res['rname'] = $res['name'];
            $res['name'] = san_data($res['name']);
            
            
            $res['rpoem'] = str_replace(["\n","\r"], [" &bull; ",""], preg_replace("/\n+\s+\n+/"," &bull; ",trim(mb_substr(filter_var($res['hon'], FILTER_SANITIZE_STRING), 0 , 150))));
            
            
            //$res['hon'] = str_replace($kurdish_nums, "", $res['hon']);
            //$res['hon'] = str_replace($other_nums, "", $res['hon']);
            
            
            $res['hon'] = san_data($res['hon']);
            $res['hon_true'] = san_data($res['hon'], true);
            
            
            
            $res['hdesc'] = san_data($res['hdesc']);
            $res['address'] = "poem:" . $res['id'];
            
            $res['len'] = ( strlen($res['hon'])>strlen($res['hdesc']) ) ? strlen($res['hon']) : strlen($res['hdesc']);

            $poems[$res['id']] = $res;
        }
        

        mysqli_select_db($con,"allekokc_search");
        
        foreach($poems as $pm) {
            
            //$pid = $pm['id'];
            $pname = $pm['name'];
            $phon = $pm['hon'];
            $phon_true = $pm['hon_true'];
            $phdesc = $pm['hdesc'];
            $pa = $pm['address'];
            $rname = $pm['rname'];
            $phonlen = $pm['len'];
            $rpoem = $pm['rpoem'];
            
            // Cssssss
            
            //$Cs_address_for_search
            //$Cs_a_f_s = $poet_address.$book_address.$pa;
            //$Cs_key = array_search($Cs_a_f_s, $Cs_address)
            if($rname == $Cs[$Cs_key]['rname']) {
                $pm['Cs'] = $Cs[$Cs_key];
                //$Cs_num++;
                $Cs_key++;
            } else {
                $pm['Cs'] = array('imp'=>1,'C'=>0, 'Cipi'=>0);
            }
            //$Cs_key++;
            
            $imp = $pm['Cs']['imp'];
            $C = $pm['Cs']['C'];
            $Cipi = $pm['Cs']['Cipi'];
            
            $qq = "INSERT INTO `poems`(`name`,`hdesc`,`poet_address`,`book_address`,`poem_address`,`poem`,`rname`,`rbook`,`rtakh`,`imp`,`C`,`Cipi`,`len`,`poem_true`,`rpoem`) VALUES ('$pname','$phdesc','$poet_address','$book_address','$pa'," . '"' . $phon . '"' . ",'$rname','$rbook','$rtakh',$imp,$C,$Cipi,$phonlen,'$phon_true','$rpoem')";
            //echo $qq . "<br><br>";
            $q = mysqli_query($con, $qq);
            
            if($q) {
                //echo "true";
            } else {
                echo "bam " . $qq;
            }
            
        }
        $poems= array();
        
        //
    }
    
    
}

mysqli_close($con);
?>