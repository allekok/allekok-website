/* -*- compile-command: "cd ../.. && make" -*- */
const _R = _relativePath || "/";
const _R_LEN = _R.length;
var bookmarks_name = bookmarks_name || 'favorites';

var apply_to_text = apply_to_text || function (el, proc) {
	let html = '';
	for(const o of el.childNodes) {
		if(o.nodeName == '#text') {
			if(o.parentElement.className.
			   indexOf('material-icons') === -1)
				html += proc(o.data);
			else
				html += o.data;
		}
		else {
			apply_to_text(o, proc);
			if(o.outerHTML !== undefined)
				html += o.outerHTML;
		}
	}
	el.innerHTML = html;
}

var apply_to_words = apply_to_words || function (str, fun) {
	let include = "«»`1234567890-=~!@#$%^&*()_+[]{}\\|;:'\",./<>?؛،؟١٢٣٤٥٦٧٨٩٠ \n\t\rABCDEFGHIJKLMNOPQRSTUVWXYZ",
	    i = 0, new_str = '';
	while(str[i] !== undefined) {
		let token = '';
		while(str[i] !== undefined &&
		      include.indexOf(str[i].toUpperCase()) === -1)
			token += str[i++];
		if(!token)
			while(str[i] !== undefined &&
			      include.indexOf(str[i].toUpperCase()) !== -1)
				token += str[i++];
		new_str += fun(token);
	}
	return new_str;
}

var ar2IL = ar2IL || function (s) {
	const bizroke = 'i';
	const v = "ەeێêۆoاaiuîûأإآ";
	const n = "قwرڕتyئحعپسشدفگغهژکلڵزخجچڤبنمڎصۊۉثذضظةطؤ";
	const before = [["عیوونی", "عiیوونی"],
			["ئارەزوی", "ئارەزuی"],
			["ئارزوی", "ئارزuی"],
			["^([رڕ])وی$", "$1uی"],
			["^لە([رڕ])وی$", "لە$1uی"]];
	const after = [["ûyyî$", "ûyîy"],
		       [`^([مس])ە([رح])u$`, "$1ە$2w"]];
	const notsure = [["وو", "û", "uw", "wu", "ww"],
			 ["یی", "îy", "îy", "yî", "yy"],
			 ["ی", "î", "y"],
			 ["و", "u", "w"]];
	function determine_notsure (R, str) {
		let pos = R[0],
		    ch = R[1][0],
		    ch_len = ch.length,
		    prev_ch = L(str, pos-1),
		    next_ch = L(str, pos+ch_len),
		    next_ch_2 = L(str, pos+ch_len+1),
		    next_v = is_(next_ch, v),
		    next_v_2 = is_(next_ch_2, v),
		    i = 1; // v
		if(prev_ch == '‌') prev_ch = L(str, pos-2);
		let prev_v = is_(prev_ch, v);
		
		if(is_(str, ["وو","یی","ی","و"]));
		else if(ch_len == 2) {
			if(prev_v && !next_v_2 &&
			   (next_v || is_(next_ch,'یو'))) i = 4;
			else if(pos == 0 || prev_v) i = 3;
			else if(next_v) i = 2;
		}
		else if(pos == 0 || prev_v || next_v ||
			(prev_ch != 'y' && ch == 'و' &&
			 next_ch == 'ی' && !next_v_2)) i = 2;
		return i;
	}
	return add_bizroke(replace_sure(replace_notsure(replace_sure(
		standardizing(s), before), notsure, determine_notsure),
					after), n, v, bizroke);
}
var ar2lat = ar2lat || function (s) {
	const sure = [["أ","ئە"],
		      ["إ","ئی"],
		      ["آ","ئا"],
		      ["َ", "e"],
		      ["ِ", "î"],
		      ["ُ", "u"],
		      ["ە", "e"],
		      ["ێ", "ê"],
		      ["ۆ", "o"],
		      ["ا", "a"],
		      ["ق", "q"],
		      ["ر", "r"],
		      ["ڕ", "ř"],
		      ["ت|ط|ة", "t"],
		      ["ئ|ء|ؤ|ع", "'"],
		      ["ح", "ḧ"],
		      ["پ", "p"],
		      ["س|ث", "s"],
		      ["ص", "ṣ"],
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
		      ["ز|ض|ظ|ذ", "z"],
		      ["خ", "x"],
		      ["ج", "c"],
		      ["چ", "ç"],
		      ["ڤ", "v"],
		      ["ب", "b"],
		      ["ن", "n"],
		      ["م", "m"],
		      ["ڎ", "ḍ"],
		      ["ۊ", "ü"],
		      ["ۉ", "ṿ"],
		      ["٠|۰", "0"],
		      ["١|۱", "1"],
		      ["٢|۲", "2"],
		      ["٣|۳", "3"],
		      ["٤|۴", "4"],
		      ["٥|۵", "5"],
		      ["٦|۶", "6"],
		      ["٧|۷", "7"],
		      ["٨|۸", "8"],
		      ["٩|۹", "9"],
		      ["،", ","],
		      ["؛", ";"],
		      ["؟", "?"]];
	return replace_sure(ar2IL(s), sure);
}

