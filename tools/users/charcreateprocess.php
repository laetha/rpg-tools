<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$title = $_REQUEST['charName'];
$charRace = $_REQUEST['charRace'];
$charClass = $_REQUEST['fullClass'];
$charBackground = $_REQUEST['charBackground'];
$charstr = $_REQUEST['charstr'];
$chardex = $_REQUEST['chardex'];
$charcon = $_REQUEST['charcon'];
$charint = $_REQUEST['charint'];
$charwis = $_REQUEST['charwis'];
$charcha = $_REQUEST['charcha'];
$charUser = $_REQUEST['charUser'];
$charLevel = $_REQUEST['charLevel'];
$hitdice = $_REQUEST['charHitdie'];
$maxhp = $_REQUEST['maxhp'];


$sql = "INSERT INTO characters(title,user,race,class1,background,level,str,dex,con,intel,wis,cha,hitdice,maxhp)
				VALUES('$title','$charUser','$charRace','$charClass','$charBackground','$charLevel','$charstr','$chardex','$charcon','$charint','$charwis','$charcha','$hitdice','$maxhp')";

        if ($dbcon->query($sql) === TRUE) {

        }
				else {
					echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
