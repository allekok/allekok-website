var bookmarks_name=bookmarks_name||"favorites",arabi_to_latin=arabi_to_latin||function(e){const t=["و([اێۆە])","w$1","ی([اێۆە])","y$1","([اێۆە])و","$1w","([اێۆە])ی","$1y","(^|[^ء-يٱ-ەwy])و([^ء-يٱ-ەwy])","$1û$2","(^|[^ء-يٱ-ەwy])و","$1w","یو","îw","یی","îy","وی","uy","وو","û","ی","î","و","u","uu","û","([ء-يٱ-ەîuûwy])ڕ","$1rr","ر|ڕ","r","ش","ş","ئ","","ا","a","ب","b","چ","ç","ج","c","د","d","ێ","ê","ە|ه‌","e","ف","f","خ|غ","x","گ","g","ح|ھ","h","ژ","j","ک","k","ڵ","ll","ل","l","م","m","ن","n","ۆ","o","پ","p","ق","q","س","s","ت","t","ڤ","v","ز","z","ع","'","‌","","؟","?","،",",","؛",";","٠|۰","0","١|۱","1","٢|۲","2","٣|۳","3","٤|۴","4","٥|۵","5","٦|۶","6","٧|۷","7","٨|۸","8","٩|۹","9","»|«",'"',"ـ","","ll","Ľ","rr","Ŕ","([bcçdfghjklĽmnpqrŔsştvwxz])([fjlĽmnrŔsşvwxyz])([fjlĽmnrŔsşvwxyz])([^aeêiîouûy])","$1$2i$3$4","([aeêiîouû])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])\\b","$1$2$3i$4","([fjlĽrŔsşwyz])([fjlĽmnrŔsşvwxyz])([bcçdfghjklĽmnpqrŔsştvwxz])","$1i$2$3","([bcçdghkmnpqtvx])([fjlĽmnrŔsşvwxyz])($|[^aeêiîouû])","$1i$2$3","([^aeêiîouû])([bcçdghkmnpqtvx])([fjlĽmnrŔsşvwxyz])($|[^aeêiîouû])","$1$2i$3$4","(^|[^aeêiîouy])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])($|[^aeêiîouû])","$1$2i$3$4","(^|[^a-zçşêîûĽŔ])([bcçdfghjklĽmnpqrŔsştvwxz])(\\s)","$1$2i$3","Ľ","ll","Ŕ","rr"],n=["([bcçdfghjklmnpqrsştvwxz])([wy][aeêiîouû])","$1i$2","(^|[^a-zêîûçş0-9'’])([bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])","$1$2i$3","([bcçdfghjklmnpqrsştvwxz][bcçdfghjklĽmnpqrŔsştvwxz])([bcçdfghjklĽmnpqrŔsştvwxz])","$1i$2"],o=["‌{1,}","‌","لاَ|لأ|لآ","لا","لً|لَ","ل","ص","س","ض","ز","ث","س","ظ","ز","ط","ت","ىَ|يَ|یَ","ی","رِ","ر","ؤ|وَ","و","ي|ى","ی","ذ","ز","ك","ک","ه‍","ھ","ه($|[^ء-يٱ-ە])","ە$1","ە‌","ە","ة","ە","ه","ھ","([ء-يٱ-ە])‌([^ء-يٱ-ە])","$1$2"];for(let t=0;t<o.length;t+=2)e=e.replace(new RegExp(o[t],"g"),o[t+1]);for(let n=0;n<t.length;n+=2)e=e.replace(new RegExp(t[n],"gim"),t[n+1]);e=e.replace(new RegExp("ll","gim"),"Ľ").replace(new RegExp("rr","gim"),"Ŕ");for(let t=0;t<n.length;t+=2)e=e.replace(new RegExp(n[t],"gim"),n[t+1]);return e=e.replace(new RegExp("Ľ","gim"),"ll").replace(new RegExp("Ŕ","gim"),"rr")},poetImage=poetImage||function(e,t){const n=new XMLHttpRequest,o=`/style/img/poets/profile/profile_${e}.jpg`;n.open("get",o),n.onload=function(){404!=this.status&&t(o)},n.send()},toggle_search=toggle_search||function(){const e=document.getElementById("search"),t=document.getElementById("search-key"),n=document.getElementById("tS");"block"!=e.style.display?(e.style.display="block",n.classList.add("color-blue"),t.focus()):(e.style.display="none",n.classList.remove("color-blue"))},get_bookmarks=get_bookmarks||function(){const e=localStorage.getItem(bookmarks_name);try{return JSON.parse(e)}catch(t){return update_bookmarks(e)}},update_bookmarks=update_bookmarks||function(e){e=e.split("[fav]");let t=[];for(const n in e)e[n]&&t.push(JSON.parse(e[n]));return localStorage.setItem(bookmarks_name,JSON.stringify(t)),t},toggle_Like=toggle_Like||function(){const e=document.getElementById("tL-res"),t=document.getElementById("tL");if("block"==e.style.display)return e.style.display="none",void t.classList.remove("color-blue");const n=get_bookmarks();let o="",s=[];for(let e=n.length-1;e>=0;e--)o+=`<a href='/${n[e].url}'\n><img class='PI${n[e].poetID}' src='/style/img/poets/profile/profile_0.png'\nstyle='display:inline-block;vertical-align:middle;width:2.5em;border-radius:50%;\nmargin-left:.5em'>${n[e].poetName} &rsaquo; ${n[e].poem}</a>`,-1===s.indexOf(n[e].poetID)&&s.push(n[e].poetID);document.getElementById("tL-res-res").innerHTML=o,e.style.display="block",e.style.animation="tL .2s",t.classList.add("color-blue"),s.map(function(e){poetImage(e,function(t){document.getElementById("tL-res-res").querySelectorAll(`.PI${e}`).forEach(function(e){e.src=t})})}),ajax()},toggle_nav=toggle_nav||function(){const e=document.getElementById("header-nav");"none"==e.style.display?(e.style.display="",e.style.animation="tL-top .1s"):e.style.display="none"},search=search||function(e){const t=document.getElementById("search-res"),n=(document.getElementById("search"),document.getElementById("search-key")),o=n.value,s=e.keyCode;if(!(o.length<3))return 27==s?(t.style.display="none",void(n.value="")):void(-1===[16,17,18,91,20,9,93,37,38,39,40,32,224,13].indexOf(s)&&(t.style.display="block",t.innerHTML="<div class='loader'></div>",getUrl(`/script/php/search-quick.php?q=${o}`,function(e){t.innerHTML=e})));t.style.display="none"};window.Clipboard=function(e,t,n){let o,s;function r(){let s,r;n.userAgent.match(/ipad|iphone/i)?((s=t.createRange()).selectNodeContents(o),(r=e.getSelection()).removeAllRanges(),r.addRange(s),o.setSelectionRange(0,999999)):o.select()}return{copy:s=function(e){!function(e){(o=t.createElement("textArea")).value=e,t.body.insertBefore(o,t.body.firstChild)}(e),r(),t.execCommand("copy"),t.body.removeChild(o)}}}(window,document,navigator);var copyPoem=copyPoem||function(){const e=document.getElementById("copy-sec"),t=[/<div class="ptr">/gi,/<div class="ptr ptrh">/gi,/<div class="m d cf">/gi,/<div class="b cf">/gi,/<div class="n cf">/gi,/<div class="b">/gi,/<div class="n">/gi,/<div class="m1">/gi,/<div class="m2">/gi,/<div class="m3">/gi,/<div class="m">/gi,/<div class="m" style="direction:ltr">/gi,/<p>/gi,/<br>/gi,/<b>/gi,/<br\/>/gi,/<br \/>/gi,/<i>/gi,/<\/br>/gi,/<\/ br>/gi,/<\/b>/gi,/<\/p>/gi,/<\/div>/gi,/<\/span>/gi,/<\/i>/gi,/<center>/gi,/<\/center>/gi,/&nbsp;/gi,/<div class="m dltr">/gi,/\r+/gi];let n=document.getElementById("hon").innerHTML;for(const e in t)n=n.replace(t[e],"");n=(n=(n=n.replace(/<sup>/gi,"[").replace(/<\/sup>/gi,"]")).replace(/\n\n+/g,"\n\n")).trim(),Clipboard.copy(n),e.innerHTML="check",e.classList.add("back-blue"),setTimeout(function(){e.innerHTML="content_copy",e.classList.remove("back-blue")},3e3)},Liked=Liked||function(){const e=document.getElementById("tL"),t=document.getElementById("like-icon"),n=document.getElementById("tN");let o=get_bookmarks();if(!o)return localStorage.setItem(bookmarks_name,JSON.stringify([poemObject])),t.innerHTML="bookmark",t.classList.add("back-blue"),t.style.animation="ll .4s ease-out forwards",e.style.display="block",void(n.style.left="2.6em");let s=-1;for(const e in o)if(o[e].url==poemObject.url){s=e;break}-1==s?(o.push(poemObject),localStorage.setItem(bookmarks_name,JSON.stringify(o)),t.innerHTML="bookmark",t.classList.add("back-blue"),t.style.animation="ll .4s ease-out forwards"):(o.splice(s,1),o.length>0?localStorage.setItem(bookmarks_name,JSON.stringify(o)):(localStorage.removeItem(bookmarks_name),e.style.display="none",n.style.left="1.3em"),t.innerHTML="bookmark_border",t.classList.remove("back-blue"),t.style.animation="")},save_fs=save_fs||function(e){const t=document.getElementById("hon"),n=window.innerWidth,o=["smaller","bigger"];let s=parseInt(t.style.fontSize);if(isNaN(s)&&(s=n>600?30:24),o[1]==e){if(s>=120)return;s+=3}else if(o[0]==e){if(s<=6)return;s-=3}localStorage.setItem("fontsize",s),t.style.fontSize=`${s}px`},isJson=isJson||function(e){try{return JSON.parse(e)}catch(e){return!1}},parse_allekok_link=parse_allekok_link||function(e){e=e.split("/");for(let t=0;t<3;t++)e[t]||(e[t]=""),e[t]=e[t].split(":")[1];return{pt:e[0]||"",bk:e[1]||"",pm:e[2]||""}},parse_search_link=parse_search_link||function(e){return e=e.substr(e.indexOf("=")+1),parse_allekok_link(e)},parse_poem_link=parse_poem_link||function(e){return e=e.substr(1),parse_allekok_link(e)},show_summary=show_summary||function(e,t){e.innerHTML="<div class='loader-round' style='width:1em;height:1em'></div>";const n=t(e.parentNode.querySelector("a").getAttribute("href")),o=n.pt,s=n.bk,r=n.pm;getUrl(`/script/php/poem-summary.php?pt=${o}&bk=${s}&pm=${r}`,function(t){e.innerHTML="dehaze";const n=t.replace(/\n/g,"<br>");e.parentNode.outerHTML+=`<div style='padding:1em;font-size:.55em'>${n}</div>`})},show_summary_search=show_summary_search||function(e){show_summary(e,parse_search_link)},show_summary_poem=show_summary_poem||function(e){show_summary(e,parse_poem_link)},filterp=filterp||function(e="",t,n=!1){let o=!1;e=san_data(e,n),t.forEach(function(t){const s=san_data(t.textContent,n);""==e||-1!==s.indexOf(e)?(t.style.display="",o=!0):(t.style.display="none",o=!1)}),o||n||filterp(e,t,!0)},KurdishNumbers=KurdishNumbers||function(e=""){const t=[/0/g,/1/g,/2/g,/3/g,/4/g,/5/g,/6/g,/7/g,/8/g,/9/g],n=[/۰/g,/۱/g,/۲/g,/۳/g,/۴/g,/۵/g,/۶/g,/۷/g,/۸/g,/۹/g],o=["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"];for(const s in t)e=e.replace(t[s],o[s]).replace(n[s],o[s]);return e},san_data=san_data||function(e="",t=!1){if(""==e)return"";const n=[/&laquo;/g,/&raquo;/g,/&rsaquo;/g,/&lsaquo;/g,/&bull;/g,/&nbsp;/g,/\?/g,/!/g,/#/g,/&/g,/\*/g,/\(/g,/\)/g,/-/g,/\+/g,/=/g,/_/g,/\[/g,/\]/g,/{/g,/}/g,/</g,/>/g,/\//g,/\|/,/\'/g,/\"/g,/;/g,/:/g,/,/g,/\./g,/~/g,/`/g,/؟/g,/،/g,/»/g,/«/g,/ـ/g,/›/g,/‹/g,/•/g,/‌/g,/\s+/g,/؛/g],o=["ِ","ُ","ٓ","ٰ","ْ","ٌ","ٍ","ً","ّ","َ"],s=["ه","ه","ک","ی","ه","ز","س","ت","ز","ر","ه","خ","و","و","و","ی","ر","ل","ز","س","ه","ر","م","ا","ا","ل","س","ی","و","ئ","ی"],r=[/ه‌/g,/ە/g,/ك/g,/ي/g,/ھ/g,/ض/g,/ص/g,/ط/g,/ظ/g,/ڕ/g,/ح/g,/غ/g,/وو/g,/ۆ/g,/ؤ/g,/ێ/g,/ڕ/g,/ڵ/g,/ذ/g,/ث/g,/ة/g,/رر/g,/مم/g,/أ/g,/آ/g,/لل/g,/سس/g,/یی/g,/ڤ/g,/ع/g,/ى/g];for(const t in n)e=e.replace(n[t],"");for(const t in o)e=e.replace(o[t],"");for(const t in s)e=e.replace(r[t],s[t]);return e=KurdishNumbers(e),t&&(e=san_data_more(e)),e},san_data_more=san_data_more||function(e){const t=[/٠/g,/١/g,/٢/g,/٣/g,/٤/g,/٥/g,/٦/g,/٧/g,/٨/g,/٩/g];e=e.replace(/ه/g,"");for(const n in t)e=e.replace(t[n],"");return e},getUrl=getUrl||function(e,t){const n=new XMLHttpRequest;n.open("get",e),n.onload=function(){t(n.responseText)},n.send()},postUrl=postUrl||function(e,t,n){const o=new XMLHttpRequest;o.open("post",e),o.onload=function(){n(this.responseText)},o.setRequestHeader("Content-type","application/x-www-form-urlencoded"),o.send(t)},poem_kind=poem_kind||function(e){return-1!=e.indexOf('<div class="n">')?"new":"classic"},bookmarksIcon=document.getElementById("tL"),favs=get_bookmarks(),tN=document.getElementById("tN"),tS=document.getElementById("tS");favs?bookmarksIcon&&(bookmarksIcon.style.display="block",tS?bookmarksIcon.style.left="1.3em":(bookmarksIcon.style.left="0",tN.style.left="1.3em")):tN&&(tN.style.left=tS?"1.3em":"0"),document.getElementById("search-form").addEventListener("submit",function(e){const t=document.getElementById("search-key");""==t.value&&(e.preventDefault(),t.focus())});try{document.getElementById("tL").addEventListener("click",toggle_Like)}catch(e){}try{document.getElementById("tS").addEventListener("click",toggle_search)}catch(e){}try{document.getElementById("tN").addEventListener("click",toggle_nav)}catch(e){}var concat_url_query=concat_url_query||function(e,t){const n=parse_poem_link(e);return n.pt&&(e=`/?ath=${n.pt}&bk=${n.bk}&id=${n.pm}`),-1!==e.indexOf("?")?e+"&"+t:e+"?"+t},match_all=match_all||function(e,t,n=-1){let o=[],s=0,r=-1;for(;-1!==(r=e.indexOf(t,s))&&0!=n;)n--,o.push(r),s=r+1;return o||!1},eval_js=eval_js||function(str){const scripts_beg=match_all(str,"<script>"),scripts_end=match_all(str,"<\/script>");for(const i in scripts_beg){const s_b=scripts_beg[i],s_e=scripts_end[i],js=str.substring(s_b+8,s_e);eval(js)}},ajax=ajax||function(e="body",t="#MAIN"){const n=document.querySelector(t),o=document.querySelector(e),s=document.getElementById("main-loader");o.querySelectorAll("a").forEach(function(o){"_blank"!=o.getAttribute("target")&&(o.onclick=function(r){const l=o.getAttribute("href");if(-1===l.indexOf("#")){r.preventDefault(),s.style.display="block";const o=concat_url_query(l,"nohead&nofoot");getUrl(o,function(r){window.history.pushState({url:o},"",l),window.scrollTo(0,0),n.outerHTML=r,eval_js(r),ajax(e,t),s.style.display="none"})}})})};ajax(),window.onpopstate=function(){const e=document.getElementById("main-loader"),t=document.querySelector("#MAIN"),n=window.history.state;if(!n)return;const o=n.url;o&&(e.style.display="block",getUrl(o,function(n){t.outerHTML=n,eval_js(n),ajax(),e.style.display="none"}))};try{document.getElementById("like-icon").addEventListener("click",Liked)}catch(e){}try{document.getElementById("copy-sec").addEventListener("click",copyPoem)}catch(e){}try{document.querySelector(".smaller").addEventListener("click",function(){save_fs("smaller")})}catch(e){}try{document.querySelector(".bigger").addEventListener("click",function(){save_fs("bigger")})}catch(e){}