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
$nametemp=$_POST['name'];
$typetemp=$_POST['type'];
$bodytemp=$_POST['body'];
$npcfactiontemp=$_POST['npc-faction'];
$npcesttemp=$_POST['npc-establishment'];
$npclocationtemp=$_POST['npc-location'];
$npcdeitytemp=$_POST['npc-deity'];
$estlocationtemp=$_POST['est-location'];
$esttypetemp=$_POST['est-type'];
$name=htmlentities(trim(addslashes($nametemp)));
$type=htmlentities(trim(addslashes($typetemp)));
$body=htmlentities(trim(addslashes($bodytemp)));
$npclocation=htmlentities(trim(addslashes($npclocationtemp)));
$npcfaction=htmlentities(trim(addslashes($npcfactiontemp)));
$npcdeity=htmlentities(trim(addslashes($npcdeitytemp)));
$npcest=htmlentities(trim(addslashes($npcesttemp)));
$estlocation=htmlentities(trim(addslashes($estlocationtemp)));
$esttype=htmlentities(trim(addslashes($esttypetemp)));

//Execute the query
$sql = "UPDATE world
SET title = '$name', type = '$type', body = '$body',  npc_deity = '$npcdeity', npc_location = '$npclocation', npc_faction = '$npcfaction', npc_est = '$npcest', est_type = '$esttype', est_location = '$estlocation'
WHERE id = $id;";

        if ($dbcon->query($sql) === TRUE) {
					include('edit-modal.php');
					include('world.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }

//Footer
 ?>
