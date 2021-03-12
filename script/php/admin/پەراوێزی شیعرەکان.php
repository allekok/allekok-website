<?php
require('session.php');
include_once("../constants.php");
include_once(ABSPATH . "script/php/colors.php");
include_once(ABSPATH . "script/php/functions.php");

$title = $_TITLE . " - تازەکان";
$desc = "تازەکانی ئاڵەکۆک";
$keys = $_KEYS;
$t_desc = "";

include(ABSPATH . "script/php/header.php");
?>

<div id="poets" style="font-size:.55em;
	 text-align:right;padding-right:1em">
	<h1 style="font-size:2em" class="color-blue">
		پەراوێزی شیعرەکان
	</h1>
	
	<section class='pitewsec' style="padding-right:1em">
		<?php
		$q = "select * from `comments` order by `id` DESC";

		include(ABSPATH . "script/php/condb.php");
		
		if(mysqli_num_rows($query)>0) {
			while($res = mysqli_fetch_assoc($query)) {
				$class = "";
				$id = num_convert($res['id'], "en", "ckb");
				
				if($res['name'] === "")    $res['name'] = "ناشناس";
				if(!$res['read'])
					$class = "class='color-blue'";
				if($res['blocked'])
					$class = "class='color-red'";
				
				echo "<div style='display:flex;border-top:1px solid'><div style='width:100%' {$class}>{$id}. {$res['name']}</div><a style='width:100%' href='/{$res['address']}'>دەق</a><a target='_blank' style='width:100%' href='comment-read.php?id={$res['id']}' class='comm-act'>خوێندمەوە / نەمخوێندەوە</a><a target='_blank' style='width:100%' href='comment-block.php?id={$res['id']}' class='comm-act'>بیسووتێنە / بیکوژێنەوە</a></div>";
				$a++;
			}
		?>
		
		<script>
		 const comm_links = document.querySelectorAll(".comm-act");
		 
		 comm_links.forEach((i) => {
			 
			 const request = i.href;
			 
			 i.addEventListener("click", function(e) {
				 e.preventDefault();
				 var xmlhttp = new XMLHttpRequest();
				 xmlhttp.onload = function() {
					 if(this.responseText == 1) {
						 i.innerHTML += " <i style='font-size:inherit' class='material-icons'>check</i>";
					 }
				 }
				 xmlhttp.open("get", request);
				 xmlhttp.send(); 
			 });
			 
		 });
		</script>
		
                <?php
		} else {
			echo "<div class='color-blue'>&bull;</div>";
		}

		mysqli_close($conn);
		?>
	</section>	
</div>
<?php
include_once(ABSPATH . "script/php/footer.php");
?>