var ar2per = ar2per || function (s) {
	const sure = [["wu", "و\u{64F}"],
		      ["û", "و\u{64F}"],
		      ["ە", "\u{64E}"],
		      ["ێ", "\u{650}"],
		      ["ۆ", "\u{64F}"],
		      ["u", "و"],
		      ["w", "و"],
		      ["y", "ی"],
		      ["î", "ی"],
		      ["i", "\u{652}"],
		      ["٠", "۰"],
		      ["١", "۱"],
		      ["٢", "۲"],
		      ["٣", "۳"],
		      ["٤", "۴"],
		      ["٥", "۵"],
		      ["٦", "۶"],
		      ["٧", "۷"],
		      ["٨", "۸"],
		      ["٩", "۹"]];
	const n = "قرڕتئحعپسشدفگغهژکلڵزخجچڤبنمڎصۊۉثذضظةطؤ";
	const v = "ەێۆاuûîiأإآ";
	/* Tashdid */
	function add_tashdid (str, n, v, tashdid="\u{651}") {
		for (let i = 0; i < str.length-2; i++) {
			if(str[i] == str[i+1] && is_(str[i], n) &&
			   is_(str[i-1], v) && is_(str[i+2], v))
				str = str_replace_pos(
					str[i]+str[i], str[i]+tashdid, str, i);
		}
		return str;
	}
	/* Beginning 'Hemze' */
	function determine_hemze (s) {
		if(s.startsWith("ئ"))
			return determine_hemze(str_replace_pos("ئ", "ا", s, 0));
		else if(s.startsWith("اا"))
			return str_replace_pos("اا", "آ", s, 0);
		return s;
	}
	return replace_sure(add_tashdid(determine_hemze(ar2IL(s)), n, v), sure);
}

var transliterate_ar2lat = transliterate_ar2lat || function (str)
{ return apply_to_words(str, w => ar2lat(w)) }

var transliterate_ar2per = transliterate_ar2per || function (str)
{ return apply_to_words(str, w => ar2per(w)) }

var replace_sure = replace_sure || function (str, sure, f=0, t=1) {
	for(const o of sure)
		str = str.replace(new RegExp(o[f],"g"), o[t]);
	return str;
}

var replace_notsure = replace_notsure || function (str, notsure, determine_fun, i=0) {
	let R;
	while(false !== (R = assoc_first(str, notsure, i))) {
		const j = determine_fun(R, str);
		str = str_replace_pos(R[1][i], R[1][j], str, R[0]);
	}
	return str;
}

var assoc_first = assoc_first || function (str, arr, i=0, off=0) {
	const str_len = str.length;
	for(let j = off; j < str_len; j++)
		for(const o of arr)
			if(o[i] == str.substr(j, o[i].length))
				return [j, o];
	return false;
}

