<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = _TITLE . " &raquo; گەڕانەکان";
$desc = "گەڕانەکان";
$keys = _KEYS;
$t_desc = "";

include(ABSPATH . 'script/php/header.php');
?>
<div id="poets">        
    <?php
    $db = "search";
    $q = "select Cipi, rtakh, rbook, rname, 
poet_id, book_id, poem_id id from poems 
where Cipi>1 order by Cipi DESC";
    
    require(ABSPATH . "script/php/condb.php");
    
    $_ths = [
        ["Cipi",
	 "5%"],
	["شێعر",
	 "90%"],
	["ژمارە",
	 "5%"],
    ];
    
    echo "<table style='font-size:.6em'>";
    echo "<tr>";
    
    foreach($_ths as $_th) {
        
        echo "<th class='color-blue' style='width:{$_th[1]};'>";
        echo $_th[0];
        echo "</th>";
    }
    
    echo "</tr>";
    
    while($res = mysqli_fetch_assoc($query))
    {
        echo "<tr style='text-align:right'>";

	echo "<td>";
        echo num_convert($res['Cipi'], 'en', 'ckb');
        echo "</td>";

	$adrs = 'poet:'.$res['poet_id'].
		'/book:'.$res['book_id'].
		'/poem:'.$res['poem_id'];
	echo "<td>";
        echo "<a href='/$adrs'>".
	     $res['rtakh'].' &rsaquo; '.
	     $res['rbook'].' &rsaquo; '.
	     $res['rname'] . '</a>';
        echo "</td>";
	
	echo "<td>";
        echo num_convert($res['id'], 'en', 'ckb');
        echo "</td>";
        
        echo "</tr>";
    }
    
    echo "</table>";
    mysqli_close($conn);
    ?>
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
