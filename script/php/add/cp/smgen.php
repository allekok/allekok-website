<meta charset="utf-8">
<title>سمجین</title>
<?php

$_sitemaps = array(
    array("sitemap.xml", "https://allekok.com/"),
    array("sitemap-h.xml", "http://allekok.com/"),
    array("sitemap-hwww.xml", "http://www.allekok.com/"),
    array("sitemap-swww.xml", "https://www.allekok.com/")
    );

$hons_num = 0;
$bks_num = 0;
$aths_num = 0;

$db = 'index';
$q = "select * from auth";
include("../../condb.php");

$msnum = mysqli_num_rows($query);
$i = 1;
$aths_num = $msnum;
$pgnum = ceil($msnum / 52);

while($res=mysqli_fetch_assoc($query)) {
    $tbls[$i] = explode(",",$res['bks']);
    $i++;
}

//mysqli_close($conn);

foreach($_sitemaps as $_S) {

$sm = fopen("../../../../$_S[0]","w");

fwrite($sm,"<?xml version='1.0' encoding='UTF-8'?>\n");

fwrite($sm,'<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"'."\n".'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

fwrite($sm,"\n<url>\n<loc>");
fwrite($sm,"$_S[1]</loc>\n</url>");
/*
for($t=1; $t<=$pgnum; $t++) {
    fwrite($sm,"\n<url>\n<loc>");
    fwrite($sm,"$_S[1]?page=$t</loc>\n</url>");
}*/

for($i=1;$i<=$msnum;$i++) {

        //$db = "db". $i;
        //$db = "index";
        
        fwrite($sm,"\n<url>\n<loc>");
        fwrite($sm,"$_S[1]poet:$i</loc>\n</url>");
        $bks_num+=count($tbls[$i]);
        for($j=1;$j<=count($tbls[$i]);$j++) {
            $_tbl = "tbl" . $i . "_" . $j;
            $q = "select * from " . $_tbl;
            //include("../../condb.php");
            $query = mysqli_query($conn, $q);
                fwrite($sm,"\n<url>\n<loc>");
                fwrite($sm, "$_S[1]poet:$i/book:$j</loc>\n</url>");
            //mysqli_close($conn);
            $hons_num += mysqli_num_rows($query);
            for($u=1; $u<=mysqli_num_rows($query); $u++) {
                fwrite($sm,"\n<url>\n<loc>");
                fwrite($sm, "$_S[1]poet:$i/book:$j/poem:$u</loc>\n</url>");
                
            }
        }
}

fwrite($sm,"\n</urlset>");

fclose($sm);

echo "ok!";

$aths_num = str_replace(array('0','1','2','3','4','5','6','7','8','9'),
    array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
    $aths_num);
$bks_num = str_replace(array('0','1','2','3','4','5','6','7','8','9'),
    array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
    $bks_num);
$hons_num = str_replace(array('0','1','2','3','4','5','6','7','8','9'),
    array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
    $hons_num);

$q = "UPDATE `stats` SET `aths_num`='$aths_num',`bks_num`='$bks_num',`hons_num`='$hons_num', `k`=1 WHERE 1";
    $query = mysqli_query($conn, $q);

if($query) {
    echo "ok! $hons_num  $bks_num  $aths_num => <a href='$_S[1]$_S[0]' target='_blank'>$_S[1]</a> <br>";
    
}


}
mysqli_close($conn);

?>

<br><br>
<button onclick="window.open('https://allekok.com/script/php/add/cp/make_search.php', '_blank','width=300,height=200','')" type="button">make_search.php</button><br>
<button onclick="window.open('https://allekok.com/script/php/add/cp/make_tbls.php', '_blank','width=300,height=200','')" type="button">make_tbls.php</button><br>
<button onclick="window.open('https://allekok.com/script/php/add/cp/make_poems.php', '_blank','width=300,height=200','')" type="button">make_poems.php</button>