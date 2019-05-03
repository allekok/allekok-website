<!DOCTYPE html>
<?php
$requri = filter_var($_SERVER['REQUEST_URI'],
		     FILTER_SANITIZE_STRING);
if(!isset($color_num))
    $color_num = 0;
if(isset($ath))
    $ogimg = _SITE.get_poet_image($ath,false);
else 
    $ogimg = _SITE.get_poet_image(0,false);
?>
<html dir="rtl" lang="ckb">
    <head>
	<script>
         if ('serviceWorker' in navigator)
	     navigator.serviceWorker.register('/sw.js', {scope: '/'});
	</script>
	<link rel='stylesheet' href='/style/css/main.css?v22'/>
	<title>
	    <?php echo $title; ?>
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="<?php echo($desc); ?>">
	<meta name="keywords" content="<?php echo($keys); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/style/img/poets/profile/profile_0.jpg">
	
	<meta property="og:title" content="<?php echo($desc); ?>" />
	<meta property="og:description" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo "https://".$_SERVER["HTTP_HOST"].$requri; ?>" />
	<meta property="og:image" content="<?php echo($ogimg); ?>" />
	
	<style>
	 header {
             background:<?php echo $colors[$color_num][0]; ?>;
	 }
	 .ptr {
             background:<?php echo($colors[$color_num][2]) ?>;
	 }
	 <?php if(isset($ath)) { ?>
	 sup {
             color:<?php echo($colors[$color_num][3]) ?>;
             padding:0 2px;
	 }
	 .gallery {
             margin-top:0.5em;
             margin-bottom:-1em;
	 }
	 @media only screen and (max-width:450px){#poets{padding-bottom:0;}
             .poetimg {
		 width:85%;
             }
             .bks a {
		 max-width:100%;
             }
	 }
	 @media only screen and (max-width:371px){
             .next {
		 padding: 0 3% 0.15em .5em;
             }
             .prev {
		 padding: 0 .5em 0.15em 3%;
             }
	 }
	 <?php } ?>
	 .bk-comp {
             color:<?php echo($colors[$color_num][0]) ?>;
	 }
	 .loader {
             border-top-color:<?php echo($colors[$color_num][0]) ?>;
	 }
	</style>
	<script>
         var colors = [<?php
		       
		       require_once("colors.php");
		       
		       foreach ($colors as $c) {
			   
			   echo "['{$c[0]}', '{$c[1]}', '{$c[2]}', '{$c[3]}'],";
			   
		       }
		       
		       ?>];
	</script>
	
    </head>

    <body>

	<header>
	    
	    <?php if(!isset($is_it_search)) { ?>
		<div id='tS' role='button' class='seartog'>
		    <i class="material-icons seartog-i" style="font-weight:bold">search</i>
		</div>
	    <?php } ?>
	    
	    <div class='seartog' role='button' id="tL" style="right:.5em;left:auto;display:none">
		<i class="material-icons seartog-i">bookmark</i>
	    </div>

	    <a href="<?php echo _SITE; ?>"><h1><?php echo _TITLE; ?></h1></a>
	</header>


	<div id='search' style='max-width:1200px;margin-right:auto;margin-left:auto'>
	    <form id="live-search-form" action="/" method="GET"><input type='text' id='search-key' onkeyup="search(event)" placeholder='گەڕان بۆ ...' name='q'><button type="submit" id="search-btn" class='button'><i class='material-icons' style='font-size:2em;'>search</i></button></form>
	    
	    <div id='search-res'></div>
	</div>

	<div id="tL-res" style="display:none;">
	    <div id="tL-res-res"></div>
	</div>
