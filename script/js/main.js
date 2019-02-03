// source: KurdiNus 4.0
// Arabic to Latin Array
var sConvertArabic2Latin = new Array(
    //managing 'و' and 'ی'
    'و([اێۆە])', 'w$1', //و + vowel => w (e.g. wan)
    'ی([اێۆە])', 'y$1', //ی + vowel => y (e.g. yas)
    '([اێۆە])و', '$1w', //vowel + و => w (e.g. kew)
    '([اێۆە])ی', '$1y', //vowel + ی => y (e.g. bey)
    '(^|[^ء-يٱ-ەwy])و([^ء-يٱ-ەwy])', '$1û$2', //non-letter + 'و' + non-letter => û (=and)
    '(^|[^ء-يٱ-ەwy])و', '$1w', //non-letter + 'و' => w (e.g. wtar)
    'یو', 'îw', //'ی' + 'و' => îw (e.g. nîw)
    'یی', 'îy', //'ی' + 'ی' => îy (e.g. kanîy)
    'وی', 'uy', //'و' + 'ی' => uy (e.g. buyn)
    'وو', 'û', //'و' + 'و' => û (e.g. bû)
    'ی', 'î',
    'و', 'u',
    'uu', 'û', //'و' + 'و' => û (e.g. bû)

    '([ء-يٱ-ەîuûwy])ڕ', '$1rr', //when 'ڕ' not at the beginning of a word => rr
    'ر|ڕ', 'r',
    'ش', 'ş',
    'ئ', '',
    'ا', 'a',
    'ب', 'b',
    'چ', 'ç',
    'ج', 'c',
    'د', 'd',
    'ێ', 'ê',
    'ە|ه‌', 'e',
    'ف', 'f',
    'خ|غ', 'x',
    'گ', 'g',
    'ح|ھ', 'h',
    'ژ', 'j',
    'ک', 'k',
    'ڵ', 'll',
    'ل', 'l',
    'م', 'm',
    'ن', 'n',
    'ۆ', 'o',
    'پ', 'p',
    'ق', 'q',
    'س', 's',
    'ت', 't',
    'ڤ', 'v',
    'ز', 'z',
    'ع', '\'',
    '‌', '',
    '؟', '?',
    '،', '\,',
    '؛', '\;',
    '٠|۰', '0',
    '١|۱', '1',
    '٢|۲', '2',
    '٣|۳', '3',
    '٤|۴', '4',
    '٥|۵', '5',
    '٦|۶', '6',
    '٧|۷', '7',
    '٨|۸', '8',
    '٩|۹', '9',
    '»|«', '"',
    'ـ', '',

    //insert i where applicable

    'll', 'Ľ', //temporary conversion to avoid seeing ll as 2 letters
    'rr', 'Ŕ', //temporary conversion to avoid seeing rr as 2 letters
    '([bcçdfghjklĽmnpqrŔsştvwxz])([fjlĽmnrŔsşvwxyz])([fjlĽmnrŔsşvwxyz])([^aeêiîouûy])', '$1$2i$3$4', //e.g. grft -> grift
    '([aeêiîouû])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])\\b', '$1$2$3i$4', //e.g. cejnt -> cejnit
    '([fjlĽrŔsşwyz])([fjlĽmnrŔsşvwxyz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1i$2$3', //e.g. wrd -> wird
    '([bcçdghkmnpqtvx])([fjlĽmnrŔsşvwxyz])($|[^aeêiîouû])', '$1i$2$3', //e.g. prd -> pird
    '([^aeêiîouû])([bcçdghkmnpqtvx])([fjlĽmnrŔsşvwxyz])($|[^aeêiîouû])', '$1$2i$3$4', //repeat the latter expression, in case skipped
    '(^|[^aeêiîouy])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])($|[^aeêiîouû])', '$1$2i$3$4', //e.g. ktk -> kitk
    '(^|[^a-zçşêîûĽŔ])([bcçdfghjklĽmnpqrŔsştvwxz])(\\s)', '$1$2i$3', //e.g. j -> ji
    'Ľ', 'll', //revert the temporary conversion
    'Ŕ', 'rr' //revert the temporary conversion
);

var sOnsetI = new Array(
    '([bcçdfghjklmnpqrsştvwxz])([wy][aeêiîouû])', '$1i$2', //e.g. dyar -> diyar
    '(^|[^a-zêîûçş0-9\'’])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1$2i$3', //e.g. bra -> bira
    '([bcçdfghjklmnpqrsştvwxz][bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1i$2' //e.g. aşkra -> aşkira
);

