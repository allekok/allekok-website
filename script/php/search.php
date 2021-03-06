<style>
 .search-main .dropbtn {
	 cursor:pointer;
	 padding:.5em 1em;
	 vertical-align:middle;
 }
 .search-main .dropdown {
	 position:relative;
	 display:inline-block;
 }
 .search-main .drp-a {
	 padding:0 1em;
	 display:block;
	 overflow:hidden;
	 white-space:nowrap;
	 text-overflow:ellipsis;
	 cursor:pointer;
 }
 .drp-a:hover {
	 color:<?php echo $_colors[2]; ?>;
 }
</style>
<div id="poets" class="search-main">
	<div>
		<form id="search-form" action="<?php echo _R; ?>" method="get">
			<input type="text" id="search-key" class="search-key-php"
			       name="q" placeholder="گەڕان بۆ ..."
			       value="<?php echo htmlspecialchars($_GET['q']); ?>">
			<button type="submit" id="search-btn"
				class="material-icons">search</button>
		</form>
	</div>
	<section class="sli" style="text-align:right;padding-left:.5em">
		<div id="search-options">
			<p style="text-align:right;font-size:.6em;padding-bottom:.6em">
				گەڕان لە شیعرەکانی: 
			</p>
			<div style="text-align:center">
				<div class="dropdown">
					<?php
					$q = "select takh from auth order by takh ASC";
					require("condb.php");
					$os = [];
					while($o = mysqli_fetch_assoc($query)) {
						$os[] = $o;
						if(@$_GET['selPT'] == $o['takh'])
							$_selPT = $o['takh'];
					}
					mysqli_close($conn);
					?>
					<button class="dropbtn button" style="font-size:.65em"
						id="search_toggle_poets_btn">
						<?php
						echo @$_selPT ? $_selPT : "تەواوی شاعیران";
						?>
						<i class='material-icons'>keyboard_arrow_down</i>
					</button>
					<div id="myDropdown" class="dropdown-content">
						<input type="text" placeholder="گەڕان..." id="myInput">
						<p class='drp-a' href="">
							تەواوی شاعیران
						</p>
						<?php
						foreach($os as $o) {
							if(@$_selPT == $o['takh']) {
								echo "<p class='drp-a' href='{$o['takh']}' 
selected='1000'>{$o['takh']}</p>";
							} else {
								echo "<p class='drp-a' href='{$o['takh']}'
>{$o['takh']}</p>";
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class='chkboxs'>
				<p style='text-align:right;font-size:.6em'>
					گەڕان لە: 
				</p>
				<div>
					<div>
						<div id="cb-pt" class='cb'>
							<i class='material-icons'>check_box</i>
							<span>شاعیران</span>
						</div>
						<form onsubmit="event.preventDefault();
search_deep(which_PT_selected(), checks());"
						      style="display:flex;width:100%;
								padding:0 1em .5em 0">
							<p style='font-size:.5em;padding:0 0 0 1em'
							>ئەژمار: </p>
							<input type="text" id="PtsNumTxt" value="10"
							       onfocus="selectText(this)"
							       style="direction:ltr;text-align:center;
								     font-size:.45em;padding:0 .5em;
								     width:4em;"
							><button class='material-icons' type="submit"
								 style="font-size:.6em;
									padding:0 .5em 0 0"
							 >arrow_back</button>
						</form>
					</div>
				</div>
				<div>
					<div id="cb-bk" class='cb'>
						<i class='material-icons'>check_box</i>
						<span>کتێبەکان</span>
					</div>
					<form onsubmit="event.preventDefault();
search_deep(which_PT_selected(), checks());"
					      style="display:flex;width:100%;
							padding:0 1em .5em 0">
						<p style='font-size:.5em;padding:0 0 0 1em'
						>ئەژمار: </p>
						<input type="text" id="BksNumTxt" value="10"
						       onfocus="selectText(this)"
						       style="direction:ltr;text-align:center;
							     font-size:.45em;padding:0 .5em;
							     width:4em;"
						><button class='material-icons' type="submit"
							 style="font-size:.6em;padding:0 .5em 0 0"
						 >arrow_back</button>
					</form>
				</div>
				<div id="cb-pm-nm" class='cb'>
					<i class='material-icons'>check_box</i>
					<span>نێوی شیعرەکان</span>
				</div>
				<div>
					<div id="cb-pm" class='cb'>
						<i class='material-icons'>check_box</i>
						<span>دەقی شیعرەکان</span>
					</div>
					<form onsubmit="event.preventDefault();
search_deep(which_PT_selected(), checks());"
					      style="display:flex;width:100%;
							padding:0 1em .5em 0">
						<p style='font-size:.5em;padding:0 0 0 1em'
						>ئەژمار: </p>
						<input type="text" id="ResNumTxt" value="10"
						       onfocus="selectText(this)"
						       style="direction:ltr;text-align:center;
							     font-size:.45em;padding:0 .5em;
							     width:4em;"
						><button class='material-icons' type="submit"
							 style="font-size:.6em;padding:0 .5em 0 0"
						 >arrow_back</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<section class='sli' style="padding-right:1em">
		<div id="search-res" style="display:block;max-width:unset"
		></div>
	</section>
</div>
<script>
 const maxRN = document.querySelector("#ResNumTxt"),
       maxBN = document.querySelector("#BksNumTxt"),
       maxPN = document.querySelector("#PtsNumTxt"),
       dpas = document.querySelectorAll(".drp-a");
 
 function checks () {
	 const pts = (document.querySelector("#cb-pt i").innerHTML
		 != "check_box_outline_blank") ? maxPN.value : 0,
	       bks = (document.querySelector("#cb-bk i").innerHTML
		       != "check_box_outline_blank") ? maxBN.value : 0,
	       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML
		       != "check_box_outline_blank") ? 1 : 0,
	       pms = (document.querySelector("#cb-pm i").innerHTML
		       != "check_box_outline_blank") ? 2 : 0,
	       pm_sum = pms+pm_nms;
	 let pms_num;
	 if(pm_sum == 0) pms_num = 0;
	 else pms_num = maxRN.value;
	 const res = `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`;
	 return res;
 }

 function which_PT_selected() {
	 let dpass = [];
	 for(let i = 0; i < dpas.length; i++)
		 dpass.push([dpas[i].getAttribute("selected"), i]);
	 dpass = dpass.sort((x,y) => (y[0] - x[0]));
	 if(dpass[0][0] !== null)
		 return dpas[dpass[0][1]].getAttribute("href");
	 else
		 return "";
 }
 function toggle_checkbox(e, nu) {
	 if(e.innerHTML != "check_box_outline_blank")
		 e.innerHTML = "check_box_outline_blank";
	 else
		 e.innerHTML = "check_box";
	 search_deep(which_PT_selected(), nu);
 }
 function myFunction() {
	 document.getElementById("myDropdown").classList.toggle("show");
	 filterFunction();
 }
 function filterFunction() {
	 const needle = document.getElementById("myInput").value,
	       context = document.getElementById("myDropdown").
				  querySelectorAll("p");
	 filterp(needle, context);
 }
 function isiOS() {
	 return navigator.userAgent.match(/ipad|iphone/i);
 }
 function selectText(e) {
	 let range, selection;
	 if(isiOS()) {
		 range = document.createRange();
		 range.selectNodeContents(e);
		 selection = window.getSelection();
		 selection.removeAllRanges();
		 selection.addRange(range);
		 e.setSelectionRange(0, 999999);
	 }
	 else e.select();
 }
 document.querySelector('.search-main #myInput').onkeyup = filterFunction;
 document.getElementById("search_toggle_poets_btn").onclick = myFunction;
 document.querySelector("#cb-pt").onclick = function() {
	 const pts = (document.querySelector("#cb-pt i").innerHTML !=
		 "check_box_outline_blank") ? 0 : maxPN.value,
	       bks = (document.querySelector("#cb-bk i").innerHTML !=
		       "check_box_outline_blank") ? maxBN.value : 0,
	       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML !=
		       "check_box_outline_blank") ? 1 : 0,
	       pms = (document.querySelector("#cb-pm i").innerHTML !=
		       "check_box_outline_blank") ? 2 : 0,
	       pm_sum = pms+pm_nms;
	 let pms_num;
	 if(pm_sum == 0) pms_num = 0;
	 else pms_num = maxRN.value;
	 toggle_checkbox(document.querySelector("#cb-pt i"),
			 `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
 }
 document.querySelector("#cb-bk").onclick = function() {
	 const pts = (document.querySelector("#cb-pt i").innerHTML
		 != "check_box_outline_blank") ? maxPN.value : 0,
	       bks = (document.querySelector("#cb-bk i").innerHTML
		       != "check_box_outline_blank") ? 0 : maxBN.value,
	       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML
		       != "check_box_outline_blank") ? 1 : 0,
	       pms = (document.querySelector("#cb-pm i").innerHTML
		       != "check_box_outline_blank") ? 2 : 0,
	       pm_sum = pms+pm_nms;
	 let pms_num;
	 if(pm_sum == 0) pms_num = 0;
	 else pms_num = maxRN.value;     
	 toggle_checkbox(document.querySelector("#cb-bk i"),
			 `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
 }
 document.querySelector("#cb-pm-nm").onclick = function() {
	 const pts = (document.querySelector("#cb-pt i").innerHTML !=
		 "check_box_outline_blank") ? maxPN.value : 0,
	       bks = (document.querySelector("#cb-bk i").innerHTML !=
		       "check_box_outline_blank") ? maxBN.value : 0,
	       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML !=
		       "check_box_outline_blank") ? 0 : 1,
	       pms = (document.querySelector("#cb-pm i").innerHTML !=
		       "check_box_outline_blank") ? 2 : 0,
	       pm_sum = pms+pm_nms;
	 let pms_num;
	 if(pm_sum == 0) pms_num = 0;
	 else pms_num = maxRN.value;
	 toggle_checkbox(document.querySelector("#cb-pm-nm i"),
			 `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
 }
 document.querySelector("#cb-pm").onclick = function() {
	 const pts = (document.querySelector("#cb-pt i").innerHTML !=
		 "check_box_outline_blank") ? maxPN.value : 0,
	       bks = (document.querySelector("#cb-bk i").innerHTML !=
		       "check_box_outline_blank") ? maxBN.value : 0,
	       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML !=
		       "check_box_outline_blank") ? 1 : 0,
	       pms = (document.querySelector("#cb-pm i").innerHTML !=
		       "check_box_outline_blank") ? 0 : 2,
	       pm_sum = pms+pm_nms;
	 let pms_num;
	 if(pm_sum == 0) pms_num = 0;
	 else pms_num = maxRN.value;
	 toggle_checkbox(document.querySelector("#cb-pm i"),
			 `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
 }
 dpas.forEach(function(dpa) {
	 dpa.addEventListener("click", function(e) {
		 e.preventDefault();
		 document.querySelector(".dropbtn").innerHTML = dpa.innerHTML;
		 dpa.setAttribute("selected", Date.now());
		 const pts = (document.querySelector("#cb-pt i").innerHTML !=
			 "check_box_outline_blank") ? maxPN.value : 0,
		       bks = (document.querySelector("#cb-bk i").innerHTML !=
			       "check_box_outline_blank") ? maxBN.value : 0,
		       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML !=
			       "check_box_outline_blank") ? 1 : 0,
		       pms = (document.querySelector("#cb-pm i").innerHTML !=
			       "check_box_outline_blank") ? 2 : 0,
		       pm_sum = pms+pm_nms;
		 let pms_num;
		 if(pm_sum == 0) pms_num = 0;
		 else pms_num = maxRN.value;

		 const qqq = `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`;
		 search_deep(dpa.getAttribute("href"), qqq);
		 document.getElementById("myDropdown").classList.remove("show");

		 const dpa_href = dpa.getAttribute('href');
		 const skp = document.querySelector('.search-key-php').value;
		 const request = `?selPT=${dpa_href}&q=${skp}`;
		 window.history.pushState({selPT : dpa_href}, "", request);
		 document.title = `ئاڵەکۆک › گەڕان: ${skp}`;
	 });
 });
 function search_deep
 (selPT = which_PT_selected(),
  nums = `pt=${maxPN.value}&bk=${maxBN.value}&pm=${maxRN.value}&k=3`) {
	 const res = document.querySelector(".sli #search-res"),
	       sk = document.querySelector(".search-key-php"),
	       v = sk.value.trim();
	 if(!v) {
		 sk.focus();
		 return;
	 }
	 const loader = "<div class='loader'></div>",
	       request = `${nums}&selPT=${selPT}&q=${v}`,
	       xmlhttp = new XMLHttpRequest();
	 res.innerHTML = loader;
	 xmlhttp.onload = function() {
		 res.innerHTML = this.responseText;
	 }
	 xmlhttp.open("get",
		      `<?php 
echo _R; ?>script/php/search-complete.php?${request}`);
	 xmlhttp.send();
 }
 document.getElementById("search-form").addEventListener(
	 "submit", function(e) {
		 e.preventDefault();
		 const skp = document.querySelector('.search-key-php');
		 const v = skp.value.trim();
		 if(!v) {
			 skp.focus();
			 return;
		 }
		 const pts = (document.querySelector("#cb-pt i").innerHTML !=
			 "check_box_outline_blank") ? maxPN.value : 0,
		       bks = (document.querySelector("#cb-bk i").innerHTML !=
			       "check_box_outline_blank") ? maxBN.value : 0,
		       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML !=
			       "check_box_outline_blank") ? 1 : 0,
		       pms = (document.querySelector("#cb-pm i").innerHTML !=
			       "check_box_outline_blank") ? 2 : 0,
		       pm_sum = pms+pm_nms;
		 let pms_num;
		 if(pm_sum == 0) pms_num = 0;
		 else pms_num = maxRN.value;	 
		 
		 const qqq = `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`,
		       which_PT_selected_res = which_PT_selected();
		 
		 if(which_PT_selected_res !== "") {
			 search_deep(which_PT_selected_res, qqq);
			 request = `?selPT=${which_PT_selected_res}&q=${v}`;
			 window.history.pushState({selPT : which_PT_selected_res},
						  "", request);
			 document.title = `ئاڵەکۆک › گەڕان: ${v}`;
		 }
		 else {
			 search_deep("", qqq);
			 request = `?selPT=&q=${v}`;
			 window.history.pushState({selPT : which_PT_selected_res},
						  "", request);
			 document.title = `ئاڵەکۆک › گەڕان: ${v}`;
		 }
		 document.getElementById("myDropdown").classList.remove("show");
 });
 search_deep("<?php echo @$_GET['selPT']; ?>");
</script>
