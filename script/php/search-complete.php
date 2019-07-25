<?php
/*
 * Input: $_GET['q'] -> $s
 * Output: HTML
 */
/* Header */
$timer_start = microtime(true);
require("functions.php");
$s = isset($_GET['q']) ? $_GET['q'] : die();
$s_sanitized = san_data($s);
if($s_sanitized=="") die();
$s_len = strlen($s_sanitized);
$s_sanitized_more = san_data_more($s_sanitized);
$selected_poet = @filter_var($_GET['selPT'], FILTER_SANITIZE_STRING);
$selected_poet_query = $selected_poet ? "and rtakh='$selected_poet'" : "";
$poets_max = isset($_GET['pt']) ? intval($_GET['pt']) : 10;
$books_max = isset($_GET['bk']) ? intval($_GET['bk']) : 10;
$poems_max = isset($_GET['pm']) ? intval($_GET['pm']) : 10;
$poem_search_kind = isset($_GET['k']) ? intval($_GET['k']) : 3;
/* k : [ 1 => poem-name, 2 => poem-context, 3 => both 1,2 ] */
$poets = [];
$books = [];
$poems = [];
$res_poets_html = "";
$res_books_html = "";
$res_poems_html = "";
$res_poems_context_html = "";

/* Load Data From Search Database */
$sql_connection = mysqli_connect(_HOST,_USER,_PASS) or die();
mysqli_select_db($sql_connection, _DB_PREFIX."search");
mysqli_set_charset($sql_connection,"utf8");
if($poets_max !== 0 and !$selected_poet)
{
    $q = "SELECT id,rtakh,takh,profname,name,hdesc FROM 
poets WHERE len>=$s_len";
    $query = mysqli_query($sql_connection,$q);
    while($poet = mysqli_fetch_assoc($query))
    {
	if(false !== strpos($poet['takh'],$s_sanitized) or
	    false !== strpos($poet['profname'],$s_sanitized))
	{
	    $poet_image = get_poet_image($poet['id'], true);
	    $res_poets_html .= "<section><a href='/poet:{$poet['id']}'
><img src='$poet_image'><h3>{$poet['rtakh']}</h3></a></section>";
	    if(--$poets_max == 0) break;
	}
	else
	{
	    $poets[] = $poet;
	}
    }
    if($poets_max !== 0)
    {
	foreach($poets as $i=>$poet)
	{
	    if(false !== strpos($poet['name'],$s_sanitized) or
		false !== strpos($poet['hdesc'],$s_sanitized))
	    {
		$poet_image = get_poet_image($poet['id'], true);
		$res_poets_html .= "<section><a href='/poet:{$poet['id']}'
><img src='$poet_image'><h3>{$poet['rtakh']}</h3></a></section>";
		$poets[$i]=[];
		if(--$poets_max == 0) break;
	    }
	}
    }
    if($poets_max !== 0)
    {
	foreach($poets as $poet)
	{
	    if($poet != [] and (
		false !== strpos(san_data_more($poet['takh']),
				 $s_sanitized_more) or
		false !== strpos(san_data_more($poet['profname']),
				 $s_sanitized_more) or
		false !== strpos(san_data_more($poet['name']),
				 $s_sanitized_more) or
		false !== strpos(san_data_more($poet['hdesc']),
				 $s_sanitized_more)))
	    {
		$poet_image = get_poet_image($poet['id'], true);
		$res_poets_html .= "<section><a href='/poet:{$poet['id']}'
><img src='$poet_image'><h3>{$poet['rtakh']}</h3></a></section>";
		if(--$poets_max == 0) break;
	    }
	}
    }
}
if($books_max !== 0)
{
    $q = "SELECT book,book_desc,poet_id,book_id,rbook,rtakh FROM
 books WHERE len>=$s_len $selected_poet_query";
    $query = mysqli_query($sql_connection, $q);
    while($book = mysqli_fetch_assoc($query))
    {
	if(false !== strpos($book['book'],$s_sanitized))
	{
	    $res_books_html .= "<a 
href='/poet:{$book['poet_id']}/book:{$book['book_id']}'
><i>{$book['rtakh']}</i> › {$book['rbook']}</a>";
	    if(--$books_max == 0) break;
	}
	else
	{
	    $books[] = $book;
	}
    }
    if($books_max !== 0)
    {
	foreach($books as $i=>$book)
	{
	    if(false !== strpos($book['book_desc'],$s_sanitized))
	    {
		$res_books_html .= "<a 
href='/poet:{$book['poet_id']}/book:{$book['book_id']}'
><i>{$book['rtakh']}</i> › {$book['rbook']}</a>";
		$books[$i] = [];
		if(--$books_max == 0) break;
	    }
	}
    }
    if($books_max !== 0)
    {
	foreach($books as $book)
	{
	    if($book != [] and (
		false !== strpos(san_data_more($book['book']),
				 $s_sanitized_more) or 
		false !== strpos(san_data_more($book['book_desc']),
				 $s_sanitized_more)))
	    {
		$res_books_html .= "<a 
href='/poet:{$book['poet_id']}/book:{$book['book_id']}'
><i>{$book['rtakh']}</i> › {$book['rbook']}</a>";
		if(--$books_max == 0) break;
	    }
	}
    }
}
if($poems_max !== 0 and
    $poem_search_kind>0 and
    $poem_search_kind<4)
{
    $q =  "SELECT name,hdesc,poet_id,book_id,poem_id,
poem,poem_true,rbook,rname,rtakh FROM poems WHERE len>=$s_len $selected_poet_query 
ORDER BY Cipi DESC";
    $query = mysqli_query($sql_connection,$q);
    while($poem = mysqli_fetch_assoc($query))
    {
	$poems[] = $poem;
    }
    if($poem_search_kind != '2')
    {
	foreach($poems as $i=>$poem)
	{
	    if(false !== strpos($poem['name'],$s_sanitized))
	    {
		$res_poems_html .= "<div style='display:flex'><button 
class='material-icons' style='background:none;padding:0 0 0 .5em;
font-size:.8em' onclick='ss(this)' type='button' 
>dehaze</button><a href='/script/php/update-cipi.php?uri=poet:
{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}'
><i>{$poem['rtakh']}</i> › <i>{$poem['rbook']}</i
> › {$poem['rname']}</a></div>";
		$poems[$i] = [];
		if(--$poems_max == 0) break;
	    }
	}
    }
    if($poem_search_kind != '1' and
	$poems_max !==0)
    {
	foreach($poems as $i=>$poem)
	{
	    if($poem!=[] and (
		false !== strpos($poem['hdesc'],$s_sanitized) or
		false !== strpos($poem['poem'],$s_sanitized)))
	    {
		$res_poems_context_html .= "<div style='display:flex'><button 
class='material-icons' style='background:none;padding:0 0 0 .5em;
font-size:.8em' onclick='ss(this)' type='button' 
>dehaze</button><a href='/script/php/update-cipi.php?uri=poet:
{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}'
><i>{$poem['rtakh']}</i> › <i>{$poem['rbook']}</i
> › {$poem['rname']}</a></div>";
		$poems[$i] = [];
		if(--$poems_max == 0) break;
	    }
	}
    }
    if($poem_search_kind != '2' and
	$poems_max !== 0)
    {
	foreach($poems as $i=>$poem)
	{
	    if($poem!=[] and
		false !== strpos(san_data_more($poem['name']),
				 $s_sanitized_more))
	    {
		$res_poems_html .= "<div style='display:flex'><button 
class='material-icons' style='background:none;padding:0 0 0 .5em;
font-size:.8em' onclick='ss(this)' type='button' 
>dehaze</button><a href='/script/php/update-cipi.php?uri=poet:
{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}'
><i>{$poem['rtakh']}</i> › <i>{$poem['rbook']}</i
> › {$poem['rname']}</a></div>";
		$poems[$i] = [];
		if(--$poems_max == 0) break;
	    }
	}
    }
    if($poem_search_kind != '1' and
	$poems_max !==0)
    {
	foreach($poems as $poem)
	{
	    if($poem!=[] and (
		false !== strpos(san_data_more($poem['hdesc']),
				 $s_sanitized_more) or
		false !== strpos($poem['poem_true'],
				 $s_sanitized_more)))
	    {
		$res_poems_context_html .= "<div style='display:flex'><button 
class='material-icons' style='background:none;padding:0 0 0 .5em;
font-size:.8em' onclick='ss(this)' type='button' 
>dehaze</button><a href='/script/php/update-cipi.php?uri=poet:
{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}'
><i>{$poem['rtakh']}</i> › <i>{$poem['rbook']}</i
> › {$poem['rname']}</a></div>";
		if(--$poems_max == 0) break;
	    }
	}
    }
    if($res_poems_context_html != "")
    {
	$res_poems_html .= "<h3 class='bhoh-newdaq'>گەڕانی نێو دەق</h3>" .
			   $res_poems_context_html;
    }
}
mysqli_close($sql_connection);

/* Print the result */
if($res_poets_html != "")
    echo "<div class='search-poet' id='poets'><h3 id='bhon'>شاعیر</h3>$res_poets_html</div>";
if($res_books_html != "")
    echo "<div class='search-book'><h3 id='bhon'>کتێب و بەرهەم</h3>$res_books_html</div>";
if($res_poems_html != "")
    echo "<div class='search-hon'><h3 id='bhon'>شێعر</h3>$res_poems_html</div>";
else
    echo "<h3 class='search-notfound'>هیچ شێعرێکم بۆ نەدۆزرایەوە</h3>";

/* Timer */
$timer_end = microtime(true);
echo "<div style='position:fixed;top:0;left:0'>".
     number_format($timer_end-$timer_start,5)."</div>";
?>
