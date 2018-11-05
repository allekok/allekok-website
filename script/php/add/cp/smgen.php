<?php

/* generating sitemap for search engines 
 *  the sitemap only contain poets , books, poems
 *  and no other pages. (for now).
*/

header("Content-type: text/html; charset=UTF-8");

require_once("../../functions.php");

$_sitemap = "sitemap.xml";

$db = 'index';
$q = "select * from auth";
include("../../condb.php");

$aths_num = mysqli_num_rows($query);    // number of poets
$tbls[0] = [];

while($res=mysqli_fetch_assoc($query)) {
    $tbls[] = explode("," , $res['bks']);
}

$sm = fopen( ABSPATH . "{$_sitemap}","w");

fwrite($sm , "<?xml version='1.0' encoding='UTF-8'?>\n");

fwrite($sm , '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"'."\n".'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

fwrite($sm , "\n<url>\n<loc>" . _SITE . "</loc>\n</url>");

for($i=1;$i<=$aths_num;$i++) {
    
    fwrite($sm , "\n<url>\n<loc>");
    fwrite($sm , _SITE . "poet:{$i}</loc>\n</url>");
    $bks_num = count($tbls[$i]);
    $bks_num_all += $bks_num;
    for($j = 1; $j <= $bks_num; $j++) {
        $_tbl = "tbl{$i}_{$j}";
        $q = "select * from {$_tbl}";

        $query = mysqli_query($conn, $q);
        
        fwrite($sm , "\n<url>\n<loc>");
        fwrite($sm , _SITE . "poet:{$i}/book:{$j}</loc>\n</url>");

        $hons_num = mysqli_num_rows($query);
        $hons_num_all += $hons_num;
        for($u=1; $u<=$hons_num; $u++) {
            fwrite($sm,"\n<url>\n<loc>");
            fwrite($sm, _SITE . "poet:{$i}/book:{$j}/poem:{$u}</loc>\n</url>");
            
        }
    }
}

fwrite($sm,"\n</urlset>");

fclose($sm);

echo "Ok! sitemap created.<br>";

$aths_num = num_convert($aths_num , "en" , "ckb");
$bks_num_all = num_convert($bks_num_all , "en" , "ckb");
$hons_num_all = num_convert($hons_num_all , "en" , "ckb");

$q = "UPDATE `stats` SET `aths_num`='$aths_num',`bks_num`='$bks_num_all',`hons_num`='$hons_num_all', `k`=1 WHERE 1";
$query = mysqli_query($conn, $q);

if($query) {
    echo "Ok! Stats updated.<br>Number of Poems: {$hons_num_all}<br>Number of books: {$bks_num_all}<br>Number of poets: {$aths_num}<br>Sitemap: "._SITE."{$_sitemap}<br>";
    
}


mysqli_close($conn);

?>

<br><br>
<button onclick="window.open('https://allekok.com/script/php/add/cp/make_search.php', '_blank','width=300,height=200','')" type="button">make_search.php</button><br>
<button onclick="window.open('https://allekok.com/script/php/add/cp/make_tbls.php', '_blank','width=300,height=200','')" type="button">make_tbls.php</button><br>
<button onclick="window.open('https://allekok.com/script/php/add/cp/make_poems.php', '_blank','width=300,height=200','')" type="button">make_poems.php</button>