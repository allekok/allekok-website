"use strict"
const bookmarks_name = 'favorites';
function arabi_to_latin(s)
{
    /* *
     * Taken from "Pellk KurdiNus 4.0".
     * https://allekok.com/kurdi-nus/kurdi-nus-kurdish.html
     * */
    const sConvertArabic2Latin = [
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

    const sOnsetI = [
	'([bcçdfghjklmnpqrsştvwxz])([wy][aeêiîouû])', '$1i$2', 
	'(^|[^a-zêîûçş0-9\'’])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1$2i$3', 
	'([bcçdfghjklmnpqrsştvwxz][bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])', '$1i$2' 
    ];

    // Standardize Arabic scripts Array
    const sConvertStandardise = [
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
    
    let i;
    for (i = 0; i < sConvertStandardise.length; i += 2)
    {
        s = s.replace(new RegExp(sConvertStandardise[i], 'g'),
		      sConvertStandardise[i + 1]);
    }
    
    for (i = 0; i < sConvertArabic2Latin.length; i += 2)
    {
        s = s.replace(new RegExp(sConvertArabic2Latin[i], 'gim'),
		      sConvertArabic2Latin[i + 1]);
    }
    s = s.replace(new RegExp('ll', 'gim'), 'Ľ').
	replace(new RegExp('rr', 'gim'), 'Ŕ');
    
    for (i = 0; i < sOnsetI.length; i += 2)
    {
        s = s.replace(new RegExp(sOnsetI[i], 'gim'), sOnsetI[i + 1]);
    }
    s = s.replace(new RegExp('Ľ', 'gim'), 'll').
	replace(new RegExp('Ŕ', 'gim'), 'rr');
    
    return s;
}

function color_num(pID)
{
    return 0;
}

function poetImage(pID, callback)
{
    const client = new XMLHttpRequest(),
	  url = `/style/img/poets/profile/profile_${pID}.jpg`;
    client.open("get", url);
    client.onload = function()
    {
	if(this.status != 404)
	    callback(url);
    }
    client.send();
}

function toggle_search()
{
    const searchSec = document.getElementById('search'),
	  searchKey = document.getElementById("search-key"),
	  searchIcon = document.getElementById('tS');
    
    if(searchSec.style.display != "block")
    {
        searchSec.style.display = "block";
        searchIcon.style.opacity="1";
        searchKey.focus();
    }
    else
    {
        searchSec.style.display="none";
        searchIcon.style.opacity="";
    }
}

function get_bookmarks()
{
    let bookmarks = localStorage.getItem(bookmarks_name);
    if(! bookmarks) return false;
    try
    {
	return JSON.parse(bookmarks);
    }
    catch(e)
    {
	return update_bookmarks(bookmarks);
    }
}

function update_bookmarks(bookmarks)
{
    bookmarks = bookmarks.split("[fav]");
    let newBookmarks = [];
    for(let i in bookmarks)
    {
	if(bookmarks[i])
	    newBookmarks.push(JSON.parse(bookmarks[i]));
    }
    localStorage.setItem(bookmarks_name, JSON.stringify(newBookmarks));
    return newBookmarks;
}

function toggle_Like()
{
    const bookmarksSection = document.getElementById('tL-res'),
	  bookmarksIcon = document.getElementById('tL');    
    if(bookmarksSection.style.display == "block")
    {
        bookmarksSection.style.display = "none";
        bookmarksIcon.style.opacity = "";
        return;
    }    
    const favs = get_bookmarks();
    let favsString="", imgs=[];
    for(let a=(favs.length-1); a>=0; a--)
    {
        favsString += `<a class='link border-bottom-eee' href='/${favs[a].url}'
><img class='PI${favs[a].poetID}' src='/style/img/poets/profile/profile_0.jpg'
style='display:inline-block;vertical-align:middle;width:3em;border-radius:50%;
margin-left:.25em'> <span class='color-555' style='font-size:.85em'
>${favs[a].poetName} &rsaquo; ${favs[a].book} &rsaquo;</span> ${favs[a].poem} </a>`;
	if(imgs.indexOf(favs[a].poetID) === -1)
	    imgs.push(favs[a].poetID);
    }    
    document.getElementById('tL-res-res').innerHTML = favsString;
    
    bookmarksSection.style.display = "block";
    bookmarksSection.style.animation = "tL .1s";
    bookmarksIcon.style.opacity = "1";

    imgs.map(function(pID) {
	poetImage(pID, function(url) {
	    document.getElementById("tL-res-res").
		querySelectorAll(`.PI${pID}`).
		forEach(function(item) {
		    item.src = url;
		});
	});
    });
}

function search(e)
{
    const searchRes=document.getElementById("search-res"),
	  searchSec=document.getElementById("search"),
	  searchBtn = document.getElementById("search-btn"),
	  searchKey=document.getElementById("search-key"),
	  q=searchKey.value,
	  currentKey = e.keyCode,
	  noActionKeys = [16, 17, 18, 91, 20, 9, 93,
			  37, 38, 39, 40, 32, 224, 13];
    if(q.length < 3)
    {
	searchBtn.innerHTML = "<i class='material-icons' \
style='font-size:2em'>search</i>";
        searchRes.style.display="none";
        return;
    }
    if(currentKey == 27)
    {
	searchBtn.innerHTML = "<i class='material-icons' \
style='font-size:2em'>search</i>";
	searchRes.style.display="none";
	searchKey.value="";
        return;
    }
    if(noActionKeys.indexOf(currentKey) !== -1) return;
    
    searchRes.style.display="block";
    searchRes.innerHTML="<div class='loader'></div>";
    getUrl(`/script/php/search-quick.php?q=${q}`,
	   function(response)
	   {
	       searchRes.innerHTML = response;
	       searchBtn.innerHTML = "گەڕانی زۆرتر";
	   });
}

window.Clipboard = (function(window, document, navigator) {
    let textArea, copy;
    
    function iOS()
    {
        return navigator.userAgent.match(/ipad|iphone/i);
    }
    
    function createTextArea(text)
    {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.insertBefore(textArea, document.body.firstChild);
    }

    function selectText()
    {
        let range, selection;

        if (iOS())
	{
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        }
	else
	{
            textArea.select();
        }
    }

    function copyToClipboard()
    {
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }

    copy = function(text)
    {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };

    return { copy: copy };
    
})(window, document, navigator);

function copyPoem()
{
    const copySec = document.getElementById("copy-sec"),
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
	      /\r+/gi,
	  ];
    let text = document.getElementById("hon").innerHTML;
    
    for(let hc in htmlchars)
    {
        text = text.replace(htmlchars[hc], "");
    }    
    text = text.replace(/<sup>/gi, "[").replace(/<\/sup>/gi, "]");
    text = text.replace(/\n\n+/g, "\n\n");
    text = text.trim();
    
    Clipboard.copy(text);
    
    copySec.innerHTML = "<i class='material-icons'>check</i> کۆپی کرا.";
    copySec.style.color = colors[0][0];
    setTimeout(function() {
        copySec.innerHTML = "<i class='material-icons'>content_copy</i> کۆپی کردن";
        copySec.style.color = "";
    }, 3000);
}

function Liked ()
{
    const bookmarksIcon = document.getElementById('tL'),
	  ico = document.getElementById("like-icon");
    let bookmarks = get_bookmarks(), i = 0;
    
    if(!bookmarks)
    {
        localStorage.setItem(bookmarks_name,
			     JSON.stringify([poemObject]));
	ico.innerHTML = "bookmark";
	ico.style.color = colors[0][0];
        ico.style.animation = "ll .4s ease-out forwards";
        bookmarksIcon.style.display = "block";
	return;
    }
    
    let where = -1;
    for(i in bookmarks)
    {
	if(bookmarks[i].url == poemObject.url)
	{
	    where = i;
	    break;
	}
    }
    
    if(where == -1)
    {
	bookmarks.push(poemObject);
        localStorage.setItem(bookmarks_name,JSON.stringify(bookmarks));
	ico.innerHTML = "bookmark";
	ico.style.color = colors[0][0];
        ico.style.animation = "ll .4s ease-out forwards";        
    }
    else
    {
	bookmarks.splice(where, 1);
        
        if(bookmarks.length>0)
	{
            localStorage.setItem(bookmarks_name,JSON.stringify(bookmarks));
        }
	else
	{
            localStorage.removeItem(bookmarks_name);
            bookmarksIcon.style.display = "none";
        }        
	ico.innerHTML = "bookmark_border";
	ico.style.color = "";
        ico.style.animation = "";        
    }
}

function save_fs(how)
{
    const hon = document.getElementById("hon"),
	  fs = parseInt(hon.style.fontSize),
	  wW = window.innerWidth,
	  hows = ["smaller", "bigger"],
	  scale = 3;
    let newfs = fs;
    if(isNaN(fs))
    {
        if(wW > 600)
	{
            newfs=30;
        }
	else
	{
            newfs=24;
        }
    }
    /* bigger */
    if(hows[1] == how)
    {
        if(newfs >= 120)
            return;
	newfs += scale;
    }
    /* smaller */
    else if(hows[0] == how)
    {
        if(newfs <= 6)
            return;
        newfs -= scale;
    }
    localStorage.setItem("fontsize", newfs);
    hon.style.fontSize = `${newfs}px`;
}

function isJson(str)
{
    try
    {
        return JSON.parse(str);
    }
    catch(e)
    {
        return false;
    }
}

function ss(button) {
    let href = button.parentNode.querySelector("a").getAttribute("href");
    href = href.substr(href.indexOf("=")+1);
    href = href.split("/");
    button.innerHTML = "<i class='loader' style='width:2.2em;height:2.2em;display:block;'></i>";
    const pt = href[0].split(":")[1],
	  bk = href[1].split(":")[1],
	  pm = href[2].split(":")[1],
	  client = new XMLHttpRequest();
    
    getUrl(`/script/php/poem-summary.php?pt=${pt}&bk=${bk}&pm=${pm}`,
	   function(response)
	   {
               button.innerHTML = "<i class='material-icons'>keyboard_arrow_down</i>";
               let san_txt = response.replace(/\n/g, "<br>");
               button.parentNode.outerHTML += `<div class='back-f3f3f3' 
style='padding:1em;font-size:.55em;border:0'>${san_txt}</div>`;
	   });
}

function filterp(needle="", context, lastChance=false) {
    let res = false;
    
    needle = san_data(needle, lastChance);
    
    context.forEach(function(item) {
	let cx = san_data(item.innerHTML, lastChance),
	    _filterp = (needle == "") ? true :
	    (cx.indexOf(needle) !== -1);
	if (_filterp)
	{
	    item.style.display = "";
	    res = true;
	}
	else
	{
	    item.style.display = "none";
	    res = false;
	}
    });

    if(!res && !lastChance)
	filterp(needle, context, true);
}

function KurdishNumbers(inp="") {    
    const en = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g],
	  ar = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g],
	  ku = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    for (let i in en)
    {
        inp = inp.replace(en[i], ku[i]).replace(ar[i], ku[i]);
    }    
    return inp;
}

