<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);

$encounter = $_REQUEST['encounter'];
$worlduser = $_REQUEST['worlduser'];
$type = 'encounter';
$sqlcompendium = "INSERT INTO `world`(title,type,worlduser)
                  VALUES ('$encounter','$type','$worlduser')";


        if ($dbcon->query($sqlcompendium) === TRUE) {
        }
				else {
        }

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
