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
$id=$_POST['editid'];
$npcfactiontemp=$_POST['npc-faction'];
$npclocationtemp=$_POST['npc-location'];
$npcdeitytemp=$_POST['npc-deity'];
$name=addslashes($nametemp);
$type=addslashes($typetemp);
$body=addslashes($bodytemp);
$npclocation=addslashes($npclocationtemp);
$npcfaction=addslashes($npcfactiontemp);
$npcdeity=addslashes($npcdeitytemp);

//Execute the query
$sql = "UPDATE Compendium
SET title = '$name', type = '$type', body = '$body',  npc_deity = '$npcdeity', npc_location = '$npclocation', npc_faction = '$npcfaction'
WHERE id = $id;";

        if ($dbcon->query($sql) === TRUE) {
					include('edit-modal.php');
					include('compendium.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
