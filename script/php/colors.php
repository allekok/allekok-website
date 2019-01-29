<?php
// 23 color groups. the 1st one is for technical pages(index,about,thanks,search,...)
// and the rest 22 groups are for poets. each poet has a color group associated with
// his/her id. (defined by `color_num()` function in `./functions.php`.
// `color_num` = (ID%22) ? ID - (22 * floor(ID/22)) : 22

// ["main-color","contrast","light","dark"]
$colors = [
    ["#fff","#000","#fff","#000"],
    ["#4dff4d","#000","#e6ffe6","#004d00"],
    ["#09f","#fff","#e6f5ff","#002e4d"],
    ["#ff00bf","#fff","#ffeffb","#4d0039"],
    ["#e63900","#fff","#ffebe6","#344d00"],
    ["#c4ff4d","#000","#ffffe6","#4d4d00"],
    ["#c80","#fff","#fff7e6","#4d3300"],
    ["#ac00e6","#fff","#f9e6ff","#39004d"],
    ["#80ffd4","#000","#e6fff7","#006644"],
    ["#4d4dff","#fff","#e6e6ff","#00004d"],
    ["#c6f","#fff","#f7e6ff","#440066"],
    ["#ff8c1a","#fff","#fff3e6","#4d2800"],
    ["#884","#fff","#ededde","#33331a"],
    ["#bf4040","#fff","#f8ecec","#4b1b1b"],
    ["#e6e600","#000","#ffffe6","#4d4d00"],
    ["#099","#fff","#e6ffff","#004d4d"],
    ["#ffd11a","#000","#fffae6","#4d3d00"],
    ["#ff4d4d","#fff","#ffe6e6","#4d0000"],
    ["#4da6ff","#fff","#e6f2ff","#003e80"],
    ["#8cff1a","#000","#f2ffe6","#254d00"],
    ["#8000ff","#fff","#f2e6ff","#25004d"],
    ["#ff00bf","#fff","#ffeffb","#4d003b"],
    ["#b30059","#fff","#ffe6f3","#33001a"],
];
    
?>
