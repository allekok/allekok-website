<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; شێعرەکان";
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
    $db = "index";
    $q = "SELECT * FROM auth ORDER BY takh ASC";
    require(ABSPATH."script/php/condb.php");
    $aths_num = mysqli_num_rows($query);
    $bks_num = 0;
    $pms_num = 0;
    $aths = [];
    while($res=mysqli_fetch_assoc($query))
    {
	$res['bks'] = explode(",",$res['bks']);
	$bks_num += count($res['bks']);
	$aths[] = $res;
    }

    /* Save imp, C, Cipi cloumns. */
    mysqli_select_db($conn,_DB_PREFIX."search");
    $query = mysqli_query($conn, "SELECT poet_id,book_id,poem_id,
imp,C,Cipi FROM poems");
    $Cs = [];
    if($query)
    {
	while($res = mysqli_fetch_assoc($query))
	{
	    $Cs[] = [
		'poet_id'=>$res['poet_id'],
		'book_id'=>$res['book_id'],
		'poem_id'=>$res['poem_id'],
		'imp'=>$res['imp'],
		'C'=>$res['C'],
		'Cipi'=>$res['Cipi']
	    ];
	}
    }
    /* WRITE*/
    $error = false;
    $string = "";
    /* Truncate 'poems' table */
    mysqli_query($conn,"TRUNCATE TABLE poems");
    
    $kurdish_nums = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',
		     '۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    $other_nums = ['0','1','2','3','4','5','6','7','8','9',
		   '٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
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
	    $poems = [];
            $query = mysqli_query($conn,"SELECT * FROM $_tbl");
	    $pms_num += mysqli_num_rows($query);
            while($res=mysqli_fetch_assoc($query))
	    {
		$res['rname'] = $res['name'];
		$res['name'] = san_data($res['name']);		
		$res['hon'] = san_data($res['hon']);
		$res['hon_true'] = san_data_more($res['hon']);
		$res['hdesc'] = san_data($res['hdesc']);
		$res['len'] = (strlen($res['hon'])>strlen($res['hdesc'])) ?
			      strlen($res['hon']) : strlen($res['hdesc']);
		$poems[] = $res;
            }
            mysqli_select_db($conn,_DB_PREFIX."search");
            foreach($poems as $pm)
	    {
		$pname = $pm['name'];
		$phon = $pm['hon'];
		$phon_true = $pm['hon_true'];
		$phdesc = $pm['hdesc'];
		$poem_id = $pm['id'];
		$rname = $pm['rname'];
		$phonlen = $pm['len'];
		if($poet_id == @$Cs[$Cs_key]['poet_id'] and
		    $book_id == @$Cs[$Cs_key]['book_id'] and
		    $poem_id == @$Cs[$Cs_key]['poem_id'])
		{
                    $pm['Cs'] = $Cs[$Cs_key];
		}
		else
		{
                    $pm['Cs'] = ['imp'=>1,'C'=>0,'Cipi'=>0];
		}
		$Cs_key++;
		
		$imp = $pm['Cs']['imp'];
		$C = $pm['Cs']['C'];
		$Cipi = $pm['Cs']['Cipi'];
		
		$q = "INSERT INTO `poems`(`name`,`hdesc`,`poet_id`,
`book_id`,`poem_id`,`poem`,`rname`,`rbook`,`rtakh`,`imp`,`C`,
`Cipi`,`len`,`poem_true`) VALUES ('$pname','$phdesc','$poet_id',
'$book_id','$poem_id'," . '"' . $phon . '"' . ",'$rname','$rbook',
'$rtakh',$imp,$C,$Cipi,$phonlen,'$phon_true')";
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
