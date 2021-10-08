<?php
require_once("session.php");
require_once("../constants.php");

if(isset($_REQUEST["column"])) {
	$column = filter_var($_REQUEST["column"],
			     FILTER_SANITIZE_STRING);
	if(isset($_REQUEST["remove"]))
		remove_column($column);
	elseif(isset($_REQUEST["add"]))
		add_column($column);
}

/* Functions */
function remove_column($column) {
	$q = "SELECT id, bks FROM auth";
	require_once("../condb.php");
	if(!$query)
		return false;
	
	$poets = [];
	while($res = mysqli_fetch_assoc($query)) {
		$poets[] = [
			"id" => $res["id"],
			"books" => explode(",", $res["bks"])
		];
	}
	foreach($poets as $pt) {
		foreach($pt["books"] as $bk_id => $bk) {
			$bk_id++;
			$tabel = "tbl{$pt["id"]}_{$bk_id}";
			$q = "ALTER TABLE $tabel DROP $column";
			$query = mysqli_query($conn, $q);
		}
	}
}
function add_column($column) {
	$q = "SELECT id, bks FROM auth";
	require("../condb.php");
	if(!$query)
		return false;
	
	$poets = [];
	while($res = mysqli_fetch_assoc($query)) {
		$poets[] = [
			"id" => $res["id"],
			"books" => explode(",", $res["bks"])
		];
	}
	foreach($poets as $pt) {
		foreach($pt["books"] as $bk_id => $bk) {
			$bk_id++;
			$tabel = "tbl{$pt["id"]}_{$bk_id}";
			$q = "ALTER TABLE $tabel ADD $column";
			$query = mysqli_query($conn, $q);
		}
	}
}
?>