var L = L || function (str, pos, len=1) {
	return str.substr(pos, len);
}

var is_ = is_ || function (c, x) {
	if(c && x.indexOf(c) !== -1) return true;
	return false;
}

var str_replace_pos = str_replace_pos || function (from, to, str, pos) {
	return str.substr(0, pos) + to +
		str.substr(pos + from.length);
}

var add_bizroke = add_bizroke || function (str, n, v, bizroke="") {
	/* I don't know the exact specification for this procedure. */
	function is_n (ch) { return is_(ch, n) }
	const L1 = L(str, 0);
	const L2 = L(str, 1);
	if(is_n(L1) && (!L2 || is_n(L2)))
		str = str_replace_pos("", bizroke, str, 1);
	return str;
}

var standardizing = standardizing || function (str) {
	return replace_sure(str, [
		["ـ",""],
		["‌+","‌"],
		["ھ","ه"],
		["ك|ڪ", "ک"],
		["ي|ى|ے", "ی"]]);
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

var getSelTxt = getSelTxt || function () {
	return window.getSelection().toString()
}

var toggle_x = toggle_x || function (searchProc, placeholder, action) {
	let Sec = document.getElementById('search'),
	    Key = document.getElementById("search-key"),
	    Icon = document.getElementById('tS'),
	    Frm = document.getElementById("search-form"),
	    selTxt = getSelTxt();
	
	if(Sec.style.display != "block") {
		if(selTxt) Key.value = selTxt;
		Sec.style.display = "block";
		Icon.classList.add('color-blue');
		Key.onkeyup = (e => searchProc(e));
		Key.placeholder = placeholder;
		Key.focus();
		searchProc();
		Frm.action = action;
	}
	else if(Key.placeholder != placeholder) {
		if(selTxt) Key.value = selTxt;
		Key.onkeyup = (e => searchProc(e));
		Key.placeholder = placeholder;
		Key.focus();
		searchProc();
		Frm.action = action;
	}
	else if(selTxt) {
		Key.value = selTxt;
		Key.focus();
		searchProc();
	}
	else {
		Sec.style.display="none";
		Icon.classList.remove('color-blue');
	}
}

var toggle_search = toggle_search || function ()
{
	toggle_x(search, 'گەڕان بۆ ...', _R);
	/* Clear The Search Stack */
	sessionStorage.removeItem('searchStack');
}

var toggle_tewar = toggle_tewar || function () {
	toggle_x(tewar, 'گەڕان بۆ واتای وشە ...', `${_R}tewar/`);
	/* Clear The Search Stack */
	sessionStorage.removeItem('searchStack');
}

var toggle_findPage = toggle_findPage || function () {
	toggle_x(findPage_, 'گەڕان لەم لاپەڕەدا ...', _R);
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
		      currentKey = e === undefined ? false : e.keyCode,
		      noActionKeys = [16, 17, 18, 91, 20, 9, 93,
				      37, 38, 39, 40, 32, 224, 13],
		      url = `${_R}script/php/search-quick.php?q=${q}`;
		if(currentKey == 27)
		{
			toggle_search();
			return;
		}
		if(noActionKeys.indexOf(currentKey) !== -1) return;
		if(q) {
			Res.style.display = "block";
			let content;
			if(content = ajax_findstate(url)) {
				Res.innerHTML = content;
				findPage(q, Res);
			}
			else {
				Res.innerHTML = "<div class='loader'></div>";
				/* Server Search */
				searchStackPush(q);
				getUrl(url, (response) => {
					ajax_savestate(url, response);
					if(searchStackPop(q)) {
						Res.innerHTML = response;
						findPage(q, Res);
					}
				});
			}
		}
		else {
			Key.value = '';
			Res.style.display = 'none';
		}
	}, 150);
}

