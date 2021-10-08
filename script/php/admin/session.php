<?php
require_once("../functions.php");

session_start();

if(!isset($_SESSION["admin"])) {
	$IP = $_SERVER["REMOTE_ADDR"];
	if(is_IP_blocked($IP, 3))
		die();
	require_once("password.php");
	$rec_pass = isset($_POST["password"]) ?
		    hash("SHA512", stripslashes($_POST["password"])) :
		    redirect("login.php");
	if($password == $rec_pass) {
		$_SESSION["admin"] = true;
	} else {
		session_destroy();
		add_IP_to_blacklist($IP);
		redirect("login.php");
		die();
	}
}

/* Functions */
function is_IP_blocked($IP, $n) {
	require_once("IP-blacklist.php");
	return isset($IP_blacklist[$IP]) ?
	       $IP_blacklist[$IP] >= $n :
	       false;
}
function add_IP_to_blacklist($IP) {
	$IP = filter_var($IP, FILTER_SANITIZE_STRING);
	require("IP-blacklist.php");
	@$IP_blacklist[$IP] += 1;
	$string = "<?php\n\$IP_blacklist = [";
	foreach($IP_blacklist as $IP => $n) {
		$string .= "\n\t\"$IP\" => $n,";
	}
	$string .= "\n];\n?>";
	file_put_contents("IP-blacklist.php", $string);
}
?>
