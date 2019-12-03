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
$raceSizetemp=$_POST['raceSize'];
$raceSpeedtemp=$_POST['raceSpeed'];
$raceAbilitytemp=$_POST['raceAbility'];
$raceSpellAbilitytemp=$_POST['raceSpellAbility'];
$raceProficiencytemp=$_POST['raceProficiency'];
$raceTraitstemp=$_POST['raceTraits'];

$name=htmlentities(trim(addslashes($nametemp)));
$type=htmlentities(trim(addslashes($typetemp)));
$raceSize=htmlentities(trim(addslashes($raceSizetemp)));
$raceSpeed=htmlentities(trim(addslashes($raceSpeedtemp)));
$raceAbility=htmlentities(trim(addslashes($raceAbilitytemp)));
$raceSpellAbility=htmlentities(trim(addslashes($raceSpellAbilitytemp)));
$raceProficiency=htmlentities(trim(addslashes($raceProficiencytemp)));
$raceTraits=htmlentities(trim(addslashes($raceTraitstemp)));


//Execute the query
$sql = "INSERT INTO compendium(title,type,raceSize,raceSpeed,raceAbility,raceSpellAbility,raceProficiency,raceTraits)
				VALUES('$name','$type','$raceSize','$raceSpeed','$raceAbility','$raceSpellAbility','$raceProficiency','$raceTraits')";

        if ($dbcon->query($sql) === TRUE) {
					include('success.php');
					include('dbimport.php');
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
