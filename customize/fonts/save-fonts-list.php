<?php
const _output = "fonts.txt";
$base_url = "https://www.kurdfonts.com";
$url = "{$base_url}/ku/browse/top-50-kurdish-unicode-fonts";
$html = file_get_contents($url);
$dom = new DOMDocument;
@$dom->loadHTML($html);
$list = [];
foreach($dom->getElementsByTagName("div") as $div) {
	if($div->getAttribute("class") != "panel panel-info")
		continue;
	$_divs = $div->getElementsByTagName("div");
	/* HEAD */
	$heading = $_divs[0];
	$a = $heading->getElementsByTagName("a")[0];
	$href = $a->getAttribute("href");
	$title = $a->getElementsByTagName("h3")[0]->nodeValue;
	/* BODY */
	$body = $_divs[1];
	$img = $base_url . "/" .
	       $body->getElementsByTagName("img")[0]->getAttribute("src");
	$list[] = [
		"title" => $title,
		"href" => $href,
		"img" => $img,
	];
}
file_put_contents(_output, json_encode($list));
echo "ok\n";
?>
