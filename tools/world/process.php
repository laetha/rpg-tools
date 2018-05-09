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
$coordtemp=$_POST['coord'];
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
$coord=htmlentities(trim(addslashes($coordtemp)));

$temp = explode(".", $_FILES["fileToUpload1"]["name"]);

if (end($temp) == 'jpg' OR end($temp) == 'png') {
	$newfilename = $name . '.' . end($temp);
	$newfilename1 = str_replace("'", "", $newfilename);
	$newfilename1 = stripslashes($newfilename1);
	move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], "uploads/" . $newfilename1);
}

//Execute the query
$sql = "INSERT INTO world(title,type,body,npc_race,npc_location,npc_faction,npc_deity,npc_est,est_type,est_location,quest_status,quest_faction,quest_reward,coord)
				VALUES('$name','$type','$body','$npcrace','$npclocation','$npcfaction','$npcdeity','$npcest','$esttype','$estlocation','$queststatus','$questfaction','$questreward','$coord')";

        if ($dbcon->query($sql) === TRUE) {
					include('success.php');
					include('import.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
