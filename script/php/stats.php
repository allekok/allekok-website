<?php
/* Number of all poets,books,poems */
$q='select * from stats';
include('condb.php');

$stats_res = $query ? mysqli_fetch_assoc($query) :
	     [
		 'aths_num'=>'۰',
		 'bks_num'=>'۰',
		 'hons_num'=>'۰',
	     ];

mysqli_close($conn);

$aths_num = $stats_res['aths_num'];
$bks_num = $stats_res['bks_num'];
$hons_num = $stats_res['hons_num'];
?>
