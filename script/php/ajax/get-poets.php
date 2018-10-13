<?php

require_once("../constants.php");
require_once("../functions.php");

$__isnew = isset($_GET['new']) ? " WHERE kind='alive'" : " WHERE kind='dead'";

$db = 'index';

$__order = " ORDER BY takh ASC";
    
$q = "SELECT id, profname, takh FROM auth" . $__isnew . $__order ;
require('../condb.php');

header("Content-type: application/json; charset=utf-8");
    
if($query) {
    
    $rows = array();

    while($row=mysqli_fetch_assoc($query)) {
    
        $row['img'] = get_poet_image($row['id'], "profile", 1);
        
        $rows[] = $row;
    }
    
    echo json_encode($rows);

}
mysqli_close($conn);

?>