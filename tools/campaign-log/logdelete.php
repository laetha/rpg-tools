<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("compendium/{$tmp_action}.php")*/)
        $id = $tmp_action;

  }

//Execute the query
$sql = "UPDATE campaignlog
SET active = '0'
WHERE id = $id;";

        if ($dbcon->query($sql) === TRUE) {
          header("Location: campaign-log.php");
          die();
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
 ?>
