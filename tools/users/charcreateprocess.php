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
$charLevel = 1;

$sql = "INSERT INTO characters(title,user,race,class1,background,level,str,dex,con,intel,wis,cha)
				VALUES('$title','$charUser','$charRace','$charClass','$charBackground','$charLevel','$charstr','$chardex','$charcon','$charint','$charwis','$charcha')";

        if ($dbcon->query($sql) === TRUE) {

        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
