/*** Allekok.com's javascript file. ***/
"use strict"
/** Arabi to Latin Conversion **/
/* *
 * Captured from source code of "Pellk KurdiNus 4.0".
 * https://allekok.com/Kurdi-Nus/Kurdi Nus 4.0 Kurdish.html
 * */
var sConvertArabic2Latin = [
    //managing 'و' and 'ی'
    'و([اێۆە])', 'w$1', 
    'ی([اێۆە])', 'y$1',
    '([اێۆە])و', '$1w',
    '([اێۆە])ی', '$1y',
    '(^|[^ء-يٱ-ەwy])و([^ء-يٱ-ەwy])', '$1û$2',
    '(^|[^ء-يٱ-ەwy])و', '$1w',
    'یو', 'îw',
    'یی', 'îy',
    'وی', 'uy',
    'وو', 'û', 
    'ی', 'î',
    'و', 'u',
    'uu', 'û',

    '([ء-يٱ-ەîuûwy])ڕ', '$1rr', 
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

    'll', 'Ľ', 
    'rr', 'Ŕ', 
    '([bcçdfghjklĽmnpqrŔsştvwxz])([fjlĽmnrŔsşvwxyz])([fjlĽmnrŔsşvwxyz])([^aeêiîouûy])', '$1$2i$3$4', 
    '([aeêiîouû])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])\\b', '$1$2$3i$4', 
    '([fjlĽrŔsşwyz])([fjlĽmnrŔsşvwxyz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1i$2$3', 
    '([bcçdghkmnpqtvx])([fjlĽmnrŔsşvwxyz])($|[^aeêiîouû])', '$1i$2$3', 
    '([^aeêiîouû])([bcçdghkmnpqtvx])([fjlĽmnrŔsşvwxyz])($|[^aeêiîouû])', '$1$2i$3$4', 
    '(^|[^aeêiîouy])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])($|[^aeêiîouû])', '$1$2i$3$4', 
    '(^|[^a-zçşêîûĽŔ])([bcçdfghjklĽmnpqrŔsştvwxz])(\\s)', '$1$2i$3', 
    'Ľ', 'll', 
    'Ŕ', 'rr' 
];

var sOnsetI = [
    '([bcçdfghjklmnpqrsştvwxz])([wy][aeêiîouû])', '$1i$2', 
    '(^|[^a-zêîûçş0-9\'’])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1$2i$3', 
    '([bcçdfghjklmnpqrsştvwxz][bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1i$2' 
];

// Standardize Arabic scripts Array
var sConvertStandardise = [
    '‌{1,}', '‌', 
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
    'ه‍', 'ھ',
    'ه($|[^ء-يٱ-ە])', 'ە$1',
    'ە‌', 'ە',
    'ة', 'ە',
    'ه', 'ھ', 
    '([ء-يٱ-ە])‌([^ء-يٱ-ە])', '$1$2'
];

function arabi_to_latin(s) {
    var i;
    // standardize Arabic before converting Arabic to Latin
    for (i = 0; i < sConvertStandardise.length; i += 2)
        s = s.replace(new RegExp(sConvertStandardise[i], 'g'), sConvertStandardise[i + 1]);

    //main conversion
    for (i = 0; i < sConvertArabic2Latin.length; i += 2)
        s = s.replace(new RegExp(sConvertArabic2Latin[i], 'gim'), sConvertArabic2Latin[i + 1]);

    // temporary conversion
    s = s.replace(new RegExp('ll', 'gim'), 'Ľ').replace(new RegExp('rr', 'gim'), 'Ŕ');
    //add extra i's for Kurmanci texts
    for (i = 0; i < sOnsetI.length; i += 2)
        s = s.replace(new RegExp(sOnsetI[i], 'gim'), sOnsetI[i + 1]); //e.g. bra -> bira
    s = s.replace(new RegExp('Ľ', 'gim'), 'll').replace(new RegExp('Ŕ', 'gim'), 'rr'); //temporary conversion

    return s;
}

function color_num (pID) {
    return (pID%22) ? (pID - (22 * Math.floor(pID/22))) : 22;
}

function poetImage (pID, callback) {
    var client = new XMLHttpRequest(),
	url = `/style/img/poets/profile/profile_${pID}.jpg`;
    
    client.open("get", url);
    client.onload = function() {
	if(this.status == 404) {
	    poetImage(0);
	}
	else {
	    callback(url);
	}
    }
    client.send();
}

