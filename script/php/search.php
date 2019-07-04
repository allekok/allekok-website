<div id="poets">

    <style>
     .dropbtn {
	 cursor: pointer;
	 padding:0.8em 1em;
     }

     #myInput {
	 width:100%;
     }

     .dropdown {
	 position: relative;
	 display: inline-block;
     }

     .dropdown-content {
	 display: none;
	 position: absolute;
	 background-color: #f6f6f6;
	 min-width: 200px;
	 overflow-y: auto;
	 border: 1px solid #ddd;
	 z-index: 1;
	 max-height:20em;
	 font-size:0.6em;
	 overflow-x:hidden;
	 white-space:nowrap;
	 text-overflow:'..';
	 box-shadow: 0 10px 11px -6px #aaa;
     }

     .dropdown-content a {
	 padding: 0.7em 0.6em;
	 text-decoration: none;
	 display: block;
	 border-bottom:1px solid #eee;
     }

     .dropdown a:hover {background-color: #ddd;}

     .show {display: block;}

     .cb {
	 padding: 1em;
	 font-size: 0.6em;
	 cursor: pointer;
	 border-bottom: 1px solid #eee;
     }

     .cb:hover {
	 background:#eee;
     }
     .cb i {
	 vertical-align:middle;
     }

    </style>

    <script>
     function myFunction() {
	 document.getElementById("myDropdown").classList.toggle("show");
	 filterFunction();
     }

     function filterFunction() {
	 const needle = document.getElementById("myInput").value,
	       context = document.getElementById("myDropdown").querySelectorAll("a");
	 filterp(needle, context);
     }
     
     function isiOS() {
	 return navigator.userAgent.match(/ipad|iphone/i);
     }

     function selectText(e) {
	 let range,
             selection;

	 if (isiOS()) {
             range = document.createRange();
             range.selectNodeContents(e);
             selection = window.getSelection();
             selection.removeAllRanges();
             selection.addRange(range);
             e.setSelectionRange(0, 999999);
	 } else {
             e.select();
	 }
     }
    </script>

    <div>
	<form id="search-form" action="/" method="GET"><input type="text" id="search-key" class='search-key-php' name="q" placeholder="گەڕان بۆ ..." value="<?php echo htmlspecialchars($_GET['q']); ?>"><button type="submit" id="search-btn" class='button'><i class='material-icons' style='font-size:2em;'>search</i></button></form>
    </div>

    <section class='sli' style="text-align:right">
	<div id="search-options">
            <p style='text-align:right;font-size:0.6em;padding-bottom:.6em'>
		گەڕان لە شێعرەکانی: 
            </p>
	    <div style="text-align:center">
		<div class="dropdown">
		    <?php
                    $db = "index";
                    $q = "select takh from auth order by takh ASC";
                    require("condb.php");
                    $os = [];
                    while($o = mysqli_fetch_assoc($query)) {
			
			$os[] = $o;
			if(@$_GET['selPT'] == $o['takh']) {
                            $_selPT = $o['takh'];
			}
                    }
                    mysqli_close($conn);
		    ?>
		    <button onclick="myFunction()" class="dropbtn button"
			    style="font-size:.65em">
			<?php
			if(@$_selPT) {
                            echo $_selPT;
			} else {
			?>
			    تەواوی شاعیران
			<?php } ?>
			<i class='material-icons'>keyboard_arrow_down</i>
		    </button>
		    <div id="myDropdown" class="dropdown-content">
			<input type="text" placeholder="گەڕان..." id="myInput" onkeyup="filterFunction()">
			<a href="">
			    تەواوی شاعیران
			</a>
			<?php
			
			foreach($os as $o) {
			    if(@$_selPT == $o['takh']) {
				echo "<a href='{$o['takh']}' selected='1000'>{$o['takh']}</a>";
			    } else {
				echo "<a href='{$o['takh']}'>{$o['takh']}</a>";
			    }
			}
			
			?>
		    </div>
		</div>
	    </div>
            
            <div style="margin:1em auto" class='chkboxs'>
		<p style='text-align:right;font-size:0.6em;padding-bottom:0.6em'>
                    گەڕان لە: 
		</p>
		<div>
                    <div>
			<div style="" id="cb-pt" class='cb'>
                            <i class='material-icons'>
				check_box
                            </i>
                            <span>
				شاعیران
                            </span>
			</div>
			<form onsubmit="event.preventDefault();search_deep(which_PT_selected(), checks());" style="background: #fff;border-bottom: 1px solid #ddd;padding: 0em .3em;">
                            <p style='text-align: right;font-size: .45em;display: inline-block;width: 50%;box-sizing: border-box;max-width:10em;padding:1.2em 0;vertical-align:middle'>
				ئەژماری شاعیران:</p><input type="text" id="PtsNumTxt" value="10" onfocus="selectText(this)" style="direction: ltr;text-align: center;box-sizing: border-box;font-size: .45em;display: inline-block;width: 23%;max-width: 100px;border: 1px solid #ddd;margin-left: 2%;border-radius: 2px;padding:.7em;vertical-align:middle"><button class='button' type="submit" style="width: 25%;font-size: .45em;text-align: center;box-sizing: border-box;max-width:60px;padding:.7em;vertical-align:middle">
				گەڕان
				</button>
			</form>
                    </div>
                    
		</div>
		<div>
                    <div style="" id="cb-bk" class='cb'>
			<i class='material-icons'>
                            check_box
			</i>
			<span>
                            کتێبەکان
			</span>
                    </div>
                    <form onsubmit="event.preventDefault();search_deep(which_PT_selected(), checks());" style="background: #fff;border-bottom: 1px solid #ddd;padding: 0em .3em;">
			<p style='text-align: right;font-size: .45em;display: inline-block;width: 50%;box-sizing: border-box;max-width:10em;padding:1.2em 0;vertical-align:middle'>
			    ئەژماری کتێبەکان:</p><input type="text" id="BksNumTxt" value="10" onfocus="selectText(this)" style="direction: ltr;text-align: center;box-sizing: border-box;font-size: .45em;display: inline-block;width: 23%;max-width: 100px;border: 1px solid #ddd;margin-left: 2%;border-radius: 2px;padding:.7em;vertical-align:middle"><button class='button' type="submit" style="width: 25%;font-size: .45em;text-align: center;box-sizing: border-box;max-width:60px;padding:.7em;vertical-align:middle">
                            گەڕان
			    </button>
                    </form>
		</div>
		<div style="" id="cb-pm-nm" class='cb'>
                    <i class='material-icons'>
			check_box
                    </i>
                    <span>
			نێوی شێعرەکان
                    </span>
		</div>
		<div>
                    <div style="" id="cb-pm" class='cb'>
			<i class='material-icons'>
                            check_box
			</i>
			<span>
                            دەقی شێعرەکان
			</span>
                    </div>
                    <form onsubmit="event.preventDefault();search_deep(which_PT_selected(), checks());" style="background: #fff;border-bottom: 1px solid #ddd;box-shadow: 0 5px 10px -5px #ddd;padding: 0em .3em;">
			<p style='text-align: right;font-size: .45em;display: inline-block;width: 50%;box-sizing: border-box;max-width:10em;padding:1.2em 0;vertical-align:middle'>
			    ئەژماری شێعرەکان:</p><input type="text" id="ResNumTxt" value="10" onfocus="selectText(this)" style="direction: ltr;text-align: center;box-sizing: border-box;font-size: .45em;display: inline-block;width: 23%;max-width: 100px;border: 1px solid #ddd;margin-left: 2%;border-radius: 2px;padding:.7em;vertical-align:middle"><button class='button' type="submit" style="width: 25%;font-size: .45em;text-align: center;box-sizing: border-box;max-width:60px;padding:.7em;vertical-align:middle">
                            گەڕان
			    </button>
                    </form>
		</div>
		<script>
		 const maxRN = document.querySelector("#ResNumTxt"),
		       maxBN = document.querySelector("#BksNumTxt"),
		       maxPN = document.querySelector("#PtsNumTxt");
		 
		 function checks () {
                     const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? maxPN.value : 0,
			   bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? maxBN.value : 0,
			   pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 1 : 0,
			   pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 2 : 0,
			   pm_sum = pms+pm_nms,
			   pms_num = maxRN.value;
                     if(pm_sum == 0) {
			 pms_num = 0;
                     }
                     
                     const res = `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`;
                     return res;
		 }

		 function which_PT_selected() {
                     const dpas = document.querySelectorAll(".dropdown-content a");
		     let dpass = [];
		     
                     for(let i=0; i<dpas.length; i++) {
			 dpass.push([dpas[i].getAttribute("selected"),i]);
                     }
                     dpass = dpass.sort();
                     dpass = dpass.reverse();
                     if(dpass[0][0] != null) {
			 
			 return dpas[dpass[0][1]].getAttribute("href");
                     } else {
			 return "";
                     }
		 }
		 function toggle_checkbox(e, nu) {
                     
                     if(e.innerHTML != "check_box_outline_blank") {
			 e.innerHTML = "check_box_outline_blank";
                     } else {
			 e.innerHTML = "check_box";
                     }
                     search_deep(which_PT_selected(), nu);
                     
		 }
		 document.querySelector("#cb-pt").onclick = function() {
                     const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? 0 : maxPN.value,
			   bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? maxBN.value : 0,
			   pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 1 : 0,
			   pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 2 : 0,
			   pm_sum = pms+pm_nms,
			   pms_num = maxRN.value;
                     if(pm_sum == 0) {
			 pms_num = 0;
                     } 
                     
                     toggle_checkbox(document.querySelector("#cb-pt i"), `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
		 }
		 document.querySelector("#cb-bk").onclick = function() {
                     const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? maxPN.value : 0,
			   bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? 0 : maxBN.value,
			   pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 1 : 0,
			   pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 2 : 0,
			   pm_sum = pms+pm_nms,
			   pms_num = maxRN.value;
                     if(pm_sum == 0) {
			 pms_num = 0;
                     } 
                     
                     toggle_checkbox(document.querySelector("#cb-bk i"), `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
		 }
		 document.querySelector("#cb-pm-nm").onclick = function() {
                     const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? maxPN.value : 0,
			   bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? maxBN.value : 0,
			   pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 0 : 1,
			   pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 2 : 0,
			   pm_sum = pms+pm_nms,
			   pms_num = maxRN.value;
                     if(pm_sum == 0) {
			 pms_num = 0;
                     } 
                     
                     toggle_checkbox(document.querySelector("#cb-pm-nm i"), `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
		 }
		 document.querySelector("#cb-pm").onclick = function() {
                     const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? maxPN.value : 0,
			   bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? maxBN.value : 0,
			   pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 1 : 0,
			   pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 0 : 2,
			   pm_sum = pms+pm_nms,
			   pms_num = maxRN.value;
                     if(pm_sum == 0) {
			 pms_num = 0;
                     } 
                     
                     toggle_checkbox(document.querySelector("#cb-pm i"), `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`);
		 }
		 
		</script>
            </div>
	</div>
	
	<script>
         
         const dpas = document.querySelectorAll(".dropdown-content a");
         dpas.forEach(function(dpa) {
             dpa.addEventListener("click", function(e) {
                 e.preventDefault();
                 document.querySelector(".dropbtn").innerHTML = dpa.innerHTML;
                 dpa.setAttribute("selected",Date.now());
                 
                 const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? maxPN.value : 0,
		       bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? maxBN.value : 0,
		       pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 1 : 0,
		       pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 2 : 0,
		       pm_sum = pms+pm_nms,
		       pms_num = maxRN.value;
                 if(pm_sum == 0) {
                     pms_num = 0;
                 } 
                 
                 const qqq = `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`;
                 
                 search_deep(dpa.getAttribute("href"), qqq);
                 document.getElementById("myDropdown").classList.remove("show");
                 
                 const request = `?selPT=${dpa.getAttribute('href')}&q=${document.querySelector('.search-key-php').value}`;
                 window.history.pushState({selPT : dpa.getAttribute('href')}, "", request);
                 document.title = `ئاڵەکۆک » گەڕان: ${document.querySelector('.search-key-php').value}`;
                 
             });
         });
         
	 function search_deep(selPT=which_PT_selected(), nums=`pt=${maxPN.value}&bk=${maxBN.value}&pm=${maxRN.value}&k=3`) {
             const res = document.querySelector(".sli #search-res"),
		   sk = document.querySelector(".search-key-php");
             
             if(sk.value == "") {
		 sk.focus();
		 return;
             }
             const loader = "<div class='loader'></div>",
		   request = `${nums}&selPT=${selPT}&q=${sk.value}`,
		   xmlhttp = new XMLHttpRequest();
             res.innerHTML = loader;
             xmlhttp.onload = function() {
		 res.innerHTML = this.responseText;
             }
             xmlhttp.open("get",`/script/php/search-complete.php?${request}`);
             xmlhttp.send();
	 }
	 
	 document.querySelector("#search-form").addEventListener("submit", function(e) {
             e.preventDefault();
             if(document.querySelector('.search-key-php').value == "") {
		 document.querySelector('.search-key-php').focus();
		 return;
             }
             
	     const pts = (document.querySelector("#cb-pt i").innerHTML != "check_box_outline_blank") ? maxPN.value : 0,
		   bks = (document.querySelector("#cb-bk i").innerHTML != "check_box_outline_blank") ? maxBN.value : 0,
		   pm_nms = (document.querySelector("#cb-pm-nm i").innerHTML != "check_box_outline_blank") ? 1 : 0,
		   pms = (document.querySelector("#cb-pm i").innerHTML != "check_box_outline_blank") ? 2 : 0,
		   pm_sum = pms+pm_nms,
		   pms_num = maxRN.value;
             if(pm_sum == 0) {
                 pms_num = 0;
             } 
             
             const qqq = `pt=${pts}&bk=${bks}&pm=${pms_num}&k=${pm_sum}`,
		   which_PT_selected_res = which_PT_selected();
             
             if(which_PT_selected_res !== "") {
		 search_deep(which_PT_selected_res, qqq);
		 
		 request = `?selPT=${which_PT_selected()}&q=${document.querySelector('.search-key-php').value}`;
                 window.history.pushState({selPT : which_PT_selected()}, "", request);
                 document.title = `ئاڵەکۆک » گەڕان: ${document.querySelector('.search-key-php').value}`;
             } else {
		 search_deep("", qqq);
		 
		 request = `?selPT=&q=${document.querySelector('.search-key-php').value}`;
                 window.history.pushState({selPT : which_PT_selected()}, "", request);
                 document.title = `ئاڵەکۆک » گەڕان: ${document.querySelector('.search-key-php').value}`;
             }
             document.getElementById("myDropdown").classList.remove("show");
	 })
	</script>
	
    </section><section class='sli'>
	<div id="search-res" style="display:block;max-width:unset">
	    <script>
             search_deep("<?php echo @$_GET['selPT'];?>");
	    </script>
	</div></section>

</div>
