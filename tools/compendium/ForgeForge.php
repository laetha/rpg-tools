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
					<p class ="bodytext" id="demo">
						<?php
							$compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE 'forgeforge'";
							$titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
							while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
								echo $row['body'];
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
								var bodytext = document.getElementById("demo").innerHTML;
								var querylower = querytext.toLowerCase();
								var url = "<a href=\"onenote:https://d.docs.live.net/acd661a65c5fe18b/Documents/Homebrew%20Campaign/Groups%20and%20Organizations.one#" + querylower + "\">" + querytext + "</a>";
								var queryexp = new RegExp(querytext, "gi");
								var newtext = bodytext.replace(queryexp, url)
								document.getElementById("demo").innerHTML = newtext;
							}
							replace(foundlink);

							</script>
							<?php
						}
						?>
				</div>
				<?php
					echo '<table>';
					echo '<tr><th>ID</th><th>Name</th><th>Race</th><th>Job</th></tr>';
					while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
						echo '<tr><td>';
						echo $row['id'];
						echo '<td>'	;
						echo $row['name'];
						echo '<td>'	;
						echo $row['race'];
						echo '<td>'	;
						echo $row['job'];
						echo '</tr>';
					}
		echo '</table>';
				?>
			</div>
		</div>
	</body>
</html>
