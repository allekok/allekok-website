<?php
/* Using 'javascript-minifier.com's API. */
const api = "https://javascript-minifier.com/raw";
const input = "main-comp.js";
const output = "main-comp.js";

$content = file_get_contents(input);

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => api,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"],
    CURLOPT_POSTFIELDS => http_build_query(["input"=>$content]),
]);
$content = curl_exec($ch);
curl_close($ch);

file_put_contents(output, $content);
?>
