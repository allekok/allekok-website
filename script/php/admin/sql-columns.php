<?php
require_once("../constants.php");
if(isset($_GET["column"]))
{
	$column = filter_var($_GET["column"], FILTER_SANITIZE_STRING);
	if(isset($_GET["remove"]))
		remove_column($column);
	elseif(isset($_GET["add"]))
		add_column($column);
}

/* Functions */
function remove_column($name)
{
	$poets = [];
	$q = "SELECT id,bks FROM auth";
	require(ABSPATH."script/php/condb.php");
	if(!$query) return false;
	while($res = mysqli_fetch_assoc($query))
	{
		$poets[] = [
			"id"=>$res["id"],
			"books"=>explode(",",$res["bks"]),
		];
	}
	foreach($poets as $pt)
	{
		foreach($pt["books"] as $bk_id=>$bk)
		{
			$bk_id++;
			$tabel = "tbl{$pt["id"]}_$bk_id";
			$q = "ALTER TABLE $tabel DROP $name";
			$query = mysqli_query($conn, $q);
		}
	}
}

function add_column($column)
{
	$poets = [];
	$q = "SELECT id,bks FROM auth";
	require(ABSPATH."script/php/condb.php");
	if(!$query) return false;
	while($res = mysqli_fetch_assoc($query))
	{
		$poets[] = [
			"id"=>$res["id"],
			"books"=>explode(",",$res["bks"]),
		];
	}
	foreach($poets as $pt)
	{
		foreach($pt["books"] as $bk_id=>$bk)
		{
			$bk_id++;
			$tabel = "tbl{$pt["id"]}_$bk_id";
			$q = "ALTER TABLE $tabel ADD $column";
			$query = mysqli_query($conn, $q);
		}
	}
}
?>
