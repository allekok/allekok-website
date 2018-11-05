<?php

$files = scandir("./");

function func($i) {
    return "<a href='../?res={$i}'>{$i}</a>";
}

echo "<pre>";
print_r (array_map("func" , $files));
echo "</pre>";

?>