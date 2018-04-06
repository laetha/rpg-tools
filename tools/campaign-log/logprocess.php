<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php

// Create variables
$datetemp=$_POST['logdate'];
$entrytemp=$_POST['logentry'];
$coordtemp=$_POST['logcoord'];
$maptemp=$_POST['logmap'];
$date=htmlentities(trim(addslashes($datetemp)));
$entry=htmlentities(trim(addslashes($entrytemp)));
$coord=htmlentities(trim(addslashes($coordtemp)));
$map=htmlentities(trim(addslashes($maptemp)));

//Execute the query
if ($map == 1){
	$sql = "INSERT INTO mapfeatures(coord,text)
					VALUES('$coord','$entry')";

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

}
else {
$sql = "INSERT INTO campaignlog(date,entry,active,coord)
				VALUES('$date','$entry',1,'$coord')";

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

}
?>
