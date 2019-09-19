<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; شێعرەکان";
$desc = "شێعرەکان";
$keys = _KEYS;
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
    <?php
    /* READ */
    $db = 'index';
    $q = 'SELECT * FROM auth ORDER BY takh ASC';
    require(ABSPATH . 'script/php/condb.php');
    $aths_num = mysqli_num_rows($query);
    $bks_num = 0;
    $pms_num = 0;
    $aths = [];
    while($res=mysqli_fetch_assoc($query))
    {
	$res['bks'] = explode(',',$res['bks']);
	$bks_num += count($res['bks']);
	$aths[] = $res;
    }

    /* Save Cipi column. */
    mysqli_select_db($conn,_DB_PREFIX.'search');
    $query = mysqli_query($conn, 'SELECT poet_id,book_id,poem_id,Cipi 
FROM poems');
    $Cs = [];
    if($query)
    {
	while($res = mysqli_fetch_assoc($query))
	{
	    $Cs["{$res['poet_id']}/{$res['book_id']}/{$res['poem_id']}"]
	    =$res['Cipi'];
	}
    }
    /* WRITE*/
    $error = false;
    $string = '';
    /* Truncate 'poems' table */
    mysqli_query($conn,'TRUNCATE TABLE poems');

    $poems = [];
    $Cs_key = 0;
    foreach($aths as $ath)
    {
	$rtakh = $ath['takh'];
	$poet_id = $ath['id'];
	for($i=0;$i<count($ath['bks']);$i++)
	{
            $rbook = $ath['bks'][$i];
            $book_id = ($i+1);
            mysqli_select_db($conn,_DB_PREFIX."index");
            $_tbl = "tbl{$poet_id}_{$book_id}";
            $query = mysqli_query($conn,"SELECT * FROM $_tbl");
	    $pms_num += mysqli_num_rows($query);
            while($res=mysqli_fetch_assoc($query))
	    {
		$res['poet_id'] = $poet_id;
		$res['book_id'] = $book_id;
		$res['rname'] = $res['name'];
		$res['name'] = san_data($res['name']);
		$res['hon'] = preg_replace('/<sup>.*<\/sup>/ui',
					   '', $res['hon']);
		$res['hon'] = san_data($res['hon']);
		$res['hon_true'] = san_data_more($res['hon']);
		$res['hdesc'] = san_data($res['hdesc']);
		$res['len'] = (strlen($res['hon'])>strlen($res['hdesc'])) ?
			      strlen($res['hon']) : strlen($res['hdesc']);
		$res = array_merge(['rbook' => $rbook],$res);
		$res = array_merge(['rtakh' => $rtakh],$res);
		
		$cipi = @intval($Cs["$poet_id/$book_id/{$res['id']}"]);
		array_unshift($res, $cipi);
		$poems[] = $res;
            }
	    rsort($poems);
	}
    }
    
    mysqli_select_db($conn,_DB_PREFIX."search");
    foreach($poems as $pm)
    {
	$poet_id = $pm['poet_id'];
	$book_id = $pm['book_id'];
	$rtakh = $pm['rtakh'];
	$rbook = $pm['rbook'];
	$pname = $pm['name'];
	$phon = $pm['hon'];
	$phon_true = $pm['hon_true'];
	$phdesc = $pm['hdesc'];
	$poem_id = $pm['id'];
	$rname = $pm['rname'];
	$phonlen = $pm['len'];
	$Cipi = $pm[0];
	
	$q = "INSERT INTO `poems`(`name`,`hdesc`,`poet_id`,
`book_id`,`poem_id`,`poem`,`rname`,`rbook`,`rtakh`,
`Cipi`,`len`,`poem_true`) VALUES ('$pname','$phdesc','$poet_id',
'$book_id','$poem_id'," . '"' . $phon . '"' . ",'$rname','$rbook',
'$rtakh',$Cipi,$phonlen,'$phon_true')";
	$query = mysqli_query($conn, $q);		
	if(!$query)
	{
            $error = true;
	    $string .= "<p class='line'><a class='link' 
href='/poet:$poet_id'>$rtakh</a> &rsaquo; <a class='link' 
href='/poet:$poet_id/book:$book_id'>$rbook</a> &rsaquo; <a 
class='link' href='/poet:$poet_id/book:$book_id/poem:$poem_id'
>$rname</a>: <b style='color:red'>نەء!</b></p>";
	}
	
    }
    mysqli_close($conn);
    /* Print error messages */
    echo "<p class='line'>ئەژماری شاعیران: ".
	 num_convert($aths_num,'en','ckb').
	 "</p><p class='line'>ئەژماری کتێبەکان: ".
	 num_convert($bks_num,'en','ckb').
	 "</p><p class='line'>ئەژماری شێعرەکان: ".
	 num_convert($pms_num,'en','ckb')."</p>";
    echo $string;
    if(!$error)
	echo "<p class='line' style='text-align:center'
><b style='color:green'>جێ‌بە‌جێیە.</b></p>";
    /* Update 'last-update.txt' */
    if(!$error)
	file_put_contents(ABSPATH."last-update.txt",
			  date("Y-m-d H:i:s"));
    ?>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
