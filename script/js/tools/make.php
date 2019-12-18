<?php
const main_js = "main.js";
const constants_js = "constants.js";
const output = "main-comp.js";

file_put_contents(output,
		  file_get_contents(constants_js) .
		  "\n" . file_get_contents(main_js));
?>
