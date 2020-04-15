const _R = _relativePath || "/";
const _R_LEN = _R.length;
var bookmarks_name = bookmarks_name || 'favorites';

var ar2lat = ar2lat || function (s) {
    window.bizroke = "i";
    window.notsure = [["وو", "û", "uw", "wu", "ww"],
		      ["ی", "î", "y", "îy"],
		      ["و", "u", "w", "uw"]];
    window.v = [["ە", "e"],
		["ێ", "ê"],
		["ۆ", "o"],
		["ا", "a"],
		["i", "i"],
		["u", "u"],
		["î", "î"],
		["û", "û"]];
    window.n = [["ق", "q"],
		["ر", "r"],
		["ڕ", "ř"],
		["ت", "t"],
		["ئ", "'"],
		["ح", "ḧ"],
		["ع", "'"],
		["پ", "p"],
		["س", "s"],
		["ش", "ş"],
		["د", "d"],
		["ف", "f"],
		["گ", "g"],
		["غ", "ẍ"],
		["ه", "h"],
		["ژ", "j"],
		["ک", "k"],
		["ل", "l"],
		["ڵ", "ɫ"],
		["ز", "z"],
		["خ", "x"],
		["ج", "c"],
		["چ", "ç"],
		["ڤ", "v"],
		["ب", "b"],
		["ن", "n"],
		["م", "m"],
		["y", "y"],
		["w", "w"]];
    window.sure = v.concat(n);
    window.determine_notsure = function (R, str) {
	const pos = R[0];
	const ch_arr = R[2];
	const ch_len = ch_arr[0].length;
	const prev_v = is_v(L(str, pos-1));
	const next_v = is_v(L(str, pos + ch_len));
	let i = 1; // v
	if(ch_len == 2) {
	    if(prev_v && next_v) i = 4; // v[cc]v
	    else if(pos == 0 || prev_v) i = 3; // v[cv]c
	    else if(next_v) i = 2; // c[vc]v
	}
	else {
	    if(pos == 1 && next_v && !prev_v) i = 3; // c[vc]v
	    else if(pos == 0 || prev_v || next_v) i = 2; // c
	}
	return i;
    }
    function transliterate (str) {
	return apply_to_words(str, function(x) {
	    if(!x) return x;
	    if(x == "و") return "u";
	    else if(x == "وو") return "û";
	    else return add_bizroke(replace_sure(replace_notsure(x)))
	});
    }
    return transliterate(s);
}

var ar2per = ar2per || function (s) {
    window.bizroke = "\u{652}";
    window.notsure = [["وو", "و\u{64F}", "و\u{651}"],
		      ["یی", "یی", "ی\u{651}"],
		      ["ئە","ا\u{64E}", "ئ\u{64E}"],
		      ["ئۆ","ا\u{64F}", "ئ\u{64F}"],
		      ["ئێ","ا\u{650}", "ئ\u{650}"],
		      ["ئو","او","ئو"],
		      ["ئی","ای","ئوو"]];
    window.v = [["ە","\u{64E}"],
		["ۆ","\u{64F}"],
		["ێ","\u{650}"],
		["و","و"],
		["ی","ی"],
		["ا","ا"],
		["آ","آ"] // It is not a vowel. But it ends with a vowel
	       ];
    window.n = [["ئا","آ"],
		["ڕ","ر"],
		["ڵ","ل"],
		["ڤ","و"]];
    window.sure = n.concat(v);
    window.determine_notsure = function (R, str) {
	const pos = R[0];
	const ch_arr = R[2];
	const ch_len = ch_arr[0].length;
	const prev_v = is_v(L(str, pos-1));
	const next_v = is_v(L(str, pos + ch_len));
	let i = 1; // v
	if(pos !== 0 && prev_v && next_v) i = 2; // v[cc]v
	else if(pos == 0) {
	    for(let j = 2; j < notsure.length; j++)
		if(notsure.indexOf(ch_arr, 2) !== -1) {i = 1; break;}
	}
	return i;
    }
    function transliterate (str) {
	return apply_to_words(str, function(x) {
	    if(!x) return x;
	    return add_bizroke(replace_sure(replace_notsure(x)))
	});
    }
    return transliterate(s);
}

var apply_to_words = apply_to_words || function (poem, fun) {
    let lines = poem.split("\n");
    for(const i in lines) {
	lines[i] = lines[i].split(" ");
	for(const j in lines[i])
	    lines[i][j] = fun(lines[i][j]);
	lines[i] = lines[i].join(" ");
    }
    return lines.join("\n");
}

var replace_sure = replace_sure || function (str, f=0, t=1) {
    for(const o of sure)
	str = str.replace(new RegExp(o[f],"g"), o[t]);
    return str;
}

var replace_notsure = replace_notsure || function (str, i=0) {
    let off = 0, R;
    while(false !== (R = assoc_first(str, notsure, i, off))) {
	const j = determine_notsure(R, str);
	str = str_replace_pos(R[2][i], R[2][j], str, R[0]);
	off = R[0] + R[2][j].length;
    }
    return str;
}

