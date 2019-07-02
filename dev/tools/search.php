<?php
/*
 * Input: REQUEST:(q, Optional:(selPT,pt,bk,pm,k))
 * Output: JSON
 */
/* Header */
$timer_start = microtime(true);
require("../../script/php/functions.php");
$s = isset($_REQUEST['q']) ? $_REQUEST['q'] : die();
$s_sanitized = san_data($s);
if($s_sanitized=="") die();
$s_len = strlen($s_sanitized);
$s_sanitized_more = san_data_more($s_sanitized);
$selected_poet = isset($_REQUEST['selPT']) ?
		 filter_var($_REQUEST['selPT'], FILTER_SANITIZE_STRING) : false;
$selected_poet_query = $selected_poet ? "and rtakh='$selected_poet'" : "";
$poets_max = isset($_REQUEST['pt']) ? intval($_REQUEST['pt']) : 10;
$books_max = isset($_REQUEST['bk']) ? intval($_REQUEST['bk']) : 10;
$poems_max = isset($_REQUEST['pm']) ? intval($_REQUEST['pm']) : 10;
$poem_search_kind = isset($_REQUEST['k']) ? intval($_REQUEST['k']) : 3;
/* k : [ 1 => poem-name, 2 => poem-context, 3 => both 1,2 ] */
$poets = [];
$books = [];
$poems = [];
$res_poets_1 = [];
$res_poets_2 = [];
$res_poets_3 = [];
$res_books_1 = [];
$res_books_2 = [];
$res_books_3 = [];
$res_poems_1 = [];
$res_poems_2 = [];
$res_poems_context_1 = [];
$res_poems_context_2 = [];

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
	    $res_poets_1[] = [
		'poet'=>$poet['rtakh'],
		'poet_id'=>intval($poet['id']),
		'url'=>"poet:{$poet['id']}",
	    ];
	    if(--$poets_max === 0) break;
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
		$res_poets_2[] = [
		    'poet'=>$poet['rtakh'],
		    'poet_id'=>intval($poet['id']),
		    'url'=>"poet:{$poet['id']}",
		];
		$poets[$i]=[];
		if(--$poets_max === 0) break;
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
		$res_poets_3[] = [
		    'poet'=>$poet['rtakh'],
		    'poet_id'=>intval($poet['id']),
		    'url'=>"poet:{$poet['id']}",
		];
		if(--$poets_max === 0) break;
	    }
	}
    }
}
$res_poets = [
    'meta'=>$res_poets_1,
    'context'=>$res_poets_2,
    'lastChance'=>$res_poets_3,
];
if($books_max !== 0)
{
    $q = "SELECT book,book_desc,poet_id,book_id,rbook,rtakh FROM
 books WHERE len>=$s_len $selected_poet_query";
    $query = mysqli_query($sql_connection, $q);
    while($book = mysqli_fetch_assoc($query))
    {
	if(false !== strpos($book['book'],$s_sanitized))
	{
	    $res_books_1[] = [
		'book'=>$book['rbook'],
		'poet'=>$book['rtakh'],
		'poet_id'=>intval($book['poet_id']),
		'book_id'=>intval($book['book_id']),
		'url'=>"poet:{$book['poet_id']}/book:{$book['book_id']}",
	    ];
	    if(--$books_max === 0) break;
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
		$res_books_2[] = [
		    'book'=>$book['rbook'],
		    'poet'=>$book['rtakh'],
		    'poet_id'=>intval($book['poet_id']),
		    'book_id'=>intval($book['book_id']),
		    'url'=>"poet:{$book['poet_id']}/book:{$book['book_id']}",
		];
		$books[$i] = [];
		if(--$books_max === 0) break;
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
		$res_books_3[] = [
		    'book'=>$book['rbook'],
		    'poet'=>$book['rtakh'],
		    'poet_id'=>intval($book['poet_id']),
		    'book_id'=>intval($book['book_id']),
		    'url'=>"poet:{$book['poet_id']}/book:{$book['book_id']}",
		];
		if(--$books_max === 0) break;
	    }
	}
    }
}
$res_books = [
    'meta'=>$res_books_1,
    'context'=>$res_books_2,
    'lastChance'=>$res_books_3,
];
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
		$res_poems_1[] = [
		    'poet'=>$poem['rtakh'],
		    'book'=>$poem['rbook'],
		    'poem'=>$poem['rname'],
		    'poet_id'=>intval($poem['poet_id']),
		    'book_id'=>intval($poem['book_id']),
		    'poem_id'=>intval($poem['poem_id']),
		    'url'=>"poet:{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}",
		];
		$poems[$i] = [];
		if(--$poems_max === 0) break;
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
		$res_poems_context_1[] = [
		    'poet'=>$poem['rtakh'],
		    'book'=>$poem['rbook'],
		    'poem'=>$poem['rname'],
		    'poet_id'=>intval($poem['poet_id']),
		    'book_id'=>intval($poem['book_id']),
		    'poem_id'=>intval($poem['poem_id']),
		    'url'=>"poet:{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}",
		];
		$poems[$i] = [];
		if(--$poems_max === 0) break;
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
		$res_poems_2[] = [
		    'poet'=>$poem['rtakh'],
		    'book'=>$poem['rbook'],
		    'poem'=>$poem['rname'],
		    'poet_id'=>intval($poem['poet_id']),
		    'book_id'=>intval($poem['book_id']),
		    'poem_id'=>intval($poem['poem_id']),
		    'url'=>"poet:{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}",
		];
		$poems[$i] = [];
		if(--$poems_max === 0) break;
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
		$res_poems_context_2[] = [
		    'poet'=>$poem['rtakh'],
		    'book'=>$poem['rbook'],
		    'poem'=>$poem['rname'],
		    'poet_id'=>intval($poem['poet_id']),
		    'book_id'=>intval($poem['book_id']),
		    'poem_id'=>intval($poem['poem_id']),
		    'url'=>"poet:{$poem['poet_id']}/book:{$poem['book_id']}/poem:{$poem['poem_id']}",
		];
		if(--$poems_max === 0) break;
	    }
	}
    }
}
mysqli_close($sql_connection);
$res_poems = [
    'firstChance'=>[
	'meta'=>$res_poems_1,
	'context'=>$res_poems_context_1,
    ],
    'lastChance'=>[
	'meta'=>$res_poems_2,
	'context'=>$res_poems_context_2,
    ],
];
/* Timer */
$timer_end = microtime(true);
/* Print the result */
$result = [
    'search_time'=>number_format($timer_end-$timer_start,5).'s',
    'poets'=>$res_poets,
    'books'=>$res_books,
    'poems'=>$res_poems,
];
header("Content-type:application/json; charset=UTF-8");
echo json_encode($result);
?>