var tewar = tewar || function (e)
{
	setTimeout(() => {
		const Res = document.getElementById("search-res"),
		      Sec = document.getElementById("search"),
		      Key = document.getElementById("search-key"),
		      q = Key.value.trim(),
		      currentKey = e === undefined ? false : e.keyCode,
		      noActionKeys = [16, 17, 18, 91, 20, 9, 93,
				      37, 38, 39, 40, 32, 224, 13],
		      dicts_str = 'xal,kameran,henbane-borine,bashur,kawe,e2k,zkurd',
		      url = `${_R}tewar/src/backend/lookup.php?q=${q}&dicts=${dicts_str}&output=json&n=1`;
		if(currentKey == 27) {
			toggle_tewar();
			return;
		}
		if(noActionKeys.indexOf(currentKey) !== -1) return;
		if(q) {
			Res.style.display = "block";
			let content;
			if(content = ajax_findstate(url)) {
				Res.innerHTML = content;
			}
			else {
				Res.innerHTML = "<div class='loader'></div>";
				/* Server Search */
				searchStackPush(q);
				getUrl(url, (response) => {
					if(searchStackPop(q)) {
						response = isJson(response);
						if(! response) return;
						delete response['time'];
						let wm_html = '';
						for(const i in response) {
							let w = response[i][1],
							    m = response[i][2];
							if(m) wm_html += `<p style='font-size:.55em'><i class='color-blue'>${w}</i>: ${m}</p>`;
						}
						let toprint = wm_html ?
						    wm_html :
						    "<p style='font-size:.55em'>(نەدۆزرایەوە)</p>";
						ajax_savestate(url, toprint);
						Res.innerHTML = toprint;
					}
				});
			}
		}
		else {
			Key.value = '';
			Res.style.display = 'none';
		}
	}, 150);
}

var findPage_ = findPage_ || function (e) {
	setTimeout(() => {
		const Key = document.getElementById("search-key"),
		      Res = document.getElementById("MAIN"),
		      q = Key.value.trim(),
		      currentKey = e === undefined ? false : e.keyCode;
		if(currentKey == 27) {
			toggle_findPage();
			return;
		}
		if(q) findPage(q, Res);
		else {
			Key.value = '';
			document.getElementById("search-res").
				style.display = 'none';
		}
	}, 50);
}

var searchStackPush = searchStackPush || function (item) {
	let array = isJson(sessionStorage.getItem('searchStack')) || [];
	array.push(item);
	sessionStorage.setItem('searchStack', JSON.stringify(array));
}

var searchStackPop = searchStackPop || function (item) {
	let array = isJson(sessionStorage.getItem('searchStack')) || [];
	let idx;
	if((idx = array.lastIndexOf(item)) !== -1) {
		array = array.slice(idx);
		sessionStorage.setItem('searchStack', JSON.stringify(array));
		return true;
	}
	return false;
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
	let title = document.getElementById("adrs").innerText.trim(),
	    body = document.getElementById("hon").innerHTML,
	    desc = document.getElementById("bhondesc").innerText.trim();
	
	for(const hc in htmlchars)
		body = body.replace(htmlchars[hc], "");
	body = body.replace(/<sup>/gi, "[").replace(/<\/sup>/gi, "]");
	body = body.replace(/\n\n+/g, "\n\n");
	body = body.trim();

	text = title + "\n\n" + body + "\n\n" + desc;
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
	}
}

var save_fs = save_fs || function (how)
{
	const hon = document.getElementById("hon"),
	      wW = window.innerWidth,
	      hows = ["smaller", "bigger"],
	      scale = 3;
	let fs = parseInt(hon.style.fontSize);
	
	if(isNaN(fs)) {
		if(wW > 600) fs=28;
		else fs=24;
	}
	
	if(hows[1] == how) fs += scale;	/* Bigger */
	else if(hows[0] == how && fs > 3) fs -= scale; /* Smaller */
	
	localStorage.setItem('fontsize', fs);
	hon.style.fontSize = `${fs}px`;
}

