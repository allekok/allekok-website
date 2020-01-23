const _R = _relativePath || "/";
const _R_LEN = _R.length;
var bookmarks_name = bookmarks_name || 'favorites';

var arabi_to_latin = arabi_to_latin || function (s)
{
    /* `arabi_to_latin' function:
       Copyright (C) 2010 by Pellk KurdiNus under GPLv2 License.
       https://github.com/allekok/kurdi-nus */
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

var poetImage = poetImage || function (pID, callback)
{
    const client = new XMLHttpRequest(),
	  url = `${_R}style/img/poets/profile/profile_${pID}.jpg`;
    client.open("get", url);
    client.onload = function()
    {
	if(this.status != 404)
	    callback(url);
    }
    client.send();
}

var toggle_search = toggle_search || function ()
{
    const Sec = document.getElementById('search'),
	  Key = document.getElementById("search-key"),
	  Icon = document.getElementById('tS');
    
    if(Sec.style.display != "block")
    {
        Sec.style.display = "block";
        Icon.classList.add('color-blue');
        Key.focus();
    }
    else
    {
        Sec.style.display="none";
        Icon.classList.remove('color-blue');
    }
}

var get_bookmarks = get_bookmarks || function ()
{
    const bookmarks = localStorage.getItem(bookmarks_name);
    try
    {
	return JSON.parse(bookmarks);
    }
    catch(e)
    {
	return update_bookmarks(bookmarks);
    }
}

var update_bookmarks = update_bookmarks || function (bookmarks)
{
    bookmarks = bookmarks.split("[fav]");
    let newBookmarks = [];
    for(const i in bookmarks)
    {
	if(bookmarks[i])
	    newBookmarks.push(JSON.parse(bookmarks[i]));
    }
    localStorage.setItem(bookmarks_name, JSON.stringify(newBookmarks));
    return newBookmarks;
}

var toggle_Like = toggle_Like || function ()
{
    const bookmarksSection = document.getElementById('tL-res'),
	  bookmarksIcon = document.getElementById('tL');    
    if(bookmarksSection.style.display == "block")
    {
        bookmarksSection.style.display = "none";
        bookmarksIcon.classList.remove('color-blue');
        return;
    }    
    const favs = get_bookmarks();
    let favsString="", imgs=[];
    for(let a=(favs.length-1); a>=0; a--)
    {
        favsString += `<a href='${_R}${favs[a].url}'
><img class='PI${favs[a].poetID}' src='${_R}style/img/poets/profile/profile_0.png'
style='display:inline-block;vertical-align:middle;width:2.5em;border-radius:50%;
margin-left:.5em'>${favs[a].poetName} &rsaquo; ${favs[a].poem}</a>`;
	if(imgs.indexOf(favs[a].poetID) === -1)
	    imgs.push(favs[a].poetID);
    }    
    document.getElementById('tL-res-res').innerHTML = favsString;
    
    bookmarksSection.style.display = "block";
    bookmarksSection.style.animation = "tL .2s";
    bookmarksIcon.classList.add('color-blue');

    imgs.map(function(pID) {
	poetImage(pID, function(url) {
	    document.getElementById("tL-res-res").
		querySelectorAll(`.PI${pID}`).
		forEach(function(item) {
		    item.src = url;
		});
	});
    });
    ajax();
}

var toggle_nav = toggle_nav || function ()
{
    const nav = document.getElementById('header-nav');
    if(nav.style.display == 'none')
    {
	nav.style.display = '';
	nav.style.animation = 'tL-top .1s';
    }
    else
    {
	nav.style.display = 'none';
    }
}

var search = search || function (e)
{
    const Res = document.getElementById("search-res"),
	  Sec = document.getElementById("search"),
	  Key = document.getElementById("search-key"),
	  q = Key.value,
	  currentKey = e.keyCode,
	  noActionKeys = [16, 17, 18, 91, 20, 9, 93,
			  37, 38, 39, 40, 32, 224, 13];
    if(q.length < 3)
    {
        Res.style.display="none";
        return;
    }
    if(currentKey == 27)
    {
	Res.style.display="none";
	Key.value="";
        return;
    }
    if(noActionKeys.indexOf(currentKey) !== -1) return;
    
    Res.style.display="block";
    Res.innerHTML="<div class='loader'></div>";
    getUrl(`${_R}script/php/search-quick.php?q=${q}`,
	   function(response)
	   {
	       Res.innerHTML = response;
	   });
}

window.Clipboard = (function (window, document, navigator) {
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

var copyPoem = copyPoem || function ()
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
    
    for(const hc in htmlchars)
    {
        text = text.replace(htmlchars[hc], "");
    }    
    text = text.replace(/<sup>/gi, "[").replace(/<\/sup>/gi, "]");
    text = text.replace(/\n\n+/g, "\n\n");
    text = text.trim();
    
    Clipboard.copy(text);
    
    copySec.innerHTML = "check";
    copySec.classList.add("back-blue");
    setTimeout(function() {
        copySec.innerHTML = "content_copy";
        copySec.classList.remove("back-blue");
    }, 3000);
}

var Liked = Liked || function ()
{
    const bookmarksIcon = document.getElementById('tL'),
	  ico = document.getElementById("like-icon"),
	  tN = document.getElementById('tN');
    let bookmarks = get_bookmarks();
    
    if(!bookmarks)
    {
        localStorage.setItem(bookmarks_name,
			     JSON.stringify([poemObject]));
	ico.innerHTML = "bookmark";
	ico.classList.add("back-blue");
        ico.style.animation = "ll .4s ease-out forwards";
        bookmarksIcon.style.display = "block";
	tN.style.left = "2.6em";
	return;
    }
    
    let where = -1;
    for(const i in bookmarks)
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
	ico.classList.add("back-blue");
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
	    tN.style.left = "1.3em";
        }
	ico.innerHTML = "bookmark_border";
	ico.classList.remove("back-blue");
        ico.style.animation = "";        
    }
}

