<!DOCTYPE HTML>
<?php
// statistics
$f = fopen("stats.txt", "a");
$dttd = date("Y m d h:i:sa");
$reff = empty($_SERVER['HTTP_REFERER']) ? "" : $_SERVER['HTTP_REFERER'];
fwrite($f, "{$_SERVER['REMOTE_ADDR']}\t{$dttd}\t{$_SERVER['REQUEST_URI']}\t{$reff}\n");
fclose($f);

if(!isset($color_num)) {
    $color_num = 0;
}
if($color_num!=0) {
    $ogimg = _SITE . get_poet_image($ath, "profile",0);
} else {
    $ogimg = _SITE.get_poet_image(0, "pro-460",0);
}
?>
<html dir="rtl" lang="ckb">
    <head>
	<script>
         if ('serviceWorker' in navigator) navigator.serviceWorker.register('/sw.js', {scope: '/'});
	</script>
	<link rel='stylesheet' href='/style/css/main.css?v11' />
	<title>
	    <?php echo($title); ?>
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="<?php echo($desc); ?>">
	<meta name="keywords" content="<?php echo($keys); ?>">
	<link href="/favicon.ico" rel="shortcut icon"/>
	<link rel="apple-touch-icon" href="/style/img/poets/profile/profile_0.jpg">
	
	<meta property="og:title" content="<?php echo($desc); ?>" />
	<meta property="og:description" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" />
	<meta property="og:image" content="<?php echo($ogimg); ?>" />
	
	<style>
	 body {
             border-top:.4em solid <?php if($color_num) {echo $colors[$color_num][0];}else{echo "transparent";} ?>;
	 }
	 .ptr {
             background:<?php echo($colors[$color_num][2]) ?>;
	 }
	 <?php if($color_num) { ?>
	 @keyframes ll {
             0% {text-shadow:none;}
             20% {text-shadow:0 0 10px <?php echo $colors[$color_num][0]; ?>;}
             50% {text-shadow:0 0 20px <?php echo $colors[$color_num][0]; ?>;}
             100% {text-shadow:none;}
	 }
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
	</style>
	<script>
         var uritg = "<?php echo _SITE; ?>";
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
		    <i class="material-icons seartog-i">search</i>
		</div>
	    <?php } ?>
	    <div class='seartog' role='button' id="tL" style="right:.3em;left:auto;display:none;">
		<i class="material-icons seartog-i"<?php if(!$color_num)    echo " style='color:red'"; ?>>bookmark</i>
	    </div>

	    <a href="<?php echo _SITE; ?>"><h1 style="color:<?php if($color_num == 0) {echo "rgb(0,210,50)";} else { echo "#555"; } ?>">ئاڵەکۆک</h1></a>
	    <span style='color:#555'><?php echo($t_desc) ?></span>
	    
	</header>


	<?php include("search-sec.php"); ?>
	<div id="tL-res" style="display:none;">
	    <div id="tL-res-res"></div>
	</div>
