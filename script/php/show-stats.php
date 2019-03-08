<?php
header("Content-type:text/plain; charset=UTF-8");

require("../../constants.php");
$f = fopen(ABSPATH . "stats.txt", "r");
$cnt = $cnt_rl = 0;
$today = $average = $google = [0, 0];
$dttd = date("Y m d");

while(!feof($f)) {
    $l = explode("\t", fgets($f));
    if(trim($l[3]) != "") {
        $cnt_rl++;
        if(strstr($l[1], $dttd))  {
            $today[1]++;
            if(strstr($l[3], "google")) $google[1]++;
        }
        if(strstr($l[3], "google")) $google[0]++;
    }
    
    if(strstr($l[1], $dttd))  $today[0]++;
    $cnt++;
}
fclose($f);

$first_attempt = "2019-01-29 12:00:01am";
$date1 = date_create("2019-01-29 12:00:01am");
$date2 = date_create(date("Y-m-d h:i:sa"));
$diff = date_diff($date1,$date2,true);

$average[0] = ($diff->days==0) ? $cnt : round ($cnt / $diff->days);
$average[1] = ($diff->days==0) ? $cnt_rl : round ($cnt_rl / $diff->days);

echo "today total visits:\t{$today[0]}\n";
echo "today real visits:\t{$today[1]}\n\n";

echo "total visits:\t{$cnt}\n";
echo "real visits:\t{$cnt_rl}\t(referral url included)\n\n";

echo "first moment:\t{$first_attempt}\n";
echo "elapsed days:\t{$diff->days}\n";
echo "elapsed hours:\t{$diff->h}:{$diff->i}:{$diff->s}\n\n";

echo "average (total visits):\t{$average[0]}\n";
echo "average (real visits):\t{$average[1]}\n\n";

echo "GOGOLE(2day) -> {$google[1]}\n";
echo "GOGOLE(total) -> {$google[0]}\n\n";

?>
