<!DOCTYPE html>
<?php
$requri = filter_var($_SERVER['REQUEST_URI'],
		     FILTER_SANITIZE_STRING);
if(!isset($color_num))
    $color_num = 0;
if(isset($ath))
    $ogimg = _SITE.get_poet_image($ath,false);
else 
    $ogimg = _SITE."style/img/logo.jpg";
?>
<html dir="rtl" lang="ckb">
    <head>
	<script>
         if ('serviceWorker' in navigator)
	     navigator.serviceWorker.register('/sw.js', {scope: '/'});
	</script>
	<link rel='stylesheet'
	      href='/style/css/<?php
			       echo (isset($_COOKIE['theme']) and
				   $_COOKIE['theme'] == 'dark') ? 
				    "main-dark.css" : 
				    "main.css";
			       ?>?v34'/>
	<title>
	    <?php echo $title; ?>
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="<?php echo($desc); ?>">
	<meta name="keywords" content="<?php echo($keys); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/style/img/logo.jpg">
	
	<meta property="og:title" content="<?php echo($desc); ?>" />
	<meta property="og:description" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php 
					 echo "https://".$_SERVER["HTTP_HOST"].$requri; 
					 ?>" />
	<meta property="og:image" content="<?php echo($ogimg); ?>" />
	
	<style>
	 header {
             background:<?php echo $colors[$color_num][0]; ?>;
	 }
	 <?php if(@$ath) { ?>
	 sup {
             color:<?php echo($colors[$color_num][0]) ?>;
             padding:0 3px;
	 }
	 @media only screen and (max-width:450px){
	     #poets{padding-bottom:0}
             .poetimg {width:85%}
             .bks a {max-width:100%}
	 }
	 @media only screen and (max-width:371px){
             .next {padding: 0 3% .15em .5em}
             .prev {padding: 0 .5em .15em 3%}
	 }
	 <?php } ?>
	 .bk-comp {
             color:<?php echo($colors[$color_num][0]); ?>;
	 }
	 .loader {
             border-top-color:<?php echo($colors[0][0]); ?>;
	 }
	 input:focus, textarea:focus{
	     border-top-color:<?php echo($colors[0][0]); ?>;
	 }
	</style>
	<script>
         const colors = [<?php
			 require_once(ABSPATH."script/php/colors.php");
			 foreach ($colors as $c) {
			     echo "['{$c[0]}', '{$c[1]}', '{$c[2]}', '{$c[3]}'],";
			 }
			 ?>];
	</script>
    </head>
    <body>
	<header>
	    <?php if(!isset($is_it_search)) { ?>
		<button id='tS' class='seartog'>
		    <i class="material-icons seartog-i"
		       style="font-weight:bold">search</i>
		</button>
	    <?php } ?>
	    <button class='seartog' id="tL"
		    style="right:.5em;left:auto;display:none">
		<i class="material-icons seartog-i">bookmark</i>
	    </button>
	    <a href="<?php echo _SITE; ?>"
	    ><h1><?php echo _TITLE; ?></h1></a>
	</header>
	<?php if(!isset($is_it_search)) { ?>
	    <div id='search'>
		<form id="search-form" action="/" method="GET"
		><input type='text'
			id='search-key'
			onkeyup="search(event)"
			placeholder='گەڕان بۆ ...' name='q'
		 ><button type="submit"
			  id="search-btn"
			  class='button'
		  ><i class='material-icons'
		      style='font-size:2em'
		   >search</i></button></form>
		<div id='search-res'></div>
	    </div>
	<?php } ?>
	<div id="tL-res" style="display:none;">
	    <div id="tL-res-res"></div>
	</div>
