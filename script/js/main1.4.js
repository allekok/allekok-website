function toggle_search() {
    var s = document.getElementById('search');
    var sk = document.getElementById("search-key");
    var h = document.querySelector('header');
    var tS = document.getElementById('tS');

    if(s.style.display !== "block") {
        s.style.display = "block";
        sk.focus();
        tS.style.opacity="1";
        h.style.animation="concentrate 1s forwards";
    } else {
        s.style.display="none";
        tS.style.opacity="";
        h.style.animation="smile 1s forwards";
    }
}


function toggle_Like() {
    var tL_res = document.getElementById('tL-res');
    var tL = document.getElementById('tL');
    
    if(tL_res.style.display == "block") {
        tL_res.style.display = "none";
        tL.style.opacity = "";
        return;
    }
    
    var favs=localStorage.getItem("favorites").split('[fav]'), favsS="", clrNum=0;
    favs = favs.reverse();
    
    for( var a in favs ) {
        if( favs[a] !== "" ) {
            favs[a] = JSON.parse(favs[a]);
            clrNum = favs[a].poetID;
            
            favsS += `<a class='link' style='border-bottom:1px solid #eee' href='/${favs[a].url}'><i style='vertical-align:middle;font-size:2em;height:.85em;color:${colors[clrNum][0]};' class='material-icons'>bookmark</i> <span style='font-size:.85em; color:#555;'>${favs[a].poetName} &rsaquo; ${favs[a].book} &rsaquo;</span> ${favs[a].poem} </a>`;
        }
    }
    
    document.getElementById('tL-res-res').innerHTML = favsS;
    
    tL_res.style.animation = "tL 0.6s";
    tL_res.style.display = "block";
    tL.style.opacity = "1";
}


function search(e) {
    var str=document.getElementById("search-key").value;
    var sres=document.getElementById("search-res");
    var s=document.getElementById('search');
    var loading = "<div class='loader'></div>";
    var xmlhttp=new XMLHttpRequest();

    var C = (typeof e.which === "number") ? e.which : e.keyCode;
    var noActionKeys = [16, 17, 18, 91, 20, 9, 93, 37, 38, 39, 40, 32, 224, 13];
    
    if(noActionKeys.indexOf(C) === -1) {

    // 27 keyCode = Esc Key
    if(C === 27) {
        s.style.display="none";
        return;
        
    } else {
        var sbtn = document.querySelector("#live-search-form #search-btn");
        
        if(str.length<3) {
            sres.style.display="none";
            sres.innerHTML = loading;
            sbtn.innerHTML = "<i class='material-icons' style='font-size:2em;'>search</i>";
            return;
        }
        
        sres.innerHTML=loading;
        sres.style.display="block";
        
        var request = "/script/php/live-search2.php?q="+str;
        xmlhttp.open("GET",request);
        xmlhttp.onload=function() {
            sres.innerHTML = this.responseText;
            sbtn.innerHTML = "گەڕانی زۆرتر";
        };
    }

    xmlhttp.send();

    // the End of noActionKeys, IF....
    } else {
        if(str === "") {
            sres.style.display="none";
            sres.innerHTML=loading;
            return;
        } 
    }
}


window.Clipboard = (function(window, document, navigator) {
    var textArea,
        copy;

    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }

    function createTextArea(text) {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.insertBefore(textArea,document.body.firstChild);
    }

    function selectText() {
        var range,
            selection;

        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }

    function copyToClipboard() {        
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }

    copy = function(text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };

    return {
        copy: copy
    };
})(window, document, navigator);


