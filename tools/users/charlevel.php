<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$charID = $_REQUEST['charID'];
$str = $_REQUEST['strength'];
$dex = $_REQUEST['dexterity'];
$con = $_REQUEST['constitution'];
$intel = $_REQUEST['intelligence'];
$wis = $_REQUEST['wisdom'];
$cha = $_REQUEST['charisma'];
$maxhp = $_REQUEST['maxhp'];
$charLevel = $_REQUEST['charLevel'];


$sql = "UPDATE characters
SET str = '$str', dex = '$dex', con = '$con', intel = '$intel', wis = '$wis', cha = '$cha', maxhp = '$maxhp', level = '$charLevel'
WHERE id = $charID;";

        if ($dbcon->query($sql) === TRUE) {

        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
