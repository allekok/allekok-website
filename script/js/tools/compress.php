<?php
require_once("constants.php");

/* Using 'terser' a node.js package */
const input = main_comp;
const output = main_comp;

exec("terser '" . input . "' -c -m -o '" . output . "'");
?>
