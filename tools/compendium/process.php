<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.html";
include_once($headpath);
// create a variable
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
						//echo "<div class=\"mainbox col-md-12\">";
          	//echo "<h1 class=\"pagetitle\">Success!</h2>";
            //echo "<div class=\"tocbox\"><a href=\"compendium.php?id=$name\">View $name page</a></div>";
            //echo "<div class=\"tocbox\"><a href=\"import.php\">Submit another entry</a><div class=\"tocbox\">";
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.html";
include_once($footpath);
