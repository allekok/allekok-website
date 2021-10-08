<?php
require_once("session.php");
require_once("../constants.php");
require_once("../colors.php");
require_once("../functions.php");

$title = $_TITLE . " › پەراوێزی شیعرەکان";
$desc = "پەراوێزی شیعرەکان";
$keys = $_KEYS;
$t_desc = "";

require_once("../header.php");
?>
<div id="poets" style="font-size:.55em;text-align:right">
	<h1 style="font-size:2em" class="color-blue">
		پەراوێزی شیعرەکان
	</h1>
	<section class="pitewsec" style="padding-right:1em">
		<?php
		$q = "SELECT * FROM `comments` ORDER BY `id` DESC";
		require_once("../condb.php");
		if(mysqli_num_rows($query) > 0) {
			while($res = mysqli_fetch_assoc($query)) {
				$class = "";
				$id = num_convert($res["id"],
						  "en",
						  "ckb");
				if($res["name"] === "")
					$res["name"] = "ناشناس";
				if(!$res["read"])
					$class = "class='color-blue'";
				if($res["blocked"])
					$class = "class='color-red'";
				echo "<div style='display:flex;" .
				     "border-top:1px solid'><div " .
				     "style='width:100%' {$class}>" .
				     "{$id}. {$res['name']}</div>" .
				     "<a style='width:100%' href='" .
				     "/{$res['address']}'>دەق</a>" .
				     "<a target='_blank' style='" .
				     "width:100%' href='comment-" .
				     "read.php?id={$res['id']}' " .
				     "class='comm-act'>" .
				     "خوێندمەوە / نەمخوێندەوە</a><a " .
				     "target='_blank' style='" .
				     "width:100%' href='comment-" .
				     "block.php?id={$res['id']}' " .
				     "class='comm-act'>" .
				     "بیسووتێنە / بیکوژێنەوە</a></div>";
			}
		?>
		<script>
		 const comm_links = document.querySelectorAll(
			 ".comm-act")
		 comm_links.forEach(i => {
			 const request = i.href
			 i.addEventListener("click", e => {
				 e.preventDefault()
				 const x = new XMLHttpRequest()
				 x.onload = () => {
					 if(x.responseText != 1)
						 return
					 i.innerHTML +=
						 " <i style='font-" +
						 "size:inherit' " +
						 "class='material-" +
						 "icons'>check</i>"
				 }
				 x.open("get", request)
				 x.send()
			 })
		 })
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
require_once("../footer.php");
?>