function toggle_search() {
    var s = document.getElementById('search'),
	sk = document.getElementById("search-key"),
	h = document.querySelector('header'),
	tS = document.getElementById('tS');
    
    if(s.style.display != "block") {
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

function get_bookmarks() {
    var bookmarks = localStorage.getItem("favorites");
    if(! bookmarks) return false;
    
    bookmarks = bookmarks.split("[fav]").
			  reverse().
			  map(
			      function (bookmark) {
				  if(! bookmark) return;
				  return JSON.parse(bookmark);
			      });
    bookmarks.shift();
    return bookmarks;
}

function toggle_Like() {
    var tL_res = document.getElementById('tL-res'),
	tL = document.getElementById('tL');
    
    if(tL_res.style.display == "block") {
        tL_res.style.display = "none";
        tL.style.opacity = "";
        return;
    }
    
    var favs=get_bookmarks(),
	favsS="",
	clrNum=0,
	imgs=[];
    
    for(var a in favs) {
        clrNum = color_num(favs[a].poetID);        
        favsS += `<a class='link' style='border-bottom:1px solid #eee' href='/${favs[a].url}'><img class='PI${favs[a].poetID}' src='/style/img/poets/profile/profile_0.jpg' style='display:inline-block;vertical-align:middle;width:2.5em;border-radius:100%;'> <span style='font-size:.85em; color:#555;'>${favs[a].poetName} &rsaquo; ${favs[a].book} &rsaquo;</span> ${favs[a].poem} </a>`;
	imgs.push(favs[a].poetID);
    }
    
    document.getElementById('tL-res-res').innerHTML = favsS;
    
    tL_res.style.animation = "tL 0.6s";
    tL_res.style.display = "block";
    tL.style.opacity = "1";

    imgs.map(function(pID) {
	poetImage(pID, function(url) {
	    document.getElementById("tL-res-res").
		     querySelector(`.PI${pID}`).
		     src = url;
	});
    });
}

function search(e) {
    var str=document.getElementById("search-key").value,
	sres=document.getElementById("search-res"),
	s=document.getElementById('search'),
	loading = "<div class='loader'></div>",
	xmlhttp=new XMLHttpRequest(),
	C = e.keyCode,
	noActionKeys = [16, 17, 18, 91, 20, 9, 93, 37, 38, 39, 40, 32, 224, 13];
    
    if(noActionKeys.indexOf(C) === -1) {
	
	// 27 keyCode = ESC Key
	if(C == 27) {
            s.style.display="none";
            return;
	}
	
        var sbtn = document.querySelector("#live-search-form #search-btn");
        
        if(str.length<3) {
	    sbtn.innerHTML = "<i class='material-icons' style='font-size:2em;'>search</i>";
	    return;
        }
        
        sres.innerHTML=loading;
        sres.style.display="block";
        
        var request = `/script/php/live-search2.php?q=${str}`;
        xmlhttp.open("get",request);
        xmlhttp.onload=function() {
	    sres.innerHTML = this.responseText;
	    sbtn.innerHTML = "گەڕانی زۆرتر";
        };
	xmlhttp.send();

	// the End of noActionKeys, IF....
    } else if(str == "") {
        sres.style.display="none";
        sres.innerHTML=loading;
        return;
    }
}

window.Clipboard = (function(window, document, navigator) {
    /* Copied from some github gist */
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
    var text = document.getElementById("hon").innerHTML,
	copySec = document.getElementById("copy-sec"),
	htmlchars = [
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
    
    text = text.replace(/<sup>/gi, "[").
		replace(/<\/sup>/gi, "]").
		trim();
    
    Clipboard.copy(text);
    
    copySec.innerHTML = "<i class='material-icons' style='vertical-align:middle;'>check</i> کۆپی کرا.";
    copySec.style.backgroundColor = "#cfc";
    
    setTimeout(function(){
        copySec.innerHTML = "<i class='material-icons' style='vertical-align:middle;'>content_copy</i> کۆپی کردن ";
        copySec.style.backgroundColor = "";
	
    },3000);
}

function Liked () {
    var tL = document.getElementById('tL'),
	ico = document.getElementById("like-icon"),
	favs = localStorage.getItem('favorites'),
	bookmarks = get_bookmarks();
    
    if(favs !== null) {
        
        var where = -1;
	var JSON_poem = JSON.parse(poemV2);
	for(var i in bookmarks) {
	    if(bookmarks[i].url == JSON_poem.url) {
		where = i;
		break;
	    }
	}
	
        if(where > -1) {
	    bookmarks.splice(where, 1);
	    for(var i in bookmarks) {
		bookmarks[i] = JSON.stringify(bookmarks[i]);
	    }
            bookmarks = bookmarks.join('[fav]') + "[fav]";
            
            if(bookmarks.length>6) {
                localStorage.setItem('favorites',bookmarks);
            } else {
                localStorage.removeItem('favorites');
                tL.style.display = "none";
            }
            
            //change like-ico
            ico.innerHTML = "bookmark_border";
            ico.style.animation = "";
            
        } else {
            
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
    var hon=document.getElementById("hon"),
	fs=parseInt(hon.style.fontSize),
	wW = window.innerWidth,
	newfs = 0,
	hows = ["smaller", "bigger"],
	scale = 3;

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
    var pt = href[0].split(":")[1],
	bk = href[1].split(":")[1],
	pm = href[2].split(":")[1],
	xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("get", `/script/php/poem-summary.php?pt=${pt}&bk=${bk}&pm=${pm}`);
    xmlhttp.onload = function() {
        button.innerHTML = "<i class=\"material-icons\" style=\"vertical-align: middle;\">keyboard_arrow_down</i>";
        var san_txt = this.responseText.replace(/\n/g, "<br>");
        button.parentNode.outerHTML += `<div style='background: #f8f8f8;padding: 1em;font-size: .55em;border:0;'>${san_txt}</div>`;
    }
    xmlhttp.send();
}

function filterp(needle="", context, lastChance=false) {
    var res = false;
    
    needle = san_data(needle, lastChance);
    
    context.forEach(function(item) {
	var cx = san_data(item.innerHTML, lastChance);
	var _filterp = (needle == "") ? true : (cx.indexOf(needle) !== -1);
	if (_filterp) {
	    item.style.display = "";
	    res = true;
	}
	else {
	    item.style.display = "none";
	    res = false;
	}
    });

    if(!res && !lastChance)
	filterp(needle, context, true);
}

function KurdishNumbers(inp="") {
    
    var en = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g],
	ku = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
	ar = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];

    for (var i in en) {
        inp = inp.replace(en[i], ku[i]);
        inp = inp.replace(ar[i], ku[i]);
    }
    
    return inp;
}

function san_data(inp="", lastChance=false) {
    if (inp == "") return "";

    var extras = [/&laquo;/g, /&raquo;/g, /&rsaquo;/g, /&lsaquo;/g, /&bull;/g, /&nbsp;/g, /\?/g, /!/g, /#/g, /&/g, /\*/g, /\(/g, /\)/g, /-/g, /\+/g, /=/g, /_/g, /\[/g, /\]/g, /{/g, /}/g, /</g, />/g, /\//g, /\|/, /\'/g, /\"/g, /;/g, /:/g, /,/g, /\./g, /~/g, /`/g, /؟/g, /،/g, /»/g, /«/g, /ـ/g, /›/g, /‹/g, /•/g, /‌/g, /\s+/g,
                  /؛/g,
    ];
    var ar_signs = ['ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ'];
    
    var kurdish_letters = [
        "ه",
        "ه",
        "ک",
        "ی",
        "ه",
        "ز",
        "س",
        "ت",
        "ز",
        "ر",
        "ه",
        "خ",
        "و",
        "و",
        "و",
        "ی",
        "ر",
        "ل",
        "ز",
        "س",
        "ه",
        "ر",
        "م",
        "ا",
        "ا",
        "ل",
        "س",
        "ی",
        "و",
        "ئ",
        "ی",
    ];

    var other_letters = [
        /ه‌/g,
        /ە/g,
        /ك/g,
        /ي/g,
        /ھ/g,
        /ض/g,
        /ص/g,
        /ط/g,
        /ظ/g,
        /ڕ/g,
        /ح/g,
        /غ/g,
        /وو/g,
        /ۆ/g,
        /ؤ/g,
        /ێ/g,
        /ڕ/g,
        /ڵ/g,
        /ذ/g,
        /ث/g,
        /ة/g,
        /رر/g,
        /مم/g,
        /أ/g,
        /آ/g,
        /لل/g,
        /سس/g,
        /یی/g,
        /ڤ/g,
        /ع/g,
        /ى/g,
    ];
    
    for (var i in extras) {
        inp = inp.replace(extras[i], "");
    }
    
    for (i in ar_signs) {
        inp = inp.replace(ar_signs[i], "");
    }

    for (i in kurdish_letters) {
        inp = inp.replace(other_letters[i], kurdish_letters[i]);
    }

    inp = KurdishNumbers(inp);

    if (lastChance) inp = inp.replace(/ه/g, "");

    return inp;
}

/// check if liked
var likeico = document.getElementById('like-icon'),
    favs = localStorage.getItem('favorites');

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

favs = localStorage.getItem('favorites');

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

var live_search_form = document.getElementById('live-search-form'),
    sk = document.getElementById("search-key");

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
