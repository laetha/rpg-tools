<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
if (!empty($_GET['editid'])) {
  $tmp_action = basename($_GET['editid']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
        $id = $tmp_action;

  }
  $entrytemp=$_POST['editentry'.$id];
  $date=$_POST['editdate'.$id];
  $entry=htmlentities(trim(addslashes($entrytemp)));
//Execute the query
$sql = "UPDATE campaignlog
SET entry = '$entry', date = '$date'
WHERE id = $id;";

        if ($dbcon->query($sql) === TRUE) {
          ?>
<script type="text/javascript">
window.location.href = 'campaign-log.php';
</script>
<?php
          die();
        }
				else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
//Footer
 ?>
