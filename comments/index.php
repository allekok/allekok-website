<?php
include_once("../script/php/constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &rsaquo; بیر و ڕاکان";
$desc = "بیر و ڕای ئێوە سەبارەت بە شێعرەکان";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");

// number of comments
$n = (@filter_var($_GET['n'], FILTER_VALIDATE_INT) !== FALSE) ?
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
    require(ABSPATH . 'script/php/condb.php');
    if($query)
    {
	echo "<div id='hon-comments-body'
    style='padding-right:1em'>";
	$comms = [];
	while($res = mysqli_fetch_assoc($query))
	{
	    if($n == 0) break;
	    $res['pt'] = substr($res['address'], 5,
				strpos($res['address'], '/') - 5); // poet's id from address(poet:{$pt}/...)
            $res['comment'] = str_replace("\n", "<br>\n", $res['comment']); // replace newlines with <br>
            $res['date'] = explode(' ', $res['date']); // split date string by space
            $res['date'] = $res['date'][0] . ' ' . $res['date'][1];
            $res['date'] = num_convert($res['date'], 'en', 'ckb');
            $res['date'] = str_replace(['am','pm'],
				       [' بەیانی ',' پاش‌نیوەڕۆ '],
				       $res['date']); // replace am,pm with kurdish ones.
	    $comms[] = $res;
	    $n--;
	}
	foreach($comms as $r)
	{
            $r["naddress"] = explode("/", $r["address"]); // split address by slash("/")
            for($a = 0; $a < count($r['naddress']); $a++) {
		
		$r["naddress"][$a] = explode(":", $r["naddress"][$a]);
		// split "naddress" elements by ":"
		// 0=>["poet", poet's_id], ...
		
            }

	    // query poet's takh per each comment
            $q = "select takh from auth where id={$r["naddress"][0][1]}";
            $query = mysqli_query($conn, $q);

	    // poet's name
            $r["ptn"] = mysqli_fetch_assoc($query)["takh"];
	    
	    // query poem's name per each comment
            $q = "select name from tbl{$r["naddress"][0][1]}_{$r["naddress"][1][1]} where id={$r["naddress"][2][1]}";
            $query = mysqli_query($conn, $q);

	    //poem's name
            $r["pmn"] = mysqli_fetch_assoc($query)["name"];

	    $r['name'] = trim($r['name']) ? $r['name'] : 'ناشناس';

	    echo "<div class='comment'><div class='comm-name'
>".$r['name']."<span 
style='font-size:.7em'> سەبارەت بە شێعری </span><a
style='font-size:.75em;padding:0 .3em' 
href='/".$r['address']."'><i class='color-blue'>".$r['ptn']."</i
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
