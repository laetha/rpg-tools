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
$player6 = 'null';
$xptemp=$_POST['xp-award'];
$numplayerstemp=$_POST['numplayers'];
$ciaratemp=$_POST['ciara'];
$riordantemp=$_POST['riordan'];
$frukastemp=$_POST['frukas'];
$quynntemp=$_POST['quynn'];
$redferdtemp=$_POST['redferd'];
$sirknighttemp=$_POST['sirknight'];
$garfiretemp=$_POST['garfire'];
$ac3temp=$_POST['ac3'];
$alltemp=$_POST['all'];
$xp=htmlentities(trim(addslashes($xptemp)));
$numplayers=htmlentities(trim(addslashes($numplayerstemp)));
$ciara=htmlentities(trim(addslashes($ciaratemp)));
$riordan=htmlentities(trim(addslashes($riordantemp)));
$frukas=htmlentities(trim(addslashes($frukastemp)));
$quynn=htmlentities(trim(addslashes($quynntemp)));
$redferd=htmlentities(trim(addslashes($redferdtemp)));
$sirknight=htmlentities(trim(addslashes($sirknighttemp)));
$garfire=htmlentities(trim(addslashes($garfiretemp)));
$ac3=htmlentities(trim(addslashes($ac3temp)));
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
if ($redferd == 1){
$player5 = 'Redferd';

}

if ($sirknight == 1){
$player6 = 'Sir Knight';

}

if ($garfire == 1){
$player7 = 'Garfire';

}

if ($ac3 == 1){
$player8 = 'AC3';

}

if ($all == 1){
	$player1 = 'Ciara';
	$player2 = 'Riordan';
	$player4 = 'Garfire';
	$player5 = 'AC3';
}

	$sql = "UPDATE world SET pc_xp = pc_xp + $xp WHERE title LIKE '$player1' OR title LIKE '$player2' OR title LIKE '$player3' OR title LIKE '$player4' OR title LIKE '$player5' OR title LIKE '$player6' OR title LIKE '$player7' OR title LIKE '$player8'";
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


?>
