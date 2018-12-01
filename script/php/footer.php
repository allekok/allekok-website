<footer><a href="<?php echo _SITE; ?>about">ئاڵەکۆک؟</a><a href="/desktop/">دێسکتاپ</a><a href="/mobile/">مۆبایل</a><a href='/pitew/index.php'>نووسینی شێعر</a><a href="<?php echo _SITE; ?>pitew/first.php">پتەوکردن</a><a href="<?php echo _SITE; ?>dev/tools/">کۆد</a><!--<a href="<?php echo _SITE; ?>tewar/">تەوار</a>--><a href="<?php echo _SITE; ?>thanks">سپاس</a><!--<a><?php
                $date1 = date_create(date("Y-m-d"));
                $date2 = date_create("2018-12-15");
                $diff = date_diff($date1,$date2,true);
                $opc = ($diff->days/100 > 0.15) ? $diff->days/100 : 0.15;
                echo "<span style='opacity:{$opc};color: rgb(204,51,0);'><span style='font-weight:bold;'>" . num_convert($diff->days,"en","ckb") . "</span></span>";
            ?></a>--></footer>

<script async src="/script/js/main1.4.js?v10"></script>

</body>
</html>