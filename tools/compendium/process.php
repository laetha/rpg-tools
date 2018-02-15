<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.html";
include_once($headpath);

// Create variables
$nametemp=$_POST['name'];
$typetemp=$_POST['type'];
$bodytemp=$_POST['body'];
$name=addslashes($nametemp);
$type=addslashes($typetemp);
$body=addslashes($bodytemp);

//Execute the query
$sql = "INSERT INTO compendium(title,type,body)
				VALUES('$name','$type','$body')";

        if ($dbcon->query($sql) === TRUE) {
					include('success.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.html";
include_once($footpath);
