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
$npcracetemp=$_POST['npc-race'];
$npcfactiontemp=$_POST['npc-faction'];
$npcesttemp=$_POST['npc-establishment'];
$npclocationtemp=$_POST['npc-location'];
$npcdeitytemp=$_POST['npc-deity'];
$estlocationtemp=$_POST['est-location'];
$queststatustemp=$_POST['quest-status'];
$questfactiontemp=$_POST['quest-faction'];
$questrewardtemp=$_POST['quest-reward'];
$esttypetemp=$_POST['est-type'];
$name=htmlentities(trim(addslashes($nametemp)));
$type=htmlentities(trim(addslashes($typetemp)));
$body=htmlentities(trim(addslashes($bodytemp)));
$npcrace=htmlentities(trim(addslashes($npcracetemp)));
$npclocation=htmlentities(trim(addslashes($npclocationtemp)));
$npcfaction=htmlentities(trim(addslashes($npcfactiontemp)));
$npcdeity=htmlentities(trim(addslashes($npcdeitytemp)));
$npcest=htmlentities(trim(addslashes($npcesttemp)));
$estlocation=htmlentities(trim(addslashes($estlocationtemp)));
$esttype=htmlentities(trim(addslashes($esttypetemp)));
$queststatus=htmlentities(trim(addslashes($queststatustemp)));
$questfaction=htmlentities(trim(addslashes($questfactiontemp)));
$questreward=htmlentities(trim(addslashes($questrewardtemp)));

/*
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
*/
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = $name . '.' . end($temp);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . $newfilename);

//Execute the query
$sql = "UPDATE world
SET title = '$name', type = '$type', body = '$body', npc_race = '$npcrace', npc_deity = '$npcdeity', npc_location = '$npclocation', npc_faction = '$npcfaction', npc_est = '$npcest', est_type = '$esttype', est_location = '$estlocation', quest_status = '$queststatus', quest_faction = '$questfaction', quest_reward = '$questreward'
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
