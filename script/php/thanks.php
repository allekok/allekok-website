<style>
    p {
        font-size: 0.6em;margin:0.3em 0.6em 0;line-height:3;border-bottom: 2px dashed #eee;text-align: right;padding:.2em 1em;
    }
    a {
        font-size: inherit;padding:0 0.6em;border-radius:2px;
    }
</style>
<div id="poets" style="margin-bottom:4em;max-width:800px">
    <h1 style="margin-bottom:.5em">
        سپاس و پێ‌زانین بۆ:
    </h1>
    
    <p>
        <a href="http://ganjoor.net/" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[2][3]; ?>;background-color:<?php echo $colors[2][2]; ?>;">گنجور</a> &rsaquo; بۆ بوون بە هۆی دروست بوونی ئاڵەکۆک
    </p>
    <p>
        <a href="https://plus.google.com/+RebwarTahir" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[3][3]; ?>;background-color:<?php echo $colors[3][2]; ?>;">Rebwar Tahir</a> &rsaquo; بۆ بەشێکی زۆر لە وێنەی شاعیران
    </p>
    <p>
        <a href="http://www.vejinbooks.com/" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[13][3]; ?>;background-color:<?php echo $colors[13][2]; ?>;">ڤەژین بوکس</a> &rsaquo; بۆ بەشێکی زۆر لە شێعرەکان
    </p>
    <p>
        <a href="http://diyako.yageyziman.com/هۆنراوە/" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[15][3]; ?>;background-color:<?php echo $colors[15][2]; ?>;">فێرگەی زمانی کوردی</a> &rsaquo; بۆ دیوانی شێعری بەشێک لە شاعیران
    </p>
    <p>
        <a href="http://www.bokan.de/laperekan/Edebiat/awat/Awat.htm" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[6][3]; ?>;background-color:<?php echo $colors[6][2]; ?>;">Rojhalat/Bokan</a> &rsaquo; بۆ 
        <a href="<?php echo _SITE; ?>poet:62/book:1" style="color:<?php echo $colors[18][3]; ?>;background-color:<?php echo $colors[18][2]; ?>;">دیوانی شاری دڵی، ئاوات</a>
    </p>
    <p>
        <a href="https://t.me/chapkagolibevena" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[1][3]; ?>;background-color:<?php echo $colors[1][2]; ?>;">کاناڵی تێلێگرامی چەپکەگوڵ</a> و کەماڵ ڕەحمانی &rsaquo; بۆ 
        <a href="<?php echo _SITE; ?>poet:65/book:1" style="color:<?php echo $colors[21][3]; ?>;background-color:<?php echo $colors[21][2]; ?>;">دیوانی شەونمی، حەقیقی</a>
    </p>
    <p>
        <a href="https://allekok.com/poet:80" style="color:<?php echo $colors[80][3]; ?>;background-color:<?php echo $colors[80][2]; ?>;">کەماڵ ڕەحمانی</a>
        &rsaquo;
        بۆ
        <a href="https://allekok.com/pitew/poem-list.php?name=%DA%A9%DB%95%D9%85%D8%A7%DA%B5%20%DA%95%DB%95%D8%AD%D9%85%D8%A7%D9%86%DB%8C" style="color:rgb(0, 138, 230);background-color:rgba(0, 153, 255,0.05);">
             نووسینی 
        <span style="color:#444; opacity:0;" id="pitew-stats">.....</span>
        شێعر لەسەر ئاڵەکۆک
        </a>
    
    <script>
        var name = "کەماڵ ڕەحمانی";
        var res = document.getElementById("pitew-stats");
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            if(this.responseText !== "") {
                res.innerHTML = this.responseText; 

                res.style.animation = "tL 1.2s ease forwards";
            }
        }
        
        xmlhttp.open("get", `/pitew/stats.php?contributor=${name}`, true);
        xmlhttp.send();
    </script>
    
    </p>
    
    <p>
        <a href="http://telegram.me/Kurdish_Poetry" target='_blank' rel='noopener noreferrer nofollow' style="color:<?php echo $colors[20][3]; ?>;background-color:<?php echo $colors[20][2]; ?>;">کەناڵی تێلێگرامی شیعر و هۆنراوە</a>
        &rsaquo; 
        بۆ بەشێکی چووک لە 
        <a href="/poet:82/book:1" style="color:<?php echo $colors[16][3]; ?>;background-color:<?php echo $colors[16][2]; ?>;">
         شێعرەکانی سافیی هیرانی
        </a>
    </p>
    <p style="text-align:center;">
        سپاس بۆ هەموو ئەو کەسانەی کە لە پتەوکردنی ئاڵەکۆک‌دا یارمەتی‌مان دەدەن.
    </p>
    
</div>