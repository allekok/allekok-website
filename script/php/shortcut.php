<?php
/*
 * Input: REQUEST:q
 * Redirect to matched url by key(q)
 */

/* Input */
$q = isset($_REQUEST['q']) ?
     strtolower(trim(
	     filter_var($_REQUEST['q'],	FILTER_SANITIZE_STRING))) :
     die();

/* Associative array */
$assoc = [
	"کوردی" => "https://github.com/allekok/diwan/raw/master/%DA%A9%D9%88%D8%B1%D8%AF%DB%8C%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86%D8%8C%20%D8%A8%DB%95%D8%B1%DA%AF%DB%8C%20%DB%8C%DB%95%DA%A9%DB%95%D9%85.pdf",
	"kurdi" => "https://github.com/allekok/diwan/raw/master/%DA%A9%D9%88%D8%B1%D8%AF%DB%8C%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86%D8%8C%20%D8%A8%DB%95%D8%B1%DA%AF%DB%8C%20%DB%8C%DB%95%DA%A9%DB%95%D9%85.pdf",
	"sware" => "https://github.com/allekok/diwan/raw/master/%D8%B3%D9%88%D8%A7%D8%B1%DB%95%20%D8%A6%DB%8C%D9%84%D8%AE%D8%A7%D9%86%DB%8C%20%D8%B2%D8%A7%D8%AF%DB%95%20-%20%D8%AA%D8%A7%D9%BE%DB%86%20%D9%88%20%D8%A8%D9%88%D9%88%D9%85%DB%95%D9%84%DB%8E%DA%B5-%20.pdf",
	"mem-u-zin" => "https://github.com/allekok/diwan/raw/master/%D8%AE%D8%A7%D9%86%DB%8C%20-%20%D9%85%DB%95%D9%85%20%D9%88%20%D8%B2%DB%8C%D9%86%20-%20%D9%84%DB%95%DA%AF%DB%95%DA%B5%20%D9%88%DB%95%D8%B1%DA%AF%DB%8E%DA%95%D8%A7%D9%88%DB%8C%20%D9%87%DB%95%DA%98%D8%A7%D8%B1.pdf",
	"mem-u-zin-chapi-yekem" => "https://github.com/allekok/diwan/raw/master/%D8%AE%D8%A7%D9%86%DB%8C%20-%20%D9%85%DB%95%D9%85%E2%80%8C%D9%88%D8%B2%DB%8C%D9%86%20-%20%D9%88%DB%95%D8%B1%DA%AF%DB%8E%DA%95:%D9%87%DB%95%DA%98%D8%A7%D8%B1%20-%20%DA%86%D8%A7%D9%BE%DB%8C%20%DB%8C%DB%95%DA%A9%DB%95%D9%85.pdf",
	"heriq" => "https://github.com/allekok/diwan/raw/master/%D8%AD%DB%95%D8%B1%DB%8C%D9%82%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86%D8%8C%20%D8%A6%DB%95%D9%86%DB%8C%D8%B3%DB%8C.pdf",
	"razi" => "https://github.com/allekok/diwan/raw/master/%DA%95%D8%A7%D8%B2%DB%8C%20-%20%DA%86%D9%88%D8%A7%D8%B1%DB%8C%D9%86%DB%95%DA%A9%D8%A7%D9%86%DB%8C%20%D8%A8%D8%A7%D8%A8%DB%95%D8%AA%D8%A7%D9%87%DB%8C%D8%B1%DB%8C%20%D8%B9%D9%88%D8%B1%DB%8C%D8%A7%D9%86%20-%20%D9%88%DB%95%D8%B1%DA%AF%DB%8E%DA%95%D8%A7%D9%86%DB%8C%20%D8%B3%DB%86%D8%B1%D8%A7%D9%86%DB%8C.pdf",
	"hemin" => "https://github.com/allekok/diwan/raw/master/%D9%87%DB%8E%D9%85%D9%86%20-%20%D8%A8%D8%A7%D8%B1%DA%AF%DB%95%DB%8C%20%DB%8C%D8%A7%D8%B1%D8%A7%D9%86%20(%DA%A9%DB%86%D9%85%DB%95%DA%B5%DB%8C%20%D8%B4%DB%8E%D8%B9%D8%B1%DB%8C%20%D9%87%DB%8E%D9%85%D9%86).pdf",
	"mewlewi-vejin" => "http://vejinbooks.com/view/%D8%AF%DB%8C%D9%88%D8%A7%D9%86%DB%8C_%D9%85%DB%95%D9%88%D9%84%DB%95%D9%88%DB%8C/%DA%BE%DB%95%D8%B1%DA%86%DB%8C%D8%AA_%D8%AF%D8%A7%D8%A8%D9%88%D9%88_%D9%BE%DB%8E%D9%85",
	"piremerd" => "https://github.com/allekok/diwan/raw/master/%D9%BE%DB%8C%D8%B1%DB%95%D9%85%DB%8E%D8%B1%D8%AF%20-%20%D9%BE%DB%8C%D8%B1%DB%95%D9%85%DB%8E%D8%B1%D8%AF%20%D9%88%20%D9%BE%DB%8E%D8%AF%D8%A7%DA%86%D9%88%D9%88%D9%86%DB%95%D9%88%DB%95%DB%8C%DB%95%DA%A9%DB%8C%20%D9%86%D9%88%DB%8E%DB%8C.pdf",
	"nali-nami" => "https://github.com/allekok/diwan/raw/master/%D9%86%D8%A7%D9%84%DB%8C%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86.pdf",
	"nali-giw" => "https://github.com/allekok/diwan/raw/master/%D9%86%D8%A7%D9%84%DB%8C%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86%20-%20%DA%86%D8%A7%D9%BE%DB%8C%20%DA%AF%DB%8C%D9%88.pdf",
	"mehwi" => "https://github.com/allekok/diwan/raw/master/%D9%85%DB%95%D8%AD%D9%88%DB%8C%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86.pdf",
	"tahir" => "https://github.com/allekok/diwan/raw/master/%D8%AA%D8%A7%D9%87%DB%8C%D8%B1%20%D8%A8%DB%95%DA%AF%DB%8C%20%D8%AC%D8%A7%D9%81%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86.pdf",
	"muxtar" => "https://github.com/allekok/diwan/raw/master/%D8%A6%DB%95%D8%AD%D9%85%DB%95%D8%AF%20%D9%85%D9%88%D8%AE%D8%AA%D8%A7%D8%B1%20%D8%AC%D8%A7%D9%81%20-%20%D8%AF%DB%8C%D9%88%D8%A7%D9%86%20-%20%DA%86%D8%A7%D9%BE%DB%8C%DB%B2.pdf"
];

/* Redirection */
if(isset($assoc[$q])) redirect($assoc[$q]);

/* Functions */
function redirect ($url, $statusCode = 303) {
	header('Location: ' . $url, true, $statusCode);
	die();
}
?>
