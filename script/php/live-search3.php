<?php

require_once('constants.php');
require_once('functions.php');


	$res_poet = "<div class='search-poet' id='poets'><h3 id='bhon'>شاعیر</h3>";
	$res_book = "<div class='search-book'><h3 id='bhon'>کتێب و بەرهەم</h3>";
	$res_hon = "<div class='search-hon'><h3 id='bhon'>شێعر</h3>";
	$q_sp = $_REQUEST['q'];
	$q1 = san_data($q_sp);
	
if(!empty($q1)) {
    
    $qlen = strlen($q1);
    $q2 = san_data($q_sp,true);
	$_selPT = filter_var($_GET['selPT'], FILTER_SANITIZE_STRING);
	
	$r_max = $_GET['pt'];
    $e_max = $_GET['bk'];
    $h_max = $_GET['pm'];
    
    $_k = $_GET['k'];  // 1 => poem-name, 2 => poem, 3 => poem-name + poem 
	
	$db = 'search';
	$q = "SELECT id,name,takh,profname,hdesc,uri,rtakh FROM poets where len>{$qlen} order by rtakh ASC";
	require("condb.php");


if($r_max !== 0) {
    $r = 0;
    $r_max = !(filter_var($_GET['pt'], FILTER_VALIDATE_INT)===false) ? $_GET['pt'] : 5;
    
    if($_selPT == "") {
$s_poet = array();

	while($res = mysqli_fetch_assoc($query)) {
	    $s_poet[] = $res;
	}
	
	for($i=0; $i<count($s_poet); $i++) {
	    if($r<$r_max) {
	        $res = $s_poet[$i];
	        
		    $s_poet_takh=$res['takh'];
        	
    		if(stristr($s_poet_takh,$q1)) {
    		    
    		    $s_poet[$i]['f'] = 1;
    		    
    			$res_poet1 .= "<section>";
    			$res_poet1 .= "<a href='/".$res['uri'] ."'>";
    			
    			$imgsrc = "/style/img/poets/profile/profile_".$res['id'].".jpg";
                if(! file_exists("../..".$imgsrc)) {
                    $imgsrc = "/style/img/poets/profile/profile_0.jpg";
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
	
	if($r<$r_max) {
    	for($i=0; $i<count($s_poet); $i++) {
    	    if($r<$r_max) {
    	        $res = $s_poet[$i];
    	        
    		    $s_poet_name=$res['name'];
    		    
    		    $s_poet_prof=$res['profname'];
    		    
    		    $s_poet_hdesc=$res['hdesc'];
            
        		if((stristr($s_poet_name,$q1) || stristr($s_poet_prof,$q1) || stristr($s_poet_hdesc,$q1)) && !$res['f']) {
        		    $s_poet[$i]['f'] = 1;
        		    
        			$res_poet1 .= "<section>";
        			$res_poet1 .= "<a href='/".$res['uri'] ."'>";
        			
        			$imgsrc = "/style/img/poets/profile/profile_".$res['id'].".jpg";
                    if(! file_exists("../..".$imgsrc)) {
                        $imgsrc = "/style/img/poets/profile/profile_0.jpg";
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
	if($r<$r_max) {
	    for($i=0; $i<count($s_poet); $i++) {
    	    if($r<$r_max) {
    	        $res = $s_poet[$i];
    	        
    	        $s_poet_takh=san_data($res['takh'],true);
    	        
    		    $s_poet_name=san_data($res['name'],true);
    		    
    		    $s_poet_prof=san_data($res['profname'],true);
    		    
    		    $s_poet_hdesc=san_data($res['hdesc'],true);
    		    
            
        		if((@stristr($s_poet_takh,$q2) || @stristr($s_poet_name,$q2) || @stristr($s_poet_prof,$q2) || @stristr($s_poet_hdesc,$q2)) && !$res['f']) {
        			$res_poet1 .= "<section>";
        			$res_poet1 .= "<a href='/".$res['uri'] ."'>";
        			
        			$imgsrc = "/style/img/poets/profile/profile_".$res['id'].".jpg";
                    if(! file_exists("../..".$imgsrc)) {
                        $imgsrc = "/style/img/poets/profile/profile_0.jpg";
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
 }

}
	if(!empty($res_poet1)) {
	    $res_poet .= $res_poet1 . "</div>";
	} else {
	    $res_poet = "";
	}
	
if($e_max !== 0) {
    $e = 0;
    $e_max = !(filter_var($_GET['bk'], FILTER_VALIDATE_INT)===false) ? $_GET['bk'] : 10;

	$q = ($_selPT == "") ? "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>{$qlen} order by rtakh ASC" : "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>{$qlen} and rtakh='{$_selPT}' order by rtakh ASC";
	$query = mysqli_query($conn,$q);
	
	$s_book = array();

	while($res=mysqli_fetch_assoc($query)) {
	    $s_book[] = $res;
	}
	
	for($i=0; $i<count($s_book); $i++) {
	    if($e<$e_max) {
	        $res = $s_book[$i];
	        
		    $s_bk = $res['book'];

			if(stristr($s_bk,$q1)) {
			    
			    $s_book[$i]['f'] = 1;
			    
				$res_book1 .= "<a href='/" . $res['poet_address'] ."/" . $res['book_address'] . "'><i>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a>";
				$e++;
			}
		
		} else {
		    break;
		}
	}
	
if($e<$e_max) {
    for($i=0; $i<count($s_book); $i++) {
	    if($e<$e_max) {
	        $res = $s_book[$i];
	        
		    $s_bk_desc = $res['book_desc'];

			if( !$res['f'] && stristr($s_bk_desc,$q1) ) {
			    
			    $s_book[$i]['f'] = 1;
			    
				$res_book1 .= "<a href='/". $res['poet_address'] ."/" . $res['book_address'] . "'><i>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a>";
				$e++;
			}
		
		} else {
		    break;
		}
	}
}
if($e<$e_max) {
    for($i=0; $i<count($s_book); $i++) {
	    if($e<$e_max) {
	        $res = $s_book[$i];
	        
	        $s_bk = san_data($res['book'], true);
		    $s_bk_desc = san_data($res['book_desc'],true);

			if( !$res['f'] && (@stristr($s_bk,$q2) || @stristr($s_bk_desc,$q2)) ) {
			    
				$res_book1 .= "<a href='/". $res['poet_address'] ."/" . $res['book_address'] . "'><i>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a>";
				$e++;
			}
		
		} else {
		    break;
		}
	}
}

}
	
	if(!empty($res_book1)) {
	    $res_book .= $res_book1 . "</div>";
	} else {
	    $res_book = "";
	}
	
if($h_max !== 0) {
    $h = 0;
    $h_max = !(filter_var($_GET['pm'], FILTER_VALIDATE_INT)===false) ? $_GET['pm'] : 15;

	        $q = ($_selPT == "") ? "SELECT name,hdesc,poet_address,book_address,poem_address,poem,poem_true,rbook,rname,rtakh,rpoem FROM poems where len>{$qlen} ORDER BY Cipi DESC" : "SELECT name,hdesc,poet_address,book_address,poem_address,poem,poem_true,rbook,rname,rtakh,rpoem FROM poems where len>{$qlen} and rtakh='{$_selPT}' ORDER BY Cipi DESC";
	        $query = mysqli_query($conn,$q);

$s_poem = array();
	        
	        while($res=mysqli_fetch_assoc($query)) {
	            $s_poem[] = $res;
	        }
	        
	        $res_Cipi = array();
	        $rCn = 0;
	        
	 if($_k !== "2") {
	        for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<$h_max) {

                	$s_name = $res['name'];

                	
	                if(stristr($s_name,$q1)) {
	                    
	                    $s_poem[$i]['f'] = 1;
	                    
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    
	                    $res_hon1 .= "<a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>" . $res['rtakh'] . "</i> &rsaquo; "."<i>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "<i style='text-indent:1em;display:block'>{$res['rpoem']}...</i></a>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }
	 }

	   if($h<$h_max) {
	     if($_k !== "1") {
	       for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<$h_max) {

                	$s_hon = $res['poem'];
                	
                	$s_hon_desc = $res['hdesc'];
                	
                	
	                if((stristr($s_hon,$q1) or stristr($s_hon_desc,$q1)) && !$res['f']) {
	                    
	                    $s_poem[$i]['f'] = 1;
	                    
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    
	                    $res_hon2 .= "<a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>" . $res['rtakh'] . "</i> &rsaquo; "."<i>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "<i style='text-indent:1em;display:block'>{$res['rpoem']}...</i></a>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }
	   }
    }
    
    if($h<$h_max) {
	     if($_k !== "2") {
	       for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<$h_max) {

                	$s_name = san_data($res['name'],true);
                	
                	
	                if(stristr($s_name,$q2) && !$res['f']) {
	                    $s_poem[$i]['f'] = 1;
	                    
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    
	                    $res_hon1 .= "<a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>" . $res['rtakh'] . "</i> &rsaquo; "."<i>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "<i style='text-indent:1em;display:block'>{$res['rpoem']}...</i></a>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }
	   }
    }
    
    if($h<$h_max) {
	     if($_k !== "1") {
	       for($i=0; $i<count($s_poem); $i++) {
	            $res = $s_poem[$i];
	            
	             if($h<$h_max) {

                	$s_hon = $res['poem_true'];
                	
                	$s_hon_desc = san_data($res['hdesc'], true);
                	
                	
	                if((stristr($s_hon,$q2) or stristr($s_hon_desc,$q2)) && !$res['f']) {
	                    
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    
	                    $res_hon2 .= "<a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>" . $res['rtakh'] . "</i> &rsaquo; "."<i>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "<i style='text-indent:1em;display:block'>{$res['rpoem']}...</i></a>";
	                    $h++;
	                }

	            } else {
	                break;
	            }
	        }
	   }
    }
}
	   
	   mysqli_close($conn);
	   
	   if(!empty($res_hon2)) {
	       $res_hon1 .= "<h3 class='bhoh-newdaq'>گەڕانی نێو دەق: </h3>" . $res_hon2;
	   }
	    
	if(!empty($res_hon1)) {
	    $res_hon .= $res_hon1;
	} else {
	    $res_hon .= "<h3 class='search-notfound'>هیچ شێعرێکم بۆ نەدۆزرایەوە</h3>";
	}
	
	$res_hon .= "</div>";
	
	$result = $res_poet . $res_book . $res_hon;
	
	echo $result;

} else {
    echo " ... ";
}

?>