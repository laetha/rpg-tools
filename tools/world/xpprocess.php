<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php

// Create variables
$player1 = 'null';
$player2 = 'null';
$player3 = 'null';
$player4 = 'null';
$player5 = 'null';
$xptemp=$_POST['xp-award'];
$numplayerstemp=$_POST['numplayers'];
$ciaratemp=$_POST['ciara'];
$riordantemp=$_POST['riordan'];
$frukastemp=$_POST['frukas'];
$quynntemp=$_POST['quynn'];
$threadstemp=$_POST['threads'];
$alltemp=$_POST['all'];
$xp=htmlentities(trim(addslashes($xptemp)));
$numplayers=htmlentities(trim(addslashes($numplayerstemp)));
$ciara=htmlentities(trim(addslashes($ciaratemp)));
$riordan=htmlentities(trim(addslashes($riordantemp)));
$frukas=htmlentities(trim(addslashes($frukastemp)));
$quynn=htmlentities(trim(addslashes($quynntemp)));
$threads=htmlentities(trim(addslashes($threadstemp)));
$all=htmlentities(trim(addslashes($alltemp)));
$xp = round($xp / $numplayers);
//Execute the query
if ($ciara == 1){
	$player1 = 'Ciara';

}
if ($riordan == 1){
$player2 = 'Riordan';

}
if ($frukas == 1){
$player3 = 'Frukas';

}
if ($quynn == 1){
$player4 = 'Quynn';

}
if ($threads == 1){
$player5 = 'Threads';

}

if ($all == 1){

$sql = "UPDATE world SET pc_xp = pc_xp + $xp WHERE type LIKE 'player character'";

if ($dbcon->query($sql) === TRUE) {
	?>
<script type="text/javascript">
window.location.href = 'lvlprocess.php';
</script>
<?php
	die();
}
else {
		echo "Error: " . $sql . "<br>" . $dbcon->error;
}

}
else {
	$sql = "UPDATE world SET pc_xp = pc_xp + $xp WHERE title LIKE '$player1' OR title LIKE '$player2' OR title LIKE '$player3' OR title LIKE '$player4' OR title LIKE '$player5'";
	if ($dbcon->query($sql) === TRUE) {
		?>
	<script type="text/javascript">
	window.location.href = 'lvlprocess.php';
	</script>
	<?php
		die();
	}
	else {
			echo "Error: " . $sql . "<br>" . $dbcon->error;
	}
}

?>