<?php

// number of poets,books,poems
$db="index";
$q= "select * from stats";
include("condb.php");

$rrr = mysqli_fetch_assoc($query);
mysqli_close($conn);

$aths_num = $rrr['aths_num'];
$bks_num = $rrr['bks_num'];
$hons_num = $rrr['hons_num'];

?>