var assoc_first = assoc_first || function (str, arr, i=0, off=0) {
    let pos, poses = [];
    for(const o of arr)
	if(-1 !== (pos = str.indexOf(o[i], off)))
	    poses.push([pos, (1.0 / o[i].length), o]);
    poses.sort();
    return poses.length ? poses[0] : false;
}

var L = L || function (str, pos, len=1) { return str.substr(pos, len); }

var is_v = is_v || function (c) {
    if(c)
	for(const o of v)
	    if(o.indexOf(c) !== -1) return true;
    return false;
}

var str_replace_pos = str_replace_pos || function (from, to, str, pos) {
    return str.substr(0, pos) + to +
	str.substr(pos + from.length);
}

var add_bizroke = add_bizroke || function (str) {
    const L2 = L(str, 1);
    if(!is_v(L(str, 0)) && (!L2 || !is_v(L(str, 1))))
	str = str_replace_pos("", bizroke, str, 1);
    return str;
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

var search = search || function (e)
{
    setTimeout(() => {
	const Res = document.getElementById("search-res"),
	      Sec = document.getElementById("search"),
	      Key = document.getElementById("search-key"),
	      q = Key.value.trim(),
	      currentKey = e.keyCode,
	      noActionKeys = [16, 17, 18, 91, 20, 9, 93,
			      37, 38, 39, 40, 32, 224, 13],
	      url = `${_R}script/php/search-quick.php?q=${q}`;
	if(currentKey == 27)
	{
	    Res.style.display="none";
	    Key.value="";
            return;
	}
	if(noActionKeys.indexOf(currentKey) !== -1) return;
	if(q) {
	    Res.style.display = "block";
	    let content = false;
	    if(content = ajax_findstate(url)) {
		Res.innerHTML = content;
		findPage(q, Res);
	    }
	    else {
		Res.innerHTML = "<div class='loader'></div>";
		/* Server Search */
		getUrl(url, (response) => {
		    Res.innerHTML = response;
		    ajax_savestate(url, response);
		    findPage(q, Res);
		});
	    }
	}
    }, 100);
}

var findPage = findPage || function (q_str, input_el) {
    let input_html = input_el.innerHTML;
    input_html = input_html.replace(/<i style="background:#FF5;color:#000">([^<]*)<\/i>/g,"$1");
    input_html = input_html.replace(new RegExp(`>([^<>]*)(${q_str})([^<>]*)<`,"g"),
				    '>$1<i style="background:#FF5;color:#000">$2</i>$3<');
    input_el.innerHTML = input_html;
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
	  ico = document.getElementById("like-icon");
    let bookmarks = get_bookmarks();
    
    if(!bookmarks)
    {
        localStorage.setItem(bookmarks_name,
			     JSON.stringify([poemObject]));
	ico.innerHTML = "bookmark";
	ico.classList.add("back-blue");
        ico.style.animation = "ll .4s ease-out forwards";
        bookmarksIcon.style.display = "block";
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

var filterp = filterp || function (needle="", context, lastChance=false,
				   toDo=(x,r)=>{x.style.display = r ? "" : "none"})
{
    let res = false;
    
    needle = san_data(needle, lastChance);
    
    context.forEach(function(item) {
	const cx = san_data(item.textContent, lastChance),
	      _filterp = (needle == "") ? true :
	      (cx.indexOf(needle) !== -1);
	if (_filterp) res = true;
	toDo(item, _filterp);
    });

    if(!res && !lastChance)
	filterp(needle, context, true, toDo);
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

var garbageCollector = garbageCollector || function (interval = 750) {
    function collectHistList () {
	let list = [];
	let k = null;
	for(let i = 0;
	    (k = localStorage.key(i)) !== null;
	    i++) {
	    if(k.indexOf("hist_") === 0)
		list.push(k);
	}
	return list;
    }
    const hist_list = collectHistList();
    if(!hist_list) return;
    const GCT = setInterval(function () {
	const hist_item = hist_list.pop();
	if(typeof(hist_item) == 'undefined')
	    clearInterval(GCT);
	else
	    ajax_findstate(hist_item.substr(5));
    }, interval);
}

var hashStr = hashStr || function (str)
{
    return str;
}

var ajax_findstate = ajax_findstate || function (url, max_delta=-1)
{
    if(max_delta == -1)
	max_delta = ajax_save_duration;
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
    let tmp;
    if(!(tmp = content.trim()) || tmp == "<script>const repeater=setInterval(()=>{if(navigator.onLine){window.location.reload();clearInterval(repeater);}},1000);</script>")
	return;
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
		    if(ajax_save_p && (content = ajax_findstate(url)))
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
    if(!S) {
	/* First State */
	window.location.reload();
	return;
    }
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
		bookmarksIcon.style.left = "0";
	    else
		bookmarksIcon.style.right = "0";
	}
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

/* Garbage Collector */
garbageCollector();
