<?php
$timer = microtime(true);

include_once('constants.php');
include_once('functions.php');

$res_poet = "<div class='search-poet' id='poets'><h3 id='bhon'>شاعیر</h3>";
$res_book = "<div class='search-book'><h3 id='bhon'>کتێب و بەرهەم</h3>";
$res_hon = "<div class='search-hon'><h3 id='bhon'>شێعر</h3>";
$null = "<p style='text-align:center'>...</p>";

$q_sp = isset($_REQUEST['q']) ? $_REQUEST['q'] : die($null);
$q_sanitized = san_data($q_sp);

if(empty($q_sanitized)) {
    $timer = microtime(true) - $timer;
    // echo "<div style='position:fixed;top:0;left:0;'>" .
    // number_format($timer, 3) . "s</div>";
    die($null);
}

$qlen = strlen($q_sanitized);

$selected_poet = isset($_GET['selPT']) ?
		 filter_var($_GET['selPT'], FILTER_SANITIZE_STRING) : "";
$poets_max = isset($_GET['pt']) ? intval($_GET['pt']) : 4;
$books_max = isset($_GET['bk']) ? intval($_GET['bk']) : 4;
$poems_max = isset($_GET['pm']) ? intval($_GET['pm']) : 7;
$poem_search_kind = isset($_GET['k']) ? intval($_GET['k']) : 3;
/* k : [ 1 => poem-name, 2 => poem-context, 3 => both 1,2 ] */

$db = 'search';
$q = "SELECT id,name,takh,profname,hdesc,rtakh FROM 
poets where len>={$qlen} order by rtakh ASC";
require('condb.php');

if($poets_max !== 0) {
    $n = 0;
    
    if($selected_poet == "") {
	$s_poet = [];

	while($res = mysqli_fetch_assoc($query)) {
	    $s_poet[] = $res;
	}
	$res_poet1 = "";
	
	for($i=0; $i<count($s_poet); $i++) {
	    if($n<$poets_max) {
	        $res = $s_poet[$i];
	        
    		if(stristr($res['takh'],$q_sanitized) ||
		   stristr($res['profname'],$q_sanitized)) {
    		    
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
    		    $n++;
    		} 
		
	    } else {
		break;
	    }
	}
	
	if($n<$poets_max) {
    	    for($i=0; $i<count($s_poet); $i++) {
    		if($n<$poets_max) {
    		    $res = $s_poet[$i];
		    
        	    if((stristr($res['name'],$q_sanitized) ||
			stristr($res['hdesc'],$q_sanitized)) && !@$res['f']) {
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
        		$n++;
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

if($books_max !== 0) {
    $n = 0;

    $q = ($selected_poet == "") ? "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>={$qlen} order by rtakh ASC" : "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>={$qlen} and rtakh='{$selected_poet}' order by rtakh ASC";
    $query = mysqli_query($conn,$q);
    
    $s_book = array();

    while($res=mysqli_fetch_assoc($query)) {
	$s_book[] = $res;
    }
    $res_book1 = "";
    
    for($i=0; $i<count($s_book); $i++) {
	if($n<$books_max) {
	    $res = $s_book[$i];
	    
	    if(stristr($res['book'],$q_sanitized)) {
		
		$s_book[$i]['f'] = 1;
		
		$res_book1 .= "<a href='/" . $res['poet_address'] ."/" . $res['book_address'] . "'><i>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a>";
		$n++;
	    }
	    
	} else {
	    break;
	}
    }
    
    if($n<$books_max) {
	for($i=0; $i<count($s_book); $i++) {
	    if($n<$books_max) {
	        $res = $s_book[$i];
	        
		if( !@$res['f'] && stristr($res['book_desc'],$q_sanitized) ) {
		    
		    $s_book[$i]['f'] = 1;
		    
		    $res_book1 .= "<a href='/". $res['poet_address'] ."/" . $res['book_address'] . "'><i>" . $res['rtakh'] . "</i> &rsaquo; " . $res['rbook'] . "</a>";
		    $n++;
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

if($poems_max !== 0) {
    $n = 0;

    $q = ($selected_poet == "") ? "SELECT name,hdesc,poet_address,book_address,poem_address,poem,rbook,rname,rtakh FROM poems where len>={$qlen} ORDER BY Cipi DESC" : "SELECT name,hdesc,poet_address,book_address,poem_address,poem,rbook,rname,rtakh FROM poems where len>={$qlen} and rtakh='{$selected_poet}' ORDER BY Cipi DESC";
    $query = mysqli_query($conn,$q);

    $s_poem = array();
    
    while($res=mysqli_fetch_assoc($query)) {
	$s_poem[] = $res;
    }
    
    $res_hon1 = "";
    $res_Cipi = array();
    $rCn = 0;
    
    if($poem_search_kind !== "2") {
	for($i=0; $i<count($s_poem); $i++) {
	    $res = $s_poem[$i];
	    
	    if($n<$poems_max) {
                
	        if(stristr($res['name'],$q_sanitized)) {
		    
		    $s_poem[$i]['f'] = 1;
		    
		    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
		    
		    $res_hon1 .= "<div style='display:flex;'><button style='background:none;padding:0 .5em;'' onclick='ss(this)' type='button'><i class='material-icons' style='vertical-align:middle;font-size:1.5em;'>keyboard_arrow_down</i></button><a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>" . $res['rtakh'] . "</i> &rsaquo; "."<i>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "</a></div>";
		    $n++;
	        }

	    } else {
	        break;
	    }
	}
    }
    
    $res_hon2 = "";
    if($n<$poems_max) {
	if($poem_search_kind !== "1") {
	    for($i=0; $i<count($s_poem); $i++) {
	        $res = $s_poem[$i];
	        
	        if($n<$poems_max) {

		    if((stristr($res['poem'],$q_sanitized) or stristr($res['hdesc'],$q_sanitized)) && !@$res['f']) {
	                
	                $s_poem[$i]['f'] = 1;
	                
	                $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                
	                $res_hon2 .= "<div style='display:flex;'><button style='background:none;padding:0 .5em;'' onclick='ss(this)' type='button'><i class='material-icons' style='vertical-align:middle;font-size:1.5em;'>keyboard_arrow_down</i></button><a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>" . $res['rtakh'] . "</i> &rsaquo; "."<i>" . $res['rbook'] . "</i> &rsaquo; " . $res['rname'] . "</a></div>";
	                $n++;
		    }

	        } else {
		    break;
	        }
	    }
	}

    }
}

mysqli_close($conn);

if(!empty($res_hon2))
    $res_hon1 .= "<h3 class='bhoh-newdaq'>گەڕانی نێو دەق: </h3>" . $res_hon2;

if(!empty($res_hon1)) 
    $res_hon .= $res_hon1;
else 
    $res_hon .= "<h3 class='search-notfound'>هیچ شێعرێکم بۆ نەدۆزرایەوە</h3>";

$res_hon .= "</div>";

$result = $res_poet . $res_book . $res_hon;

echo $result;


$timer = microtime(true) - $timer;
// echo "<div style='position:fixed;top:0;left:0;'>" . number_format($timer, 3) . "s</div>";

?>
