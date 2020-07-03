<?php
const _input = "fonts.txt";
const _output = "fonts-files";
$list = json_decode(file_get_contents(_input), true);
$dom = new DOMDocument;
$_dom = new DOMDocument;
foreach($list as $o) {
	$href = $o["href"];
	$title = $o["title"];
	while(!$html = file_get_contents($href))
		sleep(1);
	@$dom->loadHTML($html);
	$format = $link = "";
	foreach($dom->getElementsByTagName("div") as $div) {
		if($div->getAttribute("class") == "panel-body text-center") {
			$table = $div->getElementsByTagName("table")[0];
			$tds = $table->getElementsByTagName("td");
			foreach($tds as $i => $td) {
				if($td->nodeValue == "جۆر:") {
					$format = $tds[$i+1]->nodeValue;
					break;
				}
			}
		}
		elseif($div->getAttribute("class") == "panel-footer") {
			$a = $div->getElementsByTagName("a")[0];
			$link = $a->getAttribute("href");
			$download_page = file_get_contents($link);
			@$_dom->loadHTML($download_page);
			foreach($_dom->getElementsByTagName("div") as $_div) {
				if($_div->getAttribute("class") == "alert alert-warning") {
					$_link = $_div->getElementsByTagName("a")[0]->getAttribute("href");
					while(! $font = file_get_contents($_link))
						sleep(1);
					file_put_contents(_output . "/" . $title . $format,
							  $font);
					echo "'{$title}' downloaded\n";
					break 2;
				}
			}
		}
	}
}
echo "ok\n";
?>
