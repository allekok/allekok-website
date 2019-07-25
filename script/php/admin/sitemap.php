<?php
require('session.php');

/* 
 * generating sitemap for search engines 
 * the sitemap only contain poets , books, poems
 * and no other pages. (for now).
 */
require_once("../constants.php");
require_once(ABSPATH."script/php/functions.php");

$sitemap = "sitemap.xml";
$sm = fopen(ABSPATH . $sitemap, "w");

$db = 'index';
$q = 'select * from auth';
require(ABSPATH."script/php/condb.php");
$poets_num = mysqli_num_rows($query);
$books[0] = [];
while($res=mysqli_fetch_assoc($query)) {
    $books[] = explode("," , $res['bks']);
}

fwrite($sm , "<?xml version='1.0' encoding='UTF-8'?>\n");
fwrite($sm , "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\nxsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\"\nxmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">");
fwrite($sm , "\n<url>\n<loc>" . _SITE . "/</loc>\n</url>");

for($i=1;$i<=$poets_num;$i++) {    
    fwrite($sm , "\n<url>\n<loc>".
		 _SITE.
		 "/poet:$i</loc>\n</url>");
    $books_num = count($books[$i]);
    $books_num_all += $books_num;
    for($j = 1; $j <= $books_num; $j++) {
        fwrite($sm , "\n<url>\n<loc>".
		     _SITE.
		     "/poet:$i/book:$j</loc>\n</url>");

        $_tbl = "tbl{$i}_{$j}";
        $q = "select * from $_tbl";
        $query = mysqli_query($conn, $q);
        $poems_num = mysqli_num_rows($query);
        $poems_num_all += $poems_num;
        for($u=1; $u<=$poems_num; $u++)
            fwrite($sm,"\n<url>\n<loc>".
		       _SITE.
		       "/poet:$i/book:$j/poem:$u</loc>\n</url>");
    }
}

fwrite($sm,"\n</urlset>");
fclose($sm);

echo "Ok! sitemap created.<br>";

/* Update stats table */
$poets_num_all = num_convert($poets_num , "en" , "ckb");
$books_num_all = num_convert($books_num_all , "en" , "ckb");
$poems_num_all = num_convert($poems_num_all , "en" , "ckb");
$q = "UPDATE `stats` SET `aths_num`='$poets_num_all',
`bks_num`='$books_num_all',`hons_num`='$poems_num_all',
`k`=1 WHERE 1";
$query = mysqli_query($conn, $q);
if($query)
    echo "Ok! Stats updated.<br>Number of Poems: $poems_num_all<br>Number of books: {$books_num_all}<br>Number of poets: $poets_num_all<br>Sitemap: "._SITE."/$sitemap<br>";
mysqli_close($conn);

?>
<meta charset="utf-8">
<br><br>
<button onclick="window.open('https://allekok.com/script/php/admin/search-poets.php', '_blank','width=300,height=200','')" type="button">search-poets.php</button><br>
<button onclick="window.open('https://allekok.com/script/php/admin/search-books.php', '_blank','width=300,height=200','')" type="button">search-books.php</button><br>
<button onclick="window.open('https://allekok.com/script/php/admin/search-poems.php', '_blank','width=300,height=200','')" type="button">search-poems.php</button>
