<?php
echo null !== @$argv[1] ?
     hash('SHA512', $argv[1])."\n" : "";
?>
