<?php

	require_once("../script/php/colors.php");
	require_once("../script/php/constants.php");
	require_once("../script/php/functions.php");

$title = _TITLE . " &raquo; پتەوکردنی ئاڵەکۆک";
$desc = "پتەوکردنی ئاڵەکۆک - چۆن دەتوانن ئاڵەکۆک دەوڵەمەندتر کەن؟";
$keys = _KEYS;
$t_desc = "";
$t_class = "ltitle";
$color_num = 0;

	require('../script/php/header.php');
?>

<div id="poets" style="max-width:850px">
    
<p id='adrs'>
    <?php
        $__allekok_url = _SITE;
    ?>
<a href="<?php echo $__allekok_url; ?>" style='background-image:url(/style/img/allekok.png);background-repeat:no-repeat;background-position: 3.7em 0.1em;padding-right: 1.8em;background-size: 1.6em;'>ئاڵەکۆک</a>
<i style='vertical-align:middle;' class='material-icons'>keyboard_arrow_left</i>
<i style='vertical-align:middle;color:transparent;border-radius:100%;border:2px dashed #aaa;font-size:1.05em' class='material-icons'>person</i> پتەوکردنی ئاڵەکۆک
</p>

    <h1 style="background: #f4f4f4;color: #222;display: inline-block;padding: 0.1em 0.8em 0;border-radius: 5px;margin: 1em 0;">
        پتەوکردنی ئاڵەکۆک
    
    </h1>
    <br>
    <section class='pitewsec'>
        <a href="index.php">
            <i class='material-icons' style='color:rgb(0, 138, 230)'>note_add</i>
            <h3>
                نووسینی شێعر
                <br>
                <small>
                    ئەگەر بۆخۆتان شاعیرن و دەتانهەوێ شێعرەکانتان لەسەر ئاڵەکۆک دابنێن یان ئەگەر دەتانهەوێ شێعری شاعیرانی پێشووتر بنووسنەوە، لێرە کرتە بکەن.
                </small>
            </h3>
        </a>
    </section><section class='pitewsec'>
        <a href="poet-image.php">
            <i class='material-icons' style='color:purple;'>image</i>
            <h3>
                ناردنی وێنەی شاعیران
                <br>
                <small>
                    ئەگەر وێنەی یەکێک لەو شاعیرانەی کە لەسەر ئاڵەکۆک وێنەیان نیە لەلاتانە، یان وێنەیەکی باشتری هەرکام لە شاعیران‌و لەلایە، بۆ ناردنی لێرە کرتە بکەن.
                </small>
            </h3>
        </a>
    </section><section class='pitewsec'>
        <a href="edit-poet.php">
            <i class='material-icons' style='color:yellowgreen;'>person</i>
            <h3>
                نووسینی زانیاری سەبارەت بە شاعیران
                <br>
                <small>
                    ئەگەر زانیاری زیادترتان سەبارەت بە هەریەک لە شاعیران هەیە یان هەڵەیەک لە زانیاریەکانی سەر ئاڵەکۆک دەبینن، دەتوانن بە کرتە کردن لێرە ئاگادارمان کەنەوە
                </small>
            </h3>
        </a>
    </section><section class='pitewsec'>
        <a href="/comments/">
            <i class='material-icons' style='color:red;'>insert_drive_file</i>
            <h3>
                ڕاست‌کردنەوەی هەڵەکانی ناو شێعر
                <br>
                <small>
                    ئەگەر هەڵەیەک لەناو هەریەک لە شێعرەکان دا بەدی دەکەن دەتوانن لە ژێر ئەو شێعرە لە بەشی نووسینی بیر و ڕا دا، ڕەخنەکەتان بنووسن تا لە زووترین کات دا پێداچوونەوەی بەسەردا بکرێ.
                </small>
            </h3>
        </a>
    </section></section><section class='pitewsec'>
        <a href="/about">
            <i class='material-icons' style='color:blue;'><img src='/style/img/poets/profile/profile_0.jpg' style='opacity: 0.75;border: 2px dashed;border-radius: 100%;width: 0.9em;margin-bottom: 0.1em;'></i>
            <h3>
                ئاڵەکۆک؟
                <br>
                <small>
                    ئەگەر کێشەیەک لە کاری ئاڵەکۆک دا هەیە یان پێشنیارێک‌و بۆ چاکتر بوونی ئاڵەکۆک هەیە، تکایە لێرە کرتە بکەن و لەبەشی "ئاڵەکۆک‌تان بەلاوە چۆنە؟" بۆمان بنووسن.
                </small>
            </h3>
        </a>
    </section>
    
</div>

<?php
	require_once("../script/php/footer.php");
?>