<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$prof =$_REQUEST['proficiencies'];
$title = $_REQUEST['title'];
$charID = $_REQUEST['charID'];
$saves = $_REQUEST['saves'];
$expertise = $_REQUEST['expertise'];
$str = $_REQUEST['strength'];
$dex = $_REQUEST['dexterity'];
$con = $_REQUEST['constitution'];
$intel = $_REQUEST['intelligence'];
$wis = $_REQUEST['wisdom'];
$cha = $_REQUEST['charisma'];
$maxhp = $_REQUEST['maxhp'];
$hitdice = $_REQUEST['hitdice'];
$speed = $_REQUEST['speed'];
$initiative = $_REQUEST['initiative'];
$armorclass = $_REQUEST['armorclass'];



$sql = "UPDATE characters
SET proficiencies = '$prof', saves = '$saves', expertise = '$expertise', str = '$str', dex = '$dex', con = '$con', intel = '$intel', wis = '$wis', cha = '$cha', maxhp = '$maxhp', hitdice = '$hitdice', speed = '$speed', initiative = '$initiative', armorclass = '$armorclass'
WHERE id = $charID;";

        if ($dbcon->query($sql) === TRUE) {

        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
