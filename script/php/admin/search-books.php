<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; کتێبەکان";
$desc = "کتێبەکان";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<style>
 .line {
     text-align:right;
     font-size:.65em;
     padding:0 1em;
 }
</style>
<div id="poets">
    <a style="font-size:.65em;display:block"
       class="link" href="search-poems.php">شێعرەکان</a>
    <?php
    /* READ */
    $q = "SELECT * FROM auth ORDER BY takh ASC";
    require(ABSPATH."script/php/condb.php");
    $aths_num = mysqli_num_rows($query);
    $bks_num = 0;
    $aths = [];
    
    while($res=mysqli_fetch_assoc($query)) {
	$res['bks'] = explode(",",$res['bks']);
	$res['bksdesc'] = explode(",",$res['bksdesc']);
	$aths[] = $res;
	$bks_num += count($res['bks']);
    }	$res['rtakh'] = $res['takh'];
    
    /* WRITE */
    $string = "<p class='line'>ئەژماری شاعیران: ".
	      num_convert($aths_num,'en','ckb').
	      "</p><p class='line'>ئەژماری کتێبەکان: ".
	      num_convert($bks_num,'en','ckb')."</p>";
    $error = false;
    mysqli_select_db($conn,_SEARCH_DB);
    mysqli_query($conn,"TRUNCATE TABLE books");
    
    foreach($aths as $ath)
    {
	$poet_id = $ath['id'];
	$rtakh = $ath['takh'];
	for($i=0; $i<count($ath['bks']); $i++)
	{
	    $book_id = ($i+1);
	    $rbook = $ath['bks'][$i];
            $book = san_data($ath['bks'][$i]);
            $book_desc = san_data(@$ath['bksdesc'][$i]);
            $len = (strlen($book) > strlen($book_desc)) ?
		   strlen($book) : strlen($book_desc);
	    
	    $query = mysqli_query($conn, "INSERT INTO `books`(`book`,
`book_desc`,`poet_id`,`book_id`,`rtakh`,`rbook`,`len`) VALUES ('$book',
'$book_desc','$poet_id','$book_id','$rtakh','$rbook','$len')");
            if(!$query)
	    {
		$error = true;
		$string .= "<p class='line'><a class='link' 
href='/poet:$poet_id'>$rtakh</a> &rsaquo; <a class='link' 
href='/poet:$poet_id/book:$book_id'>$rbook</a>: <b 
style='color:red'>نەء!</b></p>";
            }
	}
    }
    mysqli_close($conn);
    echo $string;
    if(!$error)
	echo "<p class='line' style='text-align:center'
><b style='color:green'>جێ‌بە‌جێیە.</b></p>";
    ?>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