var save_fs = save_fs || function (how)
{
    const hon = document.getElementById("hon"),
	  wW = window.innerWidth,
	  hows = ["smaller", "bigger"],
	  scale = 3;
    let fs = parseInt(hon.style.fontSize);
    
    if(isNaN(fs))
    {
        if(wW > 600)
            fs=30;
	else
            fs=24;
    }
    
    /* Bigger */
    if(hows[1] == how)
    {
        if(fs >= 120)
            return;
	fs += scale;
    }
    
    /* Smaller */
    else if(hows[0] == how)
    {
        if(fs <= 6)
            return;
        fs -= scale;
    }
    localStorage.setItem('fontsize', fs);
    hon.style.fontSize = `${fs}px`;
}

var isJson = isJson || function (str)
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

var parse_allekok_link = parse_allekok_link || function (link)
{
    link = link.split('/');
    for(let i=0; i<3; i++)
    {
	if(! link[i]) link[i] = '';
	link[i] = link[i].split(':')[1];
    }
    
    return {
	pt: link[0] || '',
	bk: link[1] || '',
	pm: link[2] || '',
    };
}

var parse_search_link = parse_search_link || function (link)
{
    link = link.substr(link.indexOf('=')+1);
    return parse_allekok_link(link);
}

var parse_poem_link = parse_poem_link || function (link)
{
    link = link.substr(_R_LEN);
    return parse_allekok_link(link);
}

var show_summary = show_summary || function (button, parse_func)
{
    button.innerHTML = "<div class='loader-round' \
style='width:1em;height:1em'></div>";
    
    const href = button.parentNode.querySelector('a').
	  getAttribute('href');
    const href_parsed = parse_func(href);
    const pt = href_parsed.pt,
	  bk = href_parsed.bk,
	  pm = href_parsed.pm;
    
    getUrl(`${_R}script/php/poem-summary.php?pt=${pt}&bk=${bk}&pm=${pm}`,
	   function(response)
	   {
               button.innerHTML = "dehaze";
               const san_txt = response.replace(/\n/g, "<br>");
               button.parentNode.outerHTML += `<div style='padding:1em;font-size:.55em'>${san_txt}</div>`;
	   });
}

