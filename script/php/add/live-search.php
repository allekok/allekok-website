<?php

require_once('../colors.php');
require_once('../constants.php');
require_once('../functions.php');


if(!empty($_REQUEST['q']) && strlen($_REQUEST['q']) < 915) {
    //require_once("colors.php");
    
    require_once("../constants.php");
    require_once("../sanKuText.php");

	$res_poet = "<div class='search-poet' id='poets'><h3 id='bhon'>شاعیر</h3>";
	$res_book = "<div class='search-book'><h3 id='bhon'>کتێب و بەرهەم</h3>";
	$res_hon = "<div class='search-hon'><h3 id='bhon'>شێعر</h3>";
	$q1 = $_REQUEST['q'];
	$q_sp = $q1;
	
	$q1 = san_data($q1);
if(!empty($q1)) {
	
	$db = 'allekokc_search';
	$q = "SELECT * FROM poets";
	$conn = mysqli_connect(_HOST, _USER, _PASS);
    if (!$conn) {
        die("<span style='color:red;'>کێشەیەک هەیە! تکایە کاتێکی تر هەوڵ دە.</span>");
    }
    mysqli_set_charset($conn,"utf8");
    mysqli_select_db($conn,$db);
    $query = mysqli_query($conn,$q);

$r = 0;
$e = 0;
$h = 0;
$s_poet = array();
$s_p_num = 0;

	if(!empty($res_poet1)) {
	    $res_poet .= $res_poet1;
	    $res_poet .= "</div>";
	} else {
	    $res_poet = "";
	}

	$q = "select * from books";
	$query = mysqli_query($conn,$q);
	
	$s_book = array();
	$s_b_num = 0;
	
	
	if(!empty($res_book1)) {
	    $res_book .= $res_book1;
	    $res_book .= "</div>";
	} else {
	    $res_book = "";
	}

	        $q = "SELECT * FROM poems ORDER BY Cipi DESC";
	        $query = mysqli_query($conn,$q);

$s_poem = array();
$s_p_num = 0;
	        while($res=mysqli_fetch_assoc($query)) {
	            $s_poem[$s_p_num] = $res;
	            $s_p_num++;
	        }
	        
	        $res_Cipi = array();
	        $rCn = 0;
	        
	        for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<12) {
	               	//kurdi sazi
                	$s_name = $res['name'];

                	
	                if(stristr($s_name,$q1)) {
	                    
	                    $s_poem[$i]['f'] = 1;
	                    
	                    $s_poem[$i]['imp']++;
	                    $s_poem[$i]['Cipi'] = $s_poem[$i]['C'] / $s_poem[$i]['imp'];
	                    
	                    $res_Cipi[$rCn] = $s_poem[$i];
	                    
	                    $rCn++;
	                    //$C_id = $s_poem['id'];
	                    //$C_q = mysqli_query($conn, "UPDATE poems SET imp=$imp, Cipi=$Cipi WHERE id=$i//wrong because ORBERed BY Cipi");
	                    
	                    $pbp_uri = "script/php/add/add.php?db=tbl". substr($res['poet_address'], 5) ."&tbl=_" . substr($res['book_address'], 5) . "&row=" . substr($res['poem_address'], 5);
	                    
	                    $res_hon1 .= "<p><a href='"._SITE."{$pbp_uri}'><i style='font-size:0.8em;font-style:normal;'>" . $res['rtakh'] . "</i><i class='material-icons' style='vertical-align:middle;'>keyboard_arrow_left</i>"."<i style='font-size:0.8em;font-style:normal;'>" . $res['rbook'] . "</i><i class='material-icons' style='vertical-align:middle;'>keyboard_arrow_left</i> " . $res['rname'] . "</a></p>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }

	   if($h<12) {
	       for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<12) {

                	$s_hon = $res['poem'];
                	
                	$s_hon_desc = $res['hdesc'];
                	
                	$s_hon_keys = $res['keywords'];
                	
                	///triming
                	
                	
	                if((stristr($s_hon,$q1) or stristr($s_hon_keys,$q1) or stristr($s_hon_desc,$q1)) && !$res['f']) {
	                    
	                    $s_poem[$i]['imp']++;
	                    $s_poem[$i]['Cipi'] = $s_poem[$i]['C'] / $s_poem[$i]['imp'];
	                    
	                    $res_Cipi[$rCn] = $s_poem[$i];
	                    
	                    $rCn++;
	                    //$C_id = $s_poem['id'];
	                    //$C_q = mysqli_query($conn, "UPDATE poems SET imp=$imp, Cipi=$Cipi WHERE id=$i//wrong because ORBERed BY Cipi");
	                    
	                    $pbp_uri = "script/php/add/add.php?db=tbl". substr($res['poet_address'], 5) ."&tbl=_" . substr($res['book_address'], 5) . "&row=" . substr($res['poem_address'], 5);
	                    
	                    $res_hon2 .= "<p><a href='"._SITE."{$pbp_uri}'><i style='font-size:0.8em;font-style:normal;'>" . $res['rtakh'] . "</i><i class='material-icons' style='vertical-align:middle;'>keyboard_arrow_left</i>"."<i style='font-size:0.8em;font-style:normal;'>" . $res['rbook'] . "</i><i class='material-icons' style='vertical-align:middle;'>keyboard_arrow_left</i> " . $res['rname'] . "</a></p>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }
	   }
	   
	   //mysqli_close($conn);
	   if(!empty($res_hon2)) {
	       $res_hon1 .= "<h3 id='bhon' style='text-align:right;padding: 3px 10px 0;font-size: 0.46em;margin:0;background:none;border-bottom:0;'>گەڕانی نێو دەق: </h3>" . $res_hon2;
	   }
	    
	if(!empty($res_hon1)) {
	    $res_hon .= $res_hon1;
	    if($h==12) {
	    $search_more = "<a style='font-size:1em;' href='"._SITE."?q=". $q_sp ."'><h3 id='bhon' style='background-color:#fff;box-shadow:0 0 3px #aaa;'>گەڕانی زۆرتر</h3></a>";
	    }
	} else {
	    $res_hon .= "<h3 style='font-size:0.6em;background: #efefef;border-radius: 60% 60% 0 0;box-shadow: 0 2px 5px -3px #aaa;border-top: 1px solid #e0e0e0;text-align:center;'>هیچ شێعرێکم بۆ نەدۆزرایەوە</h3>";
	}
	
	$res_hon .= "</div>";
	
	
	
	
	$result = $search_more . $res_poet . $res_book . $res_hon;
	
$kurdish_nums = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
$other_nums = array('0','1','2','3','4','5','6','7','8','9');
	
$end = microtime(true)-$start;

$end = number_format($end,3);

$end = str_replace($other_nums,$kurdish_nums,$end);

//$end = substr($end,0,7);

//$endsec = "<h3 id='bhon'> {$end} چرکەی پێ چوو </h3>";
	
	echo $result . $endsec;
/**    
    if(count($res_Cipi)>0 && mb_strlen($_GET['q']) > 3) {
        foreach($res_Cipi as $rC) {
	       $q = "UPDATE poems SET `imp`=".$rC['imp'].", `Cipi`=".$rC['Cipi']. " WHERE poet_address='".$rC['poet_address']."' and book_address='".$rC['book_address']."' and poem_address='".$rC['poem_address']."'";
	       $query = mysqli_query($conn, $q);
	    }
	}
	**/
	   mysqli_close($conn);
    
} else {
    echo "";
}
} else {
    
    $search_more = "<a style='font-size:1em;' href='"._SITE."?q=". $_GET['q'] ."'><h3 id='bhon' style='background-color:#fff;box-shadow:0 0 3px #aaa;'>گەڕانی زۆرتر</h3></a>";
    
    echo $search_more . "<h3 style='font-size:0.6em;color:#444;background:rgba(204,51,0,0.1);border-radius: 60% 60% 0 0;box-shadow: 0 2px 5px -3px #aaa;border-top: 1px solid #e0e0e0;text-align:center;'>ژمارەی پیتەکان نابێ لە ۱۶۹ پیت زیاتر بێ.</h3>";
}

?>