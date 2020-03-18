<?php
const _input = "fonts.txt";
const _output = "fonts-imgs";
$list = json_decode(file_get_contents(_input), true);
foreach($list as $o) {
    $title = $o["title"];
    $img_url = $o["img"];
    while(!$res = file_get_contents($img_url))
	sleep(1);
    file_put_contents(_output . "/" . $title . ".png", $res);
    echo "'{$title}' downloaded\n";
}
echo "ok\n";
?>