var show_summary_search = show_summary_search || function (btn)
{
    show_summary(btn, parse_search_link);
}

var show_summary_poem = show_summary_poem || function (btn)
{
    show_summary(btn, parse_poem_link);
}

var filterp = filterp || function (needle="", context, lastChance=false)
{
    let res = false;
    
    needle = san_data(needle, lastChance);
    
    context.forEach(function(item) {
	const cx = san_data(item.textContent, lastChance),
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

var KurdishNumbers = KurdishNumbers || function (inp="")
{
    const en = [/0/g,/1/g,/2/g,/3/g,/4/g,/5/g,/6/g,/7/g,/8/g,/9/g],
	  fa = [/۰/g,/۱/g,/۲/g,/۳/g,/۴/g,/۵/g,/۶/g,/۷/g,/۸/g,/۹/g],
	  ku = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    
    for (const i in en)
        inp = inp.replace(en[i], ku[i]).replace(fa[i], ku[i]);
    
    return inp;
}

var san_data = san_data || function (inp="", lastChance=false)
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
    
    for (const i in extras)
        inp = inp.replace(extras[i], "");

    for (const i in ar_signs)
        inp = inp.replace(ar_signs[i], "");

    for (const i in kurdish_letters)
        inp = inp.replace(other_letters[i], kurdish_letters[i]);

    inp = KurdishNumbers(inp);
    if (lastChance) inp = san_data_more(inp);
    return inp;
}

var san_data_more = san_data_more || function (inp)
{
    /* Remove 'ه' and Numbers */
    const nums = [/٠/g,/١/g,/٢/g,/٣/g,/٤/g,/٥/g,/٦/g,/٧/g,/٨/g,/٩/g];
    inp = inp.replace(/ه/g, '');
    for(const i in nums)
	inp = inp.replace(nums[i], '');
    return inp;
}

var getUrl = getUrl || function (url, callback)
{
    const client = new XMLHttpRequest();
    client.open('get', url);
    client.onload = function ()
    {
	callback(client.responseText);
    }
    client.send();
}

var postUrl = postUrl || function (url, request, callback)
{
    const client = new XMLHttpRequest();
    client.open('post', url);
    client.onload = function ()
    {
	callback(this.responseText);
    }
    client.setRequestHeader(
	"Content-type","application/x-www-form-urlencoded");
    client.send(request);
}

var poem_kind = poem_kind || function (poem)
{
    if(poem.indexOf("<div class=\"n\">")!=-1)
    {
	return "new";
    }
    return "classic";
}

var concat_url_query = concat_url_query || function (url, q)
{
    const c = parse_poem_link(url);
    if(c.pt)
	url = `${_R}?ath=${c.pt}&bk=${c.bk}&id=${c.pm}`;
    
    if(url.indexOf('?') !== -1)
	return url + '&' + q;
    
    return url + '?' + q;	
}

var match_all = match_all || function (str, needle, n=-1)
{
    let res = [];
    let p = 0, r = -1;
    while(-1 !== (r=str.indexOf(needle, p)))
    {
	if(n == 0) break;
	n--;
	
	res.push(r);
	p = r+1;
    }
    return res || false;
}

var eval_js = eval_js || function (str)
{
    const scripts_beg = match_all(str, '<script>'),
	  scripts_end = match_all(str, '</script>');
    for(const i in scripts_beg)
    {
	const s_b = scripts_beg[i];
	const s_e = scripts_end[i];
	const js = str.substring(s_b+8, s_e);
	eval(js);
    }
}

var hashStr = hashStr || function (str)
{
    return str;
}

var ajax_findstate = ajax_findstate || function (url, max_delta=9000000)
{
    const time = Date.now(),
	  db_name = `hist_${hashStr(url)}`;
    try
    {
	const db_obj = JSON.parse(localStorage.getItem(db_name));
	if((time - db_obj.time) > max_delta)
	{
	    localStorage.removeItem(db_name);
	    return false;
	}
	return db_obj.content;
    }
    catch (e)
    {
	return false;
    }
}

var ajax_savestate = ajax_savestate || function (url,content)
{
    const time = Date.now(),
	  db_name = `hist_${hashStr(url)}`,
	  db_obj = {url:url, time:time, content:content};
    localStorage.setItem(db_name, JSON.stringify(db_obj));
}

var ajax = ajax || function (parent='body', target='#MAIN')
{
    const t = document.querySelector(target),
	  p = document.querySelector(parent),
	  loading = document.getElementById('main-loader');
    
    p.querySelectorAll('a').forEach(function (o) {
	if(o.getAttribute('target') != '_blank')
	{
	    o.onclick = function (e) {
		const href = o.getAttribute('href');
		if(href.indexOf('#') === -1)
		{
		    e.preventDefault();
		    
		    loading.style.display = 'block';
		    
		    const url = concat_url_query(href, 'nohead&nofoot');

		    let content = "";
		    if(content = ajax_findstate(url))
		    {
			window.history.pushState({url: url}, '', href);
			window.scrollTo(0,0);
			t.outerHTML = content;
			eval_js(content);
			ajax(parent, target);
			loading.style.display = 'none';
		    }
		    else
		    {
			getUrl(url, function (response) {
			    window.history.pushState({url: url}, '', href);
			    window.scrollTo(0,0);
			    t.outerHTML = response;
			    eval_js(response);
			    ajax(parent, target);
			    loading.style.display = 'none';
			    ajax_savestate(url, response);
			});
		    }
		}
	    }
	}
    });
}

ajax();

var ajax_popstate = ajax_popstate || function ()
{
    const loading = document.getElementById('main-loader'),
	  t = document.querySelector('#MAIN'),
	  S = window.history.state;
    if(!S) return;
    const url = S.url;
    if(!url) return;
    
    loading.style.display = 'block';

    let content = "";
    if(content = ajax_findstate(url))
    {
	t.outerHTML = content;
	eval_js(content);
	ajax();
	loading.style.display = 'none';
    }
    else
    {
	getUrl(url, function (response) {
	    t.outerHTML = response;
	    eval_js(response);
	    ajax();
	    loading.style.display = 'none';
	    ajax_savestate(url, response);
	});
    }
}

window.onpopstate = ajax_popstate;
/* Check if bookmarks? */
const bookmarksIcon = document.getElementById('tL'),
      favs = get_bookmarks(),
      tN = document.getElementById('tN'),
      tS = document.getElementById('tS'),
      bookmarksIconLeft = bookmarksIcon.style.left;
if(favs)
{
    if(bookmarksIcon)
    {
        bookmarksIcon.style.display = "block";
	if(tS)
	{
	    if(bookmarksIconLeft)
		bookmarksIcon.style.left = "1.3em";
	    else
		bookmarksIcon.style.right = "1.3em";
	}
	else
	{
	    if(bookmarksIconLeft)
	    {
		bookmarksIcon.style.left = "0";
		tN.style.left = "1.3em";
	    }
	    else
	    {
		bookmarksIcon.style.right = "0";
		tN.style.right = "1.3em";
	    }
	    
	}
    }
}
else if(tN)
{
    if(tS)
    {
	if(bookmarksIconLeft)
	    tN.style.left = "1.3em";
	else
	    tN.style.right = "1.3em";
    }
    else
    {
	if(bookmarksIconLeft)
	    tN.style.left = "0";
	else
	    tN.style.right = "0";
    }
}

document.getElementById("search-form").
    addEventListener("submit", function(e) {
	const Key = document.getElementById("search-key");
	if(Key.value == "")
	{
            e.preventDefault();
            Key.focus();
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
    document.getElementById("tN").
	addEventListener("click", toggle_nav);
} catch(e) {}

try
{
    document.getElementById("like-icon").
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
	addEventListener("click", () =>
			 {
			     save_fs("smaller")
			 });
} catch(e) {}

try
{
    document.querySelector(".bigger").
	addEventListener("click", () =>
			 {
			     save_fs("bigger")
			 });
} catch(e) {}
