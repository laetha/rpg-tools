<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$worlduser =$_REQUEST['worlduser'];
$date = $_REQUEST['date'];
$entry = $_REQUEST['entry'];
$active = $_REQUEST['active'];


$sql = "INSERT INTO campaignlog(worlduser,date,entry,active)
				VALUES('$worlduser','$date','$entry','$active')";

        if ($dbcon->query($sql) === TRUE) {
					
        }
				else {

        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