function copyPoem() {
    var text = document.getElementById("hon").innerHTML;
    var copySec = document.getElementById("copy-sec");

    var htmlchars = [
        /<div class="ptr">/gi,
        /<div class="ptr ptrh">/gi,
        /<div class="m d cf">/gi,
        /<div class="b cf">/gi,
        /<div class="n cf">/gi,
        /<div class="b">/gi,
        /<div class="n">/gi,
        /<div class="m1">/gi,
        /<div class="m2">/gi,
        /<div class="m3">/gi,
        /<div class="m">/gi,
        /<div class="m" style="direction:ltr">/gi,
        /<p>/gi,
        /<br>/gi,
        /<b>/gi,
        /<br\/>/gi,
        /<br \/>/gi,
        /<i>/gi,
        /<\/br>/gi,
        /<\/ br>/gi,
        /<\/b>/gi,
        /<\/p>/gi,
        /<\/div>/gi,
        /<\/span>/gi,
        /<\/i>/gi,
        /<center>/gi,
        /<\/center>/gi,
        /&nbsp;/gi,
        /<div class="m dltr">/gi,
    ];

    for(var hc in htmlchars) {
        text = text.replace(htmlchars[hc], "");
    }
    
    text = text.replace(/<sup>/gi, "[");
    text = text.replace(/<\/sup>/gi, "]");
    
    text = text.trim();
    
    Clipboard.copy(text);
    
    copySec.innerHTML = "<i class='material-icons' style='vertical-align:middle;'>check</i> کۆپی کرا.";
    copySec.style.backgroundColor = "#cfc";
        
    setTimeout(function(){
        copySec.innerHTML = "<i class='material-icons' style='vertical-align:middle;'>content_copy</i> کۆپی کردن ";
        copySec.style.backgroundColor = "";
    
    },3000);
}

    
function Liked () {
    var tL = document.getElementById('tL');
    var ico = document.getElementById("like-icon");
    var favs = localStorage.getItem('favorites');
    
    if(favs !== null) {
        console.log("! null");
        favs = favs.split("[fav]");
        
        var where = favs.indexOf(poemV2);
        
        if(where > -1) {
            console.log("founded");
            
            favs = favs.join('[fav]');
            var sd = poemV2 + "[fav]";
            favs = favs.replace(sd,"");
            
            if(favs.length>6) {
                console.log("remove and replace for more than one item");
                localStorage.setItem('favorites',favs);
            } else {
                console.log("remove");
                localStorage.removeItem('favorites');
                tL.style.display = "none";
            }
            
            //change like-ico
            ico.innerHTML = "bookmark_border";
            ico.style.animation = "";
            
        } else {
            console.log("! founded");
            
            favs = favs.join('[fav]');
            favs += poemV2 + "[fav]";
            
            localStorage.setItem('favorites',favs);
            // change like-ico
            ico.innerHTML = "bookmark";
            ico.style.animation = "ll 0.4s ease-out forwards";
            
        }
    } else {
        
        console.log("null");
        
        favs = poemV2 + "[fav]";
        localStorage.setItem('favorites',favs);
        // change like-ico
        ico.innerHTML = "bookmark";
        ico.style.animation = "ll 0.4s ease-out forwards";
        tL.style.display = "block";
    }
    
}


function save_fs(how) {
    // save_fs Function, saves changes of poem's font size into localStorage.

    var hon=document.getElementById("hon");
    var fs=parseInt(hon.style.fontSize);
    var wW = window.innerWidth;
    var newfs = 0;
    var hows = ["smaller", "bigger"];
    var scale = 3;

    if(isNaN(fs)){
        if(wW > 600){
            fs=30;
        } else {
            fs=24;
        }
    }
    
    /// make font size bigger
    if(hows.indexOf(how) === 1){
        if(fs >= 120){
            return;
        }
    
    newfs = fs + scale;

    /// make font size smaller
    } else if(hows.indexOf(how) === 0){
        if(fs<=6){
            return;
        }
        newfs = fs - scale;
    }
    
    localStorage.setItem("fontsize", newfs);
    hon.style.fontSize = newfs + "px";
}


function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

/// check if liked
var likeico = document.getElementById('like-icon');

var favs = localStorage.getItem('favorites');

if(favs !== null && typeof poemV2 !== 'undefined') {
    favs = favs.split("[fav]");
    
    var where = favs.indexOf(poemV2);
    
    if(where > -1) {
        likeico.innerHTML = "bookmark";
        likeico.style.color = colors[JSON.parse(poemV2).poetID][0];
        likeico.style.backgroundColor = "";
        likeico.style.animation = "ll 0.4s ease-out forwards";
    }
}
    
    
var favs = localStorage.getItem('favorites');
var tL = document.getElementById('tL');
    
    if(favs != null && favs.length>0) {
        favs = favs.split("[fav]");
        if(isJson(favs[0])) {
            if(tL !== null) {
                tL.style.display = "block";
            }
        } else {
            localStorage.removeItem('favorites');
        }

    }


/// *************** ///

var live_search_form = document.getElementById('live-search-form');
var sk = document.getElementById("search-key");

live_search_form.addEventListener("submit", function(e) {
    
    if(sk.value === "") {
        e.preventDefault();
        sk.focus();
    }
});


var draft = document.getElementById("tL");
if( draft !== null ) {
	draft.addEventListener("click", toggle_Like);
}

draft = document.getElementById("tS");
if( draft !== null) {
	draft.addEventListener("click", toggle_search);
}

draft = document.getElementById("fav-sec");
if( draft !== null) {
    draft.addEventListener("click", Liked);
}

draft = document.getElementById("copy-sec");
if( draft !== null) {
    draft.addEventListener("click", copyPoem);
}

draft = document.querySelector(".smaller");
if( draft !== null) {
    draft.addEventListener("click", function(){save_fs('smaller')});
}

draft = document.querySelector(".bigger");
if( draft !== null) {
    draft.addEventListener("click", function(){save_fs('bigger')});
}