// Standardize Arabic scripts Array
var sConvertStandardise = new Array(
    '‌{1,}', '‌', //omit multiple successive zero-width non-joiners
    'لاَ|لأ|لآ', 'لا',
    'لً|لَ', 'ل',
    'ص','س',
    'ض', 'ز',
    'ث', 'س',
    'ظ', 'ز',
    'ط', 'ت',
    'ىَ|يَ|یَ', 'ی',
    'رِ', 'ر',
    'ؤ|وَ', 'و',
    'ي|ى', 'ی',
    'ذ', 'ز',
    'ك', 'ک',
    // using unicode: 06D5 (Arabic letter Ae) for E
    // using unicode: 06BE (Arabic letter He Doachashmee) for H
    'ه‍', 'ھ',
    'ه($|[^ء-يٱ-ە])', 'ە$1',
    'ە‌', 'ە',
    'ة', 'ە',
    'ه', 'ھ', // rest of هs are H
    '([ء-يٱ-ە])‌([^ء-يٱ-ە])', '$1$2'
);

function arami_to_latin(s) {
    
    // standardize Arabic before converting Arabic to Latin
    for (i = 0; i < sConvertStandardise.length; i += 2)
        s = s.replace(new RegExp(sConvertStandardise[i], 'g'), sConvertStandardise[i + 1]);

    //main conversion
    for (i = 0; i < sConvertArabic2Latin.length; i += 2)
        s = s.replace(new RegExp(sConvertArabic2Latin[i], 'gim'), sConvertArabic2Latin[i + 1]);

    s = s.replace(new RegExp('ll', 'gim'), 'Ľ').replace(new RegExp('rr', 'gim'), 'Ŕ'); //temporary conversion

    //add extra i's for Kurmanci texts
    for (i = 0; i < sOnsetI.length; i += 2)
        s = s.replace(new RegExp(sOnsetI[i], 'gim'), sOnsetI[i + 1]); //e.g. bra -> bira

    s = s.replace(new RegExp('Ľ', 'gim'), 'll').replace(new RegExp('Ŕ', 'gim'), 'rr'); //temporary conversion

    return s;
}

// allekok.com
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

function color_num (pID) {
    return (pID%22) ? (pID - (22 * Math.floor(pID/22))) : 22;
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
            clrNum = color_num(favs[a].poetID);
            
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
        favs = favs.split("[fav]");
        
        var where = favs.indexOf(poemV2);
        
        if(where > -1) {
            favs = favs.join('[fav]');
            var sd = poemV2 + "[fav]";
            favs = favs.replace(sd,"");
            
            if(favs.length>6) {
                localStorage.setItem('favorites',favs);
            } else {
                localStorage.removeItem('favorites');
                tL.style.display = "none";
            }
            
            //change like-ico
            ico.innerHTML = "bookmark_border";
            ico.style.animation = "";
            
        } else {
            
            favs = favs.join('[fav]');
            favs += poemV2 + "[fav]";
            
            localStorage.setItem('favorites',favs);
            // change like-ico
            ico.innerHTML = "bookmark";
            ico.style.animation = "ll 0.4s ease-out forwards";
            
        }
    } else {
        
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

function ss(button) {
    var href = button.parentNode.querySelector("a").getAttribute("href");
    href = href.substr(href.indexOf("=")+1);
    href = href.split("/");
    button.innerHTML = "<i class='loader' style='width:2.2em;height:2.2em;display:block;'></i>";
    var pt = href[0].split(":")[1];
    var bk = href[1].split(":")[1];
    var pm = href[2].split(":")[1];
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", `/script/php/poem-summary.php?pt=${pt}&bk=${bk}&pm=${pm}`);
    xmlhttp.onload = function() {
        button.innerHTML = "<i class=\"material-icons\" style=\"vertical-align: middle;\">keyboard_arrow_down</i>";
        var san_txt = this.responseText.replace(/\n/g, "<br>");
        button.parentNode.outerHTML += `<div style='background: #f8f8f8;padding: 1em;font-size: .55em;border:0;'>${san_txt}</div>`;
    }
    xmlhttp.send();
}

/// check if liked
var likeico = document.getElementById('like-icon');

var favs = localStorage.getItem('favorites');

if(favs !== null && typeof poemV2 !== 'undefined') {
    favs = favs.split("[fav]");
    
    var where = favs.indexOf(poemV2);
    
    if(where > -1) {
        likeico.innerHTML = "bookmark";
        likeico.style.color = colors[color_num(JSON.parse(poemV2).poetID)][0];
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
