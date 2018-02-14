<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<?php

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
            echo "Success!";
            echo "<a href=\"compendium.php?id='.$name\">View $name page</a>";
            echo "<a href=\"import.php\">Submit another entry</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
