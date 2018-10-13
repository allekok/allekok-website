<?php
    $x = SHA256(uniqid(SHA256(uniqid(uniqid("",TRUE),TRUE)),TRUE));
    echo $x;
    echo "<br>";
    echo(SHA256($x))
?>