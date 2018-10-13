
function toggle_search() {
    //toggle_search Function, show/hide the search form.

    var s=document.getElementById('search');
    var sk = document.getElementById("search-key");
    var h=document.querySelector('header');
    var tS=document.getElementById('tS');

    if(s.style.display !== "block") {

        s.style.display = "block";
        sk.focus();
        tS.style.opacity="1";
        h.style.animation="concentrate 1s ease forwards";
    } else {

        s.style.display="none";
        tS.style.opacity="";
        h.style.animation="smile 1s ease forwards";
    }

}

/// **************** ///

function toggle_Like() {
  var tL_res = document.getElementById('tL-res');
  var tL = document.getElementById('tL');
  
  if(tL_res.style.display == "block") {
      tL_res.style.display = "none";
      tL.style.opacity = "";
      return;
  }
  
  var favs = localStorage.getItem("favorites");
  
  if(favs !== null) {
        favs = favs.split('[fav]');
        favs = favs.reverse();
        
        var favsS = "";
        var clrNum = 0;
        
        for ( var a in favs ) {
            if( favs[a] != "" ) {
                favs[a] = JSON.parse(favs[a]);
                clrNum = favs[a].poetID;

                favsS += `<a style='background:${colors[clrNum][2]};' href='${uritg+favs[a].url}'>${favs[a].poetName} <i style='vertical-align:middle;font-size: inherit;height: 0.6em;' class='material-icons'>keyboard_arrow_left</i> ${favs[a].book} <i style='vertical-align:middle;font-size: inherit;height: 0.6em;' class='material-icons'>keyboard_arrow_left</i> ${favs[a].poem} </a>`;
            }
        }
          
          document.getElementById('tL-res-res').innerHTML = favsS;
          
          tL_res.style.animation = "tL 0.6s";
          tL_res.style.display = "block";
          tL.style.opacity = "1";
  }
}


/// ******************** ///

function search(e) {
    // Search Function ---> Send search phrases ajaxly to server.
    
    var str=document.getElementById("search-key").value;
    var sres=document.getElementById("search-res");
    var s=document.getElementById('search');

    // the below line is from some source.
    var C = (typeof e.which === "number") ? e.which : e.keyCode;
    var noActionKeys = [16, 17, 18, 91, 20, 9, 93, 37, 38, 39, 40, 32, 224, 13];
    
    if(noActionKeys.indexOf(C) === -1) {

    // 27 keyCode = Esc Key
    if(C == 27) {
        s.style.display="none";
        return;

    } else {
        var loading = "<div class='loader' id='loader'></div>";
        var sbtn = document.querySelector("#live-search-form #search-btn");

        if(str.length<3) {
            sres.style.display="none";
            sres.innerHTML= loading;
            sbtn.innerHTML = "گەڕان";
            return;
        }
        
        sres.innerHTML=loading;
        sres.style.display="block";
        xmlhttp=new XMLHttpRequest();
        
        xmlhttp.onreadystatechange=function() {
            if(this.readyState==4 && this.status==200) {

                sres.innerHTML=this.responseText;
                sbtn.innerHTML = "گەڕانی زۆرتر";
            }
        }
    }

    var request = "/script/php/live-search2.php?q="+str;

    xmlhttp.open("GET",request,true);
    xmlhttp.send();

    // the End of noActionKeys, IF....
    } else {
        if(str === "") {
            sres.style.display="none";
            sres.innerHTML= loading;
            return;
        } 
    }
}

/* poem.js */

/**
    functions:
        1.window.Clipboard = function()
        2.copyPoem()
        3.Liked()
        4.save_fs()

**/

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
    copySec = document.getElementById("copy-sec");

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
        /&nbsp;/gi
    ];

    for(var hc in htmlchars) {

        text = text.replace(htmlchars[hc], "");
    }
    
    text = text.replace(/<sup>/gi, "[");
    text = text.replace(/<\/sup>/gi, "]");
    
    text = text.trim();
    
    Clipboard.copy(text);
    
    copySec.innerHTML = "<div style='width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;'></div><i class='material-icons' style='vertical-align:middle;'>check</i> کۆپی کرا.";
    copySec.style.backgroundColor = "#ccffcc";
        
    setTimeout(function(){
        copySec.innerHTML = "<div style='width: 100%;height: 100%;position: absolute;right: -0.02em;top:-0.001em;background: none;border: 0;box-shadow: none;'></div><i class='material-icons' style='vertical-align:middle;'>content_copy</i> کۆپی کردن ";
        copySec.style.backgroundColor = "";
    
    },3000);
}

    
function Liked() {

    var tL = document.getElementById('tL');
    var ico = document.getElementById("like-icon");
    var favs = localStorage.getItem('favorites');
    
    if(favs != null) {
        console.log("! null");
        favs = favs.split("[fav]");
        
        where = favs.indexOf(poemV2);
        
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

/* footer.js */

/**

    functions:
        1.get poem's font size from localStorage
**/

    // scrol fs
    var hon = document.querySelector("#hon");
    
if(hon !== null) {
    
    var ww;
    
    window.onscroll = function() {
        var y = 0;
        var header = document.querySelector("header");
        var adrs = document.querySelector("#adrs");
        var bhon = document.querySelector("#bhon");
        var nav = document.querySelector(".nav");
        var tLres = document.querySelector("#tL-res");
        var search = document.querySelector("#search");
        var hon = document.querySelector("#hon");
        
        var fontsize = document.querySelector(".fontsize");
        
        ww = fontsize.offsetWidth;
        
        y = header.scrollHeight + adrs.scrollHeight + bhon.scrollHeight;
        
        if(tLres.style.display != "none") {
            y += tLres.scrollHeight;
        }
        if(search.style.display != "none") {
            y += search.scrollHeight;
        }
        
        
        if(document.body.scrollTop >= y || document.documentElement.scrollTop >= y) {
            //style --> fixed position
            honpx = fontsize.offsetHeight + nav.offsetHeight + "px";
            if(window.innerWidth > 720) {
            hon.style.paddingTop = "calc(1em + "+honpx+")";
            }
            fontsize.classList.add("fsFixed");
            fontsize.style.top = nav.scrollHeight + "px";
            nav.classList.add("navFixed");

        } else {
            hon.style.paddingTop = "";
            fontsize.classList.remove("fsFixed");
            nav.classList.remove("navFixed");
            
        }
    };
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
    
    if(favs != null && typeof poemV2 !== 'undefined') {
        favs = favs.split("[fav]");
        
        where = favs.indexOf(poemV2);
        
        if(where > -1) {
            likeico.innerHTML = "bookmark";
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

live_search_form.addEventListener("submit", function(e) {
    
    if(sk.value === "") {
        e.preventDefault();
        sk.focus();
    }
});

/// ******************** ///


var tLLL = document.getElementById("tL");
if( tLLL !== null ) {
	tLLL.addEventListener("click", toggle_Like);
}


var tSSS = document.getElementById("tS");
if( tSSS !== null) {
	tSSS.addEventListener("click", toggle_search);
}

var favSecc = document.getElementById("fav-sec");
if( favSecc !== null) {
    favSecc.addEventListener("click", Liked);
}


var copySecc = document.getElementById("copy-sec");
if( copySecc !== null) {
    copySecc.addEventListener("click", copyPoem);
}
var smallerr = document.querySelector(".smaller");
if( smallerr !== null) {
    smallerr.addEventListener("click", function(){save_fs('smaller')});
}

var biggerr = document.querySelector(".bigger");
if( biggerr !== null) {
    biggerr.addEventListener("click", function(){save_fs('bigger')});
}