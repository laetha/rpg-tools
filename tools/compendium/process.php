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
$sql = "INSERT INTO compendium(title,type,body,npc_location,npc_faction,npc_deity)
				VALUES('$name','$type','$body','$npclocation','$npcfaction','$npcdeity')";

        if ($dbcon->query($sql) === TRUE) {
					include('import.php');
					include('success.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
