<?php

require_once('constants.php');
require_once('functions.php');


if(mb_strlen($_REQUEST['q']) < 915 && mb_strlen($_REQUEST['q']) > 1) {

	$res_poet = "<div class='search-poet' id='poets'><h3 id='bhon'>شاعیر</h3>";
	$res_book = "<div class='search-book'><h3 id='bhon'>کتێب و بەرهەم</h3>";
	$res_hon = "<div class='search-hon'><h3 id='bhon'>شێعر</h3>";
	$q_sp = $_REQUEST['q'];
	$q1 = san_data($q_sp);
	
if(!empty($q1)) {
	
	$db = 'search';
	$q = "SELECT * FROM poets order by rtakh ASC";
	require("condb.php");

$r = 0;
$e = 0;
$h = 0;
$s_poet = array();

	while($res = mysqli_fetch_assoc($query)) {
	    $s_poet[] = $res;
	}
	
	for($i=0; $i<count($s_poet); $i++) {
	    if($r<5) {
	        $res = $s_poet[$i];
	        
		    $s_poet_takh=$res['takh'];
        	
    		if(stristr($s_poet_takh,$q1)) {
    		    
    		    $s_poet[$i]['f'] = 1;
    		    
    			$res_poet1 .= "<section>";
    			$res_poet1 .= "<a href='"._SITE . $res['uri'] ."'>";
    			
    			$imgsrc = "../../style/img/poets/profile/profile_".$res['id'].".jpg";
                if(! file_exists($imgsrc)) {
                    $imgsrc = "../../style/img/poets/profile/profile_0.jpg";
                }
                
    			$res_poet1 .= "<img src='$imgsrc'>";
    			$res_poet1 .= "<h3>" . $res['rtakh'] . "</h3>";
    			$res_poet1 .= "</a></section>";
    		$r++;
    		} 
		
		} else {
		    break;
		}
	}
	
	if($r<5) {
    	for($i=0; $i<count($s_poet); $i++) {
    	    if($r<5) {
    	        $res = $s_poet[$i];
    	        
    		    $s_poet_name=$res['name'];
    		    
    		    $s_poet_prof=$res['profname'];
    		    
    		    $s_poet_hdesc=$res['hdesc'];
            
        		if((stristr($s_poet_name,$q1) || stristr($s_poet_prof,$q1) || stristr($s_poet_hdesc,$q1)) && !$res['f']) {
        			$res_poet1 .= "<section>";
        			$res_poet1 .= "<a href='"._SITE . $res['uri'] ."'>";
        			
        			$imgsrc = "../../style/img/poets/profile/profile_".$res['id'].".jpg";
                    if(! file_exists($imgsrc)) {
                        $imgsrc = "../../style/img/poets/profile/profile_0.jpg";
                    }
                    
        			$res_poet1 .= "<img src='$imgsrc'>";
        			$res_poet1 .= "<h3>" . $res['rtakh'] . "</h3>";
        			$res_poet1 .= "</a></section>";
        		$r++;
        		} 
    		
    		} else {
    		    break;
    		}
    	}
	}

	if(!empty($res_poet1)) {
	    $res_poet .= $res_poet1 . "</div>";
	} else {
	    $res_poet = "";
	}

	$q = "select * from books order by rtakh ASC";
	$query = mysqli_query($conn,$q);
	
	$s_book = array();

	while($res=mysqli_fetch_assoc($query)) {
	    $s_book[] = $res;
	}
	
	for($i=0; $i<count($s_book); $i++) {
	    if($e<10) {
	        $res = $s_book[$i];
	        
		    $s_bk = $res['book'];

			if(stristr($s_bk,$q1)) {
			    
			    $s_book[$i]['f'] = 1;
			    
				$res_book1 .= "<p><a href='"._SITE . $res['poet_address'] ."/" . $res['book_address'] . "'><i style='font-size:0.8em;font-style:normal;'>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a></p>";
				$e++;
			}
		
		} else {
		    break;
		}
	}
	
if($e<10) {
    for($i=0; $i<count($s_book); $i++) {
	    if($e<10) {
	        $res = $s_book[$i];
	        
		    $s_bk_desc = $res['book_desc'];

			if( !$res['f'] && stristr($s_bk_desc,$q1) ) {
			    
				$res_book1 .= "<p><a href='"._SITE . $res['poet_address'] ."/" . $res['book_address'] . "'><i style='font-size:0.8em;font-style:normal;'>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a></p>";
				$e++;
			}
		
		} else {
		    break;
		}
	}
}
	
	if(!empty($res_book1)) {
	    $res_book .= $res_book1 . "</div>";
	} else {
	    $res_book = "";
	}

	        $q = "SELECT * FROM poems ORDER BY Cipi DESC";
	        $query = mysqli_query($conn,$q);

$s_poem = array();
	        
	        while($res=mysqli_fetch_assoc($query)) {
	            $s_poem[] = $res;
	        }
	        
	        $res_Cipi = array();
	        $rCn = 0;
	        
	        for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<15) {

                	$s_name = $res['name'];

                	
	                if(stristr($s_name,$q1)) {
	                    
	                    $s_poem[$i]['f'] = 1;
	                    
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    
	                    $res_hon1 .= "<p><a href='"._SITE."script/php/UpdateCipi.php?uri={$pbp_uri}'><i style='font-size:0.8em;font-style:normal;'>" . $res['rtakh'] . "</i> &rsaquo; "."<i style='font-size:0.8em;font-style:normal;'>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "</a></p>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }

	   if($h<15) {
	       for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<15) {

                	$s_hon = $res['poem'];
                	
                	$s_hon_desc = $res['hdesc'];
                	
                	
	                if((stristr($s_hon,$q1) or stristr($s_hon_desc,$q1)) && !$res['f']) {
	                    
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    
	                    $res_hon2 .= "<p><a href='"._SITE."script/php/UpdateCipi.php?uri={$pbp_uri}'><i style='font-size:0.8em;font-style:normal;'>" . $res['rtakh'] . "</i> &rsaquo; "."<i style='font-size:0.8em;font-style:normal;'>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "</a></p>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }
	   }
	   
	   mysqli_close($conn);
	   
	   if(!empty($res_hon2)) {
	       $res_hon1 .= "<h3 id='bhon' style='text-align:right;padding: 3px 10px 0;font-size: 0.46em;margin:0;background:none;border-bottom:0;'>گەڕانی نێو دەق: </h3>" . $res_hon2;
	   }
	    
	if(!empty($res_hon1)) {
	    $res_hon .= $res_hon1;
	    if($h==12) {
	    $search_more = "<a style='font-size:1em;' href='"._SITE."?q=". $q_sp ."'><h3 id='bhon' style='background-color:#fff;box-shadow: 0 5px 4px -6px #aaa;'>گەڕانی زۆرتر</h3></a>";
	    }
	} else {
	    $res_hon .= "<h3 style='font-size:0.6em;background: #efefef;border-radius: 60% 60% 0 0;box-shadow: 0 2px 5px -3px #aaa;border-top: 1px solid #e0e0e0;text-align:center;'>هیچ شێعرێکم بۆ نەدۆزرایەوە</h3>";
	}
	
	$res_hon .= "</div>";
	
	$result = $search_more . $res_poet . $res_book . $res_hon;
	
	echo $result;

} else {
    echo "";
}
} else {
    
    $search_more = "<a style='font-size:1em;' href='"._SITE."?q=". $_GET['q'] ."'><h3 id='bhon' style='background-color:#fff;box-shadow:0 0 3px #aaa;'>گەڕانی زۆرتر</h3></a>";
    
    echo $search_more . "<h3 style='font-size:0.6em;color:#444;background:rgba(204,51,0,0.1);border-radius: 60% 60% 0 0;box-shadow: 0 2px 5px -3px #aaa;border-top: 1px solid #e0e0e0;text-align:center;'>ژمارەی پیتەکان نابێ لە ۱۶۹ پیت زیاتر بێ.</h3>";
}

?>