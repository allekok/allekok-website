<?php
/* index.php body */
require_once('constants.php');

$q = "SELECT id,profname,takh,hdesc,kind FROM auth WHERE kind != 'bayt' ORDER BY takh ASC";
require(ABSPATH.'script/php/condb.php');
?>
<div id='poets'>
	<?php
	if($query)
	{
		$poets = [];
		while($row = mysqli_fetch_assoc($query))
		{
			$hdesc = explode("[n]", $row["hdesc"]);
			$order = 7433;
			foreach($hdesc as $item)
			{
				$item = explode("[t]", $item);
				if($item[0] == "لەدایکبوون") {
					preg_match("/([٠-٩]+)ی کوردی/u", $item[1], $r);
					$order = intval(num_convert($r[1], "ckb", "en"));
					break;
				}
			}

			if($row["kind"] == "alive")
				$order += 9801;

			$poets[] = [$order, $row];
		}
		sort($poets);
		foreach($poets as $poet)
		{
			$row = $poet[1];
			$imgsrc = _R . get_poet_image($row['id'],false);
			echo '<a class="poet" href="' . _R .
			     'poet:' . $row['id'] . '"><img alt="' .
			     $row['profname'] . '" src="' . $imgsrc .
			     '"><h3 title="' . $row['profname'] . '">' .
			     $row['takh'] . '</h3></a>';
		}
	}
	mysqli_close($conn);
	?>
</div>
