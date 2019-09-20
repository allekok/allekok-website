<?php
const _input = ['main.css','main-dark.css'];
const _output = ['main-comp.css','main-dark-comp.css'];

foreach(_input as $i=>$input)
{
    $css = file_get_contents($input);

    // Remove Comments
    $css = preg_replace('/\/\*.*\*\//u', '', $css);
    // Remove New-lines
    $css = preg_replace('/[\n\r\t]+/u', '', $css);
    // ' {}(),:; ' -> '{}'
    $css = preg_replace('/\s*([{},:;\(\)])\s*/', '$1', $css);
    // Replace many spaces with one space
    $css = preg_replace('/\s+/', ' ', $css);
    // Replace ';}' -> '}'
    $css = str_replace(';}', '}', $css);

    file_put_contents(_output[$i], $css);
}
?>