function san_data(inp="", lastChance=false)
{
    if (inp == "") return "";

    const extras = [
	/&laquo;/g, /&raquo;/g, /&rsaquo;/g, /&lsaquo;/g,
	/&bull;/g, /&nbsp;/g, /\?/g, /!/g, /#/g, /&/g,
	/\*/g, /\(/g, /\)/g, /-/g, /\+/g, /=/g, /_/g,
	/\[/g, /\]/g, /{/g, /}/g, /</g, />/g, /\//g, /\|/,
	/\'/g, /\"/g, /;/g, /:/g, /,/g, /\./g, /~/g, /`/g,
	/؟/g, /،/g, /»/g, /«/g, /ـ/g, /›/g, /‹/g, /•/g, /‌/g,
	/\s+/g, /؛/g,
    ];
    const ar_signs = ['ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ'];
    
    const kurdish_letters = [
        "ه", "ه", "ک", "ی", "ه", "ز", "س", "ت", "ز", "ر",
        "ه", "خ", "و", "و", "و", "ی", "ر", "ل", "ز", "س",
        "ه", "ر", "م", "ا", "ا", "ل", "س", "ی", "و", "ئ",
        "ی",
    ];

    const other_letters = [
        /ه‌/g, /ە/g, /ك/g, /ي/g, /ھ/g, /ض/g, /ص/g, /ط/g,
        /ظ/g, /ڕ/g, /ح/g, /غ/g, /وو/g, /ۆ/g, /ؤ/g, /ێ/g,
        /ڕ/g, /ڵ/g, /ذ/g, /ث/g, /ة/g, /رر/g, /مم/g, /أ/g,
        /آ/g, /لل/g, /سس/g, /یی/g, /ڤ/g, /ع/g, /ى/g,
    ];
    
    let i=0;
    for (i in extras)
    {
        inp = inp.replace(extras[i], "");
    }    
    for (i in ar_signs)
    {
        inp = inp.replace(ar_signs[i], "");
    }
    for (i in kurdish_letters)
    {
        inp = inp.replace(other_letters[i], kurdish_letters[i]);
    }

    inp = KurdishNumbers(inp);
    if (lastChance) inp = inp.replace(/ه/g, "");
    return inp;
}

