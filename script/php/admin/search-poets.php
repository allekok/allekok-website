<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; شاعیران";
$desc = "شاعیران";
$keys = _KEYS;
$t_desc = "";
$color_num = 0;

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
       class="link" href="search-books.php">کتێبەکان</a>
    <?php
    /* READ */
    $db = "index";
    $q = "SELECT * FROM `auth` ORDER BY `takh` ASC";
    require(ABSPATH."script/php/condb.php");
    $aths_num = mysqli_num_rows($query);
    $aths = [];

    while($res=mysqli_fetch_assoc($query))
    {
	$res['rtakh'] = $res['takh'];
	$res['name'] = san_data($res['name']);
	$res['takh'] = san_data($res['takh']);
	$res['profname'] = san_data($res['profname']);
	$res['hdesc'] = san_data($res['hdesc']);
	$res['len'] = (strlen($res['name']) > strlen($res['hdesc'])) ?
		      strlen($res['name']) : strlen($res['hdesc']);
	$aths[] = $res;
    }

    /* WRITE */
    $string = "<p class='line'>ئەژماری شاعیران: ".
	      num_convert($aths_num,'en','ckb')."</p>";
    $error = false;
    mysqli_select_db($conn,_DB_PREFIX."search");
    mysqli_query($conn,"TRUNCATE TABLE poets");
    foreach($aths as $ath)
    {
	$id = $ath['id'];
	$name = $ath['name'];
	$takh = $ath['takh'];
	$profname = $ath['profname'];
	$hdesc = $ath['hdesc'];
	$rtakh = $ath['rtakh'];
	$len = $ath['len'];
	
	$query = mysqli_query($conn,
			      "INSERT INTO `poets`(`id`,`name`,`takh`,
`profname`,`hdesc`,`rtakh`,`len`) VALUES($id,'$name','$takh',
'$profname','$hdesc','$rtakh','$len')");
	
	if(!$query)
	{
	    $error = true;
            $string.="<p class='line'><a class='link' href='/poet:$id'
>$rtakh</a>: <b style='color:red'>نەء!</b></p>";
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
