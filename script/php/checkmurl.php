<?php 

$db = "index";

if ($ath!=null and $bk==null) {
    // https://allekok.com/?poet={$ath}
    // https://allekok.com/?ath={$ath}
    // poet.php page
    
    $q = "SELECT id,takh,profname,name,hdesc,bks,kind FROM auth WHERE id={$ath}";
    include("condb.php");

    if($row = mysqli_fetch_assoc($query)) {
        mysqli_close($conn);
        
        $title = _TITLE . " &raquo; " . $row["profname"];        
        $desc = "شێعرەکانی " . $row['profname'];
        $keys = "{$row["takh"]},{$row["profname"]},{$row["name"]}," . "شاعیر,شێعر,شعر";
        $color_num = color_num($ath);
        
        include("header.php");
        include("poet.php"); 
    } else {
        include("nf.php");
    }

} elseif ($ath!=null and $bk!=null and $id==null) {
    // https://allekok.com/poet:{$ath}/book:{$bk}
    // https://allekok.com/?ath={$ath}&bk={$bk}
    // bk.php

    // sort poems of the book by name or id(default).
    $_ordasc = @($_POST["order"]=="asc") ? "`name`" : "`id`";
    $q = "SELECT id,takh,profname,name,bks,bksdesc,kind FROM auth WHERE id={$ath}";
    
    include("condb.php");
    if($info = mysqli_fetch_assoc($query)) {
        
        $_tbl = "tbl{$ath}_{$bk}";
        $q = "SELECT id,name FROM $_tbl ORDER BY {$_ordasc} ASC";
        
        if($query = mysqli_query($conn, $q)) {
            
            $bknow = explode(",",$info["bks"]);
            
            $title = _TITLE . " &raquo; {$info["profname"]} &raquo; {$bknow[$bk-1]}";
            $desc = "کتێبی " . $bknow[$bk-1] . "، " . $info["profname"];
            $keys = "{$bknow[$bk-1]},{$info["takh"]},{$info["profname"]},{$info["name"]}," . "بەرهەم,شێعر,شعر,شیعر";
            $color_num = color_num($ath);
            
            include("header.php");
            include("bk.php");
        } else {
            include("nf.php");
        }
        mysqli_close($conn);        
    } else {
        $t_desc = "<h2>"._DESC."</h2>";
        include("header.php");
        include("fbody.php");
    }
    
} elseif ($ath!=null and $bk!=null and $id!=null) {
    // https://allekok.com/poet:{$ath}/book:{$bk}/poem:{$id}
    // https://allekok.com/?ath={$ath}&bk={$bk}&id={$id}
    // hon.php
    
    $q = "SELECT id,takh,profname,name,bks,kind FROM auth WHERE id={$ath}";
    include("condb.php");
    
    if($info = mysqli_fetch_assoc($query)) {
        
        $bknow = explode(",",$info["bks"]);

        $_tbl = "tbl{$ath}_{$bk}";
        $q = "SELECT * FROM $_tbl";

        if($query = mysqli_query($conn,$q)) {

            $_msqnr = mysqli_num_rows($query);
            
            $_ids = [$id-1 , $id , $id+1];
            $q = "SELECT * FROM $_tbl WHERE id BETWEEN {$_ids[0]} AND {$_ids[2]}";
            $query = mysqli_query($conn,$q);
            
            if(mysqli_num_rows($query)>0 and ($_ids[1] != 0 and $_ids[1] <= $_msqnr)) {
                $_e=0;
                while($rw = mysqli_fetch_assoc($query)) {
		    
                    $row[$_e] = $rw;
                    $_e++;
                }
                mysqli_close($conn);
                if(count($row)==2) {
                    if($row[1]['id'] != $_msqnr) {
                        $row = [0,$row[0],$row[1]];
                    } elseif($row[1]['id'] == $_msqnr && $_msqnr ==2 && $id==1) {
                        $row = [0, $row[0], $row[1]];
                    } else {
                        $row = [$row[0],$row[1],0];
                    }
                } elseif(count($row)==1) {
                    $row = [0,$row[0],0];
                }

                $title = _TITLE . " &raquo; " . "{$info["profname"]} &raquo; {$bknow[$bk-1]} &raquo; {$row[1]["name"]}";
                $desc = "شێعری " . $row[1]["name"] . "، " . $info["profname"];
                $keys = "{$row[1]["name"]},{$bknow[$bk-1]},{$info["takh"]},{$info["profname"]},{$info["name"]}," . "شێعر,شعر";
                $color_num = color_num($ath);
                
                include("header.php");
                include("hon.php");
            } else {
                include("nf.php");
            }

        } else {
            $t_desc = "<h2>"._DESC."</h2>";
            include("header.php");
            include("fbody.php");
        }
    } else {
        $t_desc = "<h2>"._DESC."</h2>";
        include("header.php");
        include("fbody.php");
    }

} elseif($q != null) {
    // https://allekok.com/?q={$q}
    // search2.php
    
    $is_it_search = 1;
    $title = _TITLE . " &raquo; گەڕان: " . $q;
    $desc = "گەڕان بۆ " . $q . " لە ئاڵەکۆک دا";
    $keys = "{$q}," . "ئاڵەکۆک,شێعر,شعر";
    $color_num = 0;
    
    include("header.php");
    include("search2.php");
    
} else {
    $t_desc = "<h2>"._DESC."</h2>";
    include("header.php");
    include("fbody.php");
}

?>
