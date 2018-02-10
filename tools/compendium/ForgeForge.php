<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../style.css" />
		<title>Compendium</title>
	</head>
	<body>
<?php
	include('../../sql-connect.php');
	$sqlget = "SELECT * FROM npcs";
	$sqldata = mysqli_query($dbcon, $sqlget) or die('error getting data');
	?>
		<div class="container">
			<div class="mainbox">
				<h1 class="pagetitle">ForgeForge</h1>
				<div class="menu">
					<p class ="bodytext" id="body">
						<?php
							$compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE 'forgeforge'";
							$titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
							while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
								echo nl2br($row['body']);
							}
						?>
						</p>
						<?php
							$sqlcompendium = "SELECT * FROM compendium";
							$compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
							while($linkrow = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
							$temp = $linkrow['title'];
							?>
							<script>
							var foundlink = "<?php echo $temp ?>";
							function replace (querytext){
								var bodytext = document.getElementById("body").innerHTML;
								var url = "<a href=\"onenote:https://d.docs.live.net/acd661a65c5fe18b/Documents/Homebrew%20Campaign/Groups%20and%20Organizations.one#" + querytext + "\">" + querytext + "</a>";
								var newtext = bodytext.replace(querytext, url)
								document.getElementById("body").innerHTML = newtext;
							}
							replace(foundlink);

							</script>
							<?php
						}
						?>
				</div>
			</div>
		</div>
	</body>
</html>
