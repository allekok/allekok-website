<?php
require_once("../../constants.php");
require_once("../../functions.php");

header("Content-type: text/html; charset=UTF-8");

$db = "index";
$q = "select * from auth";
require("../../condb.php");

$aths_num = mysqli_num_rows($query);
echo "poets: " . $aths_num;

while($res=mysqli_fetch_assoc($query)) {
    
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

// first save imp, C, Cipi cloumns.

mysqli_select_db($conn,"allekokc_search");

$C_query = mysqli_query($conn, "select * From poems");

$Cs = [];

while($C_res = mysqli_fetch_assoc($C_query)) {
    $Cs[] = array('rname'=>$C_res['rname'], 'imp'=>$C_res['imp'], 'C'=>$C_res['C'], 'Cipi'=>$C_res['Cipi']);
}

// remove poems table.
mysqli_query($conn,"TRUNCATE TABLE poems");

$kurdish_nums = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹','۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
$other_nums = array('0','1','2','3','4','5','6','7','8','9','٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
$Cs_key = 0;
foreach($aths as $ath) {

    $rtakh = $ath['rtakh'];
    $poet_takh = $ath['takh'];
    $poet_address = $ath['address'];
    
    for($i=0;$i<count($ath['bks']);$i++) {

        $book = $ath['bks'][$i];
        $rbook = $ath['rbks'][$i];
        $book_address = "book:" . ($i+1);
        mysqli_select_db($conn,"allekokc_index");
        $_tbl = "tbl" . $ath['id'] . "_" . ($i+1);
        $q = mysqli_query($conn,"select * from " . $_tbl);
        
        while($res=mysqli_fetch_assoc($q)) {

            $res['rname'] = $res['name'];
            $res['name'] = san_data($res['name']);
            
            
            // $res['rpoem'] = str_replace(["\n","\r"], [" &bull; ",""], preg_replace("/\n+\s+\n+/"," &bull; ",trim(mb_substr(filter_var($res['hon'], FILTER_SANITIZE_STRING), 0 , 150))));
            
            
            
            $res['hon_true'] = san_data($res['hon'], true);
            $res['hon'] = san_data($res['hon']);
            
            
            $res['hdesc'] = san_data($res['hdesc']);
            $res['address'] = "poem:" . $res['id'];
            
            $res['len'] = ( strlen($res['hon'])>strlen($res['hdesc']) ) ? strlen($res['hon']) : strlen($res['hdesc']);

            $poems[$res['id']] = $res;
        }
        

        mysqli_select_db($conn,"allekokc_search");
        
        foreach($poems as $pm) {
            
            //$pid = $pm['id'];
            $pname = $pm['name'];
            $phon = $pm['hon'];
            $phon_true = $pm['hon_true'];
            $phdesc = $pm['hdesc'];
            $pa = $pm['address'];
            $rname = $pm['rname'];
            $phonlen = $pm['len'];
            // $rpoem = $pm['rpoem'];
            
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
            
            $qq = "INSERT INTO `poems`(`name`,`hdesc`,`poet_address`,`book_address`,`poem_address`,`poem`,`rname`,`rbook`,`rtakh`,`imp`,`C`,`Cipi`,`len`,`poem_true`) VALUES ('$pname','$phdesc','$poet_address','$book_address','$pa'," . '"' . $phon . '"' . ",'$rname','$rbook','$rtakh',$imp,$C,$Cipi,$phonlen,'$phon_true')";
            //echo $qq . "<br><br>";
            $q = mysqli_query($conn, $qq);
            
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

mysqli_close($conn);

$now = date("Y-m-d H:i:s");
file_put_contents(ABSPATH . "last-update.txt", $now);
?>
