<?php

require_once('../../constants.php');
require_once(ABSPATH . 'script/php/functions.php');

header("Content-type:application/json; charset=UTF-8");
$null = json_encode(null);


$res_poet = [];
$res_book = [];
$res_hon = [];
$q_sp = $_REQUEST['q'];
$q1 = san_data($q_sp);

if(!empty($q1)) {
    
    $qlen = strlen($q1);
    $q2 = san_data($q_sp,true);
    $_selPT = filter_var($_GET['poet'], FILTER_SANITIZE_STRING);
    
    $r_max = $_GET['pt'];
    $e_max = $_GET['bk'];
    $h_max = $_GET['pm'];
    
    $_k = $_GET['k'];  // 1 => poem-name, 2 => poem, 3 => poem-name + poem 
    
    $db = 'search';
    $q = "SELECT id,name,takh,profname,hdesc,uri,rtakh FROM poets where len>={$qlen} order by rtakh ASC";
    require("../../script/php/condb.php");


    if($r_max !== 0) {
	$r = 0;
	$r_max = !(filter_var($_GET['pt'], FILTER_VALIDATE_INT)===false) ? $_GET['pt'] : 5;
	
	if($_selPT == "") {
	    $s_poet = array();

	    while($res = mysqli_fetch_assoc($query)) {
		$s_poet[] = $res;
	    }
	    
	    $res_poet1 = $res_poet2 = $res_poet3 = [];
	    
	    for($i=0; $i<count($s_poet); $i++) {
		if($r<$r_max) {
	            $res = $s_poet[$i];
	            
		    $s_poet_takh=$res['takh'];
        	    
    		    if(stristr($s_poet_takh,$q1)) {
    			
    			$s_poet[$i]['f'] = 1;

			$res['id'] = intval($res['id']);
    			$res['takh'] = $res['rtakh'];
			unset($res['name'], $res['profname'], $res['hdesc'], $res['rtakh']);
			
    			$res_poet1[] = $res;
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
        		    
        		    $res['id'] = intval($res['id']);
        		    $res['takh'] = $res['rtakh'];
			    unset($res['name'], $res['profname'], $res['hdesc'], $res['rtakh']);
			    
    			    $res_poet2[] = $res;
    			    
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
    			
			
        		if((stristr($s_poet_takh,$q2) || stristr($s_poet_name,$q2) || stristr($s_poet_prof,$q2) || stristr($s_poet_hdesc,$q2)) && !$res['f']) {
        		    
        		    $res['id'] = intval($res['id']);
        		    $res['takh'] = $res['rtakh'];
			    unset($res['name'], $res['profname'], $res['hdesc'], $res['rtakh']);
			    
    			    $res_poet3[] = $res;
        		    $r++;
        		} 
    			
    		    } else {
    			break;
    		    }
    		}
	    }
	}

    }
    
    $res_poet = [
	"meta" => $res_poet1,
	"context" => $res_poet2,
	"lastChance" => $res_poet3,
    ];
    
    if($e_max !== 0) {
	$e = 0;
	$e_max = !(filter_var($_GET['bk'], FILTER_VALIDATE_INT)===false) ? $_GET['bk'] : 10;

	$q = ($_selPT == "") ? "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>={$qlen} order by rtakh ASC" : "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>={$qlen} and rtakh='{$_selPT}' order by rtakh ASC";
	$query = mysqli_query($conn,$q);
	
	$s_book = array();

	while($res=mysqli_fetch_assoc($query)) {
	    $s_book[] = $res;
	}
	
	$res_book1 = $res_book2 = $res_book3 = [];
	
	for($i=0; $i<count($s_book); $i++) {
	    if($e<$e_max) {
	        $res = $s_book[$i];
	        
		$s_bk = $res['book'];

		if(stristr($s_bk,$q1)) {
		    
		    $s_book[$i]['f'] = 1;
		    
		    
		    $res['poet'] = $res['rtakh'];
		    $res['book'] = $res['rbook'];
		    $res['poet_id'] = intval(substr($res['poet_address'],5));
		    $res['book_id'] = intval(substr($res['book_address'],5));
		    $res['address'] = "{$res['poet_address']}/{$res['book_address']}";
		    unset($res['book_desc'], $res['poet_address'], $res['book_address'], $res['rtakh'], $res['rbook']);
		    
		    $res_book1[] = $res;
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
			
			
			$res['poet'] = $res['rtakh'];
			$res['book'] = $res['rbook'];
			$res['poet_id'] = intval(substr($res['poet_address'],5));
			$res['book_id'] = intval(substr($res['book_address'],5));
			$res['address'] = "{$res['poet_address']}/{$res['book_address']}";
			unset($res['book_desc'], $res['poet_address'], $res['book_address'], $res['rtakh'], $res['rbook']);
			
			$res_book2[] = $res;
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

		    if( !$res['f'] && (stristr($s_bk,$q2) || stristr($s_bk_desc,$q2)) ) {
			
			
			$res['poet'] = $res['rtakh'];
			$res['book'] = $res['rbook'];
			$res['poet_id'] = intval(substr($res['poet_address'],5));
			$res['book_id'] = intval(substr($res['book_address'],5));
			$res['address'] = "{$res['poet_address']}/{$res['book_address']}";
			unset($res['book_desc'], $res['poet_address'], $res['book_address'], $res['rtakh'], $res['rbook']);
			
			$res_book3[] = $res;
			$e++;
		    }
		    
		} else {
		    break;
		}
	    }
	}

    }
    
    $res_book = [
	"meta" => $res_book1,
	"context" => $res_book2,
	"lastChance" => $res_book3,
    ];
    
    if($h_max !== 0) {
	$h = 0;
	$h_max = !(filter_var($_GET['pm'], FILTER_VALIDATE_INT)===false) ? $_GET['pm'] : 15;

	$q = ($_selPT == "") ? "SELECT name,hdesc,poet_address,book_address,poem_address,poem,poem_true,rbook,rname,rtakh FROM poems where len>={$qlen} ORDER BY Cipi DESC" : "SELECT name,hdesc,poet_address,book_address,poem_address,poem,poem_true,rbook,rname,rtakh FROM poems where len>={$qlen} and rtakh='{$_selPT}' ORDER BY Cipi DESC";
	$query = mysqli_query($conn,$q);

        $s_poem = array();
	
	while($res=mysqli_fetch_assoc($query)) {
	    $s_poem[] = $res;
	}
	
	$res_Cipi = array();
	$rCn = 0;
	
	$res_hon1_1 = $res_hon1_2 = $res_hon2_1 = $res_hon2_2 = [];
	
	if($_k !== "2") {
	    for($i=0; $i<count($s_poem); $i++) {
	        $res = $s_poem[$i];
	        
	        if($h<$h_max) {

                    $s_name = $res['name'];

                    
	            if(stristr($s_name,$q1)) {
	                
	                $s_poem[$i]['f'] = 1;
	                
	                $res['summary'] = $res['rpoem'];
	                $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                $res['poet'] = $res['rtakh'];
	                $res['book'] = $res['rbook'];
	                $res['name'] = $res['rname'];
	                $res['poet_id'] = intval(substr($res['poet_address'],5));
			$res['book_id'] = intval(substr($res['book_address'],5));
			$res['poem_id'] = intval(substr($res['poem_address'],5));
			
	                unset($res['hdesc'], $res['poet_address'], $res['book_address'], $res['poem_address'], $res['poem'], $res['poem_true'], $res['rtakh'], $res['rbook'], $res['rname'], $res['rpoem']);
	                $res['address'] = $pbp_uri;
	                $res_hon1_1[] = $res;
	                
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
	                    
	                    $res['summary'] = $res['rpoem'];
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    $res['poet'] = $res['rtakh'];
	                    $res['book'] = $res['rbook'];
	                    $res['name'] = $res['rname'];
	                    $res['poet_id'] = intval(substr($res['poet_address'],5));
			    $res['book_id'] = intval(substr($res['book_address'],5));
			    $res['poem_id'] = intval(substr($res['poem_address'],5));
			    
	                    unset($res['hdesc'], $res['poet_address'], $res['book_address'], $res['poem_address'], $res['poem'], $res['poem_true'], $res['rtakh'], $res['rbook'], $res['rname'], $res['rpoem']);
	                    $res['address'] = $pbp_uri;
	                    $res_hon2_1[] = $res;
	                    
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
	                    
	                    $res['summary'] = $res['rpoem'];
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    $res['poet'] = $res['rtakh'];
	                    $res['book'] = $res['rbook'];
	                    $res['name'] = $res['rname'];
	                    $res['poet_id'] = intval(substr($res['poet_address'],5));
			    $res['book_id'] = intval(substr($res['book_address'],5));
			    $res['poem_id'] = intval(substr($res['poem_address'],5));
			    
	                    unset($res['hdesc'], $res['poet_address'], $res['book_address'], $res['poem_address'], $res['poem'], $res['poem_true'], $res['rtakh'], $res['rbook'], $res['rname'], $res['rpoem']);
	                    $res['address'] = $pbp_uri;
	                    $res_hon1_2[] = $res;
	                    
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
	                    
	                    $res['summary'] = $res['rpoem'];
	                    $pbp_uri = $res['poet_address'] ."/" . $res['book_address'] . "/" . $res['poem_address'];
	                    $res['poet'] = $res['rtakh'];
	                    $res['book'] = $res['rbook'];
	                    $res['name'] = $res['rname'];
	                    $res['poet_id'] = intval(substr($res['poet_address'],5));
			    $res['book_id'] = intval(substr($res['book_address'],5));
			    $res['poem_id'] = intval(substr($res['poem_address'],5));
			    
	                    unset($res['hdesc'], $res['poet_address'], $res['book_address'], $res['poem_address'], $res['poem'], $res['poem_true'], $res['rtakh'], $res['rbook'], $res['rname'], $res['rpoem']);
	                    $res['address'] = $pbp_uri;
	                    $res_hon2_2[] = $res;
	                    
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
    
    $res_hon = [
	"firstChance" => [
	    "meta" => $res_hon1_1,
	    "context" => $res_hon2_1,
	],
	"lastChance" => [
	    "meta" => $res_hon1_2,
	    "context" => $res_hon2_2,
	],
    ];
    

    $result = [
	"poets" => $res_poet,
	"books" => $res_book, 
	"poems" => $res_hon,
    ];
    
    echo json_encode($result);

} else {
    echo $null;
}

?>
