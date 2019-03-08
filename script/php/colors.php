<?php
// 23 color groups. the 1st one is for technical pages(index,about,thanks,search,...)
// and the rest 22 groups are for poets. each poet has a color group associated with
// his/her id. (defined by `color_num()` function in `./functions.php`.
// `color_num` = (ID%22) ? ID - (22 * floor(ID/22)) : 22

// ["main-color","contrast","light","dark"]
$colors = [
    ["#15c314","#fff","#f6f6f6","#000"],
];

?>
