<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " &rsaquo; بیر و ڕاکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شێعرەکان";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");

/* Number of comments */
$n = @filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE ?
     $_GET['n'] : 20;
?>
<style>
 .tmi-news
 {
     padding:0 .6em;
     font-size:1.1em;
 }
</style>
<div id="poets">
    <h1 class="color-blue"
	       style="font-size:1em;text-align:right">
        بیر و ڕاکان
    </h1>
    <div class="tools-menu" style="font-size:.6em;padding-right:2em;margin-bottom:1em">
	<div style="display:flex;font-size:1.15em">
	    <div style="padding-left:1em">
		ئەژمار:
	    </div>
	    <div>
		<?php 
		function print_tools_menu ($all, $sel)
		{
		    foreach($all as $o)
		    {
			$_ = num_convert($o, 'en', 'ckb');
			
			if($o == $sel)
			    echo "<span class='color-blue tmi-news'>{$_}</span>";
			elseif($sel == -1 and $_ == 'هەموو')
			    echo "<span class='color-blue tmi-news'>هەموو</span>";
			else
			{
			    if($o == 'هەموو') $o = -1;
			    echo "<a href='?n=$o' class='tmi-news'>{$_}</a>";
			}
		    }
		}

		print_tools_menu(['70','35','20','هەموو'], $n);
		?>
	    </div>
	</div>
    </div>
    <?php
    $q = 'select * from comments where blocked=0 order by id DESC';
    include(ABSPATH . 'script/php/condb.php');
    if($query)
    {
	echo "<div id='hon-comments-body' 
style='padding-right:1em'>";
	$comms = [];
	while($res = mysqli_fetch_assoc($query))
	{
	    if($n-- == 0) break;
	    /* Poet's id from address(poet:{$pt}/...) */
	    $res['pt'] = substr($res['address'], 5,
				strpos($res['address'], '/') - 5);
	    /* Replace newline characters with <br> */
            $res['comment'] = str_replace("\n", "<br>\n", $res['comment']);
	    /* Split 'date' string by spaces */
            $res['date'] = explode(' ', $res['date']);
            $res['date'] = $res['date'][0] . ' ' . $res['date'][1];
            $res['date'] = num_convert($res['date'], 'en', 'ckb');
            $res['date'] = str_replace(['am','pm'],
				       [' بەیانی ',' پاش‌نیوەڕۆ '],
				       $res['date']);
	    $comms[] = $res;
	}
	foreach($comms as $r)
	{
	    /* Split address by slashes ('/') */
            $_adrs = explode("/", $r["address"]);
	    $_adrs_len = count($_adrs);
            for($i = 0; $i < $_adrs_len; $i++)
	    {
		/* Split '$_adrs' elements by ":"
		   0 => ["Poet", "Poet's id"], ... */
		$_adrs[$i] = explode(":", $_adrs[$i]);
            }

	    /* Poet's name */
            $q = "select takh from auth where id={$_adrs[0][1]}";
            $query = mysqli_query($conn, $q);
            $r["ptn"] = @mysqli_fetch_assoc($query)["takh"];
	    
	    /* Poem title */ 
	    $tbl = "tbl{$_adrs[0][1]}_{$_adrs[1][1]}";
            $q = "select name from {$tbl} where id={$_adrs[2][1]}";
            $query = mysqli_query($conn, $q);
            $r["pmn"] = @mysqli_fetch_assoc($query)["name"];

	    $r['name'] = trim($r['name']) ? $r['name'] : 'ناشناس';

	    echo "<div class='comment'><div class='comm-name'
>".$r['name']."<span 
style='font-size:.7em'> سەبارەت بە شێعری </span><a
style='font-size:.75em;padding:0 .3em' 
href='"._R.$r['address']."'><i class='color-blue'>".$r['ptn']."</i
> &rsaquo; <i class='color-blue'>".$r['pmn']."</i></a
><span style='font-size:.7em'> نووسیویەتی:</span></div
><div class='comm-body'>".$r['comment']."</div><div class='comm-footer'
>".$r['date']."</div></div>";
	}
	echo '</div>';
    }
    mysqli_close($conn);
    ?>
</div>
<?php
include_once(ABSPATH . 'script/php/footer.php');
?>
