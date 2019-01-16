<?php 

$db = 'index';

if ($ath!=null && $bk==null && $id==null) {
    // poet.php page
    
    $q = "SELECT id,takh,profname,hdesc,bks,kind FROM auth WHERE id={$ath}";
    
    require('condb.php');

    if(mysqli_num_rows($query)===1) {
        
        $row = mysqli_fetch_assoc($query);

        $title = "ئاڵەکۆک &raquo; " . $row['profname'];
        
        $desc = "شێعرەکانی " . $row['profname'];
        
        $keys = $row['takh'] . "," . $row['profname'] . "," . $row['name'] . "," . "شاعیر,شێعر,شعر";
    
        $color_num = color_num($ath);
        require('header.php');
        require('poet.php');
    } else {
        include("nf.php");
    }
    mysqli_close($conn);

} elseif ($ath!=null && $bk!=null && $id==null) {
    
    $_ordasc = ($_POST['order']=="asc") ? "`name`" : "`id`";
    

    $q = 'SELECT * FROM auth WHERE id=' . $ath;
    require('condb.php');
    if(mysqli_num_rows($query)===1) {
        $info = mysqli_fetch_assoc($query);

        $_tbl = "tbl".$ath."_".$bk;
        $q = "SELECT * FROM $_tbl ORDER BY {$_ordasc} ASC";

        $query = mysqli_query($conn, $q);
        if($query) {
            $bknow = explode(',',$info['bks']);
            $title = "ئاڵەکۆک &raquo; {$info['profname']} &raquo; " . $bknow[$bk-1];

            $desc = "کتێبی " . $bknow[$bk-1] . " " . $info['profname'];

            $keys = $bknow[$bk-1] . "," . $info['takh'] . "," . $info['profname'] . "," . $info['name'] . "," . "بەرهەم,شێعر,شعر,شیعر";

            $color_num = color_num($ath);
            require('header.php');
            require('bk.php');
        } else {
            include("nf.php");
        }
        mysqli_close($conn);
    } else {
        $t_desc = "<h2>"._DESC."</h2>";
        require('header.php');
        require('fbody.php');
    }
} elseif ($ath!=null && $bk!=null && $id!=null) {

    $q = 'SELECT * FROM auth WHERE id=' . $ath;
    require('condb.php');
    if(mysqli_num_rows($query)>0) {
        $info = mysqli_fetch_assoc($query);
        $bknow = explode(',',$info['bks']);

        $_tbl = "tbl".$ath."_".$bk;
        $q = "SELECT * FROM $_tbl";

        if($query = mysqli_query($conn,$q)) {

            $_msqnr = mysqli_num_rows($query);

            $_ids = array($id-1,$id,$id+1);
            $q = "SELECT * FROM $_tbl WHERE id BETWEEN $_ids[0] and $_ids[2]";

            $query = mysqli_query($conn,$q);
            if(mysqli_num_rows($query)>0 && ($_ids[1] != 0 && $_ids[1] <= $_msqnr)) {
                $_e=0;
                while($rrow = mysqli_fetch_assoc($query)) {
        
                    $row[$_e] = $rrow;
                    $_e++;
                }
                if(count($row)==2) {
                    if($row[1]['id'] != $_msqnr) {
                        $row = array(0,$row[0],$row[1]);
                    } elseif($row[1]['id'] == $_msqnr && $_msqnr ==2 && $id==1) {
                        $row = array(0, $row[0], $row[1]);
                    } else {
                        $row = array($row[0],$row[1],0);
                    }
                } elseif(count($row)==1) {
                    $row = array(0,$row[0],0);
                }

                $title = "ئاڵەکۆک &raquo; " . "{$info['profname']} &raquo; {$bknow[$bk-1]} &raquo; " . $row[1]['name'];


                $desc = "شێعری " . $row[1]['name'] . " " . $info['profname'];

                $keys = $row[1]['name'] . "," . $bknow[$bk-1] . "," . $info['takh'] . "," . $info['profname'] . "," . $info['name'] . "," . "شێعر,شعر";

                $color_num = color_num($ath);
                include('header.php');

                mysqli_close($conn);


                require('hon.php');
            } else {
                include("nf.php");
            }

        } else {
            $t_desc = "<h2>"._DESC."</h2>";
            include('header.php');
            include('fbody.php');
        }
    } else {
        $t_desc = "<h2>"._DESC."</h2>";
        include('header.php');
        include('fbody.php');
    }


} elseif($q != null) {
    
    
    $is_it_search = 1;

	$title = "ئاڵەکۆک &raquo; گەڕان: " . $q;
	
	$desc = "گەڕان بۆ " . $q . " لە ئاڵەکۆک دا";
	
	$keys = $q . "," . "ئاڵەکۆک,شێعر,شعر";
	
    $color_num = 0;
	
	include('header.php');
	include('search2.php');
    
} else {
    $t_desc = "<h2>"._DESC."</h2>";
    include('header.php');
    include('fbody.php');

}

?>