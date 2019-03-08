<?php
// 23 color groups. the 1st one is for technical pages(index,about,thanks,search,...)
// and the rest 22 groups are for poets. each poet has a color group associated with
// his/her id. (defined by `color_num()` function in `./functions.php`.
// `color_num` = (ID%22) ? ID - (22 * floor(ID/22)) : 22

// ["main-color","contrast","light","dark"]
$colors = [
    ["#15d643","#fff","#f6f6f6","#000"],
    ["#95ff21","#000","#ebffd4","#004d00"],
    ["#2da7e9","#fff","#e6f5ff","#002e4d"],
    ["#d75691","#fff","#ffeffb","#4d0039"],
    ["#d2350c","#fff","#ffebe6","#344d00"],
    ["#bcfc3a","#000","#ffffe6","#4d4d00"],
    ["#b38323","#fff","#fff7e6","#4d3300"],
    ["#b43ed2","#fff","#f9e6ff","#39004d"],
    ["#1aae79","#fff","#e6fff7","#006644"],
    ["#4334e0","#fff","#e6e6ff","#00004d"],
    ["#c44eff","#fff","#f7e6ff","#440066"],
    ["#f28638","#fff","#fff3e6","#4d2800"],
    ["#9b9b00","#fff","#ededde","#33331a"],
    ["#c63e3e","#fff","#f8ecec","#4b1b1b"],
    ["#e6e600","#000","#ffffe6","#4d4d00"],
    ["#419e9e","#fff","#e6ffff","#004d4d"],
    ["#ffd11a","#000","#fffae6","#4d3d00"],
    ["#e94a4a","#fff","#ffe6e6","#4d0000"],
    ["#4da6ff","#fff","#e6f2ff","#003e80"],
    ["#8cff1a","#000","#f2ffe6","#254d00"],
    ["#5a40b3","#fff","#f2e6ff","#25004d"],
    ["#d75691","#fff","#ffeffb","#4d003b"],
    ["#a81f63","#fff","#ffe6f3","#33001a"],
];

?>
