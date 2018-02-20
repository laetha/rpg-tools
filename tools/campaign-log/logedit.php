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

$id=$_POST['editid'];
$nametemp=$_POST['editEntry'];
$name=addslashes($nametemp);

//Execute the query
$sql = "UPDATE campaignlog
SET title = '$name'
WHERE id = $id;";

        if ($dbcon->query($sql) === TRUE) {
					include('edit-modal.php');
					include('compendium.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
 ?>
