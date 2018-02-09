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
	$sqlcompendium = "SELECT * FROM compendium";
	$compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
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
						<script>
						<?php
							while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
								echo "TEST"
						?>
								window.onload = myFunction("<?php echo $row['title'] ?>")
						<?php
							}
						?>
						//window.onload = myFunction("ForgeForge")
					function myFunction(querytext) {
    			var bodytext = document.getElementById("demo").innerHTML;
    			var n = bodytext.search(querytext);
					if (n !== -1){
						var newtext = bodytext.replace("<?php echo $row['title'] ?>", "<a href=\"onenote:https://d.docs.live.net/acd661a65c5fe18b/Documents/Homebrew%20Campaign/Groups%20and%20Organizations.one#ForgeForge\"><?php echo $row['title'] ?></a>")
					}
					else{
						newtext = bodytext;
					}
    document.getElementById("demo").innerHTML = newtext;
	}
					</script>
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
