<?php
/* No head,foot */
$no_head = isset($_GET['nohead']);
$no_foot = isset($_GET['nofoot']);

/** Default values **/
$title = SP("title") . ' - ' . SP("desc");
/* Page title <title> */

$desc = SP("desc");
/* Page description <meta name="description"> ,
   <meta property="og:title"> */

$keys = _KEYS;
/* Page keywords <meta name="keywords"> */

$t_desc = "";
/* Page description section -> "header h2" */

/*
 * URL structure:
 * https://allekok.com/poet:{$ath}/book:{$bk}/poem:{$id}
 * https://allekok.com/?ath={$ath}&bk={$bk}&id={$id}
 * https://allekok.com/?q={$q}
 */
$ath = @filter_var($_GET["ath"], FILTER_SANITIZE_NUMBER_INT);
$bk = @filter_var($_GET["bk"], FILTER_SANITIZE_NUMBER_INT);
$id = @filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$q = @filter_var($_GET["q"], FILTER_SANITIZE_STRING);

/** URL Processing **/

if ($ath and !$bk) {
    /*
     * https://allekok.com/?poet={$ath}
     * https://allekok.com/?ath={$ath}
     * poet.php page
     */
    
    $q = "SELECT id,takh,profname,name,hdesc,
bks,kind FROM auth WHERE id={$ath}";
    include("condb.php");
    
    if($row = mysqli_fetch_assoc($query)) {
        mysqli_close($conn);
        
        $title = _TITLE . " &rsaquo; " . $row["profname"];        
        $desc = "شێعرەکانی " . $row['profname'];
        $keys = "{$row["takh"]},{$row["profname"]},{$row["name"]},"
	      . "شاعیر,شێعر,شعر";
        
        include("header.php");
        include("poet.php"); 
    }
    else
        include("not-found.php");
}
elseif ($ath and $bk and !$id) {
    /*
     * https://allekok.com/poet:{$ath}/book:{$bk}
     * https://allekok.com/?ath={$ath}&bk={$bk}
     * book.php page
     */

    /* Sort poems by name or id(default) */
    $_ordasc = @($_POST['order']=='asc') ? "`name`" : "`id`";
    $q = "SELECT id,takh,profname,name,bks,bksdesc
,bks_completion,kind FROM auth WHERE id=$ath";    
    include("condb.php");
    
    if($info = mysqli_fetch_assoc($query)) {
        
        $_tbl = "tbl{$ath}_{$bk}";
        $q = "SELECT id,name FROM $_tbl ORDER BY $_ordasc ASC";
        if($query = mysqli_query($conn, $q)) {
            
            $bknow = explode(",",$info["bks"]);
	    
            $title = _TITLE . " &rsaquo; {$info["profname"]} &rsaquo; {$bknow[$bk-1]}";
            $desc = "کتێبی " . $bknow[$bk-1] . "، " . $info["profname"];
            $keys = "{$bknow[$bk-1]},{$info["takh"]},{$info["profname"]},{$info["name"]},"
		  . "بەرهەم,شێعر,شعر,شیعر";
            
            include("header.php");
            include("book.php");
        }
	else
            include("not-found.php");
	
	mysqli_close($conn);
    } else {
	$fbody = true;
        $t_desc = "<h2>"._DESC."</h2>";
        include("header.php");
        include("fbody.php");
    }
}
elseif ($ath and $bk and $id) {
    /*
     * https://allekok.com/poet:{$ath}/book:{$bk}/poem:{$id}
     * https://allekok.com/?ath={$ath}&bk={$bk}&id={$id}
     * poem.php page
     */
    
    $q = "SELECT id,takh,profname,name,bks,kind FROM auth WHERE id=$ath";
    include("condb.php");
    
    if($info = mysqli_fetch_assoc($query)) {
        
	$bknow = explode(',',$info['bks']);

        $_tbl = "tbl{$ath}_{$bk}";
        $q = "SELECT * FROM $_tbl";

        if($query = mysqli_query($conn,$q)) {
	    
            $_msqnr = mysqli_num_rows($query);

            $_ids = [$id-1 , $id , $id+1];
            $q = "SELECT * FROM $_tbl WHERE id BETWEEN 
{$_ids[0]} AND {$_ids[2]}";
            $query = mysqli_query($conn,$q);
            
            if(mysqli_num_rows($query)>0 and
		($id != 0 and $id <= $_msqnr)) {
                $_e=0;
                while($rw = mysqli_fetch_assoc($query)) {
                    $row[$_e] = $rw;
                    $_e++;
                }
                mysqli_close($conn);
                if(count($row)==2) {
                    if($row[1]['id'] != $_msqnr)
                        $row = [0,$row[0],$row[1]];
                    elseif($row[1]['id']==$_msqnr and
			$_msqnr==2 and $id==1) 
                    $row = [0, $row[0], $row[1]];
                    else 
                        $row = [$row[0],$row[1],0];
		    
                }
		elseif(count($row)==1)
                    $row = [0,$row[0],0];
                

                $title = _TITLE . " &rsaquo; "
		       . "{$info["profname"]} &rsaquo; {$bknow[$bk-1]} &rsaquo; {$row[1]["name"]}";
                $desc = "شێعری " . $row[1]["name"] . "، " . $info["profname"];
                $keys = "{$row[1]["name"]},{$bknow[$bk-1]},{$info["takh"]},{$info["profname"]},{$info["name"]},"
		      . "شێعر,شعر";
                
                include("header.php");
                include("poem.php");
            }
	    else
                include("not-found.php");

        } else {
	    $fbody = true;
            $t_desc = "<h2>"._DESC."</h2>";
            include("header.php");
            include("fbody.php");
        }
    } else {
	$fbody = true;
        $t_desc = "<h2>"._DESC."</h2>";
        include("header.php");
        include("fbody.php");
    }

} elseif($q) {
    /*
     * https://allekok.com/?q={$q}
     * search.php page
     */
    
    $is_it_search = 1;
    $title = _TITLE . " &rsaquo; گەڕان: " . $q;
    $desc = "گەڕان بۆ " . $q . " لە ئاڵەکۆک دا";
    $keys = "$q," . "ئاڵەکۆک,شێعر,شعر";
    
    include("header.php");
    include("search.php");
    
} else {
    $fbody = true;
    $t_desc = "<h2>"._DESC."</h2>";
    include("header.php");
    include("fbody.php");
}
/** End of URL processing **/
?>
