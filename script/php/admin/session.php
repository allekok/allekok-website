<?php
require_once("../constants.php");
session_start();
if(! isset($_SESSION['admin'])) {
    $IP = $_SERVER['REMOTE_ADDR'];
    if(is_IP_blocked($IP,3)) die();
    require('password.php');
    $received_pass = isset($_POST['password']) ?
		     hash('SHA512',stripslashes($_POST['password'])) :
		     redirect(_R.'script/php/admin/login.php');
    if($password == $received_pass) {
	$_SESSION['admin'] = true;
    }
    else {
	session_destroy();
	add_IP_to_blacklist($IP);
	die();
    }
}

function is_IP_blocked($IP,$n) {
    require('IP-blacklist.php');
    return null !== @$IP_blacklist[$IP] ?
	   $IP_blacklist[$IP] >= $n : false;
}

function add_IP_to_blacklist($IP) {
    $IP = filter_var($IP, FILTER_SANITIZE_STRING);
    require('IP-blacklist.php');
    @$IP_blacklist[$IP] += 1;
    $string .= "<?php\n\$IP_blacklist=[";
    foreach($IP_blacklist as $IP=>$n) {
	$string .= "\n'$IP'=>$n,";
    }
    $string .= "\n];\n?>";
    file_put_contents('IP-blacklist.php',$string);
}

function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    die();
}
?>
