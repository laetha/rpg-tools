<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

// Create variables
$datetemp=$_POST['logdate'];
$entrytemp=$_POST['logentry'];
$date=addslashes($datetemp);
$entry=addslashes($entrytemp);

//Execute the query
$sql = "INSERT INTO campaignlog(date,entry,active)
				VALUES('$date','$entry',1)";

        if ($dbcon->query($sql) === TRUE) {
					include('logmodal.php');
					include('campaign-log.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
