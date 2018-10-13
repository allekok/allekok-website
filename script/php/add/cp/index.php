<meta charset="utf-8">
<title>جپ</title>

<?php

$files = scandir("./");

foreach($files as $f) {
    echo "<p><a href='{$f}'>{$f}</a></p>";
}

?>