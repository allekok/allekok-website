<?php
$color_num = 0;
?>
<!DOCTYPE HTML>
<html dir="rtl">
    <head>

        <link rel="stylesheet" href="/style/css/main.css?v10">
        <script type="text/javascript">
	 var uritg = "<?php echo _SITE; ?>";
	</script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            ئاڵەکۆک
        </title>
        <style>
         #search {
             display: block;
         }
         #search-key {
             background: #fafafa;
         }
         #live-search-form {
             box-shadow: 0 2px 2px #eee;
         }
         .nf_p a {
             border-bottom: 1px solid #ccc;
             color:#444;
             font-size: 0.6em;
             padding:0.1em 0.3em;
             margin:0 0.5em;
         }
         .nf_p a:hover {
             text-decoration: none;
             border-bottom: 0;
             background: #eee;
         }
        </style>
    </head>
    <body style="text-align:center;background: white;">
        <img src="/style/img/poets/profile/profile_0.jpg" style="max-width:100%;display:block;margin:auto" alt="ئاڵەکۆک">
        <h1 style='font-size:1em'>
            ئەم لاپەڕە لەسەر ئاڵەکۆک نیە.
        </h1>

        <p class='nf_p' style="margin-bottom:0.5em;">
            <a href="<?php echo(_SITE); ?>">
                ئاڵەکۆک
            </a>
            <a href="<?php echo(_SITE); ?>about#message">
                پەیوەندی کردن
            </a>
        </p>
        
        <?php include("search-sec.php"); ?>

        <script type="text/javascript">
         document.getElementById("search-key").focus();
        </script>
	<script async src="/script/js/main.js?v7"></script>
    </body>
</html>
