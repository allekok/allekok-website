<?php
$no_head = isset($_GET['nohead']);
if(!$no_head) {
?>
    <!DOCTYPE html>
    <?php
    $requri = @filter_var($_SERVER['REQUEST_URI'],
			  FILTER_SANITIZE_STRING);
    if(@$ath)
	$ogimg = _SITE.get_poet_image($ath,true);
    else 
	$ogimg = _SITE.'/logo/logo-128.jpg';
    ?>
    <html dir='rtl' lang='ckb'>
	<head>
	    <script>	 
             if ('serviceWorker' in navigator)
		 navigator.serviceWorker.register('/sw.js', {scope: '/'});
	    </script>
	    <link rel='stylesheet'
		  href='/style/css/<?php
				   echo $_theme_dark ? 
					'main-dark-comp.css' :
					'main-comp.css';
				   ?>?v8'/>
	    <title>
		<?php echo $title; ?>
	    </title>
	    <meta charset='utf-8'>
	    <meta name='viewport' content='width=device-width, initial-scale=1'>
	    <meta name='description' content='<?php echo $desc; ?>'>
	    <meta name='keywords' content='<?php echo $keys; ?>'>
	    <meta property='og:title' content='<?php echo $desc; ?>' />
	    <meta property='og:description' content='' />
	    <meta property='og:type' content='website' />
	    <meta property='og:url' content='<?php
					     echo _SITE.$requri;
					     ?>' />
	    <meta property='og:image' content='<?php echo $ogimg; ?>' />
	    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
	    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	    <link rel="manifest" href="/favicon/site.webmanifest">
	    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
	    <link rel="shortcut icon" href="/favicon/favicon.ico">
	    <meta name="msapplication-TileColor" content="#2d89ef">
	    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
	    <meta name="theme-color" content="#ffffff">
	</head>
	<body>
	    <!-- Header -->
	    <header>
		<!-- Title -->
		<a href='<?php echo _SITE; ?>/'>
		    <h1><?php echo _TITLE; ?></h1>
		</a>
		    <!-- Search Icon -->
		    <button id='tS' class='header-icon material-icons'
				style='left:0'>search</button>
		<!-- Bookmarks Icon -->
		<button id='tL' class='header-icon material-icons'
			style='left:1.3em;display:none'
		>bookmark</button>
		<!-- Nav Icon -->
		<button id='tN' class='header-icon material-icons'
			style='left:2.6em'
		>more_vert</button>
	    </header>
	    <!-- Links -->
	    <div id="header-nav" style="display:none">
		<?php
		include('footer-links.php');
		?><a href="#footer" title="چوونە خوارەوە"
		  ><i class="material-icons"
		   >arrow_downward</i></a>
	    </div>
		<!-- Search Section -->
		<div id='search'>
		    <form id='search-form' action='/' method='GET'
		    ><input type='text'
			    id='search-key'
			    onkeyup='search(event)'
			    placeholder='گەڕان بۆ ...' name='q'
		     ><button type='submit'
			      id='search-btn'
			      class='material-icons'
		      >search</button></form>
		    <div id='search-res'></div>
		</div>
	    <!-- Bookmarks -->
	    <div id='tL-res' style='display:none'>
		<div id='tL-res-res'></div>
	    </div>
<?php
} // no-head
else
{
?>
    <script>
     document.title = `<?php echo html_entity_decode($title); ?>`;
    </script>
<?php
}
?>