function getUrl(url, callback) {
    const client = new XMLHttpRequest();
    client.open("get", url);
    client.onload = function ()
    {
	callback(client.responseText);
    }
    client.send();
}

/* check if liked */
const bookmarksIcon = document.getElementById('tL'),
      likeico = document.getElementById('like-icon'),
      favs = get_bookmarks();
if(favs)
{
    if(typeof bookmarksIcon !== "undefined")
    {
        bookmarksIcon.style.display = "block";
    }
    
    if(typeof poemObject !== "undefined")
    {
	for(let i in favs)
	{
	    if(favs[i].url == poemObject.url)
	    {
		likeico.innerHTML = "bookmark";
		likeico.style.color = colors[0][0];
		likeico.style.animation = "ll .4s ease-out forwards";
		break;
	    }
	}
    }
}

document.getElementById("search-form").
    addEventListener("submit", function(e) {
	const searchKey = document.getElementById("search-key");
	if(searchKey.value == "")
	{
            e.preventDefault();
            searchKey.focus();
	}
    });

try
{
    document.getElementById("tL").
	addEventListener("click", toggle_Like);
} catch(e) {}

try
{
    document.getElementById("tS").
	addEventListener("click", toggle_search);
} catch(e) {}

try
{
    document.getElementById("fav-sec").
	addEventListener("click", Liked);
} catch(e) {}

try
{
    document.getElementById("copy-sec").
	addEventListener("click", copyPoem);
} catch(e) {}

try
{
    document.querySelector(".smaller").
	addEventListener("click", function()
			 {
			     save_fs("smaller")
			 });
} catch(e) {}

try
{
    document.querySelector(".bigger").
	addEventListener("click", function()
			 {
			     save_fs("bigger")
			 });
} catch(e) {}
