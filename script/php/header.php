<!DOCTYPE HTML>
<?php
    // statistics
    $f = fopen("stats.txt", "a");
    $dttd = date("Y m d h:i:sa");
    fwrite($f, "{$_SERVER['REMOTE_ADDR']}\t{$dttd}\t{$_SERVER['REQUEST_URI']}\t{$_SERVER['HTTP_REFERER']}\n");
    fclose($f);

        if(!isset($color_num) && !$is_it_search) {
            $color_num = 0;
            $fhclass="fheader";
            $fhs = "y";

        } elseif($is_it_search && !isset($color_num)) {
            $color_num = count($colors) - 1;
            $fhclass="fheader";
            $fhs = "y";

        }
        if(isset($color_num) && $color_num!=0 && !$thanks && !$about && !$is_it_search) {

                $ogimg = _SITE . get_poet_image($color_num, "profile",0);
            
        } else {
            $ogimg = _SITE.get_poet_image(0, "pro-460",0);
        }
    ?>
<html dir="rtl">
<head>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js', {scope: '/'});
        }
        var uritg = "<?php echo _SITE; ?>";
    
        var colors = [<?php
        
        require_once("colors.php");

        foreach ($colors as $c) {
            
            echo "['{$c[0]}', '{$c[1]}', '{$c[2]}', '{$c[3]}'],";
            
        }
    
    ?>];
    
    </script>
			
	<title>
	    <?php echo($title); ?>
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='/style/css/main2.5.css?v6' />

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
        header {
            border-top:.4em solid <?php if($color_num) {echo $colors[$color_num][0];}else{echo "transparent";} ?>;
        }
      .seartog {
          position:absolute;
          right:.4em;
          cursor:pointer;
          top:<?php if(isset($fhs)) {echo("1");}else{echo("1");} ?>em;
      }
      .seartog-i {
          font-size:<?php if(isset($fhs)){echo("1.6");}else{echo("1.6");} ?>em;
      }
    @keyframes ll {
        0% {text-shadow:none;}
        20% {text-shadow:0 0 10px <?php echo $colors[$color_num][0]; ?>;}
        100% {text-shadow:0 0 20px <?php echo $colors[$color_num][0]; ?>;}
    }
    @keyframes concentrate {
        0% { border-radius:0 0 <?php if($fhclass){echo "12% 12%";}else{echo "15% 15%";}?>;box-shadow: 0 8px 2px -8px #ccc; }
        70% { border-radius:0 0 <?php if($fhclass){echo "25% 25%";}else{echo "22% 22%";}?>;box-shadow: 0 8px 2px -6px #aaa; }
        100% { border-radius:0;box-shadow: 0 8px 2px -8px #ccc; }
    }
    @keyframes smile {
        0% { border-radius:0;box-shadow: 0 8px 2px -8px #ccc; }
        50% { border-radius:0 0 <?php if($fhclass){echo "30% 30%";}else{echo "27% 27%";}?>;box-shadow: 0 8px 2px -6px #aaa; }
        100% { border-radius:0 0 <?php if($fhclass){echo "12% 12%";}else{echo "15% 15%";}?>;box-shadow: none;}
    }
    .ptr {
        margin-top:1em;
        padding: 0.75em 0 0.1em;
        font-size:1em;
        background:<?php echo($colors[$color_num][2]) ?>;
    }
    <?php if($color_num) { ?>
    sup {
        color:<?php echo($colors[$color_num][3]) ?>;
        padding:0 2px;
    }
    .gallery {
        margin-top:0.5em;
    }
    @media only screen and (max-width:450px){#poets{padding-bottom:0;}
        .poetimg {
            width:85%;
        }
        .bks a {
            max-width:100%;
        }
        .gallery {
            margin-bottom:-17px;
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
        vertical-align: middle;
        text-shadow: 0 0 3px #fff;
        font-size: 0.8em;
        font-weight: bold;
        height: 0.4em;
        padding-right: 0.2em;
        cursor:pointer;
    }
    .h {
    direction:rtl;
    }
    .ptrh {
        font-size:0.58em;
        padding-bottom:0.9em;
    }
    .d {
        font-size:0.8em;
        color:#333;
        padding:1em;
    }
  </style>
</head>

<body>

<header <?php if(isset($fhclass)) {echo("class='$fhclass'");} ?>>
    
    <?php if(!$is_it_search) { ?>
<div id='tS' role='button' class='seartog'>
    <i class="material-icons seartog-i">search</i>
</div>
    <?php } ?>
<div class='seartog' role='button' id="tL" style="left:.3em;right:auto;display:none;">
    <i class="material-icons seartog-i"<?php if(!$color_num)    echo " style='color:red'"; ?>>bookmark</i>
</div>

<a class="<?php echo($t_class) ?>" href="<?php echo _SITE; ?>"><h1 style="color: #555;"><span style="<?php if($color_num == 0) {echo "color:rgb(0,210,50)";} ?>">ئاڵە</span>کۆک</h1></a>
    <span style='color:#555'><?php echo($t_desc) ?></span>
    
</header>


<?php include("search-sec.php"); ?>
<div id="tL-res" style="display:none;">
<div id="tL-res-res"></div>
</div>