var isJson = isJson || function (str) {
	try      { return JSON.parse(str) }
	catch(e) { return false }
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
		/\[/g, /\]/g, /{/g, /}/g, /</g, />/g, /\//g, /؍/g, /\|/,
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
	let p = 0, r;
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
	const p = document.querySelector(parent),
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

					let content;
					if(ajax_save_p && (content = ajax_findstate(url)))
					{ ajax_load(url, href, content, parent, target, loading); }
					else {
						getUrl(url, function (content) {
							ajax_load(url, href, content, parent, target, loading);
							ajax_savestate(url, content);
						});
					}
				}
			}
		}
	});
}

var ajax_load = ajax_load || function (url, href, content, parent, target, loading) {
	const t = document.querySelector(target);
	window.history.pushState({url: url}, '', href);
	window.scrollTo(0,0);
	t.outerHTML = content;
	eval_js(content);
	ajax(parent, target);
	loading.style.display = 'none';
}

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

	let content;
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

var get_cookie = get_cookie || function (key) {
	if(document.cookie) {
		const cookies = document.cookie.split(';');
		for(const i in cookies)	{
			const c = cookies[i].split('=');
			if(c[0].trim() == key) {
				return c[1];
				break;
			}
		}
	}
	return false;
}

var set_cookie = set_cookie || function (cookie_name, value, days=1000, path="/") {
	let expires = new Date();
	expires.setTime(expires.getTime() + (days*24*3600*1000));
	expires = expires.toUTCString();
	const cookie = `${cookie_name}=${value};expires=${expires};path=${path}`;
	document.cookie = cookie;
	return cookie;
}

try { ajax() } catch (e) {}

window.onpopstate = ajax_popstate;
try {
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
} catch (e) {}

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

/* Garbage Collector */
garbageCollector();

/* Key bindings */
var keyDispatch = keyDispatch || function (e) {
	if(e.altKey) return;
	if((e.srcElement.nodeName == 'INPUT' &&
	    e.srcElement.getAttribute('type') == 'text') ||
	   e.srcElement.nodeName == 'TEXTAREA') return;

	/* Key dispatch */
	if(e.ctrlKey) {
		if(e.code == 'ArrowUp') {
			try {save_fs("bigger")} catch (e) {}
		}
		else if(e.code == 'ArrowDown') {
			try {save_fs("smaller")} catch (e) {}
		}
		else if(e.code == 'ArrowRight') {
			try {document.querySelector(".prev a").click()}
			catch (e) {}
		}
		else if(e.code == 'ArrowLeft') {
			try {document.querySelector(".next a").click()}
			catch (e) {}
		}
	}
	else {
		if(e.code == 'KeyG')       toggle_search();
		else if(e.code == 'KeyT')  toggle_tewar();
		else if(e.code == 'KeyF')  toggle_findPage();
		else if(e.code == 'KeyL')
			apply_to_text(document.body, x => {
				x = transliterate_ar2lat(x);
				if(!x.trim()) return x;
				return `<allekok style='direction:ltr;display:inline-block'>${x}</allekok>`;
			});
		else if(e.code == 'KeyP')
			apply_to_text(document.body, transliterate_ar2per);
		else if(e.code == 'KeyB') {
			try {
				toggle_Like()
				document.querySelector("#tL-res-res a").focus()
			} catch (e) {}
		}
		else if(e.code == 'KeyM')
			document.querySelector("header a").click()
		else if(e.code == 'KeyK') {
			try {copyPoem()} catch (e) {}
		}
		else if(e.code == 'KeyN') {
			try {Liked()} catch (e) {}
		}
		else if(e.code == 'KeyR') {
			if(get_cookie('theme') == 'dark')
				set_cookie('theme', 'light');
			else    set_cookie('theme', 'dark');
			window.location.reload();
		}
		else if(e.code == 'KeyS')
			window.scrollTo(0,0);
		else if(e.code == 'KeyX')
			window.scrollTo(
				0,document.getElementById("footer").offsetTop);
	}
}
window.addEventListener("keyup", keyDispatch);
