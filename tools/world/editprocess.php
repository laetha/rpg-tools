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
$codetemp=$_POST['code'];
$bodytemp=$_POST['body'];
$npcracetemp=$_POST['npc-race'];
$npcfactiontemp=$_POST['npc-faction'];
$npcesttemp=$_POST['npc-establishment'];
$npclocationtemp=$_POST['npc-location'];
$npcdeitytemp=$_POST['npc-deity'];
$npctitletemp=$_POST['npc-title'];
$estlocationtemp=$_POST['est-location'];
$queststatustemp=$_POST['quest-status'];
$questfactiontemp=$_POST['quest-faction'];
$questrewardtemp=$_POST['quest-reward'];
$esttypetemp=$_POST['est-type'];
$coordtemp=$_POST['coord'];
$name=htmlentities(trim(addslashes($nametemp)));
$type=htmlentities(trim(addslashes($typetemp)));
$code=htmlentities(trim(addslashes($codetemp)));
$body=htmlentities(trim(addslashes($bodytemp)));
$npcrace=htmlentities(trim(addslashes($npcracetemp)));
$npclocation=htmlentities(trim(addslashes($npclocationtemp)));
$npcfaction=htmlentities(trim(addslashes($npcfactiontemp)));
$npcdeity=htmlentities(trim(addslashes($npcdeitytemp)));
$npcest=htmlentities(trim(addslashes($npcesttemp)));
$npctitle=htmlentities(trim(addslashes($npctitletemp)));
$estlocation=htmlentities(trim(addslashes($estlocationtemp)));
$esttype=htmlentities(trim(addslashes($esttypetemp)));
$queststatus=htmlentities(trim(addslashes($queststatustemp)));
$questfaction=htmlentities(trim(addslashes($questfactiontemp)));
$questreward=htmlentities(trim(addslashes($questrewardtemp)));
$coord=htmlentities(trim(addslashes($coordtemp)));


$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = $name . '.' . end($temp);
if (end($temp) == 'jpg' OR end($temp) == 'png') {
$newfilename1 = str_replace("'", "", $newfilename);
$newfilename1 = stripslashes($newfilename1);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . $newfilename1);
}

//Execute the query
$sql = "UPDATE world
SET title = '$name', type = '$type', code = '$code', body = '$body', npc_race = '$npcrace', npc_deity = '$npcdeity', npc_location = '$npclocation', npc_faction = '$npcfaction', npc_est = '$npcest', npc_title = '$npctitle', est_type = '$esttype', est_location = '$estlocation', quest_status = '$queststatus', quest_faction = '$questfaction', quest_reward = '$questreward', coord = '$coord'
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
