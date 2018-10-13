<?php

$_1 = microtime(true);
    
    require_once("constants.php");
    require_once("functions.php");
    
    $q = $_GET['q'];
    if(! $q)    die();
    
    $q_san = san_data($q);
    $q_san_true = san_data($q, true);
    
    $_selPT = filter_var($_GET['selPT'], FILTER_SANITIZE_STRING);
    
    $pt_max_default = 5;
    $bk_max_default = 10;
    $pm_max_default = 15;
    $pm_kind_default = 3;
    
    $pt_max = ! (filter_var($_GET['pt'], FILTER_VALIDATE_INT)===false) ? $_GET['pt'] : $pt_max_default;
    $bk_max = ! (filter_var($_GET['bk'], FILTER_VALIDATE_INT)===false) ? $_GET['bk'] : $bk_max_default;
    $pm_max = ! (filter_var($_GET['pm'], FILTER_VALIDATE_INT)===false) ? $_GET['pm'] : $pm_max_default;
    $pm_kind = ! (filter_var($_GET['k'], FILTER_VALIDATE_INT)===false) ? $_GET['k'] : $pm_kind_default;
    
    
    
    header("Content-type: text/html; charset=utf-8");
    
    $_poets = search_poet($q_san,$q_san_true,$pt_max);
    $_books = search_book($q_san,$q_san_true,$bk_max,$_selPT);
    $_poems = search_poem($q_san,$q_san_true,$pm_max,$_selPT,$pm_kind);
    
    if(! empty($_poets)) {
        
        echo "<div class='search-poet' id='poets'><h3 id='bhon'>شاعیر</h3>";
        
        foreach($_poets as $_r) {
            echo "<section>";
			echo "<a href='/{$_r['uri']}'>";
            
			echo "<img src='{$_r['img']}'>";
			echo "<h3>{$_r['rtakh']}</h3>";
			echo "</a></section>";
        }
        
        echo "</div>";
        
    }
    if(! empty($_books)) {
        
        echo "<div class='search-book'><h3 id='bhon'>کتێب و بەرهەم</h3>";
        
        foreach($_books as $_r) {
            echo "<a href='/{$_r['poet_address']}/{$_r['book_address']}'><i>{$_r['rtakh']}</i> &rsaquo; {$_r['rbook']}</a>";
        }
        
        echo "</div>";
    }
    if(! empty($_poems)) {
        echo "<div class='search-hon'><h3 id='bhon'>شێعر</h3>";
        
        if(! empty($_poems['name'])) {
            
            foreach($_poems['name'] as $_r) {
                $pbp_uri = "{$_r['poet_address']}/{$_r['book_address']}/{$_r['poem_address']}";
	                    
                echo "<a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>{$_r['rtakh']}</i> &rsaquo; <i>{$_r['rbook']}</i> &rsaquo; {$_r['rname']}</a>";
            }
            
        }
        
        if(! empty($_poems['context'])) {
            
            echo "<h3 class='bhoh-newdaq'>گەڕانی نێو دەق: </h3>";
            
            foreach($_poems['context'] as $_r) {
                $pbp_uri = "{$_r['poet_address']}/{$_r['book_address']}/{$_r['poem_address']}";
	                    
                echo "<a href='/script/php/UpdateCipi.php?uri={$pbp_uri}'><i>{$_r['rtakh']}</i> &rsaquo; <i>{$_r['rbook']}</i> &rsaquo; {$_r['rname']}</a>";
            }
        }
        
        echo "</div>";
        
    }
    

    
    function search_poet($q_san,$q_san_true,$pt_max) {
        $_1 = microtime(true);
        if($pt_max === 0)   return;
        
        $max_len = strlen($q_san);
        
        $db = "search";
        $q = "SELECT id,name,takh,profname,hdesc,uri,rtakh FROM poets WHERE len>${max_len} ORDER BY rtakh ASC";
        require("condb.php");
        
        if(!$query) return;
        
        $_res_takh = $_res_prof = $_res_name = $_res_hdesc = $_res_takh_true = $_res_prof_true = $_res_name_true = $_res_hdesc_true = [];
        
        while($res = mysqli_fetch_assoc($query) ) {
            
            $is_takh = stristr($res['takh'], $q_san);
            $is_prof = stristr($res['profname'], $q_san);
            $is_name = stristr($res['name'], $q_san);
            $is_hdesc = stristr($res['hdesc'], $q_san);
            
            $is_takh_true = stristr(san_data($res['takh'], true), $q_san_true);
            $is_prof_true = stristr(san_data($res['profname'], true), $q_san_true);
            $is_name_true = stristr(san_data($res['name'], true), $q_san_true);
            $is_hdesc_true = stristr(san_data($res['hdesc'], true), $q_san_true);
            
            
            unset($res['takh']);
            unset($res['profname']);
            unset($res['name']);
            unset($res['hdesc']);

            
            $res['img'] = get_poet_image($res['id'], "profile", 1);
            
            
            if($is_takh)    $_res_takh[] = $res;
            if($is_prof and !$is_takh)    $_res_prof[] = $res;
            if($is_name and !$is_takh and !$is_prof)    $_res_name[] = $res;
            if($is_hdesc and !$is_takh and !$is_prof and !$is_name) $_res_hdesc[] = $res;
            
            if($is_takh_true and !$is_takh and !$is_prof and !$is_name and !$is_hdesc)   $_res_takh_true[] = $res;
            if($is_prof_true and !$is_takh_true and !$is_takh and !$is_prof and !$is_name and !$is_hdesc)   $_res_prof_true[] = $res;
            if($is_name_true and !$is_takh_true and !$is_prof_true and !$is_takh and !$is_prof and !$is_name and !$is_hdesc)   $_res_name_true[] = $res;
            if($is_hdesc_true and !$is_takh_true and !$is_prof_true and !$is_name_true and !$is_takh and !$is_prof and !$is_name and !$is_hdesc)   $_res_hdesc_true[] = $res;
            
        }
        
        mysqli_close($conn);
        
        
        $_res_takh = array_slice($_res_takh, 0, $pt_max);
        $pt_max -= count($_res_takh);
        if($pt_max) {
            
            $_res_prof = array_slice($_res_prof, 0, $pt_max);
            $pt_max -= count($_res_prof);
            
            if($pt_max) {
                $_res_name = array_slice($_res_name, 0, $pt_max);
                $pt_max -= count($_res_name);
                if($pt_max) {
                    
                    $_res_hdesc = array_slice($_res_hdesc, 0, $pt_max);
                    $pt_max -= count($_res_hdesc);
                } else {
                    $_res_hdesc = [];
                }
            } else {
                $_res_name = [];
                $_res_hdesc = [];
            }
        } else {
            
            $_res_hdesc = [];
            $_res_name = [];
            $_res_prof = [];
        }
        
        if( $pt_max )  {
            
            $_res_takh_true = array_slice($_res_takh_true, 0, $pt_max);
            
            $pt_max -= count($_res_takh_true);
            
            if($pt_max) {
                
                $_res_prof_true = array_slice($_res_prof_true, 0, $pt_max);
                
                $pt_max -= count($_res_prof_true);
                
                if($pt_max) {
                    $_res_name_true = array_slice($_res_name_true, 0, $pt_max);
                    $pt_max -= count($_res_name_true);
                    if($pt_max) {
                        $_res_hdesc_true = array_slice($_res_hdesc_true, 0, $pt_max);
                        
                    } else {
                        $_res_hdesc_true = [];
                    }
                } else {
                    $_res_hdesc_true = [];
                    $_res_name_true = [];
                }
            } else {
                
                $_res_hdesc_true = [];
                $_res_name_true = [];
                $_res_prof_true = [];
            }
        } else {
            $_res_hdesc_true = [];
            $_res_takh_true = [];
            $_res_name_true = [];
            $_res_prof_true = [];
        }
        
        $_reses = array_merge($_res_takh,$_res_prof,$_res_name,$_res_hdesc,$_res_takh_true,$_res_prof_true,$_res_name_true,$_res_hdesc_true);
            
        echo microtime(true) - $_1;
        return $_reses;
    }
    
    
    
    
    function search_book($q_san,$q_san_true,$bk_max,$_selPT) {
        $_1 = microtime(true);
        if($bk_max === 0)   return;
        
        $max_len = strlen($q_san);
        
        $db = "search";
        $q = ($_selPT == "") ? "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>{$max_len} order by rtakh ASC" : "select book,book_desc,poet_address,book_address,rbook,rtakh from books where len>{$max_len} and rtakh='{$_selPT}' order by rtakh ASC";
        require("condb.php");
        
        if(!$query) return;
        
        $_res_book = $_res_book_desc = $_res_book_true = $_res_book_desc_true = [];
        
        while($res = mysqli_fetch_assoc($query) ) {
            
            $is_book = stristr($res['book'], $q_san);
            $is_book_desc = stristr($res['book_desc'], $q_san);
            
            $is_book_true = stristr(san_data($res['book'], true), $q_san_true);
            $is_book_desc_true = stristr(san_data($res['book_desc'], true), $q_san_true);
            
            
            unset($res['book']);
            unset($res['book_desc']);
            
            
            if($is_book)    $_res_book[] = $res;
            if($is_book_desc and !$is_book)    $_res_book_desc[] = $res;
            
            
            if($is_book_true and !$is_book and !$is_book_desc)   $_res_book_true[] = $res;
            if($is_book_desc_true and !$is_book_true and !$is_book and !$is_book_desc)   $_res_book_desc_true[] = $res;
            
        }
        
        mysqli_close($conn);
        
        
        $_res_book = array_slice($_res_book, 0, $bk_max);
        $bk_max -= count($_res_book);
        if($bk_max) {
            
            $_res_book_desc = array_slice($_res_book_desc, 0, $bk_max);
            $bk_max -= count($_res_book_desc);
            
        } else {
            
            $_res_book_desc = [];
        }
        
        if( $bk_max )  {
            
            $_res_book_true = array_slice($_res_book_true, 0, $bk_max);
            
            $bk_max -= count($_res_book_true);
            
            if($bk_max) {
                
                $_res_book_desc_true = array_slice($_res_book_desc_true, 0, $bk_max);
                
            } else {
                
                $_res_book_desc_true = [];

            }
        } else {
            $_res_book_true = [];
            $_res_book_desc_true = [];
        }
        
        $_reses = array_merge($_res_book, $_res_book_desc, $_res_book_true, $_res_book_desc_true);
            
        echo microtime(true) - $_1;
        return $_reses;
    }
    
    
    function search_poem($q_san,$q_san_true,$pm_max,$_selPT,$pm_kind) {
        $_1 = microtime(true);
        if($pm_max === 0)   return;
        
        $max_len = strlen($q_san);
        
        $db = "search";
        $q = ($_selPT == "") ? "SELECT name,hdesc,poet_address,book_address,poem_address,poem,poem_true,rbook,rname,rtakh FROM poems where len>{$max_len} ORDER BY Cipi DESC" : "SELECT name,hdesc,poet_address,book_address,poem_address,poem,poem_true,rbook,rname,rtakh FROM poems where len>{$max_len} and rtakh='{$_selPT}' ORDER BY Cipi DESC";
        require("condb.php");
        
        if(!$query) return;
        
        $_res_name = $_res_hdesc = $_res_poem =  $_res_name_true = $_res_hdesc_true = $_res_poem_true = [];
        
        while($res = mysqli_fetch_assoc($query) ) {
            
            if(count($_res_name) == $pm_max and $pm_kind != 2)  break;
            if( count($_res_poem) == $pm_max and $pm_kind == 2)  break;
            
            $is_name = stristr($res['name'], $q_san) and $pm_kind != 2;
            $is_poem = stristr($res['poem'], $q_san) and $pm_kind != 1;
            $is_hdesc = stristr($res['hdesc'], $q_san);

            $is_name_true = stristr(san_data($res['name'], true), $q_san_true) and $pm_kind != 2;
            $is_poem_true = stristr($res['poem_true'], $q_san_true) and $pm_kind != 1;
            $is_hdesc_true = stristr(san_data($res['hdesc'], true), $q_san_true);
            
            
            unset($res['name']);
            unset($res['poem']);
            unset($res['poem_true']);
            unset($res['hdesc']);


            
            if($is_name)    $_res_name[] = $res;
            if($is_poem and !$is_name)    $_res_poem[] = $res;
            if($is_hdesc and !$is_name and !$is_poem) $_res_hdesc[] = $res;
            
            if($is_name_true and !$is_name and !$is_poem and !$is_hdesc)   $_res_name_true[] = $res;
            if($is_poem_true and !$is_name_true and !$is_name and !$is_poem and !$is_hdesc)   $_res_poem_true[] = $res;
            if($is_hdesc_true and !$is_name_true and !$is_poem_true and !$is_name and !$is_poem and !$is_hdesc)   $_res_hdesc_true[] = $res;
            
        }
        
        mysqli_close($conn);
        
        
        $_res_name = array_slice($_res_name, 0, $pm_max);
        $pm_max -= count($_res_name);
        if($pm_max) {
            
            $_res_poem = array_slice($_res_poem, 0, $pm_max);
            $pm_max -= count($_res_poem);
            
            if($pm_max) {
                $_res_hdesc = array_slice($_res_hdesc, 0, $pm_max);
                $pm_max -= count($_res_hdesc);
            } else {
                $_res_hdesc = [];
            }
        } else {
            
            $_res_hdesc = [];
            $_res_poem = [];
        }
        
        if( $pm_max )  {
            
            $_res_name_true = array_slice($_res_name_true, 0, $pm_max);
            
            $pm_max -= count($_res_name_true);
            
            if($pm_max) {
                
                $_res_poem_true = array_slice($_res_poem_true, 0, $pm_max);
                
                $pm_max -= count($_res_poem_true);
                
                if($pm_max) {
                    $_res_hdesc_true = array_slice($_res_hdesc_true, 0, $pm_max);
                } else {
                    $_res_hdesc_true = [];
                }
            } else {
                
                $_res_hdesc_true = [];
                $_res_poem_true = [];
            }
        } else {
            $_res_poem_true = [];
            $_res_name_true = [];
            $_res_hdesc_true = [];
        }
        
        $_reses01 = array_merge($_res_name, $_res_name_true);
        $_reses02 = array_merge($_res_poem, $_res_hdesc, $_res_poem_true, $_res_hdesc_true);
        
        $_reses = [
            "name"=>$_reses01,
            "context"=>$_reses02,
            ];
        
        echo microtime(true) - $_1;
        return $_reses;
    }
    
    echo (microtime(true) - $_1);
    
?>